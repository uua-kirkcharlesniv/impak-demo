<?php

use App\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\OnboardController;
use App\Http\Controllers\RegisteredTenantController;
use App\Models\CentralUser;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::redirect('/', 'login');
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('centralDashboard');
    } else {
        return redirect()->route('sso-login');
    }
    // return view('home/index');
})->name('index');
Route::get('/features', function () {
    return view('home/features');
})->name('features');
Route::get('/pricing', function () {
    return view('home/pricing');
})->name('pricing');
Route::get('/about', function () {
    return view('home/about');
})->name('about');
Route::get('/contact', function () {
    return view('home/contact');
})->name('contact');
Route::get('/help', function () {
    return view('home/help');
})->name('help');

Route::middleware(['guest'])->group(function () {
    Route::get('/register', function () {
        return view('auth/new-register');
    })->name('register');
    Route::post('/register', [RegisteredTenantController::class, 'store']);
    Route::post('/create-account', [RegisteredTenantController::class, 'createCentralAccount'])->name('create-account');
    Route::get('/login', function () {
        return view('auth/sso-login');
    })->name('sso-login');
    Route::post('processCentralLogin', [AuthenticatedSessionController::class, 'ssoLogin'])->name('processCentralLogin');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthenticatedSessionController::class, 'centralDashboard'])->name('centralDashboard');
    Route::post('/logout', [AuthenticatedSessionController::class, 'logoutCentral'])->name('logoutCentral');
    Route::post('/create-company', [AuthenticatedSessionController::class, 'createCompany'])->name('create-company');
    Route::get('/redirect-user/{globalUserId}/to-tenant/{tenant}', [AuthenticatedSessionController::class, 'redirectUserToTenant'])->name('redirect-user-to-tenant');
});

// Reset Password Routes
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');
Route::get('/reset-password/{token}', function (Request $request, string $token) {
    return view('auth.reset-password', ['token' => $token, 'request' => $request]);
})->middleware('guest')->name('password.reset');


// Business logics for reset password
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $centralUser =  CentralUser::where('email', $user->email)->first();
            $centralUser->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $centralUser->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
