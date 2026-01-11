<?php

namespace App\Http\Controllers;

use App\Models\SideProjectenModel;

class SideProjectenController extends Controller
{
    public function index()
    {
        return view('side-projecten');
    }
}
