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

        if($request->exists('user')){

            $results = $results->where('creata_da', $request->user);
            $succes = true;

        }


        if($request->exists('subject')){

            $results = $results->where('materia', $request->subject);
            $succes = true;


        }


       /* $hasAdded = false;

        foreach(array_keys($request->query()) as $pathField){

            $path = $path.$pathField;

            if($hasAdded){
                $path = $path.'&&';
            }

            $hasAdded = true;

        }*/

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
    //effettua una ricerca normale tramite utente e/o materia e procede a filtrare i risultati di quest'ultima
        $succes = false;
        $results = Page::all();
        //$path = '/api/pages/search?';

        if($request->exists('user')){

            $results = $results->where('creata_da', $request->user);
            $succes = true;

        }

        if($request->exists('subject')){

            $results = $results->where('materia', $request->subject);
            $succes = true;

        }

        if(!$succes){

            return response()->json([
                'message' => 'La ricerca non è andata a buon fine'
            ], 403);

        }

        $pagineFiltrate = $results;
        $tmp = '';

        //tra le pagine trovate con una normale ricerca scarta tutte quelle che non contengono appunti con gli attributi specificati

        foreach ($pagineFiltrate as $page){


             $contents = Content::where('contents.pagina', '=', $page->id)->get();

            foreach ($contents as $content){



                if($request->exists('course')){
                    if($content->corso_laurea == $request->course){
                        $tmp = $tmp.(String)$pagineFiltrate->where('id', $content->pagina);
                     }
                }

                if($request->exists('language')){
                    if($content->lingua == $request->language){
                        $tmp = $tmp.(String)$pagineFiltrate->where('id', $content->pagina);
                    }
                }

                if($request->exists('fileType')){
                    if($content->fileType == $request->fileType){
                        $tmp = $tmp.(String)$pagineFiltrate->where('id', $content->pagina);
                    }
                }

                if($request->exists('category')){
                    if($content->categoria == $request->category){

                        $tmp = $tmp.(String)$pagineFiltrate->where('id', $request->category);

                    }
                }

            }

        }

        return $tmp;
    }

//ORDINARISULTATI
    public function sort(Request $request)
    {

        return 'risultati ordinati';

    }




}
