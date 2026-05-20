<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepositDetailsController extends Controller
{
    /**
     * Display the deposit details page for frontend members.
     */
    public function index()
    {
        // resources/views/frontend/deposit-details.blade.php ফাইলটিকে ব্রাউজারে প্রদর্শন করবে
        return view('frontend.deposit-details');
    }
}
