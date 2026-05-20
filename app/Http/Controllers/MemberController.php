<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display the Registered Member List with Infinite Scroll and Database Table Join.
     */
    public function index(Request $request)
    {
        // tblapplicantinfo এর সাথে tblhospitalname টেবিলের রিয়েল-টাইম জয়েন কুয়েরি
        $members = DB::table('tblapplicantinfo')
                    ->leftJoin('tblhospitalname', 'tblapplicantinfo.hospitalname', '=', 'tblhospitalname.hid')
                    ->select(
                        'tblapplicantinfo.*', 
                        'tblhospitalname.hospitalname AS true_hospital_name' // আসল হাসপাতালের নামকে আলাদা ভ্যারিয়েবলে নেওয়া হলো
                    )
                    ->where('tblapplicantinfo.status', 2)
                    ->orderBy('tblapplicantinfo.mid', 'asc')
                    ->paginate(20);

        // যদি ব্রাউজার থেকে স্ক্রল করার সময় ব্যাকগ্রাউন্ডে অতিরিক্ত ডাটা চাওয়া হয় (AJAX Call)
        if ($request->ajax()) {
            return view('frontend.partials.member-cards', compact('members'))->render();
        }

        return view('frontend.member-list', compact('members'));
    }
}
