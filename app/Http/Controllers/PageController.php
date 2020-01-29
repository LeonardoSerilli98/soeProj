<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Http\Resources\Page as PageResource;
use App\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return URL::current();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//CREA PAGINA
    public function store(Request $request)
    {

        $newItem = new Page();
        $newItem->creata_da = 2; //Auth::id();
        $newItem->nome_pagina = $request->nome_pagina;
        $newItem->materia = $request->materia;
        $newItem->save();

        return new PageResource($newItem);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

//VISUALIZZA PAGINA
    public function show($id)
    {
        return new PageResource(Page::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//AGGIORNA PAGINA
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//CANCELLA PAGINA
    public function destroy($id)
    {
        //
    }

//PAGINE AQUISTATE
    public function bought($id)
    {
        return 'pagine comprate';

    }

//PAGINE CREATE

    public function created($id)
    {

        return 'pagine create';

    }

//RICERCA

    public function search(Request $request)
    {

        if(!$request->exists('subject') && !$request->exists('user')){

            return response()->json([
                'message' => 'La ricerca non è andata a buon fine'
            ], 403);

        }

        $results = Page::all();
        $path = '/api/pages/search?';

        if($request->exists('subject')){

            $results = $results->where('pages.materia', '=', $request->subject);

        }

        if($request->exists('user')){

            $results = $results->where('pages.creata_da', '=', $request->user);
        }

            return array_keys($request->query());



        $results->withPath('/api/pages/search?user='.$request->user);
        return PageResource::collection($results);



    }
//FILRAGGIO AVANZATO

    public function advancedFilter(Request $request)
    {

        if($request->exists('subject') && $request->exists('user')){
            $results = Page::where('pages.materia', '=', $request->subject)
                ->where('pages.materia', '=', $request->subject);
        }

        if($request->exists('subject') && !$request->exists('user')){

            $results = Page::where('pages.materia', '=', $request->subject);

         }

        if($request->exists('user') && !$request->exists('subject')){

            $results = Page::where('pages.creata_da', '=', $request->user);

        }



    }

//ORDINARISULTATI
    public function sort(Request $request)
    {

        return 'risultati ordinati';

    }




}
