<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\ArtworkController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::controller(RegisterController::class)->group(function () {
    //Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(RegisterController::class)->group(function () {
        Route::post('profile', 'profile');
    });

    Route::controller(ArtworkController::class)->group(function () {
        Route::post('dashboard', 'index');
        Route::post('dashboard/total', 'artworkTotal');
        Route::post('artwork', 'getArtworkList');
        Route::post('position', 'getUserSessionPosition');
        Route::post('update-position', 'updateUserSession');
        Route::post('sortlist', 'storeSortLisedArtworks');
        Route::post('discard', 'updateArtworkDiscard');
        Route::post('final/list', 'getFinalArtworkList');
        Route::post('final/submit', 'updateArtworkFinal');
        //Route::post('sortlist/store', 'storeSortlist');
    });

    /*Route::controller(ApiController::class)->group(function () {
        // Main Sub Category
        Route::post('storeMainSubCategory', 'storeMainSubCategory');
        Route::get('getMainSubCategory', 'getMainSubCategory');

        // Main Sort lists
        Route::post('storeMainSortlists', 'storeMainSortlists');
        Route::get('getMainSortlist', 'getMainSortlist');

        // Main Category Details
        Route::post('storeMainCategory', 'storeMainCategory');
        Route::get('getMainCategoryList', 'getMainCategoryList');

        // Judge Session Details
        Route::post('storeJudgeSessionList', 'storeJudgeSessionList');
        Route::get('getJudgeSessionList', 'getJudgeSessionList');

        // Artwork Details
        Route::post('storeArtWorkDetail', 'storeArtWorkDetail');
        Route::get('getArtWorkDetailList', 'getArtWorkDetailList');

        // Collections
        Route::get('getCollectionList', 'getCollectionList');
        Route::post('storeCollectionList', 'storeCollectionList');

        // Sort list artwork
        Route::get('getSortLisedArtworks', 'getSortLisedArtworks');
        Route::post('storeSortLisedArtworks', 'storeSortLisedArtworks');
    });*/
});

Route::fallback(function () {
    return response()->json([
        'success' => false,
        'message' => 'Not Found!',
        'data' => []
    ], 404);
});
