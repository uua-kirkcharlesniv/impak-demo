<?php

namespace App\Http\Controllers;

use App\Models\CentralUser;
use App\Models\Invite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InviteController extends Controller
{
    public function accept($token)
    {
        $invite = Invite::where('token', $token)->first();

        if (!$invite) {
            abort(404);
        }

        return view('pages/accept-invite')->with([
            'token' => $token
        ]);
    }

    public function processAccept(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'token' => 'required|string'
        ]);

        $invite = Invite::where('token', $request->token)->first();

        if (!$invite) {
            abort(404);
        }

        $globalId = Str::orderedUuid();

        $existingUser = CentralUser::where('email', $invite->email)->first();

        if ($existingUser) {
            $globalId = $existingUser->global_id;
        }

        $userData = [
            'global_id' => $globalId,
            'first_name' => $invite->first_name,
            'last_name' => $invite->last_name,
            'email' => $invite->email,
            'password' => Hash::make($request->password),
        ];

        if (!$existingUser) {
            CentralUser::create($userData);
        }

        try {
            User::create($userData);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $refetchedLocal = User::where('global_id', $globalId)->first();
        if ($refetchedLocal) {
            auth()->login($refetchedLocal);
            $refetchedLocal->assignRole('employee');
        }

        $invite->delete();

        return redirect()->route('login');
    }
}
