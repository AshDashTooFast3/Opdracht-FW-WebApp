<?php

namespace App\Http\Controllers;

use App\Models\SideProjectenModel;

class SideProjectenController extends Controller
{
    private $sideprojecten;

    public function __construct()
    {
        $this->sideprojecten = new SideProjectenModel;
    }

    public function index()
    {
        return view('side-projecten');
    }
}
