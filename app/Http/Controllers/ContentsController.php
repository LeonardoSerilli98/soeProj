<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Content;
use App\Http\Resources\Content as ContentResource;

class contentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

//CARICA APPUNTO
    public function store(Request $request)
    {
        $newItem = new Content();
        $newItem->pagina = $request->idPagina;
        $newItem->caricato_da = 2; //Auth::id();
        $newItem->corso_laurea = $request->corso_laurea;
        $newItem->lingua = $request->lingua;
        $newItem->categoria= $request->categoria;
        $newItem->tipo_file= $request->tipo_file;
        $newItem->argomento= $request->argomento;
        $newItem->path_contenuto = 'venezia'; //inserisci generazione automatica path
        $newItem->save();

        return new ContentResource($newItem);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//VISUALIZZA ANTEPRIMA
    public function show($id)
    {
        return new ContentResource(Content::find(1));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

//AGGIORNA APPUNTO

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
//CANCELLA APPUNTO
    public function destroy($id)
    {
        //
    }

//ACQUISTA APPUNTO
    public function acquista($id)
    {
        return 'acquistato con successo';
    }
//SCARICA APPUNTO
    public function scarica($id)
    {
        //
    }
//SEGNALA APPUNTO
    public function segnala($id)
    {
        //
    }
//VOTA APPUNTO
    public function vota($id)
    {
        //
    }

}
