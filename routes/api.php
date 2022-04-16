<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('slide')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllSlide']);
});

Route::prefix('temoignange')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllTemoignange']);
});

Route::prefix('actualite')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllActualite']);
});

Route::prefix('actualitelimit')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllActualitelimite']);
});

Route::prefix('produitP')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllProduitP']);
});

Route::prefix('produitE')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllProduitE']);
});

Route::prefix('produitphare')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllProduitPhare']);
});

Route::prefix('menufront')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllMenufront']);
});

Route::prefix('partenaire')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllPartenaire']);
});

Route::prefix('statistique')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllStatistique']);
});

Route::prefix('personnelresp')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllPersonnelResp']);
});

Route::prefix('personnel')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllPersonnel']);
});

Route::prefix('logo')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllLogo']);
});

Route::prefix('email')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllEmail']);
});

Route::prefix('espaceclient')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllEspaceClient']);
});

Route::prefix('ouvrircompte')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllOuvrirCompte']);
});

Route::prefix('contactgna')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllContactgna']);
});


Route::prefix('reseauxsocial')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllReseaux']);
});

Route::prefix('banner')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllBanner']);
});

Route::prefix('help')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllHelp']);
});
Route::prefix('articles')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllArticle']);
});

Route::prefix('articlesmission')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllArticleMission']);
});

Route::prefix('articlesvaleur')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllArticleValeur']);
});

Route::prefix('articlesvision')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllArticleVision']);
});

Route::prefix('articlespolitiquequalite')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllArticlePolitiqueQualite']);
});

Route::prefix('articlesplansite')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllArticlePlanSite']);
});

Route::prefix('articlespolitiqueconfidentialite')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllArticlePolitiqueConfidentilite']);
});

Route::prefix('articlesmentionslegale')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllArticleMentionLegale']);
});

Route::prefix('aproposdenous')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllArticleapropos']);
});

Route::prefix('ausujet')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllArticlesujet']);
});

Route::prefix('actualitedetail')->group( function (){
    Route::get('/{id}',[\App\Http\Controllers\Api\ApiController::class,'getAllActualiteDetail']);
});


Route::prefix('agence')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllAgence']);
});

Route::prefix('contactuser')->group( function (){
    Route::post('/',[\App\Http\Controllers\Api\ApiController::class,'contact']);
});

Route::prefix('newsletter')->group( function (){
    Route::post('/',[\App\Http\Controllers\Api\ApiController::class,'newsletter']);
});

Route::prefix('countproduit')->group( function (){
    Route::post('/',[\App\Http\Controllers\Api\ApiController::class,'countproduit']);
});

Route::prefix('bannerParticulier')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllBannerParticulier']);
});

Route::prefix('bannerEntreprise')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllBannerEntreprise']);
});

Route::prefix('bannerActualite')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllBannerActualite']);
});

Route::prefix('bannerMetier')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllBannerMetier']);
});

Route::prefix('bannerContact')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllBannerContact']);
});

Route::prefix('parammap')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllvaleurMap']);
});

Route::prefix('publicite')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllPublicite']);
});
