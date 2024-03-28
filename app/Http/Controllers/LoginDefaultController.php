<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginDefaultController extends Controller
{
    public function index()
    {
        return view('default');
    }
}
