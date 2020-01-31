<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['name','email','password','corso_laurea','per_token', 'num_token',];
    public function AuthAcessToken(){
        return $this->hasMany('\App\OauthAccessToken');
    }


}
