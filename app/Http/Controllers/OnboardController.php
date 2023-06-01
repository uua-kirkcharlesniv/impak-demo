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
        $user->createAsCustomer([
            'trial_ends_at' => now()->addDays(7)
        ]);        

        return redirect()->route('dashboard');
    }
}
