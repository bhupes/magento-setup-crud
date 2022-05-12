<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SortLisedArtwork extends JsonResource
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
            'UserId' => $this->UserId,
            'ArtworkId' => $this->ArtworkId,
            'SortlistId' => $this->SortlistId,
            'Comment' => $this->Comment
        ];
    }
}
