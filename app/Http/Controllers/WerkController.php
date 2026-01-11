<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WerkController extends Controller
{
    public function index()
    {
        return view('werk');
    }
}
