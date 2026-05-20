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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // মেসেজের জন্য অটো-ইনক্রিমেন্ট আইডি
            
            // কন্ট্রোলারের ডাটা লেন্থ লিমিট অনুসারে কলাম ডিজাইন
            $table->string('name', 100); // প্রেরকের নাম (সর্বোচ্চ ১০০ ক্যারেক্টার)
            $table->string('email', 100); // প্রেরকের ইমেইল (সর্বোচ্চ ১০০ ক্যারেক্টার)
            $table->string('subject', 200); // বার্তার বিষয় (সর্বোচ্চ ২০০ ক্যারেক্টার)
            $table->text('message'); // বার্তার মূল বিবরণ বা কমপ্লেইন
            $table->string('mobileno', 20)->nullable(); // মোবাইল নম্বর রাখার জন্য নতুন কলাম
            $table->timestamps(); // তৈরি এবং আপডেটের সময় অটো ট্র্যাক করবে (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
