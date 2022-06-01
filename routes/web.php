<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    //exit('test');
    return view('welcome');
});*/

Route::match(['get', 'post'], '/', [App\Http\Controllers\ConnexionController::class, 'login'])->name('connexion');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::match(['get', 'post'], '/login', [App\Http\Controllers\ConnexionController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/connexion', [App\Http\Controllers\ConnexionController::class, 'login'])->name('connexion');
Route::match(['get', 'post'], '/motdepasseoublie', [App\Http\Controllers\ConnexionController::class, 'motdepasseoublie'])->name('motdepasseoublie');
Route::get('/dashboard', [App\Http\Controllers\ConnexionController::class, 'dashboard'])->name('dashboard');
Route::get('/reload-captcha', [App\Http\Controllers\ConnexionController::class, 'reloadCaptcha'])->name('reloadCaptcha');


Route::group(['middleware' => ['auth']], function () {

    Route::resources([
        'roles' => App\Http\Controllers\RoleController::class,
        'users' => App\Http\Controllers\UserController::class,
        /*'products' => App\Http\Controllers\ProductController::class,*/
        'piece' => App\Http\Controllers\PieceController::class,
        'permissions' => App\Http\Controllers\PermissionController::class,
        'menus' => App\Http\Controllers\MenuController::class,
        'sousmenus' => App\Http\Controllers\SousmenuController::class,
    ]);

    Route::match(['get', 'post'], '/menuprofil', [App\Http\Controllers\GenerermenuController::class, 'parametragemenu'])->name('menuprofil');

    Route::match(['get', 'post'], '/compteclient/{id}', [App\Http\Controllers\UserController::class, 'compteclient'])->name('compteclient');


    Route::match(['get', 'post'], '/profil', [App\Http\Controllers\HomeController::class, 'profil'])->name('profil');

    Route::match(['get', 'post'], '/modifiermotdepasse', [App\Http\Controllers\HomeController::class, 'updatepassword'])->name('modifier.mot.passe');

    Route::match(['get', 'post'], '/generermenu', [App\Http\Controllers\GenerermenuController::class, 'index'])->name('generermenu');

    Route::match(['get', 'post'], '/menuprofillayout/{id}', [App\Http\Controllers\GenerermenuController::class, 'menuprofillayout'])->name('menuprofillayout');

    Route::match(['get', 'post'], '/slides', [App\Http\Controllers\ParametrageController::class, 'slide'])->name('slides');

    Route::match(['get', 'post'], '/creerslides', [App\Http\Controllers\ParametrageController::class, 'creationslide'])->name('creerslides');

    Route::match(['get', 'post'], '/creerslidesv', [App\Http\Controllers\ParametrageController::class, 'creationslidevideo'])->name('creerslidesv');

    Route::match(['get', 'post'], '/modifierslides/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierslides'])->name('modifierslides');

    Route::match(['get', 'post'], '/activeslides/{id}', [App\Http\Controllers\ParametrageController::class, 'activeslide'])->name('activeslides');

    Route::match(['get', 'post'], '/desactiveslides/{id}', [App\Http\Controllers\ParametrageController::class, 'desactiveslide'])->name('desactiveslides');


    Route::match(['get', 'post'], '/productservice', [App\Http\Controllers\ParametrageController::class, 'productservice'])->name('productservice');

    Route::match(['get', 'post'], '/creerproductservice', [App\Http\Controllers\ParametrageController::class, 'creerproductservice'])->name('creerproductservice');

    Route::match(['get', 'post'], '/modifierproductservice/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierproductservice'])->name('modifierproductservice');

    Route::match(['get', 'post'], '/activeproductservice/{id}', [App\Http\Controllers\ParametrageController::class, 'activeproductservice'])->name('activeproductservice');

    Route::match(['get', 'post'], '/desactiveproductservice/{id}', [App\Http\Controllers\ParametrageController::class, 'desactiveproductservice'])->name('desactiveproductservice');


    Route::match(['get', 'post'], '/actualite', [App\Http\Controllers\ParametrageController::class, 'actualite'])->name('actualite');

    Route::match(['get', 'post'], '/creationactualite', [App\Http\Controllers\ParametrageController::class, 'creationactualite'])->name('creationactualite');

    Route::match(['get', 'post'], '/modifieractualite/{id}', [App\Http\Controllers\ParametrageController::class, 'modifieractualite'])->name('modifieractualite');

    Route::match(['get', 'post'], '/activeactualite/{id}', [App\Http\Controllers\ParametrageController::class, 'activeactualite'])->name('activeactualite');

    Route::match(['get', 'post'], '/desactiveactualite/{id}', [App\Http\Controllers\ParametrageController::class, 'desactiveactualite'])->name('desactiveactualite');


    Route::match(['get', 'post'], '/produitphare', [App\Http\Controllers\ParametrageController::class, 'produitphare'])->name('produitphare');

    Route::match(['get', 'post'], '/creerproduitphare', [App\Http\Controllers\ParametrageController::class, 'creerproduitphare'])->name('creerproduitphare');

    Route::match(['get', 'post'], '/modifierproduitphare/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierproduitphare'])->name('modifierproduitphare');

    Route::match(['get', 'post'], '/activeproduitphare/{id}', [App\Http\Controllers\ParametrageController::class, 'activeproduitphare'])->name('activeproduitphare');

    Route::match(['get', 'post'], '/desactiveproduitphare/{id}', [App\Http\Controllers\ParametrageController::class, 'desactiveproduitphare'])->name('desactiveproduitphare');


    Route::match(['get', 'post'], '/temoignanges', [App\Http\Controllers\ParametrageController::class, 'temoignanges'])->name('temoignanges');

    Route::match(['get', 'post'], '/creertemoignanges', [App\Http\Controllers\ParametrageController::class, 'creertemoignanges'])->name('creertemoignanges');

    Route::match(['get', 'post'], '/modifiertemoignanges/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiertemoignanges'])->name('modifiertemoignanges');

    Route::match(['get', 'post'], '/activetemoignanges/{id}', [App\Http\Controllers\ParametrageController::class, 'activetemoignanges'])->name('activetemoignanges');

    Route::match(['get', 'post'], '/desactivetemoignanges/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivetemoignanges'])->name('desactivetemoignanges');



    Route::match(['get', 'post'], '/categorieactivite', [App\Http\Controllers\ParametrageController::class, 'categorieactivite'])->name('categorieactivite');

    Route::match(['get', 'post'], '/creercategorieactivite', [App\Http\Controllers\ParametrageController::class, 'creercategorieactivite'])->name('creercategorieactivite');

    Route::match(['get', 'post'], '/modifiercategorieactivite/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiercategorieactivite'])->name('modifiercategorieactivite');

    Route::match(['get', 'post'], '/activecategorieactivite/{id}', [App\Http\Controllers\ParametrageController::class, 'activecategorieactivite'])->name('activecategorieactivite');

    Route::match(['get', 'post'], '/desactivecategorieactivite/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivecategorieactivite'])->name('desactivecategorieactivite');


    Route::match(['get', 'post'], '/gestionpage', [App\Http\Controllers\ParametrageController::class, 'gestionpage'])->name('gestionpage');

    Route::match(['get', 'post'], '/creergestiondepage', [App\Http\Controllers\ParametrageController::class, 'creergestiondepage'])->name('creergestiondepage');

    Route::match(['get', 'post'], '/modifiergestiondepage/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiergestiondepage'])->name('modifiergestiondepage');

    Route::match(['get', 'post'], '/activegestiondepage/{id}', [App\Http\Controllers\ParametrageController::class, 'activegestiondepage'])->name('activegestiondepage');

    Route::match(['get', 'post'], '/desactivegestiondepage/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivegestiondepage'])->name('desactivegestiondepage');


    Route::match(['get', 'post'], '/gestionbloc', [App\Http\Controllers\ParametrageController::class, 'gestionbloc'])->name('gestionbloc');

    Route::match(['get', 'post'], '/creergestiondebloc', [App\Http\Controllers\ParametrageController::class, 'creergestiondebloc'])->name('creergestiondebloc');

    Route::match(['get', 'post'], '/modifiergestiondebloc/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiergestiondebloc'])->name('modifiergestiondebloc');

    Route::match(['get', 'post'], '/activegestiondebloc/{id}', [App\Http\Controllers\ParametrageController::class, 'activegestiondebloc'])->name('activegestiondebloc');

    Route::match(['get', 'post'], '/desactivegestiondebloc/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivegestiondebloc'])->name('desactivegestiondebloc');


    Route::match(['get', 'post'], '/gestionpersonnel', [App\Http\Controllers\ParametrageController::class, 'gestionpersonnel'])->name('gestionpersonnel');

    Route::match(['get', 'post'], '/creergestionpersonnels', [App\Http\Controllers\ParametrageController::class, 'creergestionpersonnels'])->name('creergestionpersonnels');

    Route::match(['get', 'post'], '/modifiergestionpersonnels/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiergestionpersonnels'])->name('modifiergestionpersonnels');

    Route::match(['get', 'post'], '/activegestionpersonnels/{id}', [App\Http\Controllers\ParametrageController::class, 'activegestionpersonnels'])->name('activegestionpersonnels');

    Route::match(['get', 'post'], '/desactivegestionpersonnels/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivegestionpersonnels'])->name('desactivegestionpersonnels');

    Route::match(['get', 'post'], '/menufront', [App\Http\Controllers\ParametrageController::class, 'menufront'])->name('menufront');

    Route::match(['get', 'post'], '/creermenufront', [App\Http\Controllers\ParametrageController::class, 'creermenufront'])->name('creermenufront');

    Route::match(['get', 'post'], '/modifiermenufront/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiermenufront'])->name('modifiermenufront');

    Route::match(['get', 'post'], '/menufronthaut', [App\Http\Controllers\ParametrageController::class, 'menufronthaut'])->name('menufronthaut');

    Route::match(['get', 'post'], '/creermenufronthaut', [App\Http\Controllers\ParametrageController::class, 'creermenufronthaut'])->name('creermenufronthaut');

    Route::match(['get', 'post'], '/modifiermenufronthaut/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiermenufronthaut'])->name('modifiermenufronthaut');


    Route::match(['get', 'post'], '/partenaire', [App\Http\Controllers\ParametrageController::class, 'partenaire'])->name('partenaire');

    Route::match(['get', 'post'], '/creerpartenaire', [App\Http\Controllers\ParametrageController::class, 'creerpartenaire'])->name('creerpartenaire');

    Route::match(['get', 'post'], '/modifierpartenaire/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierpartenaire'])->name('modifierpartenaire');

    Route::match(['get', 'post'], '/activepartenaire/{id}', [App\Http\Controllers\ParametrageController::class, 'activepartenaire'])->name('activepartenaire');

    Route::match(['get', 'post'], '/desactivepartenaire/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivepartenaire'])->name('desactivepartenaire');

    Route::match(['get', 'post'], '/categorieproduit', [App\Http\Controllers\ParametrageController::class, 'categorieproduit'])->name('categorieproduit');

    Route::match(['get', 'post'], '/creercategorieproduit', [App\Http\Controllers\ParametrageController::class, 'creercategorieproduit'])->name('creercategorieproduit');

    Route::match(['get', 'post'], '/modifiercategorieproduit/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiercategorieproduit'])->name('modifiercategorieproduit');

    Route::match(['get', 'post'], '/activecategorieproduit/{id}', [App\Http\Controllers\ParametrageController::class, 'activecategorieproduit'])->name('activecategorieproduit');

    Route::match(['get', 'post'], '/desactivecategorieproduit/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivecategorieproduit'])->name('desactivecategorieproduit');


    Route::match(['get', 'post'], '/statistique', [App\Http\Controllers\ParametrageController::class, 'statistique'])->name('statistique');

    Route::match(['get', 'post'], '/creerstatistique', [App\Http\Controllers\ParametrageController::class, 'creerstatistique'])->name('creerstatistique');

    Route::match(['get', 'post'], '/modifierstatistique/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierstatistique'])->name('modifierstatistique');

    Route::match(['get', 'post'], '/activestatistique/{id}', [App\Http\Controllers\ParametrageController::class, 'activestatistique'])->name('activestatistique');

    Route::match(['get', 'post'], '/desactivstatistique/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivstatistique'])->name('desactivstatistique');

    Route::match(['get', 'post'], '/logo', [App\Http\Controllers\ParametrageController::class, 'logo'])->name('logo');

    Route::match(['get', 'post'], '/creerlogo', [App\Http\Controllers\ParametrageController::class, 'creerlogo'])->name('creerlogo');

    Route::match(['get', 'post'], '/modifierlogo/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierlogo'])->name('modifierlogo');

    Route::match(['get', 'post'], '/activelogo/{id}/{id1}', [App\Http\Controllers\ParametrageController::class, 'activelogo'])->name('activelogo');

    Route::match(['get', 'post'], '/desactivelogo/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivelogo'])->name('desactivelogo');

    Route::match(['get', 'post'], '/banner', [App\Http\Controllers\ParametrageController::class, 'banner'])->name('banner');

    Route::match(['get', 'post'], '/creerbanner', [App\Http\Controllers\ParametrageController::class, 'creerbanner'])->name('creerbanner');

    Route::match(['get', 'post'], '/modifierbanner/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierbanner'])->name('modifierbanner');

    Route::match(['get', 'post'], '/activebanner/{id}', [App\Http\Controllers\ParametrageController::class, 'activebanner'])->name('activebanner');

    Route::match(['get', 'post'], '/desactivebanner/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivebanner'])->name('desactivebanner');

    Route::match(['get', 'post'], '/personnel', [App\Http\Controllers\ParametrageController::class, 'personnel'])->name('personnel');

    Route::match(['get', 'post'], '/creerpersonnel', [App\Http\Controllers\ParametrageController::class, 'creerpersonnel'])->name('creerpersonnel');

    Route::match(['get', 'post'], '/modifierpersonnel/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierpersonnel'])->name('modifierpersonnel');

    Route::match(['get', 'post'], '/activepersonnel/{id}', [App\Http\Controllers\ParametrageController::class, 'activepersonnel'])->name('activepersonnel');

    Route::match(['get', 'post'], '/desactivepersonnel/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivepersonnel'])->name('desactivepersonnel');

    Route::match(['get', 'post'], '/activepersonnelres/{id}', [App\Http\Controllers\ParametrageController::class, 'activepersonnelres'])->name('activepersonnelres');

    Route::match(['get', 'post'], '/desactivepersonnelres/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivepersonnelres'])->name('desactivepersonnelres');

    Route::match(['get', 'post'], '/help', [App\Http\Controllers\ParametrageController::class, 'help'])->name('help');

    Route::match(['get', 'post'], '/creerhelp', [App\Http\Controllers\ParametrageController::class, 'creerhelp'])->name('creerhelp');

    Route::match(['get', 'post'], '/modifierhelp/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierhelp'])->name('modifierhelp');

    Route::match(['get', 'post'], '/activehelp/{id}', [App\Http\Controllers\ParametrageController::class, 'activehelp'])->name('activehelp');

    Route::match(['get', 'post'], '/desactivehelp/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivehelp'])->name('desactivehelp');

    Route::match(['get', 'post'], '/article', [App\Http\Controllers\ParametrageController::class, 'article'])->name('article');

    Route::match(['get', 'post'], '/creerarticle', [App\Http\Controllers\ParametrageController::class, 'creerarticle'])->name('creerarticle');

    Route::match(['get', 'post'], '/modifierarticle/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierarticle'])->name('modifierarticle');

    Route::match(['get', 'post'], '/activearticle/{id}', [App\Http\Controllers\ParametrageController::class, 'activearticle'])->name('activearticle');

    Route::match(['get', 'post'], '/desactivearticle/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivearticle'])->name('desactivearticle');

    Route::match(['get', 'post'], '/categoriearticle', [App\Http\Controllers\ParametrageController::class, 'categoriearticle'])->name('categoriearticle');

    Route::match(['get', 'post'], '/creercategoriearticle', [App\Http\Controllers\ParametrageController::class, 'creercategoriearticle'])->name('creercategoriearticle');

    Route::match(['get', 'post'], '/modifiercategoriearticle/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiercategoriearticle'])->name('modifiercategoriearticle');

    Route::match(['get', 'post'], '/activecategoriearticle/{id}', [App\Http\Controllers\ParametrageController::class, 'activecategoriearticle'])->name('activecategoriearticle');

    Route::match(['get', 'post'], '/desactivecategoriearticle/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivecategoriearticle'])->name('desactivecategoriearticle');

    Route::match(['get', 'post'], '/agences', [App\Http\Controllers\ParametrageController::class, 'agence'])->name('agences');

    Route::match(['get', 'post'], '/creeragences', [App\Http\Controllers\ParametrageController::class, 'creeragences'])->name('creeragences');

    Route::match(['get', 'post'], '/modifieragences/{id}', [App\Http\Controllers\ParametrageController::class, 'modifieragences'])->name('modifieragences');

    Route::match(['get', 'post'], '/activeagences/{id}', [App\Http\Controllers\ParametrageController::class, 'activeagences'])->name('activeagences');

    Route::match(['get', 'post'], '/desactiveagences/{id}', [App\Http\Controllers\ParametrageController::class, 'desactiveagences'])->name('desactiveagences');

    Route::match(['get', 'post'], '/listeabonnees', [App\Http\Controllers\ParametrageController::class, 'newsletter'])->name('listeabonnees');

    Route::match(['get', 'post'], '/publicites', [App\Http\Controllers\ParametrageController::class, 'publicite'])->name('publicites');

    Route::match(['get', 'post'], '/creerpublicites', [App\Http\Controllers\ParametrageController::class, 'creerpublicite'])->name('creerpublicites');

    Route::match(['get', 'post'], '/modifierpublicites/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierpublicite'])->name('modifierpublicites');

    Route::match(['get', 'post'], '/activepublicites/{id}', [App\Http\Controllers\ParametrageController::class, 'activepublicite'])->name('activepublicites');

    Route::match(['get', 'post'], '/desactivepublicites/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivepublicite'])->name('desactivepublicites');

    Route::match(['get', 'post'], '/products', [App\Http\Controllers\ParametrageController::class, 'products'])->name('products');

    Route::match(['get', 'post'], '/apercuproduits/{id}/{id1}', [App\Http\Controllers\ParametrageController::class, 'apercuproduits'])->name('apercuproduits');


    Route::match(['get', 'post'], '/categorieagences', [App\Http\Controllers\ParametrageController::class, 'categorieagences'])->name('categorieagences');

    Route::match(['get', 'post'], '/creercategorieagences', [App\Http\Controllers\ParametrageController::class, 'creercategorieagences'])->name('creercategorieagences');

    Route::match(['get', 'post'], '/modifiercategorieagences/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiercategorieagences'])->name('modifiercategorieagences');

    Route::match(['get', 'post'], '/activecategorieagences/{id}', [App\Http\Controllers\ParametrageController::class, 'activecategorieagences'])->name('activecategorieagences');

    Route::match(['get', 'post'], '/desactivecategorieagences/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivecategorieagences'])->name('desactivecategorieagences');

    Route::match(['get', 'post'], '/listescontacts', [App\Http\Controllers\ParametrageController::class, 'listescontacts'])->name('listescontacts');

    Route::match(['get', 'post'], '/pays', [App\Http\Controllers\PaysController::class, 'pays'])->name('pays');
    //---- route type de marche----
    Route::match(['get', 'post'], '/typemarche', [App\Http\Controllers\TypeMarcheController::class, 'index'])->name('typemarche');

    Route::match(['get', 'post'], '/typemarche/creer', [App\Http\Controllers\TypeMarcheController::class, 'create'])->name('typemarchecreer');

    Route::match(['get', 'post'], '/typemarche/modifier/{id}', [App\Http\Controllers\TypeMarcheController::class, 'edit'])->name('typemarchemodifier');

    //---- route type de contrat----
    Route::match(['get', 'post'], '/typecontrat', [App\Http\Controllers\TypeContratController::class, 'index'])->name('typecontrat');

    Route::match(['get', 'post'], '/typecontrat/creer', [App\Http\Controllers\TypeContratController::class, 'create'])->name('typecontratcreer');

    Route::match(['get', 'post'], '/typecontrat/modifier/{id}', [App\Http\Controllers\TypeContratController::class, 'edit'])->name('typecontratmodifier');

    //---- route marche----
    Route::match(['get', 'post'], '/listemarche', [App\Http\Controllers\MarcheController::class, 'index'])->name('listemarche');

    Route::match(['get', 'post'], '/marche/creer', [App\Http\Controllers\MarcheController::class, 'create'])->name('marchecreer');

    Route::match(['get', 'post'], '/marche/modifier/{id}', [App\Http\Controllers\MarcheController::class, 'edit'])->name('marchemodifier');


 // ## Partie cyrille

      //---- route machines----
      Route::match(['get', 'post'], '/consommables', [App\Http\Controllers\ConsommableController::class, 'index'])->name('list-consommable');

      Route::match(['get', 'post'], '/consommable/creer', [App\Http\Controllers\ConsommableController::class, 'create'])->name('creer-consommable');
  
      Route::match(['get', 'post'], '/consommable/modifier/{id}', [App\Http\Controllers\ConsommableController::class, 'edit'])->name('modifier-consommable');
  
      Route::post( '/consommable/send',  [App\Http\Controllers\ConsommableController::class, 'store'])->name('store-consommable');
      //---- fin route machines----


    //---- route intervenants----
    Route::match(['get', 'post'], '/intervenants', [App\Http\Controllers\IntervenantController::class, 'index'])->name('list-intervenant');

    Route::match(['get', 'post'], '/intervenant/creer', [App\Http\Controllers\IntervenantController::class, 'create'])->name('creer-intervenant');

    Route::match(['get', 'post'], '/intervenant/modifier/{id}', [App\Http\Controllers\IntervenantController::class, 'edit'])->name('modifier-intervenant');

    Route::post( '/intervenant/send',  [App\Http\Controllers\IntervenantController::class, 'store'])->name('store-intervenant');
    //---- fin route intervenants----



    //---- route livrables----
    Route::match(['get', 'post'], '/livrables', [App\Http\Controllers\LivraisonController::class, 'index'])->name('list-livrable');

    Route::match(['get', 'post'], '/livrable/creer', [App\Http\Controllers\LivraisonController::class, 'create'])->name('creer-livrable');

    Route::match(['get', 'post'], '/livrable/modifier/{id}', [App\Http\Controllers\LivraisonController::class, 'edit'])->name('modifier-livrable');

    Route::post( '/livrable/send',  [App\Http\Controllers\LivraisonController::class, 'store'])->name('store-livrable');
    //---- fin route livrables----




    //---- route machines----
    Route::match(['get', 'post'], '/machines', [App\Http\Controllers\MachineController::class, 'index'])->name('list-machine');

    Route::match(['get', 'post'], '/machine/creer', [App\Http\Controllers\MachineController::class, 'create'])->name('creer-machine');

    Route::match(['get', 'post'], '/machine/modifier/{id}', [App\Http\Controllers\MachineController::class, 'edit'])->name('modifier-machine');

    Route::post( '/machine/send',  [App\Http\Controllers\MachineController::class, 'store'])->name('store-machine');
    //---- fin route machines----


        //---- route projections----
    Route::match(['get', 'post'], '/projections', [App\Http\Controllers\ProjectionController::class, 'index'])->name('list-projection');

    Route::match(['get', 'post'], '/projection/creer', [App\Http\Controllers\ProjectionController::class, 'create'])->name('creer-projection');

    Route::match(['get', 'post'], '/projection/modifier/{id}', [App\Http\Controllers\ProjectionController::class, 'edit'])->name('modifier-projection');

    Route::post( '/projection/send',  [App\Http\Controllers\ProjectionController::class, 'store'])->name('store-projection');
    //---- fin route projections----



    //---- route rapports----
    Route::match(['get', 'post'], '/rapports', [App\Http\Controllers\RapportController::class, 'index'])->name('list-rapport');

    Route::match(['get', 'post'], '/rapport/creer', [App\Http\Controllers\RapportController::class, 'create'])->name('creer-rapport');

    Route::match(['get', 'post'], '/rapport/modifier/{id}', [App\Http\Controllers\RapportController::class, 'edit'])->name('modifier-rapport');

    Route::post( '/rapport/send',  [App\Http\Controllers\RapportController::class, 'store'])->name('store-rapport');
    //---- fin route rapports----




     //---- route travaux----
     Route::match(['get', 'post'], '/travaux', [App\Http\Controllers\TravauxController::class, 'index'])->name('list-travaux');

     Route::match(['get', 'post'], '/travaux/creer', [App\Http\Controllers\TravauxController::class, 'create'])->name('creer-travaux');
 
     Route::match(['get', 'post'], '/travaux/modifier/{id}', [App\Http\Controllers\TravauxController::class, 'edit'])->name('modifier-travaux');
 
     Route::post( '/travaux/send',  [App\Http\Controllers\TravauxController::class, 'store'])->name('store-travaux');
     //---- fin route travaux----
// ## Fin Partie cyrille

});

Route::get('/deconnexion', [App\Http\Controllers\HomeController::class, 'deconnexion']);


