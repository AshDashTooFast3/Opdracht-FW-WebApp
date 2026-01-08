<?php

use App\Http\Controllers\AllesController;
use App\Http\Controllers\MorgenController;
use App\Http\Controllers\PriveController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SideProjectenController;
use App\Http\Controllers\VandaagController;
use App\Http\Controllers\WerkController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('vandaag', [VandaagController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('vandaag');

Route::get('morgen', [MorgenController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('morgen');

Route::get('alles', [AllesController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('alles');

Route::get('school', [SchoolController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('school');

Route::get('werk', [WerkController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('werk');

Route::get('side-projecten', [SideProjectenController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('side-projecten');

Route::get('prive', [PriveController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('prive');

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
