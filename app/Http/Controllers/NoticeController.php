<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoticeController extends Controller
{

    public function index()
    {
        // লারাভেল কুয়েরি বিল্ডার দিয়ে ডাটা লেটেস্ট ক্রমানুসারে তুলে আনা হলো
        $notices = DB::table('notices')
                    ->where('status', 2)
                    ->orderBy('notice_date', 'desc')
                    ->paginate(10); // প্রতি পেজে ১০টি করে নোটিশ ব্রেক করে দেখাবে (Pagination Friendly)

        // resources/views/frontend/notice.blade.php ফাইলে ডেটা পাঠানো হলো
        return view('frontend.notice', compact('notices'));
    }
}
