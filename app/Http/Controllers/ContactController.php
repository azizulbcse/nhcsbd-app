<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        DB::table('contacts')->insert([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'subject'    => $validated['subject'],
            'message'    => $validated['message'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $htmlContent = "
            <h3>New Contact Form Message</h3>
            <p><strong>Name:</strong> {$validated['name']}</p>
            <p><strong>Email:</strong> {$validated['email']}</p>
            <p><strong>Subject:</strong> {$validated['subject']}</p>
            <p><strong>Message:</strong><br>" . nl2br(e($validated['message'])) . "</p>
        ";

        Mail::html($htmlContent, function ($message) use ($validated) {
            $message->to('azizulbcse@gmail.com')
                    ->subject('New NHCS Contact: ' . $validated['subject']);
        });
        return back()->with('success', 'আপনার বার্তাটি সফলভাবে পাঠানো হয়েছে এবং এডমিনকে ইমেইল করা হয়েছে। ধন্যবাদ!');
    }
}
