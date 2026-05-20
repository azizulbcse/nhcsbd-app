<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DataMigrationController extends Controller
{
    public function migrateOldUsers()
    {
        try {
            // ১. লারাভেল স্ট্যান্ডার্ডে নতুন 'users' টেবিলটি ডাটাবেজে তৈরি আছে কি না নিশ্চিত হওয়া
            if (!Schema::hasTable('users')) {
                DB::statement("
                    CREATE TABLE `users` (
                      `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                      `sl` bigint(20) NULL,
                      `name` varchar(255) NOT NULL,
                      `email` varchar(255) NOT NULL,
                      `mobileno` varchar(20) NULL,
                      `designations` varchar(255) NULL,
                      `pcode` varchar(50) NULL,
                      `userpic` text NULL,
                      `usertype` varchar(50) NULL,
                      `role` varchar(30) NOT NULL DEFAULT 'member',
                      `status` tinyInteger NOT NULL DEFAULT '1',
                      `email_verified_at` timestamp NULL DEFAULT NULL,
                      `password` varchar(255) NOT NULL,
                      `remember_token` varchar(100) NULL DEFAULT NULL,
                      `created_at` timestamp NULL DEFAULT NULL,
                      `updated_at` timestamp NULL DEFAULT NULL,
                      PRIMARY KEY (`id`),
                      UNIQUE KEY `users_email_unique` (`email`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                ");
            }

            // ২. ডুপ্লিকেট এড়াতে এবং নতুন টেবিল সম্পূর্ণ ফ্রেশ করে নেওয়ার জন্য (যদি আগে ভুল ডাটা এসে থাকে)
            DB::statement("SET FOREIGN_KEY_CHECKS = 0;");
            DB::table('users')->truncate();
            DB::statement("SET FOREIGN_KEY_CHECKS = 1;");

            // ৩. matrik স্টাইলে পিওর SQL কুয়েরি - এবার sl কলামে পুরনো 'sl' কলামের আসল ডাটা পুশ করা হচ্ছে
            DB::statement("
                INSERT INTO users (id, sl, name, email, designations, pcode, usertype, userpic, mobileno, role, status, password, created_at, updated_at)
                SELECT 
                    user_id AS id,
                    sl AS sl, /* এখানে user_id এর বদলে পুরনো টেবিলের আসল sl কলামের ডাটা ডিরেক্ট ম্যাপিং করা হলো */
                    fullname AS name,
                    IF(username LIKE '%@%', username, CONCAT(username, '@nhcsbd.org')) AS email,
                    designations,
                    pcode,
                    usertype,
                    userpic,
                    mobileno,
                    IF(LOWER(usertype) = 'admin' OR role = 1, 'admin', 'member') AS role,
                    IFNULL(status, 1) AS status,
                    password, 
                    NOW(),
                    NOW()
                FROM tbladminuser;
            ");

            return response()->json([
                'status' => 'success',
                'message' => 'অভিনন্দন! এবার পুরনো টেবিলের আসল SL কলামের ডাটাসহ সমস্ত রেকর্ড নিখুঁতভাবে লারাভেলে স্থানান্তরিত হয়েছে।'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'মাইগ্রেশন ব্যর্থ হয়েছে: ' . $e->getMessage()
            ], 500);
        }
    }
}
