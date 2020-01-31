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
        $categorie = Category::all();
        $corsi = Course::all();

        $nome_pagina = Page::find($id)->nome_pagina;

        return view('mypage')->with('contents', $myContent)->with('idPagina', $id)->with('categorie', $categorie)->with('corsi', $corsi)->with('nome_pagina', $nome_pagina);
    }


    public function search(Request $request)
    {

        //ricerca tramite utente e/o materia

        $succes = false;
        $results = Page::all();
        $hasResults = 1;

        if (!$request->user == '') {

            $userId = User::select("users.id")
                ->where('users.name', '=', $request->user)->get();

            if($userId->isEmpty()){
                return 'la ricerca non è andata a buon fine';
            }

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
            ->with('hasResults',  $hasResults)
            ->with('risultati', $results)
            ->with('categorie', $categorie)
            ->with('corsi', $corsi)
            ->with('data', $request);
    }

    public function advancedFilter(Request $request)
    {

        $results = Page::all();

        //variabili necessare alla form di filtraggio avanzato

        $categorie = Category::all();
        $corsi = Course::all();
        $hasResults = 1;

        if (!$request->user == '') {

            $userId = User::select("users.id")
                ->where('users.name', '=', $request->user)->get();

            $userId = $userId[0]->id;

            $results = $results->where('creata_da', '=', $userId);


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
            return view('search')
                ->with('hasResults', $hasResults)
                ->with('categorie', $categorie)
                ->with('corsi', $corsi)
                ->with('data', $request);
        }

        //le operazioni sulla stringa tmp sono eseguite al fine di farla matchare con il tipo di stringa richiesto da dal metodo json_decode;
        //se avessimo implementato la ricerca avanzata ramite una singola query contentente un join tra appunti e pagine avremmo impiegato molto piu tempo che facendo nel seguente modo
        //ovvero vedendo al risultato del filtraggio con un intersezione tra i risultati dei filtraggi tra i singoli campi e scartando tramite confronti sempre di più riducendo esponenzialmente la complessita di where in where.


        $contenuti = Content::when($request->course != "0", function ($q) use ($request) {

            return $q->where('corso_laurea', '=', $request->course);

        })
            ->when($request->language != "0", function ($q) use ($request) {

                return $q->where('lingua', '=', $request->language);

            })
            ->when($request->fileType != "0", function ($q) use ($request) {

                return $q->where('tipo_file', '=', $request->fileType);

            })
            ->when($request->category != "0", function ($q) use ($request) {

                return $q->where('categoria', '=', $request->category);

            })
            ->join('pages', 'contents.pagina', '=', 'pages.id')
            ->whereIn('pages.id', $idArray)
            ->select('contents.pagina as id', 'pages.creata_da', 'pages.materia', 'pages.nome_pagina');



        $contenuti = $contenuti->get();
        $contenuti = json_decode($contenuti);
        $contenuti = array_values(array_unique($contenuti, SORT_REGULAR));
//tra le pagine trovate con una normale ricerca scarta tutte quelle che non contengono appunti con gli attributi specificati


        return view('search')
            ->with('hasResults', $hasResults)
            ->with('risultati', $contenuti)
            ->with('categorie', $categorie)
            ->with('corsi', $corsi)
            ->with('data', $request);


    }
}
