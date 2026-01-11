<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolModel;

class SchoolController extends Controller
{
    public function index()
    {
        return view('school');
    }
}
