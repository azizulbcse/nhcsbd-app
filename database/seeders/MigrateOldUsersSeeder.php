<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class MigrateOldUsersSeeder extends Seeder
{
    public function run(): void
    {
        // ল্যারাভেলের 'migrate:fresh' আপনার পুরনো 'tbladminuser' টেবিলটি মুছে দেয়। 
        // তাই ডাটাবেজে টেবিলটি এখনো আছে কি না তা আগে চেক করা হচ্ছে
        $tableExists = DB::select("SHOW TABLES LIKE 'tbladminuser'");

        if (empty($tableExists)) {
            $this->command->error('tbladminuser টেবিলটি পাওয়া যায়নি! সম্ভবত migrate:fresh দেওয়ার কারণে এটি ডিলিট হয়ে গেছে। আপনি সমাধান-১ এর SQL কোডটি phpMyAdmin এ রান করুন।');
            return;
        }

        $oldUsers = DB::table('tbladminuser')->get();

        foreach ($oldUsers as $oldUser) {
            $email = filter_var($oldUser->username, FILTER_VALIDATE_EMAIL) 
                     ? $oldUser->username 
                     : $oldUser->username . '@nhcsbd.org';

            if (!User::where('email', $email)->exists()) {
                User::create([
                    'sl'           => $oldUser->user_id ?? null, // আপনার স্ক্রিনশট অনুযায়ী এটি user_id
                    'name'         => $oldUser->fullname ?? 'Unknown Name',
                    'email'        => $email,
                    'designations' => $oldUser->designations ?? null,
                    'pcode'        => $oldUser->pcode ?? null,
                    'usertype'     => $oldUser->usertype ?? null,
                    'mobileno'     => $oldUser->mobileno ?? null,
                    'role'         => (strtolower($oldUser->usertype) == 'admin' || $oldUser->role == 1) ? 'admin' : 'member',
                    'status'       => $oldUser->status ?? 1,
                    'password'     => Hash::make($oldUser->password), // পাসওয়ার্ড Bcrypt এনক্রিপশন
                ]);
            }
        }
    }
}
