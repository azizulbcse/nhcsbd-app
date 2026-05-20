<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DataMigrationController extends Controller
{
    /**
     * ১. ওল্ড ইউজার ডাটা মাইগ্রেশন গেটওয়ে
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
                SELECT user_id, sl, fullname, IF(username LIKE '%@%', username, CONCAT(username, '@nhcsbd.org')), designations, pcode, usertype, userpic, mobileno, IF(LOWER(usertype) = 'admin' OR role = 1, 'admin', 'member'), IFNULL(status, 1), password, NOW(), NOW() FROM tbladminuser;
            ");

            return response()->json(['status' => 'success', 'message' => 'ইউজার রেকর্ড স্থানান্তরিত হয়েছে।'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * ২. ওল্ড গ্যালারি ডাটা মাইগ্রেশন গেটওয়ে
     * ব্রাউজার ইউআরএল: http://localhost:8000/migrate-old-gallery
     */
    public function migrateOldGallery()
    {
        try {
            if (!Schema::hasTable('tblgallery')) { return response()->json(['status' => 'error', 'message' => 'tblgallery পাওয়া যায়নি!'], 404); }
            if (!Schema::hasTable('galleries')) {
                DB::statement("CREATE TABLE `galleries` (`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, `title` varchar(255) NOT NULL, `media_type` enum('image','video') NOT NULL DEFAULT 'image', `file_name` text NOT NULL, `created_by` bigint(20) UNSIGNED NULL, `status` tinyint(4) NOT NULL DEFAULT '1', `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
            }
            DB::statement("SET FOREIGN_KEY_CHECKS = 0;"); DB::table('galleries')->truncate(); DB::statement("SET FOREIGN_KEY_CHECKS = 1;");
            DB::statement("INSERT INTO galleries (id, title, media_type, file_name, created_by, status, upload_date, created_at, updated_at) SELECT id, IFNULL(title, 'Untitled Media'), IFNULL(media_type, 'image'), file_name, 1, IFNULL(status, 2), IFNULL(upload_date, NOW()), NOW(), NOW() FROM tblgallery;");
            return response()->json(['status' => 'success', 'message' => 'গ্যালারি ডাটা স্থানান্তরিত হয়েছে।'], 200);
        } catch (\Exception $e) { return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500); }
    }

    /**
     * ৩. ওল্ড নোটিশ ডাটা মাইগ্রেশন গেটওয়ে
     * ব্রাউজার ইউআরএল: http://localhost:8000/migrate-old-notices
     */
    public function migrateOldNotices()
    {
        try {
            if (!Schema::hasTable('tblnotices')) { return response()->json(['status' => 'error', 'message' => 'tblnotices পাওয়া যায়নি!'], 404); }
            if (!Schema::hasTable('notices')) {
                DB::statement("CREATE TABLE `notices` (`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, `noticeno` varchar(255) NULL, `title` varchar(255) NOT NULL, `notice_date` date NOT NULL, `content` text NULL, `file_name` varchar(255) NULL, `created_by` bigint(20) UNSIGNED NULL, `status` tinyint(4) NOT NULL DEFAULT '1', `created_at` timestamp NULL DEFAULT NULL, `updated_at` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
            }
            DB::statement("SET FOREIGN_KEY_CHECKS = 0;"); DB::table('notices')->truncate(); DB::statement("SET FOREIGN_KEY_CHECKS = 1;");
            DB::statement("INSERT INTO notices (id, noticeno, title, notice_date, content, file_name, creator_id, IFNULL(status, 2), IFNULL(created_at, NOW()), NOW() FROM tblnotices;");
            return response()->json(['status' => 'success', 'message' => 'নোটিশ মাইগ্রেশন সফল হয়েছে।'], 200);
        } catch (\Exception $e) { return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500); }
    }

    /**
     * ৪. অ্যাডমিন এবং সাধারণ মেম্বার (tblapplicantinfo) উভয়ের ছবির পাথ ক্লিন করার মাস্টার মেথড।
     * ব্রাউজার ইউআরএল: http://localhost:8000/update-user-pic-path
     */
    public function updateUserPicPath()
    {
        try {
            $cleanedAdmins = 0;
            $cleanedMembers = 0;

            // ক. প্রথমে লারাভেলের 'users' টেবিলের অ্যাডমিনদের ওল্ড পাথ ক্লিন করা
            $dirtyAdmins = DB::table('users')->where('userpic', 'LIKE', '%assets/img/user%')->get();
            foreach ($dirtyAdmins as $admin) {
                DB::table('users')->where('id', $admin->id)->update([
                    'userpic'    => basename($admin->userpic),
                    'updated_at' => now()
                ]);
                $cleanedAdmins++;
            }

            // খ. এবার স্ক্রিনশট অনুযায়ী 'tblapplicantinfo' টেবিলের সব সাধারণ সদস্যদের ওল্ড পাথ ক্লিন করা
            if (Schema::hasTable('tblapplicantinfo')) {
                $dirtyMembers = DB::table('tblapplicantinfo')->where('userpic', 'LIKE', '%assets/img/user%')->get();
                foreach ($dirtyMembers as $member) {
                    DB::table('tblapplicantinfo')->where('mid', $member->mid)->update([
                        'userpic' => basename($member->userpic)
                    ]);
                    $cleanedMembers++;
                }
            }

            return response()->json([
                'status' => 'success',
                'cleaned_admin_records_in_users' => $cleanedAdmins,
                'cleaned_member_records_in_tblapplicantinfo' => $cleanedMembers,
                'message' => 'অভিনন্দন! ডাটাবেজের অ্যাডমিন এবং সাধারণ মেম্বার (tblapplicantinfo) উভয়ের ছবির ওল্ড পাথ চিরতরে কেটে একদম ক্লিন ও ফিউচার-প্রুফ করা হয়েছে।'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'পাথ ক্লিন ও আপডেট করতে ব্যর্থ হয়েছে: ' . $e->getMessage()
            ], 500);
        }
    }
}
