<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JudgeSession extends JsonResource
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
            'Id' => $this->Id,
            'CollectionId' => $this->CollectionId,
            'UserId' => $this->UserId,
            'SortlistId' => $this->ShortlistId,
            'Position' => $this->Position,
            //'CreatedAt' => $this->CreatedAt->format('d/m/Y'),
            //'UpdatedAt' => $this->UpdatedAt->format('d/m/Y')
        ];
    }
}
