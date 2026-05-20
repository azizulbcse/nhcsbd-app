<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * এই মাইগ্রেশনটি লারাভেলের লেটেস্ট স্ট্যান্ডার্ড এবং আপনার কাস্টম কলামের সমন্বয়ে তৈরি।
     */
    public function up(): void
    {
        Schema::create('notices', function (Blueprint $table) {
            // ১. প্রাইমারি আইডেন্টিফায়ার
            $table->id(); // নতুন টেবিলের নিজস্ব প্রাইমারি আইডি (যা পুরনো id এর ডাটা ধারণ করবে)
            
            // ২. নোটিশ কোর ইনফরমেশন (কন্ট্রোলারের ডাটা লেন্থ লিমিট অনুসারে কলাম ডিজাইন)
            $table->string('noticeno', 200)->nullable(); // স্মারক নম্বর কলাম
            $table->string('title', 255); // নোটিশের মূল শিরোনাম
            $table->date('notice_date')->index(); // দ্রুত কোয়েরি ফিল্টারিং এর জন্য ইনডেক্সড নোটিশ তারিখ
            $table->text('content')->nullable(); // নোটিশের মূল বিবরণ বা কন্টেন্ট
            $table->string('file_name', 255)->nullable(); // নোটিশের পিডিএফ বা ইমেজ ফাইল পাথ সেভ করার জন্য
            
            // ৩. সিকিউরিটি, অ্যাক্সেস কন্ট্রোল এবং এডমিন ট্র্যাকিং
            $table->unsignedBigInteger('created_by')->nullable()->index(); // কোন এডমিন এটি এন্ট্রি বা আপলোড করেছে তার আইডি ট্র্যাকিং
            $table->tinyInteger('status')->default(1)->comment('2: Published, 1: Draft, 0: Hidden')->index(); // মেমোরি সাশ্রয়ী কলাম এবং ২ কন্ডিশন ট্র্যাকার
            
            // ৪. লারাভেল বিল্ট-ইন টাইমস্ট্যাম্পস
            $table->timestamps(); // তৈরি এবং আপডেটের সময় অটো ট্র্যাক করবে (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
