<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdministratorController extends Controller
{
    /**
     * Display the Administrator List page for frontend visitors.
     * আমাদের স্থানান্তরিত 'users' টেবিল থেকে শুধুমাত্র admin রোল এবং status = 2 ওয়ালা ডেটা তুলে আনবে।
     */
    public function index()
    {
        // লারাভেল কুয়েরি বিল্ডার দিয়ে সিরিয়াল (sl) ক্রমানুসারে অ্যাডমিনদের তালিকা তুলে আনা হলো
        $admins = DB::table('users')
                    ->where('role', 'admin')
                    ->where('status', 2)
                    ->orderBy('sl', 'asc')
                    ->get();

        // resources/views/frontend/administrator-list.blade.php ফাইলে ডেটা পাঠানো হলো
        return view('frontend.administrator-list', compact('admins'));
    }
}
