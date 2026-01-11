<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PriveModel;

class PriveController extends Controller
{
    public function index()
    {
        return view('prive');
    }
}
