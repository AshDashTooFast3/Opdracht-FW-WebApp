<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MorgenModel;

class MorgenController extends Controller
{
    private $morgen;
    public function __construct()
    {
        $this->morgen = new MorgenModel();
    }

    public function index()
    {
        return view('morgen');
    }
}
