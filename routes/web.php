<?php

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
