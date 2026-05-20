<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DataMigrationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


Route::get('/', function () {
    return view('welcome');
});

Route::group([], function () {
    Route::get('/administrator-list', function () { return "Administrator List Page"; })->name('administrator.list');
    Route::get('/member-list', function () { return "Member List Page"; })->name('member.list');
    Route::get('/notice', function () { return "Notice Board Page"; })->name('notice');
    Route::get('/gallery/photo', function () { return "Photo Gallery"; })->name('gallery.photo');
    Route::get('/gallery/video', function () { return "Video Gallery"; })->name('gallery.video');
    Route::get('/deposit-details', function () { return "Deposit Details Page"; })->name('deposit.details');

    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
    });

/*
|--------------------------------------------------------------------------
| ২. সুরক্ষিত ড্যাশবোর্ড ও প্রোফাইল রাউটস (Authenticated Dashboard Routes)

|--------------------------------------------------------------------------
| শুধুমাত্র লগইন করা (Status = 2) ইউজাররাই এই রাউটগুলোতে প্রবেশ করতে পারবেন।
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
| ৩. ডেটা মাইগ্রেশন ও ইউটিলিটি রাউটস (Utility Routes)
|--------------------------------------------------------------------------

| matrik স্টাইলে ব্রাউজার থেকে সরাসরি ডেটা অটো-ট্রান্সফার করার রাউট।
*/
Route::get('/migrate-old-users', [DataMigrationController::class, 'migrateOldUsers']);

/*
|--------------------------------------------------------------------------
| ৪. লারাভেল ব্রিজ অথেনটিকেশন ইঞ্জিন (Auth Engine)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
