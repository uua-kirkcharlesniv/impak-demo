<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Group;
use App\Models\Survey;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use MattDaneshvar\Survey\Models\Entry;

class TenantApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))) {
            return response()->json(['data' => 'Invalid Credentials'], 422);
        }

        $user = User::findOrFail(Auth::user()->id);

        $accessToken = $user->createToken('moveupapp')->plainTextToken;

        return response()->json(['user' => $user, 'access_token' => $accessToken]);
    }

    public function communityList(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:groups,departments'
        ]);

        if ($request->input('type') == 'groups') {
            $data = Group::with('members')->get();
        } else {
            $data = Department::with('members')->get();
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function availableSurveys(Request $request)
    {
        $campaigns = Survey::where('publish_status', 'published')->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->latest()->get();

        $user = Auth::user();

        $campaigns = $campaigns->filter(function ($survey) use ($user) {
            return $survey->isEligible($user) && $survey->is_targeted == true;
        });

        return response()->json([
            'data' => [...$campaigns],
        ]);
    }

    public function completedSurveys(Request $request)
    {
        $campaigns = Survey::where('publish_status', '!=', 'draft')->latest()->get();

        $user = Auth::user();

        $campaigns = $campaigns->filter(function ($survey) use ($user) {
            return $survey->entriesFrom($user)->count() > 0;
        });

        return response()->json([
            'data' => [...$campaigns],
        ]);
    }

    public function getSurvey($id, Request $request)
    {
        $survey = Survey::with('sections', 'sections.questions')->findOrFail($id);

        return response()->json([
            'data' => $survey,
        ]);
    }

    public function submitSurvey($id, Request $request)
    {
        $survey = Survey::findOrFail($id);

        $answers = $this->validate($request, $survey->rules, [
            'required' => 'This field is required',
            'min' => 'Must at least pick :min choices.',
            'max' => 'Maximum of :max choices only.'
        ]);

        (new Entry)->for($survey)->by(Auth::user())->fromArray($answers)->push();

        return response()->json([
            'message' => 'Success',
        ]);
    }

    public function validateAnswer(Request $request)
    {
        $request->validate([
            'key' => 'required',
            'answer' => 'nullable',
            'rules' => 'nullable',
        ]);

        $validator = Validator::make([
            $request->key => $request->answer
        ], [
            $request->key => $request->rules
        ], [
            'required' => 'This field is required',
            'min' => 'Must at least pick :min choices.',
            'max' => 'Maximum of :max choices only.'
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                return response()->json([
                    'message' => $error,
                ], 422);
            }
            return;
        } else {
            return response()->json([
                'message' => $request->rules,
            ]);
        }
    }

    public function changePassword(Request $request): JsonResponse
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password'
        ]);

        if (!Hash::check($request->input('old_password'), Auth::user()->password)) {
            return response()->json([
                'message' => 'Invalid old password.'
            ], 400);
        }

        if (Hash::check($request->input('new_password'), Auth::user()->password)) {
            return response()->json([
                'message' => 'Your new password must not be the same as your old password.'
            ], 400);
        }

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->input('new_password'))
        ]);

        return response()->json([
            'message' => 'Successfully changed your password.'
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'email' => 'email|nullable|unique:users,email,' . $user->id,
            'last_name' => 'nullable|max:55',
            'first_name' => 'nullable|max:55',
            'phone' => 'nullable|string',
        ]);

        User::where('id', $user->id)->update(array_filter($data));

        return response()->json([
            'message' => 'Successfully updated profile.',
            'data' => User::findOrFail($user->id),
        ]);
    }

    public function deactivateAccount()
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->delete();

        return response()->json([
            'message' => 'Successfully deleted user.'
        ]);
    }
}
