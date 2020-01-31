<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Http\Request;

class WebContentController extends Controller
{

    public function store(Request $request)
    {
        //
    }

//fornisce un singolo appunto alla view 'singleContent'
    public function show($id)
    {
        $content = Content::where('contents.id', '=', $id)->get();
       return view('singleContent')->with('content', $content);
    }
}
