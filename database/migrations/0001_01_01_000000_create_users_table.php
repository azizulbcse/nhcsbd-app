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
        Schema::create('users', function (Blueprint $table) {
            // ১. প্রাইমারি আইডেন্টিফায়ার এবং সিরিয়াল ট্র্যাকিং
            $table->id(); 
            $table->unsignedBigInteger('sl')->nullable()->index(); // ইডেক্সিং সহ লারাভেল স্ট্যান্ডার্ড আইডি ট্র্যাকিং
            
            // ২. প্রোফাইল এবং মেম্বার কোর ইনফরমেশন
            $table->string('name'); 
            $table->string('email')->unique(); 
            $table->string('mobileno', 20)->nullable(); // স্ট্রিং টাইপ এবং লেন্থ লিমিট সহ প্রফেশনাল মোবাইল কলাম
            $table->string('designations')->nullable(); 
            $table->string('pcode', 50)->nullable(); 
            $table->text('userpic')->nullable(); // আপনার চাওয়া টেক্সট ফরম্যাটের প্রফেশনাল পিকচার কলাম
            
            // ৩. সিকিউরিটি, অ্যাক্সেস কন্ট্রোল এবং রোল ম্যানেজমেন্ট
            $table->string('usertype', 50)->nullable(); // পুরনো সিস্টেম ট্র্যাকিং
            $table->string('role', 30)->default('member')->index(); // লারাভেল ব্রিজ অথেনটিকেশন রোল (ফাস্ট কোয়েরির জন্য ইনডেক্সড)
            $table->tinyInteger('status')->default(1)->comment('1: Active, 0: Inactive'); // মেমোরি সাশ্রয়ী কলাম এবং ডকুমেন্টেশন কমেন্ট
            
            // ৪. লারাভেল বিল্ট-ইন সিকিউরিটি এবং টাইমস্ট্যাম্পস
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password'); 
            $table->rememberToken();
            $table->timestamps(); // তৈরি এবং আপডেটের সময় অটো ট্র্যাক করবে (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
