<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DataMigrationController extends Controller
{
    /**
     * ১. ওল্ড ইউজার ডাটা মাইগ্রেশন গেটওয়ে (অপরিবর্তিত ও সুরক্ষিত)
     * ব্রাউজার ইউআরএল: http://localhost:8000/migrate-old-users
     */
    public function migrateOldUsers()
    {
        try {
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

            DB::statement("SET FOREIGN_KEY_CHECKS = 0;");
            DB::table('users')->truncate();
            DB::statement("SET FOREIGN_KEY_CHECKS = 1;");

            DB::statement("
                INSERT INTO users (id, sl, name, email, designations, pcode, usertype, userpic, mobileno, role, status, password, created_at, updated_at)
                SELECT 
                    user_id AS id,
                    sl AS sl, 
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

            return response()->json(['status' => 'success', 'message' => 'ইউজার রেকর্ড নিখুঁতভাবে স্থানান্তরিত হয়েছে।'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * ২. ওল্ড গ্যালারি ডাটা মাইগ্রেশন গেটওয়ে (অপরিবর্তিত ও সুরক্ষিত)
     * ব্রাউজার ইউআরএল: http://localhost:8000/migrate-old-gallery
     */
    public function migrateOldGallery()
    {
        try {
            if (!Schema::hasTable('tblgallery')) {
                return response()->json(['status' => 'error', 'message' => 'tblgallery পাওয়া যায়নি!'], 404);
            }

            if (!Schema::hasTable('galleries')) {
                DB::statement("
                    CREATE TABLE `galleries` (
                      `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                      `title` varchar(255) NOT NULL,
                      `media_type` enum('image','video') NOT NULL DEFAULT 'image',
                      `file_name` text NOT NULL,
                      `created_by` bigint(20) UNSIGNED NULL,
                      `status` tinyint(4) NOT NULL DEFAULT '1',
                      `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                      `created_at` timestamp NULL DEFAULT NULL,
                      `updated_at` timestamp NULL DEFAULT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                ");
            }

            DB::statement("SET FOREIGN_KEY_CHECKS = 0;");
            DB::table('galleries')->truncate();
            DB::statement("SET FOREIGN_KEY_CHECKS = 1;");

            DB::statement("
                INSERT INTO galleries (id, title, media_type, file_name, created_by, status, upload_date, created_at, updated_at)
                SELECT id, IFNULL(title, 'Untitled Media'), IFNULL(media_type, 'image'), file_name, 1, IFNULL(status, 2), IFNULL(upload_date, NOW()), NOW(), NOW() FROM tblgallery;
            ");

            return response()->json(['status' => 'success', 'message' => 'গ্যালারি ডাটা স্থানান্তরিত হয়েছে।'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * ৩. ওল্ড নোটিশ ডাটা মাইগ্রেশন গেটওয়ে (অপরিবর্তিত ও সুরক্ষিত)
     * ব্রাউজার ইউআরএল: http://localhost:8000/migrate-old-notices
     */
    public function migrateOldNotices()
    {
        try {
            if (!Schema::hasTable('tblnotices')) {
                return response()->json(['status' => 'error', 'message' => 'tblnotices পাওয়া যায়নি!'], 404);
            }

            if (!Schema::hasTable('notices')) {
                DB::statement("
                    CREATE TABLE `notices` (
                      `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                      `noticeno` varchar(255) NULL,
                      `title` varchar(255) NOT NULL,
                      `notice_date` date NOT NULL,
                      `content` text NULL,
                      `file_name` varchar(255) NULL,
                      `created_by` bigint(20) UNSIGNED NULL,
                      `status` tinyint(4) NOT NULL DEFAULT '1',
                      `created_at` timestamp NULL DEFAULT NULL,
                      `updated_at` timestamp NULL DEFAULT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                ");
            }

            DB::statement("SET FOREIGN_KEY_CHECKS = 0;");
            DB::table('notices')->truncate();
            DB::statement("SET FOREIGN_KEY_CHECKS = 1;");

            DB::statement("
                INSERT INTO notices (id, noticeno, title, notice_date, content, file_name, created_by, status, created_at, updated_at)
                SELECT id, noticeno, title, notice_date, content, file_name, creator_id, IFNULL(status, 2), IFNULL(created_at, NOW()), NOW() FROM tblnotices;
            ");

            return response()->json(['status' => 'success', 'message' => 'নোটিশ মাইগ্রেশন সফল হয়েছে।'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * ৪. ডাটাবেজে ইউজার এবং অ্যাডমিনদের ছবির পাথ ক্লিন ও আপডেট করার প্রফেশনাল মেথড।
     * ব্রাউজার ইউআরএল: http://localhost:8000/update-user-pic-path
     */
    public function updateUserPicPath()
    {
        try {
            // ডাটাবেজ থেকে যাদের ইমেজ পাথে '../' ডিরেক্টরি ট্র্যাকিং আছে তাদের ফিল্টার করে তুলে আনা
            $users = DB::table('users')->where('userpic', 'LIKE', '%../%')->get();
            $updatedCount = 0;

            foreach ($users as $user) {
                // basename() মেথডটি '../assets/img/user/1773169009622d8c08bb79b.jpg' থেকে
                // সরাসরি শুধু ক্লিন ফাইলের নাম '1773169009622d8c08bb79b.jpg' আলাদা করে নেবে।
                $cleanFileName = basename($user->userpic);

                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'userpic'    => $cleanFileName,
                        'updated_at' => now()
                    ]);
                
                $updatedCount++;
            }

            return response()->json([
                'status' => 'success',
                'total_dirty_paths_found' => $users->count(),
                'successfully_cleaned' => $updatedCount,
                'message' => 'অভিনন্দন! ডাটাবেজের সমস্ত ইউজারের প্রোফাইল পিকচারের ওল্ড পাথ কেটে একদম ক্লিন স্ট্যান্ডার্ড ফাইলের নামে রূপান্তর করা হয়েছে।'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'পাথ ক্লিন ও আপডেট করতে ব্যর্থ হয়েছে: ' . $e->getMessage()
            ], 500);
        }
    }
}
