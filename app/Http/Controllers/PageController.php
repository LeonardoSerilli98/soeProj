<?php

namespace App\Http\Controllers;

use App\Content;
use App\Http\Resources\Content as ContentResource;
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

//PAGINE CON AQUISTI EFFETTUATI
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
    //ricerca tramite utente e/o materia

    $succes = false;
    $results = Page::all();
    //$path = '/api/pages/search?';

    if (!$request->user == 0) {

        $results = $results->where('creata_da', '=', $request->user);
        $succes = true;
    }


    if (!$request->subject == 0) {

        $results = $results->where('materia', $request->subject);
        $succes = true;


    }

    if(!$succes){


        return response()->json([
            'message' => 'La ricerca non è andata a buon fine'
        ], 403);

    }

    return PageResource::collection($results);



}
//FILRAGGIO AVANZATO


public function advancedFilter(Request $request)
{

    $results = Page::all();

    //variabili necessare alla form di filtraggio avanzato

    $categorie = Category::all();
    $corsi = Course::all();
    $hasResults = 1;

    if (!$request->user == 0) {

        $results = $results->where('creata_da', '=', $request->user);

    }


    if (!$request->subject == 0) {

        $results = $results->where('materia', $request->subject);

    }

    $IdArray = [];
    $count = 0;

    foreach ($results as $res){

        $idArray[$count] = $res->id;
        $count++;
    }





    if(($request->language == $request->course) && ($request->category == $request->fileType)){
        $hasResults = 0;
        return 'il filtraggio non ha prodotto risultati';
    }

    //le operazioni sulla stringa tmp sono eseguite al fine di farla matchare con il tipo di stringa richiesto da dal metodo json_decode;
    //se avessimo implementato la ricerca avanzata ramite una singola query contentente un join tra appunti e pagine avremmo impiegato molto piu tempo che facendo nel seguente modo
    //ovvero vedendo al risultato del filtraggio con un intersezione tra i risultati dei filtraggi tra i singoli campi e scartando tramite confronti sempre di più riducendo esponenzialmente la complessita di where in where.


    $contenuti = Content::when($request->course != 0, function ($q) use ($request) {

        return $q->where('corso_laurea', '=', $request->course);

    })
        ->when($request->language != "", function ($q) use ($request) {

            return $q->where('lingua', '=', $request->language);

        })
        ->when($request->fileType != "", function ($q) use ($request) {

            return $q->where('tipo_file', '=', $request->fileType);

        })
        ->when($request->category != 0, function ($q) use ($request) {

            return $q->where('categoria', '=', $request->category);

        })
        ->join('pages', 'contents.pagina', '=', 'pages.id')
        ->whereIn('pages.id', $idArray)
        ->select('contents.pagina as id', 'pages.creata_da', 'pages.materia', 'pages.nome_pagina');



    $contenuti = $contenuti->get();
    $contenuti = json_decode($contenuti);

    //qui eliminiamo i possibili duplicati nel json
    $contenuti = array_values(array_unique($contenuti, SORT_REGULAR));

    return $contenuti;


}

//ORDINARISULTATI
    public function sort(Request $request)
    {

        return 'risultati ordinati';

    }




}
