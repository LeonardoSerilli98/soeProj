<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebPageController extends Controller
{

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function getMyPages()
    {
        $pages = Page::where('pages.creata_da', '=', Auth::id() )->get();
        return view('mypages')->with('pages', $pages);
    }


    public function getMyPage($id)
    {
        $page = Page::where('pages.id','=', $id)->where('pages.creata_da', '=', Auth::id())->get();
        return $page;
    }




}
