<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MainCategory extends JsonResource
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
            'CategoryId' => $this->CategoryId,
            'CategoryName' => $this->CategoryName,
            'Description' => $this->Description,
            'Ranking' => $this->Ranking
        ];
    }
}
