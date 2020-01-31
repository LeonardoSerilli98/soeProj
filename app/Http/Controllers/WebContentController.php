<?php
namespace App\Http\Controllers;

use App\Content;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WebContentController extends Controller
{

    public function store(Request $request)
    {
        if($request->file('appunto')->isValid()) {

            $extension = $request->file('appunto')->extension();
            if($extension == 'jpeg'){
                $extension = 'image/jpeg';
            }elseif ($extension == 'png'){
                    $extension = 'image/png';
            }elseif ($extension == 'mp3'){
                $extension = 'audio/mpeg';
            }elseif ($extension == 'pdf'){
                $extension = 'application/pdf';
            }


            $content = new Content();
            $content->caricato_da = Auth::id();
            $content->pagina = $request->pagina;
            $content->corso_laurea = $request->corso_laurea;
            $content->lingua = $request->lingua;
            $content->categoria = $request->categoria;
            $content->tipo_file = $extension;
            $content->argomento = $request->argomento;
            $content->nome_contenuto = $request->nome_contenuto;

            $content->save();

            $request->file('appunto')->storeAs('content', $content->id, 'public');

            $content->update(['path_contenuto'=> 'storage/content/'.$content->id]);

            $content = Content::where('contents.id', '=', $content->id)->get();

            if(Auth::user()->per_token == 1 ){
                Auth::user()->update(['per_token'=> 5]);
                Auth::user()->update(['num_token' => (Auth::user()->num_token + 3)]);
            }else{
                Auth::user()->update(['per_token'=> (Auth::user()->per_token - 1)]);
            }



            return view('singleContent')->with('content', $content);
        }else{
            return 'errore nel caricamento del file';
        }
    }

//fornisce un singolo appunto alla view 'singleContent'
    public function show($id)
    {
        $content = Content::where('contents.id', '=', $id)->get();
       return view('singleContent')->with('content', $content);
    }
}
