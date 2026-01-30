<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CardSubmissionController;
use App\Models\ShowcaseCard;
use Illuminate\Support\Facades\Route;

// New Frontend Routes
Route::get('/', function () {
    $showcaseCards = \App\Models\ShowcaseCard::where('is_active', true)->orderBy('order')->get();
    $faqs = \App\Models\Faq::where('is_active', true)->where('show_on_home', true)->orderBy('order')->take(5)->get();
    return view('frontend.home', compact('showcaseCards', 'faqs'));
})->name('home');



Route::get('/faq', function () {
    $faqs = \App\Models\Faq::where('is_active', true)
        ->where('show_on_home', false)
        ->orderBy('category')
        ->orderBy('order')
        ->get();
    return view('frontend.faq', compact('faqs'));
})->name('faq');


Route::get('/contact', function () {
    return view('frontend.contact');
})->name('contact');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::get('/pricing', function () {
    return view('frontend.pricing');
})->name('pricing');

Route::get('/about', function () {
    return view('frontend.about');
})->name('about');

// User Routes (New)
Route::prefix('user')->name('user.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\UserDashboardController::class, 'index'])->name('dashboard');
    Route::post('/profile/update-info', [\App\Http\Controllers\UserDashboardController::class, 'updateInfo'])->name('profile.update-info');
    Route::post('/profile/update-address', [\App\Http\Controllers\UserDashboardController::class, 'updateAddress'])->name('profile.update-address');
    Route::post('/profile/update-password', [\App\Http\Controllers\UserDashboardController::class, 'updatePassword'])->name('profile.update-password');
});

// Admin Routes (Preserved)
Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('population', \App\Http\Controllers\Admin\PopulationReportController::class);
    Route::resource('showcase', \App\Http\Controllers\Admin\ShowcaseCardController::class);
    Route::resource('contact-queries', \App\Http\Controllers\Admin\ContactQueryController::class)->only(['index', 'show', 'destroy']);
    Route::get('/submissions', [\App\Http\Controllers\Admin\SubmissionController::class, 'index'])->name('submissions.index');
    Route::get('/submissions/{submission}', [\App\Http\Controllers\Admin\SubmissionController::class, 'show'])->name('submissions.show');
    Route::patch('/submissions/{submission}/status', [\App\Http\Controllers\Admin\SubmissionController::class, 'updateStatus'])->name('submissions.updateStatus');
    Route::delete('/submissions/{submission}', [\App\Http\Controllers\Admin\SubmissionController::class, 'destroy'])->name('submissions.destroy');
    Route::get('/submissions/cards/{card}/edit', [\App\Http\Controllers\Admin\SubmissionController::class, 'editCard'])->name('submissions.cards.edit');
    Route::patch('/submissions/cards/{card}', [\App\Http\Controllers\Admin\SubmissionController::class, 'updateCard'])->name('submissions.cards.update');
    Route::post('/submissions/{submission}/cards', [\App\Http\Controllers\Admin\SubmissionController::class, 'storeCard'])->name('submissions.cards.store');
    Route::resource('newsletter', \App\Http\Controllers\Admin\NewsletterController::class)->only(['index', 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Submission Routes (Preserved)
Route::group(['prefix' => 'submission', 'as' => 'submission.'], function () {
    Route::get('/start', [CardSubmissionController::class, 'index'])->name('step1');
    Route::post('/start', [CardSubmissionController::class, 'storeStep1'])->name('storeStep1');

    Route::get('/service-level', [CardSubmissionController::class, 'step2'])->name('step2');
    Route::post('/service-level', [CardSubmissionController::class, 'storeStep2'])->name('storeStep2');

    Route::get('/step3', [CardSubmissionController::class, 'step3'])->name('step3');
    Route::post('/step3', [CardSubmissionController::class, 'storeStep3'])->name('storeStep3');
    
    // Step 4: Shipping
    Route::get('/shipping', [CardSubmissionController::class, 'step4'])->name('step4');
    Route::post('/shipping', [CardSubmissionController::class, 'storeStep4'])->name('storeStep4');

    // Step 5: Review
    Route::get('/review', [CardSubmissionController::class, 'step5'])->name('step5');
    // Route::post('/review', [CardSubmissionController::class, 'storeStep5'])->name('storeStep5'); 

    // Step 6: Payment
    Route::get('/payment', [CardSubmissionController::class, 'step6'])->name('step6');
    Route::post('/payment', [CardSubmissionController::class, 'processPayment'])->name('processPayment');
    Route::get('/payment/success', [CardSubmissionController::class, 'paymentSuccess'])->name('success');
    Route::get('/payment/cancel', [CardSubmissionController::class, 'paymentCancel'])->name('cancel');
    Route::get('/packing-slip/{id}', [CardSubmissionController::class, 'downloadPackingSlip'])->name('packingSlip.download');
    Route::get('/resume/{id}', [CardSubmissionController::class, 'resume'])->name('resume');
});

// Public Card Validation/Report
Route::get('/cert-check', [\App\Http\Controllers\CardReportController::class, 'index'])->name('cert.index');
Route::post('/cert-check/search', [\App\Http\Controllers\CardReportController::class, 'search'])->name('cert.search');
Route::get('/card/{cert_number}', [\App\Http\Controllers\CardReportController::class, 'show'])->name('card.report');
Route::get('/pop-report', [\App\Http\Controllers\PopulationReportController::class, 'index'])->name('pop-report');


Route::post('/newsletter/subscribe', [\App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
