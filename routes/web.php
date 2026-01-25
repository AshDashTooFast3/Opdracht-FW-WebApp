<?php

use App\Http\Controllers\AllesController;
use App\Http\Controllers\MorgenController;
use App\Http\Controllers\PriveController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SideProjectenController;
use App\Http\Controllers\VandaagController;
use App\Http\Controllers\WerkController;
use App\Http\Controllers\TakenController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', [VandaagController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('/taak/check', [VandaagController::class, 'checkTaak'])
    ->middleware(['auth', 'verified'])
    ->name('checkTaak');

//taken CRUD routes
Route::get('taken/create', [TakenController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('taken.create');

Route::post('taken/store', [TakenController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('taken.store');

Route::get('taken/edit/{Id}', [TakenController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('taken.edit');

Route::put('taken/update/{Id}', [TakenController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('taken.update');

Route::post('taken/destroy/{Id}', [TakenController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('taken.destroy');

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
