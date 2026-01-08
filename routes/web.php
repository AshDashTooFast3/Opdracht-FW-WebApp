<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\VandaagController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('vandaag', [VandaagController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('vandaag');

Route::view('morgen', 'morgen')
    ->middleware(['auth', 'verified'])
    ->name('morgen');

Route::view('alles', 'alles')
    ->middleware(['auth', 'verified'])
    ->name('alles');    

Route::view('school', 'school')
    ->middleware(['auth', 'verified'])
    ->name('school');

Route::view('werk', 'werk')
    ->middleware(['auth', 'verified'])
    ->name('werk');

Route::view('side-projecten', 'side-projecten')
    ->middleware(['auth', 'verified'])
    ->name('side-projecten');

Route::view('privé', 'privé')
    ->middleware(['auth', 'verified'])
    ->name('privé');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    // Route::get('settings/two-factor', TwoFactor::class)
    //     ->middleware(
    //         when(
    //             Features::canManageTwoFactorAuthentication()
    //                 && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
    //             ['password.confirm'],
    //             [],
    //         ),
    //     )
    //     ->name('two-factor.show');
});
