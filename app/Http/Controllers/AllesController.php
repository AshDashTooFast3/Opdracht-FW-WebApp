<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllesModel;

class AllesController extends Controller
{
    private $alles;
    public function __construct()
    {
        $this->alles = new AllesModel();
    }

    public function index()
    {
        return view('alles');
    }
}
