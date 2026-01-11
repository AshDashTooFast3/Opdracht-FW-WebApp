<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MorgenController extends Controller
{
    public function index()
    {
        return view('morgen');
    }
}
