<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllesModel;

class AllesController extends Controller
{

    public function index()
    {
        return view('alles');
    }
}
