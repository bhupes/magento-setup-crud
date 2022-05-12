<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Models\MainCollection;
use App\Http\Resources\MainCollection as MainCollectionResource;
use App\Models\ArtWorkDetail;
use App\Http\Resources\ArtWorkDetail as ArtWorkDetailResource;
use App\Models\JudgeSession;
use App\Http\Resources\JudgeSession as JudgeSessionResource;
use App\Models\SortLisedArtwork;
use App\Http\Resources\SortLisedArtwork as SortLisedArtworkResource;
use App\Models\MainSortlists;
use App\Http\Resources\MainSortlists as MainSortlistsResource;

class ArtworkController extends BaseController
{
    const isTrue = 1;
    const isFalse = 0;

    public function index(Request $request)
    {
        try {
            $data = [
                'collection' => MainCollectionResource::collection(MainCollection::all()),
                'sortlist_level' => MainSortlistsResource::collection(MainSortlists::all())
            ];

            return $this->sendResponse($data, 'All dashboard data retrieved successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Something went wrong.please contact admin', $e->getMessage());
        }
    }

    public function artworkTotal(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'CollectionId' => 'required',
                'ShortlistId' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $artWorkDetail =  ArtWorkDetail::withoutGlobalScope('globalArtworkDetail')
                ->where('ArtworkSubmittedBy', auth()->user()->id)
                ->where('IsDeleted', self::isFalse)
                ->where('CollectionId', $request->get('CollectionId'));

            $collectionName = "";
            if (is_null($artWorkDetail->first())) {
                throw new \Exception('Artwork count not found');
            }

            if ($artWorkDetail->first()->MainCollection()->get()->first()) {
                $collectionName = $artWorkDetail->first()->MainCollection()->get()->first()->CollectionName;
            }

            if ($request->get('ShortlistId') !== 1) {
                $shortListedArtworkIds = auth()->user()->sortListedArtwork()
                    ->where('SortlistId', $request->get('ShortlistId') - 1)
                    ->pluck('ArtworkId');

                $artWorkDetail = $artWorkDetail->whereIn('ArtworkId', $shortListedArtworkIds);
            }

            $data = [
                'CollectionId' => $request->get('CollectionId'),
                'TotalCount' => isset($shortListedArtworkIds) && $shortListedArtworkIds->count() === 0 ? 0 : $artWorkDetail->count(),
                'ShortCount' => auth()->user()->sortListedArtwork()->where('SortlistId', $request->get('ShortlistId'))->count(),
                'CollectionName' => $collectionName
            ];

            return $this->sendResponse($data, 'Datshboard totals retrived successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Something went wrong.please contact admin', $e->getMessage());
        }
    }

    public function getArtworkList(Request $request)
    {
        try {
            $input = $request->all();

            $validator = Validator::make($input, [
                'CollectionId' => 'required',
                'ShortlistId' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $shortListedArtworkIds = auth()->user()->sortListedArtwork()
                ->where('SortlistId', $input['ShortlistId'])
                ->pluck('ArtworkId');

            if ($input['ShortlistId'] === 1) {
                $getUserSession = auth()->user()->userSession()
                    ->with('mainCollection.artwork')
                    ->where('ShortlistId', $input['ShortlistId'])
                    ->where('CollectionId', $input['CollectionId']);

                if ($getUserSession->count() > 0) {
                    $artWorkDetail = $getUserSession->first()->mainCollection
                        ->artwork
                        ->whereNotIn('ArtworkId', $shortListedArtworkIds);
                } else {
                    $artWorkDetail = ArtWorkDetail::where('CollectionId', $input['CollectionId'])
                        ->whereNotIn('ArtworkId', $shortListedArtworkIds)
                        ->get();
                }

                return $this->sendResponse(ArtWorkDetailResource::collection($artWorkDetail), 'All artwork retrieved successfully.');
            }

            $getSortListedArtwork = auth()->user()->sortListedArtwork()
                ->with('artwork')
                ->where('SortlistId', $input['ShortlistId'] - 1)
                ->whereNotIn('ArtworkId', $shortListedArtworkIds);

            if ($getSortListedArtwork->count() > 0) {
                $artWorkDetail = $getSortListedArtwork->get()->pluck('artwork.0');

                return $this->sendResponse(ArtWorkDetailResource::collection($artWorkDetail), 'All artwork retrieved successfully.');
            }

            return $this->sendResponse([], 'All artwork retrieved successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Something went wrong.please contact admin', $e->getMessage());
        }
    }

    public function getUserSessionPosition(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'CollectionId' => 'required',
                'ShortlistId' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $judgeSession = auth()->user()->userSession()
                ->where('CollectionId', $request->get('CollectionId'))
                ->where('ShortlistId', $request->get('ShortlistId'));

            if ($judgeSession->count() > 0) {
                return $this->sendResponse([
                    'position' => $judgeSession->pluck('Position')->first()
                ], 'Get current position from session retrived successfully.');
            }

            return $this->sendResponse([], 'Get current position from session retrived successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Something went wrong.please contact admin', $e->getMessage());
        }
    }


    public function updateUserSession(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'CollectionId' => 'required',
                'ShortlistId' => 'required',
                'Position' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $judgeSession = JudgeSession::updateOrCreate(
                [
                    'UserId' => auth()->user()->id,
                    'CollectionId' => $request->get('CollectionId'),
                    'ShortlistId' => $request->get('ShortlistId')
                ],
                ['Position' => $request->get('Position')]
            );

            return $this->sendResponse(new JudgeSessionResource($judgeSession), 'Session created successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Something went wrong.please contact admin', $e->getMessage());
        }
    }

    public function storeSortLisedArtworks(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'ArtworkId' => 'required',
                'SortlistId' => 'required',
                'Comment' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $sortLisedArtwork = SortLisedArtwork::updateOrCreate(
                [
                    'UserId' => auth()->user()->id,
                    'ArtworkId' => $request->get('ArtworkId'),
                    'SortlistId' => $request->get('SortlistId')
                ],
                ['Comment' => $request->get('Comment')]
            );

            return $this->sendResponse(new SortLisedArtworkResource($sortLisedArtwork), 'Artwork sort list created successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Something went wrong.please contact admin', $e->getMessage());
        }
    }

    public function updateArtworkDiscard(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'ArtworkId' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $artWorkDetail = ArtWorkDetail::where('ArtworkId', $request->get('ArtworkId'))->firstOrFail();
            $artWorkDetail->IsDiscard = self::isTrue;
            $artWorkDetail->save();

            return $this->sendResponse(new ArtWorkDetailResource($artWorkDetail), 'Artwork discard successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Something went wrong.please contact admin', $e->getMessage());
        }
    }

    public function updateArtworkFinal(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'CollectionId' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $artWorkDetail = ArtWorkDetail::where('ArtworkSubmittedBy', auth()->user()->id)
                ->where('CollectionId', $request->get('CollectionId'))
                ->update(['IsActive' => self::isFalse]);

            return $this->sendResponse([], 'Artwork finalized successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Something went wrong.please contact admin', $e->getMessage());
        }
    }

    public function getFinalArtworkList(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'CollectionId' => 'required',
                'ShortlistId' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $getSortListedArtwork = auth()->user()->sortListedArtwork()
                ->with('artwork', function ($query) use ($request) {
                    $query->withoutGlobalScope('globalArtworkDetail')
                        ->where('IsDeleted', self::isFalse)
                        ->where('IsDiscard', self::isFalse)
                        ->where('IsActive', self::isTrue)
                        ->where('CollectionId', $request->get('CollectionId'));
                })
                ->where('SortlistId', $request->get('ShortlistId'));

            if ($getSortListedArtwork->count() > 0) {
                $artWorkDetail = $getSortListedArtwork->first()->artwork;

                return $this->sendResponse(ArtWorkDetailResource::collection($artWorkDetail), 'All final artwork retrieved successfully.');
            }

            return $this->sendResponse([], 'All final artwork retrieved successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Something went wrong.please contact admin', $e->getMessage());
        }
    }

    public function storeSortlist(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'ShortlistName' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $mainSortlists =  MainSortlists::where("ShortlistName", $request->get('ShortlistName'))
                ->update(["IsActive" => self::isTrue]);

            return $this->sendResponse([], 'Sortlists created successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Something went wrong.please contact admin', $e->getMessage());
        }
    }
}
