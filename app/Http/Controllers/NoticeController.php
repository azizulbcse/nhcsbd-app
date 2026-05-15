<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class NoticeController extends Controller
{
    public function index()
    {
        $notices = DB::table('notices')
                        ->where('status', 2)
                        ->orderBy('notice_date', 'desc') 
                        ->paginate(10); 

        return view('notice', compact('notices'));
    }
}
