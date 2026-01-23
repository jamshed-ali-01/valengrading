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
        Route::delete('/submissions/{submission}', [\App\Http\Controllers\Admin\SubmissionController::class, 'destroy'])->name('submissions.destroy');

        Route::post('/logout', function () {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect('/login');
        })->name('logout');
    });
