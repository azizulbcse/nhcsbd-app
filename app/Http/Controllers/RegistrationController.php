<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    /**
     * ১. জয়েন অ্যাপ্লিকেশন ফর্ম ভিউ করার মেথড
     */
    public function index()
    {
        // মাস্টার হাসপাতাল টেবিল থেকে বর্ণানুক্রমিকভাবে তালিকা তুলে আনা হলো
        $hospitals = DB::table('tblhospitalname')->orderBy('hospitalname', 'asc')->get();
        return view('frontend.application4join', compact('hospitals'));
    }

    /**
     * ২. ৪৪টি কলামের পিওর এসকিউএল স্ক্রিপ্ট অনুযায়ী ডাটা ইনসার্ট ইঞ্জিন
     */
    public function submit(Request $request)
    {
        // ক. ডাটাবেজের NOT NULL কন্ডিশন এবং ডাটা লেন্থ লিমিট অনুযায়ী কঠোর ভ্যালিডেশন
        $validated = $request->validate([
            'name_bangla'       => 'required|string|max:500',
            'name_english'      => 'required|string|max:500',
            'fathers_name'      => 'required|string|max:500',
            'mothers_name'      => 'required|string|max:500',
            'gender'            => 'required|string|max:10',
            'maritalstatus'     => 'required|string|max:15',
            'dateofbirth'       => 'required|date',
            'age'               => 'required|string|max:20',
            'presentaddress'    => 'required|string|max:500',
            'permanentaddress'  => 'required|string|max:500',
            'hospitalname'      => 'required|integer',
            'mobileno'          => 'required|string|max:20',
            'nid'               => 'required|string|max:20',
            'email'             => 'required|email|max:100',
            'password'          => 'required|string|min:6|confirmed', // পাসওয়ার্ড কনফার্মেশন ম্যাচিং চেক
            'bloodgroup'        => 'required|string|max:10',
            'nomineename'       => 'required|string|max:500',
            'nomineerelation'   => 'required|string|max:100',
            'nomineemobile'     => 'required|string|max:20', // স্ক্রিপ্ট অনুযায়ী ফিক্সড স্পেলিং
            'nomineeaddress'    => 'required|string|max:500',
            'emergencycontact'  => 'required|string|max:20',
            'bkashno'           => 'required|string|max:20',
            'trxid'             => 'required|string|max:30',
            'agreement'         => 'required|accepted', // নীতিমালা টিকবক্স চেক বাধ্যতামূলক
        ]);

        // খ. মেমোরি কনফ্লিক্ট ও ডুপ্লিকেট এন্ট্রি এড়াতে ইউনিক মোবাইল, ইমেইল এবং এনআইডি ডাবল-চেকিং প্রটেকশন
        $exists = DB::table('tblapplicantinfo')
            ->where('email', $validated['email'])
            ->orWhere('mobileno', $validated['mobileno'])
            ->orWhere('nid', $validated['nid'])
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'দুঃখিত, এই ইমেইল, মোবাইল নম্বর বা এনআইডি কার্ড দিয়ে অলরেডি আবেদন করা হয়েছে!');
        }

        // গ. আপনার দেওয়া ৪৪টি কলামের পিওর স্ক্রিপ্ট সিকোয়েন্স মেনে ডাটাবেজ এন্ট্রি ইঞ্জিন (XSS প্রটেক্টেড)
        try {
            DB::table('tblapplicantinfo')->insert([
                // mid কলামটি AUTO_INCREMENT হওয়ায় এখানে ইনসার্ট স্টেটমেন্টে বাদ রাখা হয়েছে
                'userpic'          => null,
                'name_bangla'      => strip_tags($validated['name_bangla']),
                'name_english'     => strip_tags($validated['name_english']),
                'fathers_name'     => strip_tags($validated['fathers_name']),
                'mothers_name'     => strip_tags($validated['mothers_name']),
                'gender'           => $validated['gender'],
                'maritalstatus'    => $validated['maritalstatus'],
                'dateofbirth'      => $validated['dateofbirth'],
                'age'              => strip_tags($validated['age']),
                'presentaddress'   => strip_tags($validated['presentaddress']),
                'permanentaddress' => strip_tags($validated['permanentaddress']),
                'hospitalname'     => $validated['hospitalname'],
                'mobileno'         => strip_tags($validated['mobileno']),
                'nid'              => strip_tags($validated['nid']),
                'email'            => strip_tags($validated['email']),
                'password'         => Hash::make($validated['password']), // পাসওয়ার্ড হ্যাশ এনক্রিপশন (সর্বোচ্চ ৬০ ক্যারেক্টার লকিং)
                'pcode'            => 'NHCS-' . rand(1000, 9999), // সাময়িক ট্র্যাকিং পি-কোড জেনারেটর
                'bloodgroup'       => $validated['bloodgroup'],
                'nomineepic'       => null,
                'nomineename'      => strip_tags($validated['nomineename']),
                'nomineerelation'  => strip_tags($validated['nomineerelation']),
                'nomineemobile'    => strip_tags($validated['nomineemobile']), // আপনার স্ক্রিপ্টের রিয়াল কলাম নাম
                'nomineeaddress'   => strip_tags($validated['nomineeaddress']),
                'nomineenid'       => $request->input('nomineenid') ?? null, // Nullable কলাম
                'emergencycontact' => strip_tags($validated['emergencycontact']),
                'bkashno'          => strip_tags($validated['bkashno']),
                'trxid'            => strip_tags($validated['trxid']),
                'app_amount'       => 1000, // ডিফল্ট আবেদন চাঁদা ফি
                'signature'        => null,
                'bankmname'        => null, // আপনার স্ক্রিপ্ট অনুযায়ী ফিক্সড 'bankmname' স্পেলিং
                'branchname'       => null,
                'acc_no'           => null,
                'acc_name'         => null,
                'mobilebanktype'   => 'bKash',
                'mobilebankno'     => strip_tags($validated['bkashno']),
                'status'           => 1, // ডিফল্ট স্ট্যাটাস ১ (পেন্ডিং) হিসেবে সেভ হবে, এডমিন এপ্রুভ করলে ২ হবে
                'role'             => 1, // আপনার স্ক্রিপ্টের ডিফল্ট মেম্বার রোল আইডি কন্ডিশন
                'creator_id'       => null,
                'modifier_id'      => null,
                'createdate'       => now(), // আপনার স্ক্রিপ্টের রিয়াল টাইমস্ট্যাম্প কলাম নাম
                'monthly_amount'   => 2000, // মাসিক ফিক্সড ডাইনামিক কিস্তি চাঁদা
                'fixed_amount'     => 55000, // ফিক্সড বেস ভ্যালু ডিপোজিট
                'designation'      => 'General Member',
            ]);

            return back()->with('success', 'আপনার মেম্বারশিপ আবেদনপত্রটি সফলভাবে ডাটাবেজে জমা হয়েছে। কার্যনির্বাহী কমিটির এপ্রুভাল শেষে আপনার অ্যাকাউন্টটি সক্রিয় হবে। ধন্যবাদ!');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'ডাটাবেজে তথ্য সংরক্ষণে ব্যর্থ হয়েছে: ' . $e->getMessage());
        }
    }
}
