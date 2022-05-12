<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Models\ArtWorkDetail;
use App\Http\Resources\ArtWorkDetail as ArtWorkDetailResource;
use App\Models\MainCollection;
use App\Http\Resources\MainCollection as MainCollectionResource;
use App\Models\SortLisedArtwork;
use App\Http\Resources\SortLisedArtwork as SortLisedArtworkResource;
use App\Models\JudgeSession;
use App\Http\Resources\JudgeSession as JudgeSessionResource;
use App\Models\MainCategory;
use App\Http\Resources\MainCategory as MainCategoryResource;
use App\Models\MainSortlists;
use App\Http\Resources\MainSortlists as MainSortlistsResource;
use App\Models\MainSubCategory;
use App\Http\Resources\MainSubCategory as MainSubCategoryResource;

class ApiController extends BaseController
{
    const isTrue = 1;
    const isFalse = 0;

    // Sub Category
    public function getMainSubCategory(Request $request)
    {
        $category = MainSubCategory::all();

        return $this->sendResponse(MainSubCategoryResource::collection($category), 'All MainSubCategory retrieved successfully.');
    }

    public function storeMainSubCategory(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'SubCategoryName' => 'required',
            'Description' => 'required',
            'CategoryId' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['SubCategoryId'] = MainSubCategory::all()->last()->SubCategoryId + 1;
        $input['IsDeleted'] = self::isFalse;

        $MainSubCategory = MainSubCategory::create($input);

        return $this->sendResponse(new MainSubCategoryResource($MainSubCategory), 'MainSubCategory created successfully.');
    }

    // Main Sort list
    public function getMainSortlist(Request $request)
    {
        $category = MainSortlists::all();

        return $this->sendResponse(MainSortlistsResource::collection($category), 'All MainSortlists retrieved successfully.');
    }

    public function storeMainSortlists(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'ShortlistName' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['IsActive'] = self::isTrue;

        $MainSortlists = MainSortlists::create($input);

        return $this->sendResponse(new MainSortlistsResource($MainSortlists), 'MainSortlists created successfully.');
    }

    // Category
    public function getMainCategoryList(Request $request)
    {
        $category = MainCategory::all();

        return $this->sendResponse(MainCategoryResource::collection($category), 'All Category retrieved successfully.');
    }

    public function storeMainCategory(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'CategoryName' => 'required',
            'Description' => 'required',
            'Ranking' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['CategoryId'] = MainCategory::all()->last()->CategoryId + 1;
        $input['IsDeleted'] = self::isFalse;

        $mainCategory = MainCategory::create($input);

        return $this->sendResponse(new MainCategoryResource($mainCategory), 'MainCategory created successfully.');
    }

    // Judge Session
    public function getJudgeSessionList(Request $request)
    {
        $JudgeSession = JudgeSession::where('UserId', auth()->user()->id)->get();

        return $this->sendResponse(JudgeSessionResource::collection($JudgeSession), 'All JudgeSession retrieved successfully.');
    }

    public function storeJudgeSessionList(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'CollectionId' => 'required',
            'ShortlistId' => 'required',
            'Position' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['UserId'] = auth()->user()->id;

        $JudgeSession = JudgeSession::create($input);

        return $this->sendResponse(new JudgeSessionResource($JudgeSession), 'JudgeSession created successfully.');
    }

    // ArtWork Detail
    public function getArtWorkDetailList(Request $request)
    {
        $artWorkDetail = ArtWorkDetail::all();

        return $this->sendResponse(ArtWorkDetailResource::collection($artWorkDetail), 'All artWorkDetail retrieved successfully.');
    }

    public function storeArtWorkDetail(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'ArtworkTitle' => 'required',
            'ArtworkUrl' => 'required',
            'ArtworkSubmittedBy' => 'required',
            'SubCategoryId' => 'required',
            'CollectionId' => 'required',
            'Description' => 'required',
            'IsDiscard' => 'required',
            'IsActive' => 'required',
            'IsDeleted' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['ArtworkId'] = ArtWorkDetail::all()->last()->ArtworkId + 1;

        $artWorkDetail = ArtWorkDetail::create($input);

        return $this->sendResponse(new ArtWorkDetailResource($artWorkDetail), 'ArtWorkDetail created successfully.');
    }

    // Sort listed artwork
    public function getSortLisedArtworks(Request $request)
    {
        $collection = SortLisedArtwork::where('UserId', auth()->user()->id)->get();

        return $this->sendResponse(SortLisedArtworkResource::collection($collection), 'All SortLisedArtwork retrieved successfully.');
    }

    public function storeSortLisedArtworks(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'ArtworkId' => 'required',
            'SortlistId' => 'required',
            'Comment' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['UserId'] = auth()->user()->id;
        $sortLisedArtwork = SortLisedArtwork::create($input);

        return $this->sendResponse(new SortLisedArtworkResource($sortLisedArtwork), 'SortLisedArtwork created successfully.');
    }

    //  Collection
    public function getCollectionList(Request $request)
    {
        $collection = auth()->user()->collections
            ->where('IsActive', self::isTrue)
            ->where('IsDeleted', self::isFalse);

        return $this->sendResponse(MainCollectionResource::collection($collection), 'All collection retrieved successfully.');
    }

    public function storeCollectionList(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'CollectionName' => 'required',
            'Description' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['CollectionId'] = MainCollection::all()->last()->CollectionId + 1;
        $input['user_id'] = auth()->user()->id;
        $input['IsActive'] = self::isTrue;
        $input['IsDeleted'] = self::isFalse;

        $mainCategory = MainCollection::create($input);

        return $this->sendResponse(new MainCollectionResource($mainCategory), 'MainCategory created successfully.');
    }
}
