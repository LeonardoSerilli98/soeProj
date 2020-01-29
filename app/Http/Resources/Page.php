<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Content as ContentResource;
use App\Content;

class Page extends JsonResource
{
    public $preserveKeys = true;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $contents = Content::where('contents.pagina', '=', $this->id)->get();
        return [
            'id' => $this->id,
            'creata_da' => $this->creata_da,
            'materia' => $this->materia,
            'nome_pagina' => $this->nome_pagina,
            'contenuto' => ContentResource::collection($contents),
        ];
    }
}
