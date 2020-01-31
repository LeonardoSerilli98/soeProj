<?php

namespace App\Http\Controllers;

use App\Page;
use App\Content;
use App\Subject;
use App\Category;
use App\Course;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebPageController extends Controller
{

    public function store(Request $request)
    {
        $page = new Page();
        $page->creata_da = Auth::id();
        $page->materia = $request->materia;
        $page->nome_pagina = $request->nome;
        $page->save();

        return redirect('/mypages/' . $page->id);
    }

//mostra il contenuto di una singola pagina tramite i link offerti dalla ricerca
    public function show($id)
    {
        $contenuts = Content::where('contents.pagina', '=', $id)->get();
        return view('page')->with('contents', $contenuts);
    }

//tramite link nella home mostra i link per accedere alle proprie pagine

    public function getMyPages()
    {
        $pages = Page::where('pages.creata_da', '=', Auth::id())->get();
        $materie = Subject::all();
        return view('mypages')->with('pages', $pages)->with('materie', $materie);
    }

//tramite i link nella view 'mypages' permette di accedere agli appunti contenuti in una propria pagina

    public function getMyPage($id)
    {

        $myContent = Content::where('contents.pagina', '=', $id)
            ->where('caricato_da', '=', Auth::id())
            ->get();

        return view('mypage')->with('contents', $myContent);
    }

    public function search(Request $request)
    {

        //ricerca tramite utente e/o materia

        $succes = false;
        $results = Page::all();

        if (!$request->user == '') {

            $userId = User::select("users.id")
                ->where('users.name', '=', $request->user)->get();

            $userId = $userId[0]->id;

            $results = $results->where('creata_da', '=', $userId);
            $succes = true;

        }


        if (!$request->subject == 0) {

            $results = $results->where('materia', $request->subject);
            $succes = true;


        }


        if (!$succes) {

            return 'la ricerca non è andata a buon fine';

        }

        //variabili necessare alla form di filtraggio avanzato
        $categorie = Category::all();
        $corsi = Course::all();

        return view('search')
            ->with('risultati', $results)
            ->with('categorie', $categorie)
            ->with('corsi', $corsi)
            ->with('data', $request);
    }

    public function advancedFilter(Request $request)
    {
        $succes = false;
        $results = Page::all();

        if (!$request->user == '') {

            $userId = User::select("users.id")
                ->where('users.name', '=', $request->user)->get();

            $userId = $userId[0]->id;

            $results = $results->where('creata_da', '=', $userId);


        }


        if (!$request->subject == 0) {

            $results = $results->where('materia', $request->subject);



        }


         $pagineFiltrate = $results;
        // return $pagineFiltrate = json_encode($pagineFiltrate);
       // return json_decode($pagineFiltrate);
        $tmp = '';


        //tra le pagine trovate con una normale ricerca scarta tutte quelle che non contengono appunti con gli attributi specificati

        foreach ($pagineFiltrate as $page) {

            $contents = Content::where('contents.pagina', '=', $page->id)->get();

            foreach ($contents as $content) {

                //le operazioni sulla stringa tmp sono eseguite al fine di farla matchare con il tipo di stringa richiesto da dal metodo json_decode;
                //se avessimo implementato la ricerca avanzata ramite una singola query contentente un join tra appunti e pagine avremmo impiegato molto piu tempo che facendo nel seguente modo
                //ovvero vedendo al risultato del filtraggio con un intersezione tra i risultati dei filtraggi tra i singoli campi e scartando tramite confronti sempre di più riducendo esponenzialmente la complessita di query in query.

                 if ($request->course != 0) {

                     if ($content->corso_laurea == $request->course) {
                         $tmp = $tmp.(($pagineFiltrate->where('id', $content->pagina))[0]).',';
                         $succes = true;
                     }
                 }

                   if ((!$request->language == '')) {

                       if ($content->lingua == $request->language) {
                           $tmp = $tmp.(($pagineFiltrate->where('id', $content->pagina))[0]).',';
                           $succes = true;

                       }
                   }

                    if (!($request->fileType == '0')) {

                         if ($content->fileType == $request->fileType) {
                             $tmp = $tmp.(($pagineFiltrate->where('id', $content->pagina))[0]).',';
                             $succes = true;

                         }
                     }

                     if ($request->category != 0) {

                         if ($content->categoria == $request->category) {

                             $tmp = $tmp.(($pagineFiltrate->where('id', $request->category))[0]).',';
                             $succes = true;


                         }
                     }

            }

        }

        //variabili necessare alla form di filtraggio avanzato
        $categorie = Category::all();
        $corsi = Course::all();
        $tmp = substr($tmp, 0, -1);
        $tmp = '['.$tmp.']';
        $tmp = json_decode($tmp);
        $tmp = array_values( array_unique( $tmp, SORT_REGULAR ) );

        if(!$succes){
            return view('search')
                ->with('risultati', $results)
                ->with('categorie', $categorie)
                ->with('corsi', $corsi)
                ->with('data', $request);
        }
        return view('search')
            ->with('risultati', $tmp)
            ->with('categorie', $categorie)
            ->with('corsi', $corsi)
        ->with('data', $request);

    }
}
