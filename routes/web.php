<?php
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Builder\InvitationBuilder;
use App\Livewire\Dashboard\InvitationList;
use App\Livewire\Public\PublicInvitation;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', fn() => view('welcome'))->name('home');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
});
Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth');

// Dashboard & Builder
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', InvitationList::class)->name('dashboard');
    Route::get('/builder/{invitation:uuid}', InvitationBuilder::class)->name('builder');
});

// Public Invitation — must be last!
Route::get('/{invitation:slug}', PublicInvitation::class)->name('invitation.show');
