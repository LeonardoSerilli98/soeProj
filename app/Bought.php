<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bought extends Model
{
    protected $fillable = ['utente', 'appunto'];
    public $timestamps = false;
}
