<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Group;
use App\Models\Survey;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $data = Group::all();
        } else {
            $data = Department::all();
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
            'data' => $campaigns,
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
}
