<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function send(Request $request)
    {
        // ১. মোবাইল নম্বর সহ স্মার্ট ভ্যালিডেশন
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|max:100',
            'mobileno' => 'required|string|max:20', // মোবাইল নম্বর বাধ্যতামূলক করা হলো
            'subject'  => 'required|string|max:200',
            'message'  => 'required|string|max:2000',
        ]);

        // ২. ডাটাবেজে মোবাইল নম্বর সহ ডাটা ইনসার্ট
        DB::table('contacts')->insert([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'mobileno'   => $validated['mobileno'], // নতুন কলাম ম্যাপিং
            'subject'    => $validated['subject'],
            'message'    => $validated['message'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ৩. মেইল কন্টেন্টের ভেতর মোবাইল নম্বর যুক্তকরণ
        $htmlContent = "
            <h3 style='color: #1A237E;'>New Contact Form Message</h3>
            <p><strong>Name:</strong> {$validated['name']}</p>
            <p><strong>Email:</strong> {$validated['email']}</p>
            <p><strong>Mobile No:</strong> {$validated['mobileno']}</p>
            <p><strong>Subject:</strong> {$validated['subject']}</p>
            <p><strong>Message:</strong><br>" . nl2br(e($validated['message'])) . "</p>
        ";

        // ৪. ল্যারাভেল স্ট্যান্ডার্ড অনুযায়ী .env ফাইলের নতুন ডাইনামিক ইউজারনেম সিঙ্ক
        $recipientEmail = config('mail.from.address', 'nhcs.org.bd@gmail.com');

        Mail::html($htmlContent, function ($message) use ($validated, $recipientEmail) {
            $message->to($recipientEmail) // আপনার নতুন ফিক্সড জিমেইল অ্যাকাউন্টে অটোমেটিক মেইল যাবে
                    ->subject('New NHCS Contact: ' . $validated['subject']);
        });

        return back()->with('success', 'আপনার বার্তাটি সফলভাবে পাঠানো হয়েছে এবং এডমিনকে ইমেইল করা হয়েছে। ধন্যবাদ!');
    }
}
