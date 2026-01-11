<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MorgenModel;

class MorgenController extends Controller
{
    public function index()
    {
        return view('morgen');
    }
}
