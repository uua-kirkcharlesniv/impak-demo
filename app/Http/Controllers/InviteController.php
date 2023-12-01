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
        $userData = [
            'global_id' => $globalId,
            'first_name' => $invite->first_name,
            'last_name' => $invite->last_name,
            'email' => $invite->email,
            'password' => Hash::make($request->password),
        ];

        $centralUserAccount = CentralUser::create($userData);
        $localAccount = User::create($userData);

        try {
            $refetchedLocal = User::findOrFail($localAccount->id);
            $refetchedLocal->assignRole('employee');
        } catch (\Throwable $th) {
            //throw $th;
        }

        return redirect()->route('login');
    }
}
