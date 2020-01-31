<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Course;
use App\University;

class FrontEndController extends Controller
{
    public function getMaster()
    {
        return view('home');
    }
    public function getAuth()
    {
        $corsi = Course::all();
        $universita = University::all();
        return view('auth')->with('corsi', $corsi)->with('universita', $universita);
    }

}
