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
    Route::get('/constitution', function () { return view('frontend.constitution'); })->name('pages.constitution');
    Route::get('/about', function () { return view('frontend.about'); })->name('pages.about');
    
    Route::get('/admin-login', function () { 
        return redirect('/nhcsbdapp/nurses_access_789.php'); 
    })->name('auth.admin');
    
    Route::get('/member-login', function () { 
        return redirect('/nhcsbdapp/member-login.php'); 
    })->name('auth.member');
});


Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/notice', [NoticeController::class, 'adminIndex'])->name('admin.notice.index');
    Route::get('/admin/notice/create', [NoticeController::class, 'create'])->name('admin.notice.create');
    Route::post('/admin/notice/store', [NoticeController::class, 'store'])->name('admin.notice.store');


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
use Illuminate\Support\Facades\DB;
Route::get('/migrate-old-notices', [DataMigrationController::class, 'migrateOldNotices']);
Route::get('/migrate-old-gallery', [DataMigrationController::class, 'migrateOldGallery']);
Route::get('/migrate-old-users', [DataMigrationController::class, 'migrateOldUsers']);

/*
|--------------------------------------------------------------------------
| ৪. লারাভেল ব্রিজ অথেনটিকেশন ইঞ্জিন (Auth Engine)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
