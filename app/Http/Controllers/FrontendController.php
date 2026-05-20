<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;

class FrontendController extends Controller
{
    /**
     * Display the contact view.
     */
    public function contact()
    {
        return view('frontend.contact');
    }

    /**
     * Send Secure Contact Email to Administration.
     */
    public function sendContactMessage(Request $request)
    {
        // ১. স্মার্ট সার্ভার-সাইড ভ্যালিডেশন (স্প্যাম ও বট প্রটেকশন)
        $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'string', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $data = [
            'name'    => strip_tags($request->name),
            'email'   => strip_tags($request->email),
            'subject' => strip_tags($request->subject),
            'message' => strip_tags($request->message),
        ];

        try {
            // ২. আপনার অফিশিয়াল জিমেইলে স্বয়ংক্রিয়ভাবে মেইল পাঠানো হচ্ছে
            Mail::to('azizulbcse@gmail.com')->send(new ContactMessageMail($data));
            
            return back()->with('success', 'আপনার বার্তাটি সফলভাবে পাঠানো হয়েছে এবং এটি এডমিন প্যানেলে মেইল করা হয়েছে। ধন্যবাদ!');
            
        } catch (\Exception $e) {
            // মেইল ড্রাইভার কনফিগারেশন ভুল হলে এরর ব্যাক করবে
            return back()->withInput()->withErrors(['mail_error' => 'মেইল পাঠানো সম্ভব হয়নি। অনুগ্রহ করে আপনার .env ফাইলের SMTP কনফিগারেশন চেক করুন।']);
        }
    }
}
