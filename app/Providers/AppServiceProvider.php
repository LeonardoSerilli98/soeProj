<?php

namespace App\Providers;

use App\Subject;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layout' , function($view)
        {
            $materie = Subject::all();
            if(Auth::check()){
                $num_token = Auth::user()->num_token;
            }else{
                $num_token = 0;
            }

            $view->with('materie', $materie)->with('num_token', $num_token);
        });


        view()->composer('mypages', function($view)
        {
           
                $num_caricamenti = Auth::user()->num_caricamenti;
           
            

            $view->with('num_caricamenti', $num_caricamenti);
        });
    } 
    
}
