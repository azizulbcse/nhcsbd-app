<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $current_page = 'index.php';
        return view('home', compact('current_page'));
    }
}
