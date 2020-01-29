<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'users';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

// CREA PROFILO
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

// VISUALIZZA PROFILO
    public function show($id)
    {
        //
    }

    /**

     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

// AGGIORNA PROFILO
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

// CANCELLA PROFILO
    public function destroy($id)
    {
        //
    }

//VISUALIZZA GRADUATORIA BCS
    public function bestCollaborative()
    {

        $bcs = User::orderBy('users.upvote_ricevuti', 'DESC')->paginate(30);;
        return $bcs;
    }

//BANNA
    public function banna($id){

        return 'utente bannato con successo';

    }

}
