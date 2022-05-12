<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArtWorkDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //dd($this->artwork);
        return [
            'ArtworkId' => $this->ArtworkId,
            'ArtworkTitle' => $this->ArtworkTitle,
            'ArtworkUrl' => env('BASE_IMG_URL', 'https://betatestingstorage.blob.core.windows.net') . $this->ArtworkUrl,
            'Category' => [
                'Name' => $this->mainSubCategory->mainCategory->CategoryName,
                'Description' => $this->mainSubCategory->mainCategory->Description,
                'Ranking' => $this->mainSubCategory->mainCategory->Ranking,
            ],
            //'CollectionId' => $this->CollectionId,
            'Collection' => [
                'Name' => $this->MainCollection->CollectionName,
                'Description' => $this->MainCollection->Description,
            ],
            'Description' => $this->Description,
            //'SubCategoryId' => $this->SubCategoryId,
            'SubCategory' => [
                'Name' => $this->mainSubCategory->SubCategoryName,
                'Description' => $this->mainSubCategory->Description,
            ],
            //'ArtworkSubmittedBy' => $this->ArtworkSubmittedBy,
            'IsDiscard' => $this->IsDiscard,
            //'IsActive' => $this->IsActive,
            //'IsDeleted' => $this->IsDeleted
        ];
    }
}
