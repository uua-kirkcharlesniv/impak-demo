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
    return view('home/index');
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
// Route::get('/register', function () {
//     return view('auth/register');
// })->name('register');
Route::get('/register', function () {
    return view('auth/new-register');
})->name('register');
Route::post('/register', [RegisteredTenantController::class, 'store']);
Route::post('/create-account', [RegisteredTenantController::class, 'createCentralAccount'])->name('create-account');
Route::get('/sso-login', function () {
    return view('auth/sso-login');
})->name('sso-login');
Route::post('sso-login', [AuthenticatedSessionController::class, 'ssoLogin']);
