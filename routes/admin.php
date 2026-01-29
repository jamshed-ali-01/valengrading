<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LabelTypeController;
use App\Http\Controllers\Admin\ServiceLevelController;
use App\Http\Controllers\Admin\SubmissionTypeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('/service-levels', ServiceLevelController::class)
            ->except(['show']);

        // Yeh line add karni hai
        Route::resource('/label-types', LabelTypeController::class)
            ->except(['show']);

        Route::resource('/submission-types', SubmissionTypeController::class)
            ->except(['show']);

        // Submissions Management
        Route::get('/submissions', [\App\Http\Controllers\Admin\SubmissionController::class, 'index'])->name('submissions.index');
        Route::get('/submissions/{submission}', [\App\Http\Controllers\Admin\SubmissionController::class, 'show'])->name('submissions.show');
        Route::patch('/submissions/{submission}/status', [\App\Http\Controllers\Admin\SubmissionController::class, 'updateStatus'])->name('submissions.update-status');
        
        // Card Management
        Route::post('/submissions/{submission}/cards', [\App\Http\Controllers\Admin\SubmissionController::class, 'storeCard'])->name('submissions.cards.store');
        Route::get('/submissions/cards/{card}/edit', [\App\Http\Controllers\Admin\SubmissionController::class, 'editCard'])->name('submissions.cards.edit');
        Route::patch('/submissions/cards/{card}', [\App\Http\Controllers\Admin\SubmissionController::class, 'updateCard'])->name('submissions.cards.update');
        
        // Settings
        Route::get('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
        Route::patch('/settings/general', [\App\Http\Controllers\Admin\SettingsController::class, 'updateGeneral'])->name('settings.update-general');
        Route::patch('/settings/smtp', [\App\Http\Controllers\Admin\SettingsController::class, 'updateSMTP'])->name('settings.update-smtp');
        Route::patch('/settings/shipping', [\App\Http\Controllers\Admin\SettingsController::class, 'updateShipping'])->name('settings.update-shipping');
        Route::patch('/settings/profile', [\App\Http\Controllers\Admin\SettingsController::class, 'updateProfile'])->name('settings.update-profile');
        Route::patch('/settings/password', [\App\Http\Controllers\Admin\SettingsController::class, 'updatePassword'])->name('settings.update-password');
        
        Route::delete('/submissions/{submission}', [\App\Http\Controllers\Admin\SubmissionController::class, 'destroy'])->name('submissions.destroy');

        // Notifications
        Route::get('/notifications', [DashboardController::class, 'notifications'])->name('notifications.index');
        Route::post('/notifications/mark-all-read', [DashboardController::class, 'markAllRead'])->name('notifications.mark-all-read');

        // FAQs
        Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class);

        Route::post('/logout', function () {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect('/login');
        })->name('logout');
        // User Management
        Route::resource('/users', \App\Http\Controllers\Admin\UserController::class)->only(['index', 'destroy']);
    });
