<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MainCollection extends JsonResource
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
            'CollectionId' => $this->CollectionId,
            'CollectionName' => $this->CollectionName,
            //'Description' => $this->Description,
            // 'IsActive' => $this->IsActive,
            // 'IsDeleted' => $this->IsDeleted,
            // 'CreatedAt' => $this->CreatedAt->format('d/m/Y'),
            // 'UpdatedAt' => $this->UpdatedAt->format('d/m/Y'),
        ];
    }
}
