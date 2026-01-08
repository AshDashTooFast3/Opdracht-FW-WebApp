<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolModel;

class SchoolController extends Controller
{
    private $school;
    public function __construct()
    {
        $this->school = new SchoolModel();
    }

    public function index()
    {
        return view('school');
    }
}
