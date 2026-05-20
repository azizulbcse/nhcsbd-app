<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id(); // লারাভেলের অটো-ইনক্রিমেন্ট আইডি
            $table->string('title'); // ছবির বা ভিডিওর শিরোনাম
            
            // মিডিয়া টাইপ আলাদা করার এনক্রিপ্টেড ইনডেক্সিং
            $table->enum('media_type', ['image', 'video'])->default('image')->index();
            $table->text('file_name'); // ইমেজ পাথ বা ইউটিউব ভিডিও লিংক সেভ করার জন্য
            
            // ট্র্যাকিং ও সিকিউরিটি: কোন অ্যাডমিন এটি এন্ট্রি করেছে তার আইডি ট্র্যাক
            $table->unsignedBigInteger('created_by')->nullable()->index(); 
            
            // অ্যাকাউন্ট স্ট্যাটাস কন্ডিশন (২ হলেই কেবল ফ্রন্টএন্ডে লাইভ হবে)
            $table->tinyInteger('status')->default(1)->comment('2: Published, 1: Draft, 0: Hidden')->index();
            
            $table->timestamp('upload_date')->useCurrent(); // আপলোড টাইম
            $table->timestamps(); // লারাভেলের ডিফল্ট created_at এবং updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
