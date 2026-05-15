<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('notices')) {
            Schema::create('notices', function (Blueprint $table) {
                $table->id(); 
                $table->string('notice_no', 100)->nullable(); 
                $table->string('title', 255); 
                $table->date('notice_date'); 
                $table->text('content'); 
                $table->string('file_name', 255)->nullable(); 
                $table->tinyInteger('status')->default(1); 
                $table->integer('creator_id')->nullable(); 
                $table->timestamps(); 
            });
        }

        if (Schema::hasTable('tblnotices')) {
            $oldNotices = DB::table('tblnotices')->get();

            foreach ($oldNotices as $old) {
                $oldData = (array) $old;

                $exists = DB::table('notices')->where('id', $oldData['id'])->exists();
                
                if (!$exists) {
                    DB::table('notices')->insert([
                        'id'          => $oldData['id'],
                        'notice_no'   => $oldData['noticeno'] ?? null, // কলাম ম্যাপিং ফিক্স
                        'title'       => $oldData['title'],
                        'notice_date' => $oldData['notice_date'],
                        'content'     => $oldData['content'],
                        'file_name'   => $oldData['file_name'] ?? null,
                        'status'      => $oldData['status'] ?? 2,
                        'creator_id'  => $oldData['creator_id'] ?? null,
                        'created_at'  => $oldData['created_at'] ?? now(),
                        'updated_at'  => now(),
                    ]);
                }
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
