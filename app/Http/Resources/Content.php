<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Content extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'pagina' => $this->pagina,
            'caricato_da' => $this->caricato_da,
            'corso_laurea' => $this->corso_laurea,
            'lingua' => $this->lingua,
            'categoria'=> $this->categoria,
            'tipo_file' => $this->tipo_file,
            'argomento' => $this->argomento,
        ];
    }
}
