<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function getMaster()
    {
        return view('home');
    }
    public function getAuth()
    {
        return view('auth');
    }

}
