<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DataMigrationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\DepositDetailsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegistrationController;

/*

|--------------------------------------------------------------------------
| ১. রুট এবং পাবলিক ফ্রন্টএন্ড নেভিগেশন রাউটস (Public Frontend Routes)
|--------------------------------------------------------------------------
*/
// হোমপেজ রাউটে নেমড রাউট 'home' যুক্ত করা হলো (যা ফুটারের এররটি স্থায়ীভাবে ফিক্স করবে)
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::group([], function () {
    Route::get('/administrator-list', [AdministratorController::class, 'index'])->name('administrator.list');
    Route::get('/member-list', [MemberController::class, 'index'])->name('member.list');
    Route::get('/notice', [NoticeController::class, 'index'])->name('notice');
    Route::get('/gallery/photo', [GalleryController::class, 'photoGallery'])->name('gallery.photo');
    Route::get('/gallery/video', [GalleryController::class, 'videoGallery'])->name('gallery.video');
    Route::get('/deposit-details', [DepositDetailsController::class, 'index'])->name('deposit.details');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
    Route::get('/emi-calculator', function () { return view('frontend.emi-calculator'); })->name('loan.calculator');
    Route::get('/application4join', [RegistrationController::class, 'index'])->name('member.join');
    Route::post('/application4join/submit', [RegistrationController::class, 'submit'])->name('member.join.submit');
    Route::get('/terms-conditions', function () { return view('frontend.terms'); })->name('pages.terms');
    Route::get('/constitution', function () { return view('frontend.constitution');})->name('pages.constitution');
    Route::get('/about', function () { return view('frontend.about');})->name('pages.about');
    
    // routes/web.php ফাইলে এই ২টি লাইন যোগ করে রাখতে পারেন
Route::get('/admin-login', function () { return redirect('/nhcsbd-row/nurses_access_789.php'); })->name('auth.admin');
Route::get('/member-login', function () { return redirect('/nhcsbd-row/member-login.php'); })->name('auth.member');

    });

/*

|--------------------------------------------------------------------------
| ২. সুরক্ষিত ড্যাশবোর্ড ও প্রোফাইল রাউটস (Authenticated Dashboard Routes)
|--------------------------------------------------------------------------

| শুধুমাত্র লগইন করা ইউজাররাই এই রাউটগুলোতে প্রবেশ করতে পারবেন।
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // সাধারণ মেম্বার ড্যাশবোর্ড
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // অ্যাডমিনিস্ট্রেটর ড্যাশবোর্ড (Webarch থিম লেআউট)
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // ইউজার প্রোফাইল ম্যানেজমেন্ট (লারাভেল ব্রিজ বিল্ট-ইন)
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| ৩. matrik স্টাইল ওল্ড ডাটা মাইগ্রেশন এবং পাথ ক্লিনার গেটওয়ে রাউটস

|--------------------------------------------------------------------------
*/
Route::get('/update-user-pic-path', [DataMigrationController::class, 'updateUserPicPath']);
Route::get('/migrate-old-notices', [DataMigrationController::class, 'migrateOldNotices']);
Route::get('/migrate-old-gallery', [DataMigrationController::class, 'migrateOldGallery']);
Route::get('/migrate-old-users', [DataMigrationController::class, 'migrateOldUsers']);

/*
|--------------------------------------------------------------------------
| ৪. লারাভেল ব্রিজ অথেনটিকেশন engine (Auth Engine)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
