<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WerkModel;

class WerkController extends Controller
{
    public function index()
    {
        return view('werk');
    }
}
