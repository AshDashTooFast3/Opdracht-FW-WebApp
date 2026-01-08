<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WerkModel;

class WerkController extends Controller
{
    private $werk;
    public function __construct()
    {
        $this->werk = new WerkModel();
    }

    public function index()
    {
        return view('werk');
    }
}
