<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['path_contenuto'];
    public $timestamps = false;
}
