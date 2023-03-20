<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnboardController extends Controller
{
    public function finishOnboard()
    {
        Auth::user();
        $user = User::findOrFail(Auth::user()->id);
        $user->is_onboarded = true;
        $user->save();

        return redirect()->route('dashboard');
    }
}
