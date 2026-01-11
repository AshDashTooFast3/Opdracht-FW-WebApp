<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VandaagModel;

class VandaagController extends Controller
{
    public function index()
    {
        return view('dashboard', 
        [
            'taak' => "Jouw taken voor vandaag"
        ]
    );
    }
}
