<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $accessToken = $user->createToken('moveupapp')->accessToken;

        return response()->json(['user' => $user, 'access_token' => $accessToken]);
    }
}
