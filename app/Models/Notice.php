<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = [
        'notice_no', 
        'title', 
        'notice_date', 
        'content', 
        'file_name', 
        'status', 
        'creator_id'
    ];
}
