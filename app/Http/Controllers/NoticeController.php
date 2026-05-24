<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    /**
     * ১. ফ্রন্টএন্ড সাধারণ ইউজারদের জন্য নোটিশের তালিকা ভিউ (আপনার আগের কোড অক্ষত রাখা হলো)
     */
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

    /**
     * ২. অ্যাডমিন প্যানেলের জন্য নোটিশের মাস্টার তালিকা ভিউ
     */
    public function adminIndex()
    {
        $notices = DB::table('notices')
                    ->orderBy('notice_date', 'desc')
                    ->paginate(10);

        return view('admin.notice.index', compact('notices'));
    }

    /**
     * ৩. নতুন নোটিশ তৈরির ফর্ম ভিউ
     */
    public function create()
    {
        return view('admin.notice.create');
    }

    /**
     * ৪. ডাটাবেজে নোটিশ এবং ফাইল আপলোড করার পিওর লারাভেল মাস্টার ইঞ্জিন
     */
    public function store(Request $request)
    {
        // ক. কঠোর ইনপুট ভ্যালিডেশন এবং ফাইল টাইপ লকিং
        $validated = $request->validate([
            'noticeno'    => 'nullable|string|max:100',
            'title'       => 'required|string|max:500',
            'notice_date' => 'required|date',
            'content'     => 'nullable|string',
            'file_name'   => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // সর্বোচ্চ ৫ মেগাবাইট পিডিএফ বা ইমেজ
        ]);

        $fileNameToStore = null;

        // খ. রিয়েল-টাইম ফাইল আপলোড ও রিনেম প্রসেসিং (XSS ও ওভাররাইট প্রোটেকশন)
        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            // ইউনিক টাইমস্ট্যাম্প ভিত্তিক ফাইলনেম জেনারেশন
            $fileNameToStore = 'notice_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // সরাসরি ল্যারাভেলের public/uploads/notice ফোল্ডারে ফাইলটি মুভ করা
            $file->move(public_path('uploads/notice'), $fileNameToStore);
        }

        try {
            // গ. আপনার ডাটাবেজ টেবিল notices-এ সিকিউর ডাটা ইনসার্ট (status = 2 অর্থাৎ সরাসরি পাবলিশড হবে)
            DB::table('notices')->insert([
                'noticeno'    => strip_tags($validated['noticeno']),
                'title'       => strip_tags($validated['title']),
                'notice_date' => $validated['notice_date'],
                'content'     => $validated['content'] ? strip_tags($validated['content']) : null,
                'file_name'   => $fileNameToStore,
                'status'      => 2, // ফ্রন্টএন্ডে status=2 ফিল্টার থাকায় এটি সরাসরি লাইভ দেখা যাবে
                'creator_id'  => Auth::id() ?? null, // লগইন করা অ্যাডমিনের আইডি ট্র্যাকিং
                'createdat'   => now(), // ডাটাবেজের টাইমস্ট্যাম্প কলাম নাম
            ]);

            return redirect()->route('admin.notice.index')->with('success', 'অভিনন্দন! নতুন অফিশিয়াল নোটিশটি সফলভাবে আপলোড ও পাবলিশ করা হয়েছে।');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'ডাটাবেজে নোটিশ আপলোড করতে ব্যর্থ হয়েছে: ' . $e->getMessage());
        }
    }
}
