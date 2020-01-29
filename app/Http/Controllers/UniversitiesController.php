<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class UniversitiesController extends Controller
{

//AGGIUNGI UNIVERSITÀ
    public function store(Request $request)
    {
        return 'università aggiunta';

    }
//AGGIUNGI CORSO
    public function addCourse(Request $corso)
    {
        return 'corso aggiunto';
    }
}
