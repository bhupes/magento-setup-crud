<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MainSubCategory extends JsonResource
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
            'SubCategoryId' => $this->SubCategoryId,
            'SubCategoryName' => $this->SubCategoryName,
            'Description' => $this->Description,
            'CategoryId' => $this->CategoryId
        ];
    }
}
