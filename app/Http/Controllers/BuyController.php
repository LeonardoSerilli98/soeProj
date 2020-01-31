<?php

namespace App\Http\Controllers;

use App\Bought;
use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyController extends Controller
{
    public function buy(Request $request){
        $content = Content::where('contents.id', '=', $request->idAppunto)->get();
        if((Auth::user()->num_token >= 3)&&(Auth::id() != $content[0]->id)){
            $acquisto = new Bought();
            $acquisto->utente = Auth::id();
            $acquisto->appunto = $request->idAppunto;
            $acquisto->save();
            Auth::user()->update(['num_token' => (Auth::user()-> num_token - 3)]);

            return view('singleContent')->with('content', $content)->with('bought', true);
        }else{
            return 'non puoi comprare questo appunto';
        }
    }
}
