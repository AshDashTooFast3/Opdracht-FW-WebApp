<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PriveModel;

class PriveController extends Controller
{
    private $prive;
    public function __construct()
    {
        $this->prive = new PriveModel();
    }

    public function index()
    {
        return view('prive');
    }
}
