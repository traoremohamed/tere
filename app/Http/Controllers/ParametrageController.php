<?php

namespace App\Http\Controllers;


use App\Models\Agence;
use App\Models\Article;
use App\Models\Banner;
use App\Models\CategorieArticle;
use App\Models\Help;
use App\Models\Logo;
use App\Models\Partenaire;
use App\Models\Personnel;
use App\Models\Publicite;
use App\Models\Slide;
use App\Models\Produit;
use App\Models\Actualite;
use App\Models\ProduitPhare;
use App\Models\Statistique;
use App\Models\Temoignange;
use App\Models\CategorieActivite;
use App\Models\GestionPage;
use App\Models\GestionBloc;
use App\Models\GestionPersonnel;
use App\Models\MenuFront;
use App\Models\SousMenuFront;
use App\Models\CategorieProduit;
use App\Models\CategorieAgence;
use App\Models\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use Hash;
use Auth;
use Session;
use Image;
use File;

class ParametrageController extends Controller
{
    public function slide(){

        $slides = DB::table('slide')->get();

        return view('slide.index',compact('slides'));
    }

    public function creationslide(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $slide = new Slide;

            $slide->titre_slide = $data['titre_slide'];
            $slide->description_slide = $data['description_slide'];
            $slide->id_user = $idutil;
            $slide->flag_slide = 0;
            $slide->type_fichier = 'FI';
            $slide->libelle_bouton_slide = $data['libelle_bouton_slide'];
            $slide->lien_bouton_slide = $data['lien_bouton_slide'];

            if (isset($data['slide'])){

            $filefront = $data['slide'];

            $fileName1 = 'slide'. '_' . rand(111,99999) . '_' . 'slide' . '_' . time() . '.' . $filefront->extension();

            $filefront->move(public_path('frontend/slide/'), $fileName1);

            $slide->image_slide = $fileName1;
            }

            $slide->save();

            return redirect('/slides')->with('success','enregistrement effectué');

        }

        return view('slide.creer');
    }

    public function creationslidevideo(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $slide = new Slide;

            $slide->titre_slide = $data['titre_slide'];
            $slide->description_slide = $data['description_slide'];
            $slide->id_user = $idutil;
            $slide->flag_slide = 0;
            $slide->type_fichier = 'FV';
            $slide->libelle_bouton_slide = $data['libelle_bouton_slide'];
            $slide->lien_bouton_slide = $data['lien_bouton_slide'];

            /*if (isset($data['slide'])){

                $filefront = $data['slide'];

                $fileName1 = 'slide'. '_' . rand(111,99999) . '_' . 'slide' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/slide/'), $fileName1);

                $slide->image_slide = $fileName1;
            }*/

            if (isset($data['slide'])){

                $res1 = explode("/", $data['slide']);
                $res = 'https://www.youtube.com/embed/' . $res1[3];

                $slide->image_slide = $res;

            }

            $slide->save();

            return redirect('/modifierslides')->with('success','enregistrement effectué');

        }

        return view('slide.creerv');
    }

    public function modifierslides(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $slide = DB::table('slide')->where([['id_slide','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            if (isset($data['slide'])){

                $filefront = $data['slide'];

                $fileName1 = 'slide'. '_' . rand(111,99999) . '_' . 'slide' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/slide/'), $fileName1);

                Slide::where([['id_slide','=',$id]])->update(['titre_slide' =>$data['titre_slide'],'description_slide' =>$data['description_slide'],'id_user' =>$idutil,'libelle_bouton_slide' =>$data['libelle_bouton_slide'],'lien_bouton_slide' =>$data['lien_bouton_slide'],'image_slide' =>$fileName1]);

            }else{


                Slide::where([['id_slide','=',$id]])->update(['titre_slide' =>$data['titre_slide'],'description_slide' =>$data['description_slide'],'id_user' =>$idutil,'libelle_bouton_slide' =>$data['libelle_bouton_slide'],'lien_bouton_slide' =>$data['lien_bouton_slide']]);

            }


            return redirect('/slides')->with('success','modification effectué');
        }

        return view('slide.modifier',compact('slide','id'));
    }

    public function activeslide($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Slide::where([['id_slide','=',$id]])->update(['flag_slide' => 1]);

        return redirect('/slides')->with('success','modification effectué');

    }

    public function desactiveslide($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Slide::where([['id_slide','=',$id]])->update(['flag_slide' => 0]);

        return redirect('/slides')->with('success','modification effectué');
    }

    public function productservice(){

        $produits = DB::table('produit')->get();

        return view('produit.index',compact('produits'));
    }

    public function creerproductservice(Request $request){

        $idutil = Auth::user()->id;



        if ($request->isMethod('post')) {

         $this->validate($request, [
                            'titre_prod_ph' => 'required',
                            'description_prod_ph' => 'required',
                            'id_cat_prod' => 'required',
                            'lien_produit_phare' => 'required'
                        ]);

            $data = $request->all();

            //dd($data);die();

            $produit = new Produit;

            $produit->titre_produit = $data['titre_produit'];
            $produit->id_cat_produit = $data['id_cat_produit'];
            $produit->lien_produit = $data['lien_produit'];
            $produit->description_produit = $data['description_produit'];
            $produit->id_user = $idutil;
            $produit->flag_produit = 0;

            if (isset($data['image'])){

                $filefront = $data['image'];

                $fileName1 = 'produitimage'. '_' . rand(111,99999) . '_' . 'produit' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/produit/image/'), $fileName1);

                $produit->image_produit = $fileName1;

            }

            if (isset($data['icon'])){

                $filefront1 = $data['icon'];

                $fileName2 = 'produiticon'. '_' . rand(111,99999) . '_' . 'produit' . '_' . time() . '.' . $filefront1->extension();

                $filefront1->move(public_path('frontend/produit/icon/'), $fileName2);

                $produit->icon_produit = $fileName2;

            }


            $produit->save();

            return redirect('/productservice')->with('success','enregistrement effectué');

        }

        $categoriesprods =  DB::select(DB::raw('select  * from categorie_produit c where c.flag_cat_prod = true order by c.id_cat_prod '),

        );
        // $clients = Client::where([['flag_prospect_cli', '=', 1]])->get();
        $categoriesact = "<option selected > Selectionner une categorie :</option>";
        foreach ($categoriesprods as $comp) {
            $categoriesact .= "<option value='" . $comp->id_cat_prod . "'>" . $comp->libelle_cat_prod . "</option>";
        }

        return view('produit.creer',compact('categoriesact'));
    }

    public function modifierproductservice(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $produit = DB::table('produit')->where([['id_produit','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            if(isset($data['icon']) and isset($data['image'])){

                $filefront = $data['image'];

                $fileName1 = 'produitimage'. '_' . rand(111,99999) . '_' . 'produit' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/produit/image/'), $fileName1);

                $filefront1 = $data['icon'];

                $fileName2 = 'produiticon'. '_' . rand(111,99999) . '_' . 'produit' . '_' . time() . '.' . $filefront1->extension();

                $filefront1->move(public_path('frontend/produit/icon/'), $fileName2);

                Produit::where([['id_produit','=',$id]])->update(['titre_produit' =>$data['titre_produit'],'description_produit' =>$data['description_produit'],
                    'id_user' =>$idutil,'id_cat_produit' =>$data['id_cat_produit'],'lien_produit' =>$data['lien_produit'],'icon_produit' =>$fileName2,'image_produit' =>$fileName1]);

            }elseif(isset($data['icon'])){

                $filefront1 = $data['icon'];

                $fileName2 = 'produiticon'. '_' . rand(111,99999) . '_' . 'produit' . '_' . time() . '.' . $filefront1->extension();

                $filefront1->move(public_path('frontend/produit/icon/'), $fileName2);

                Produit::where([['id_produit','=',$id]])->update(['titre_produit' =>$data['titre_produit'],'description_produit' =>$data['description_produit'],
                    'id_user' =>$idutil,'id_cat_produit' =>$data['id_cat_produit'],'lien_produit' =>$data['lien_produit'],'icon_produit' =>$fileName2]);

            }elseif(isset($data['image'])){

                $filefront = $data['image'];

                $fileName1 = 'produitimage'. '_' . rand(111,99999) . '_' . 'produit' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/produit/image/'), $fileName1);

                Produit::where([['id_produit','=',$id]])->update(['titre_produit' =>$data['titre_produit'],'description_produit' =>$data['description_produit'],
                    'id_user' =>$idutil,'id_cat_produit' =>$data['id_cat_produit'],'lien_produit' =>$data['lien_produit'],'image_produit' =>$fileName1]);

            }else{
                Produit::where([['id_produit','=',$id]])->update(['titre_produit' =>$data['titre_produit'],'description_produit' =>$data['description_produit'],
                    'id_user' =>$idutil,'id_cat_produit' =>$data['id_cat_produit'],'lien_produit' =>$data['lien_produit']]);

            }


            return redirect('/productservice')->with('success','modification effectué');
        }

        $categoriesactss = DB::table('categorie_produit')->where([['id_cat_prod','=',$produit->id_cat_produit]])->first();

        $categoriesacts =  DB::select(DB::raw('select  * from categorie_produit c where c.flag_cat_prod = true order by c.id_cat_prod '),

        );
        // $clients = Client::where([['flag_prospect_cli', '=', 1]])->get();
        $categoriesact = "<option value='" . $categoriesactss->id_cat_prod . "'>" . $categoriesactss->libelle_cat_prod . "</option>";
        foreach ($categoriesacts as $comp) {
            $categoriesact .= "<option value='" . $comp->id_cat_prod . "'>" . $comp->libelle_cat_prod . "</option>";
        }

        return view('produit.modifier',compact('produit','id','categoriesact'));
    }

    public function activeproductservice($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Produit::where([['id_produit','=',$id]])->update(['flag_produit' => 1]);

        return redirect('/productservice')->with('success','modification effectué');

    }

    public function desactiveproductservice($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Produit::where([['id_produit','=',$id]])->update(['flag_produit' => 0]);

        return redirect('/productservice')->with('success','modification effectué');
    }



    public function actualite(){

        $actualites = DB::table('actualite')->join('categorie_activite','actualite.id_cat','categorie_activite.id_categ')->get();

        return view('actualite.index',compact('actualites'));
    }

    public function creationactualite(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $actualite = new Actualite;

            $actualite->titre_actualite = $data['titre_actualite'];
            $actualite->description_actualite = $data['description_actualite'];
            $actualite->id_user = $idutil;
            $actualite->flag_actualite = 0;
            $actualite->id_cat = $data['id_cat'];
            $actualite->lien_text_actu = $data['lien_text_actu'];
            $actualite->date_pub_actu = $data['date_pub_actu'];

            if (isset($data['image_actualite'])){

                $filefront = $data['image_actualite'];

                $fileName1 = 'actualite'. '_' . rand(111,99999) . '_' . 'actualite' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/actualite/'), $fileName1);

                $actualite->image_actualite = $fileName1;
            }

            $actualite->save();

            return redirect('/actualite')->with('success','enregistrement effectué');

        }

        $categoriesacts =  DB::select(DB::raw('select  * from categorie_activite c where c.flag_categ = true order by c.id_categ '),

        );
        // $clients = Client::where([['flag_prospect_cli', '=', 1]])->get();
        $categoriesact = "<option selected > Selectionner une categorie :</option>";
        foreach ($categoriesacts as $comp) {
            $categoriesact .= "<option value='" . $comp->id_categ . "'>" . $comp->lib_categ . "</option>";
        }

        return view('actualite.creer',compact('categoriesact'));
    }

    public function modifieractualite(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $actualite = DB::table('actualite')->where([['id_actualite','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            if (isset($data['image_actualite'])){

                $filefront = $data['image_actualite'];

                $fileName1 = 'actualite'. '_' . rand(111,99999) . '_' . 'actualite' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/actualite/'), $fileName1);

                //$actualite->image_actualite = $fileName1;

                Actualite::where([['id_actualite','=',$id]])->update(['titre_actualite' =>$data['titre_actualite'],'description_actualite' =>$data['description_actualite'],
                    'id_user' =>$idutil, 'lien_text_actu' => $data['lien_text_actu'], 'date_pub_actu' => $data['date_pub_actu'],'image_actualite' => $fileName1]);
            }else{

                Actualite::where([['id_actualite','=',$id]])->update(['titre_actualite' =>$data['titre_actualite'],'description_actualite' =>$data['description_actualite'],
                    'id_user' =>$idutil, 'lien_text_actu' => $data['lien_text_actu'], 'date_pub_actu' => $data['date_pub_actu']]);

            }



            return redirect('/actualite')->with('success','modification effectué');
        }

        $categoriesactss = DB::table('categorie_activite')->where([['id_categ','=',$actualite->id_cat]])->first();

        $categoriesacts =  DB::select(DB::raw('select  * from categorie_activite c where c.flag_categ = true order by c.id_categ '),

        );
        // $clients = Client::where([['flag_prospect_cli', '=', 1]])->get();
        $categoriesact = "<option value='" . $categoriesactss->id_categ . "'>" . $categoriesactss->lib_categ . "</option>";
        foreach ($categoriesacts as $comp) {
            $categoriesact .= "<option value='" . $comp->id_categ . "'>" . $comp->lib_categ . "</option>";
        }

        return view('actualite.modifier',compact('actualite','id','categoriesact'));
    }

    public function activeactualite($id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Actualite::where([['id_actualite','=',$id]])->update(['flag_actualite' => 1]);

        return redirect('/actualite')->with('success','modification effectué');

    }

    public function desactiveactualite($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Actualite::where([['id_actualite','=',$id]])->update(['flag_actualite' => 0]);

        return redirect('/actualite')->with('success','modification effectué');
    }


    public function produitphare(){

        $produit_phares = DB::table('produit_phare')->get();

        return view('produitphare.index',compact('produit_phares'));
    }

    public function creerproduitphare(Request $request){

        $idutil = Auth::user()->id;

        $nombre =DB::table('produit_phare')->where([['flag_prod_ph','=',1]])->get();

        $nbre = count($nombre);

        $this->validate($request, [
            'titre_prod_ph' => 'required',
            'description_prod_ph' => 'required',
            'id_cat_prod' => 'required',
            'lien_produit_phare' => 'required'
        ]);

        if ($request->isMethod('post')) {

            $data = $request->all();

           // dd($data);die();

            $produit = new ProduitPhare;

            $produit->titre_prod_ph = $data['titre_prod_ph'];
            $produit->description_prod_ph = $data['description_prod_ph'];
            $produit->id_cat_prod = $data['id_cat_prod'];
            $produit->lien_produit_phare = $data['lien_produit_phare'];
            $produit->id_user = $idutil;
            if ($nbre == 3){
                $produit->flag_prod_ph = 0;
            }else{
                $produit->flag_prod_ph = 1;
            }


            if (isset($data['image_prod_ph'])){

                $filefront = $data['image_prod_ph'];

                $fileName1 = 'produitphare'. '_' . rand(111,99999) . '_' . 'produitphare' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/produitphare/'), $fileName1);

                $produit->image_prod_ph = $fileName1;

            }

            if (isset($data['video_prod_ph'])){

                $res1 = explode("/", $data['video_prod_ph']);
                $res = 'https://www.youtube.com/embed/' . $res1[3];

                $produit->video_prod_ph = $res;

            }


            $produit->save();

            return redirect('/produitphare')->with('success','enregistrement effectué');

        }

        $categoriesprods =  DB::select(DB::raw('select  * from categorie_produit c where c.flag_cat_prod = true order by c.id_cat_prod '),

        );
        // $clients = Client::where([['flag_prospect_cli', '=', 1]])->get();
        $categoriesact = "<option selected > Selectionner une categorie :</option>";
        foreach ($categoriesprods as $comp) {
            $categoriesact .= "<option value='" . $comp->id_cat_prod . "'>" . $comp->libelle_cat_prod . "</option>";
        }

        return view('produitphare.creer', compact('categoriesact'));
    }

    public function modifierproduitphare(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $produit = DB::table('produit_phare')->where([['id_prod_ph','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            ProduitPhare::where([['id_prod_ph','=',$id]])->update(['titre_prod_ph' =>$data['titre_prod_ph'],'description_prod_ph' =>$data['description_prod_ph'],'id_user' =>$idutil]);

            return redirect('/produitphare')->with('success','modification effectué');
        }

        $categoriesactss = DB::table('categorie_produit')->where([['id_cat_prod','=',$produit->id_cat_prod]])->first();
//dd($categoriesactss);
        $categoriesacts =  DB::select(DB::raw('select  * from categorie_produit c where c.flag_cat_prod = true order by c.id_cat_prod '),

        );
        // $clients = Client::where([['flag_prospect_cli', '=', 1]])->get();
        $categoriesact = "<option value='" . $categoriesactss->id_cat_prod . "'>" . $categoriesactss->libelle_cat_prod . "</option>";
        foreach ($categoriesacts as $comp) {
            $categoriesact .= "<option value='" . $comp->id_cat_prod . "'>" . $comp->libelle_cat_prod . "</option>";
        }

        return view('produitphare.modifier',compact('produit','id', 'categoriesact'));
    }

    public function activeproduitphare($id=null){

       /* $nombre =DB::table('produit_phare')->where([['flag_prod_ph','=',1]])->get();

        $nbre = count($nombre);

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        if ($nbre == 3){
            return redirect('/produitphare')->with('errors','Vous ne pouvez pas activer plus de trois produits phare');
        }else{
            ProduitPhare::where([['id_prod_ph','=',$id]])->update(['flag_prod_ph' => 1]);

            return redirect('/produitphare')->with('success','modification effectué');
        }*/

        $nombre =DB::table('produit')->where([['flag_produit_phare','=',1]])->get();

        $nbre = count($nombre);

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        if ($nbre == 3){
            return redirect('/productservice')->with('errors','Vous ne pouvez pas activer plus de trois produits phare');
        }else{
            Produit::where([['id_produit','=',$id]])->update(['flag_produit_phare' => 1]);

            return redirect('/productservice')->with('success','modification effectué');
        }


    }

    public function desactiveproduitphare($id=null){

       /* $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        ProduitPhare::where([['id_prod_ph','=',$id]])->update(['flag_prod_ph' => 0]);

        return redirect('/produitphare')->with('success','modification effectué');*/

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Produit::where([['id_produit','=',$id]])->update(['flag_produit_phare' => 0]);

        return redirect('/productservice')->with('success','modification effectué');
    }



    public function temoignanges(){

        $temoignanges = DB::table('temoignange')->get();

        return view('temoignanges.index',compact('temoignanges'));
    }

    public function creertemoignanges(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $temoignange = new Temoignange;

            $temoignange->message_temoin = $data['message_temoin'];
            $temoignange->id_user = $idutil;
            $temoignange->flag_temoi = 0;
            $temoignange->nom_prenom = $data['nom_prenom'];

            if (isset($data['image_temoi'])){

                $filefront = $data['image_temoi'];

                $fileName1 = 'temoignange'. '_' . rand(111,99999) . '_' . 'temoignange' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/temoignange/'), $fileName1);

                $temoignange->image_temoi = $fileName1;

            }


            $temoignange->save();

            return redirect('/temoignanges')->with('success','enregistrement effectué');

        }

        return view('temoignanges.creer');
    }

    public function modifiertemoignanges(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $temoignange = DB::table('temoignange')->where([['id_temoi','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            Temoignange::where([['id_temoi','=',$id]])->update(['message_temoin' =>$data['message_temoin'],'nom_prenom' =>$data['nom_prenom'],'id_user' =>$idutil]);

            return redirect('/temoignanges')->with('success','modification effectué');
        }

        return view('temoignanges.modifier',compact('temoignange','id'));
    }

    public function activetemoignanges($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Temoignange::where([['id_temoi','=',$id]])->update(['flag_temoi' => 1]);

        return redirect('/temoignanges')->with('success','modification effectué');

    }

    public function desactivetemoignanges($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Temoignange::where([['id_temoi','=',$id]])->update(['flag_temoi' => 0]);

        return redirect('/temoignanges')->with('success','modification effectué');
    }

    public function categorieactivite(){

        $categorieactivites = DB::table('categorie_activite')->get();

        return view('categorieactivites.index',compact('categorieactivites'));
    }

    public function creercategorieactivite(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $categorieactivit = new CategorieActivite;

            $categorieactivit->lib_categ = $data['lib_categ'];
            $categorieactivit->id_user = $idutil;
            $categorieactivit->flag_categ = 1;


            $categorieactivit->save();

            return redirect('/categorieactivite')->with('success','enregistrement effectué');

        }

        return view('categorieactivites.creer');
    }

    public function modifiercategorieactivite(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $categorieactivite = DB::table('categorie_activite')->where([['id_categ','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            CategorieActivite::where([['id_categ','=',$id]])->update(['lib_categ' =>$data['lib_categ'],'id_user' =>$idutil]);

            return redirect('/categorieactivite')->with('success','modification effectué');
        }

        return view('categorieactivites.modifier',compact('categorieactivite','id'));
    }

    public function activecategorieactivite($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        CategorieActivite::where([['id_categ','=',$id]])->update(['flag_categ' => 1]);

        return redirect('/categorieactivite')->with('success','modification effectué');

    }

    public function desactivecategorieactivite($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        CategorieActivite::where([['id_categ','=',$id]])->update(['flag_categ' => 0]);

        return redirect('/categorieactivite')->with('success','modification effectué');
    }

    public function gestionpage(){

        $gestiondepages = DB::table('gestion_page')->get();

        return view('gestiondepages.index',compact('gestiondepages'));
    }

    public function creergestiondepage(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $gestionpage = new GestionPage;

            $gestionpage->nom_tech_gest_page = $data['nom_tech_gest_page'];
            $gestionpage->nom_pub_gest_page = $data['nom_pub_gest_page'];
            $gestionpage->descrp_gest_page = $data['descrp_gest_page'];
            $gestionpage->ordre_gest_page = $data['ordre_gest_page'];
            $gestionpage->id_user = $idutil;
            $gestionpage->flag_gest_page = 0;

            if (isset($data['image_banner'])){

                $filefront = $data['image_banner'];

                $fileName1 = 'image_banner'. '_' . rand(111,99999) . '_' . 'image_banner' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/banner/'), $fileName1);

                $gestionpage->image_banner = $fileName1;

            }


            $gestionpage->save();

            return redirect('/gestionpage')->with('success','enregistrement effectué');

        }

        return view('gestiondepages.creer');
    }

    public function modifiergestiondepage(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $gestiondepage = DB::table('gestion_page')->where([['id_gest_page','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();
            if (isset($data['image_banner'])) {

                $filefront = $data['image_banner'];

                $fileName1 = 'image_banner'. '_' . rand(111,99999) . '_' . 'image_banner' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/banner/'), $fileName1);

                GestionPage::where([['id_gest_page','=',$id]])->update(['nom_tech_gest_page' =>$data['nom_tech_gest_page'],
                    'nom_pub_gest_page' =>$data['nom_pub_gest_page'],
                    'descrp_gest_page' =>$data['descrp_gest_page'],
                    'ordre_gest_page' =>$data['ordre_gest_page'],
                    'id_user' =>$idutil, 'image_banner' =>$fileName1]);

            }else {

                GestionPage::where([['id_gest_page','=',$id]])->update(['nom_tech_gest_page' =>$data['nom_tech_gest_page'],
                    'nom_pub_gest_page' =>$data['nom_pub_gest_page'],
                    'descrp_gest_page' =>$data['descrp_gest_page'],
                    'ordre_gest_page' =>$data['ordre_gest_page'],
                    'id_user' =>$idutil]);
            }



            return redirect('/gestionpage')->with('success','modification effectué');
        }

        return view('gestiondepages.modifier',compact('gestiondepage','id'));
    }

    public function activegestiondepage($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        GestionPage::where([['id_gest_page','=',$id]])->update(['flag_gest_page' => 1]);

        return redirect('/gestionpage')->with('success','modification effectué');

    }

    public function desactivegestiondepage($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        GestionPage::where([['id_gest_page','=',$id]])->update(['flag_gest_page' => 0]);

        return redirect('/gestionpage')->with('success','modification effectué');
    }


    public function gestionbloc(){

        $gestiondeblocs = DB::table('gestion_bloc')->join('gestion_page','gestion_bloc.id_gestion_page','gestion_page.id_gest_page')->get();

        return view('gestiondeblocs.index',compact('gestiondeblocs'));
    }

    public function creergestiondebloc(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

           // dd($data);die();

            $gestionbloc = new GestionBloc;

            $gestionbloc->id_gestion_page = $data['id_gestion_page'];
            $gestionbloc->nom_tech_gest_bloc = $data['nom_tech_gest_bloc'];
            $gestionbloc->nom_pub_gest_bloc = $data['nom_pub_gest_bloc'];
            $gestionbloc->descrp_gest_bloc = $data['descrp_gest_bloc'];
            $gestionbloc->ordre_gest_bloc = $data['ordre_gest_bloc'];
            $gestionbloc->bloc_parent = $data['bloc_parent'];
            $gestionbloc->id_user = $idutil;
            $gestionbloc->flag_bloc = 1;


            $gestionbloc->save();

            return redirect('/gestionbloc')->with('success','enregistrement effectué');

        }

        $gestionpages = GestionPage::where([['flag_gest_page','=',true]])->get();

        $gestionpage = "<option> Selection une page </option>";
        foreach ($gestionpages as $comp) {
            $gestionpage .= "<option value='" . $comp->id_gest_page . "'>" . $comp->nom_tech_gest_page . '/' . $comp->nom_pub_gest_page ."</option>";
        }

        return view('gestiondeblocs.creer',compact('gestionpage'));
    }

    public function modifiergestiondebloc(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $gestiondebloc = DB::table('gestion_bloc')->where([['id_gest_bloc','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            GestionBloc::where([['id_gest_bloc','=',$id]])->update(['nom_tech_gest_bloc' =>$data['nom_tech_gest_bloc'],
                'id_gestion_page' => $data['id_gestion_page'],
                'nom_pub_gest_bloc' =>$data['nom_pub_gest_bloc'],
                'descrp_gest_bloc' =>$data['descrp_gest_bloc'],
                'ordre_gest_bloc' =>$data['ordre_gest_bloc'],
                'bloc_parent' =>$data['bloc_parent'],
                'id_user' =>$idutil]);

            return redirect('/gestionbloc')->with('success','modification effectué');
        }

        $gestionpagess = GestionPage::where([['id_gest_page','=',$gestiondebloc->id_gestion_page]])->first();

        $gestionpages = GestionPage::where([['flag_gest_page','=',true]])->get();

        $gestionpage = "<option value='" . $gestionpagess->id_gest_page . "'>" . $gestionpagess->nom_tech_gest_page . '/' . $gestionpagess->nom_pub_gest_page ."</option>";
        foreach ($gestionpages as $comp) {
            $gestionpage .= "<option value='" . $comp->id_gest_page . "'>" . $comp->nom_tech_gest_page . '/' . $comp->nom_pub_gest_page ."</option>";
        }

        return view('gestiondeblocs.modifier',compact('gestiondebloc','id','gestionpage'));
    }

    public function activegestiondebloc($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        GestionBloc::where([['id_gest_bloc','=',$id]])->update(['flag_bloc' => 1]);

        return redirect('/gestionbloc')->with('success','modification effectué');

    }

    public function desactivegestiondebloc($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        GestionBloc::where([['id_gest_bloc','=',$id]])->update(['flag_bloc' => 0]);

        return redirect('/gestionbloc')->with('success','modification effectué');
    }

    public function gestionpersonnel(){

        $gestionpersonnels = DB::table('gestion_personnel')->get();

        return view('gestionpersonnels.index',compact('gestionpersonnels'));
    }

    public function creergestionpersonnels(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $gestpersonnel = new GestionPersonnel;

            $gestpersonnel->nom_gest_pers = $data['nom_gest_pers'];
            $gestpersonnel->fonc_gest_pers = $data['fonc_gest_pers'];
            $gestpersonnel->desc_gest_pers = $data['desc_gest_pers'];
            $gestpersonnel->id_user = $idutil;
            $gestpersonnel->flag_gest_pers = 0;
            $gestpersonnel->ordre_gest_pers = $data['ordre_gest_pers'];

            if (isset($data['image_gest_pers'])){

                $filefront = $data['image_gest_pers'];

                $fileName1 = 'gestion_personnel'. '_' . rand(111,99999) . '_' . 'gestion_personnel' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/gestionpersonnel/'), $fileName1);

                $gestpersonnel->image_gest_pers = $fileName1;

            }


            $gestpersonnel->save();

            return redirect('/gestionpersonnel')->with('success','enregistrement effectué');

        }

        return view('gestionpersonnels.creer');
    }

    public function modifiergestionpersonnels(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $gestionpersonnel = DB::table('gestion_personnel')->where([['id_gest_pers','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            GestionPersonnel::where([['id_gest_pers','=',$id]])->update(['nom_gest_pers' =>$data['nom_gest_pers'],
                'id_user' =>$idutil, 'fonc_gest_pers' => $data['fonc_gest_pers'], 'desc_gest_pers' => $data['desc_gest_pers'],
                'ordre_gest_pers' => $data['ordre_gest_pers']]);

            return redirect('/gestionpersonnel')->with('success','modification effectué');
        }

        return view('gestionpersonnels.modifier',compact('gestionpersonnel','id'));
    }

    public function activegestionpersonnels($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        GestionPersonnel::where([['id_gest_pers','=',$id]])->update(['flag_gest_pers' => 1]);

        return redirect('/gestionpersonnel')->with('success','modification effectué');

    }

    public function desactivegestionpersonnels($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        GestionPersonnel::where([['id_gest_pers','=',$id]])->update(['flag_gest_pers' => 0]);

        return redirect('/gestionpersonnel')->with('success','modification effectué');
    }

    public function menufront(Request $request)
    {

        $data = MenuFront::all();


        return view('menu_front.index',compact('data'));
    }

    public function creermenufront(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $menuf = new MenuFront;

            $menuf->nenu_front = $data['nenu_front'];
            $menuf->priorite_menu_front = $data['priorite_menu_front'];

            $menuf->save();

            return redirect('/menufront')->with('success','enregistrement effectué');

        }

        return view('menu_front.create');
    }

    public function modifiermenufront(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $menu = DB::table('menu_front')->where([['id_menu_front','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            MenuFront::where([['id_menu_front','=',$id]])->update(['nenu_front' =>$data['nenu_front'], 'priorite_menu_front' => $data['priorite_menu_front']]);

            return redirect('/menufront')->with('success','modification effectué');
        }

        return view('menu_front.edit',compact('menu','id'));
    }

    public function menufronthaut(Request $request)
    {

        $data = DB::table('sous_menu_front')->join('menu_front','sous_menu_front.menu_front_id_menu_front','menu_front.id_menu_front')->get();


        return view('sousmenus_front.index',compact('data'));
    }

    public function creermenufronthaut(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $menusf = new SousMenuFront;

            $menusf->menu_front_id_menu_front = $data['menu_front_id_menu_front'];
            $menusf->libelle_sous_menu_front = $data['libelle_sous_menu_front'];
            $menusf->priorite_sous_menu_front = $data['priorite_sous_menu_front'];
            $menusf->sous_menu_front = $data['sous_menu_front'];

            $menusf->save();

            return redirect('/menufronthaut')->with('success','enregistrement effectué');

        }

        $menuss = MenuFront::get();

        /*$stocks = Stock::where(['flag_statut'=>1])->orderby('created_at','DESC')->get();*/


        $menus = "<option selected disabled>Select</option>";
        foreach ($menuss as $comp ) {
            $menus .= "<option value='".$comp->id_menu_front."'>".$comp->nenu_front."</option>";
        }

        return view('sousmenus_front.create',compact('menus'));
    }

    public function modifiermenufronthaut(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $sousmenus = DB::table('sous_menu_front')->where([['id_sous_menu_front','=',$id]])->first();
//dd($sousmenus);
        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            SousMenuFront::where([['id_sous_menu_front','=',$id]])->update(['menu_front_id_menu_front' =>$data['menu_front_id_menu_front'], 'libelle_sous_menu_front' => $data['libelle_sous_menu_front'],
                'priorite_sous_menu_front' =>$data['priorite_sous_menu_front'], 'sous_menu_front' => $data['sous_menu_front']]);

            return redirect('/menufronthaut')->with('success','modification effectué');
        }

        $menusss = MenuFront::where([['id_menu_front','=',$sousmenus->menu_front_id_menu_front]])->first();

        $menuss = MenuFront::get();

        $menus = "<option value='".$menusss->id_menu_front."'>".$menusss->nenu_front."</option>";
        foreach ($menuss as $comp ) {
            $menus .= "<option value='".$comp->id_menu_front."'>".$comp->nenu_front."</option>";
        }

        return view('sousmenus_front.edit',compact('sousmenus','id','menus'));
    }


    public function partenaire(){

        $partenaires = DB::table('partenaire')->get();

        return view('partenaires.index',compact('partenaires'));
    }

    public function creerpartenaire(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $partenaire = new Partenaire;

            $partenaire->titre_part = $data['titre_part'];
            $partenaire->id_user = $idutil;
            $partenaire->flag_part = 0;

            if (isset($data['logo_part'])){

                $filefront = $data['logo_part'];

                $fileName1 = 'logo_part'. '_' . rand(111,99999) . '_' . 'logo_part' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/logopart/'), $fileName1);

                $partenaire->logo_part = $fileName1;

            }

            $partenaire->save();

            return redirect('/partenaire')->with('success','enregistrement effectué');

        }

        return view('partenaires.creer');
    }

    public function modifierpartenaire(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $partenaire = DB::table('partenaire')->where([['id_parte','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            if(isset($data['logo_part'])){

                 $filefront = $data['logo_part'];

                 $fileName1 = 'logo_part'. '_' . rand(111,99999) . '_' . 'logo_part' . '_' . time() . '.' . $filefront->extension();

                 $filefront->move(public_path('frontend/logopart/'), $fileName1);

            Partenaire::where([['id_parte','=',$id]])->update(['titre_part' =>$data['titre_part'],'logo_part' => $fileName1,
            'id_user' =>$idutil]);

            }else{

            Partenaire::where([['id_parte','=',$id]])->update(['titre_part' =>$data['titre_part'],'id_user' =>$idutil]);
            }


            return redirect('/partenaire')->with('success','modification effectué');
        }

        return view('partenaires.modifier',compact('partenaire','id'));
    }

    public function activepartenaire($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Partenaire::where([['id_parte','=',$id]])->update(['flag_part' => 1]);

        return redirect('/partenaire')->with('success','modification effectué');

    }

    public function desactivepartenaire($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Partenaire::where([['id_parte','=',$id]])->update(['flag_part' => 0]);

        return redirect('/partenaire')->with('success','modification effectué');
    }

    public function categorieproduit(){

        $categorieproduits = DB::table('categorie_produit')->get();

        return view('categorieproduits.index',compact('categorieproduits'));
    }

    public function creercategorieproduit(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $categorieprodui = new CategorieProduit;

            $categorieprodui->libelle_cat_prod = $data['libelle_cat_prod'];
            $categorieprodui->id_user = $idutil;
            $categorieprodui->flag_cat_prod = 1;


            $categorieprodui->save();

            return redirect('/categorieproduit')->with('success','enregistrement effectué');

        }

        return view('categorieproduits.creer');
    }

    public function modifiercategorieproduit(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $categorieproduit = DB::table('categorie_produit')->where([['id_cat_prod','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            CategorieProduit::where([['id_cat_prod','=',$id]])->update(['libelle_cat_prod' =>$data['libelle_cat_prod'],'id_user' =>$idutil]);

            return redirect('/categorieproduit')->with('success','modification effectué');
        }

        return view('categorieproduits.modifier',compact('categorieproduit','id'));
    }

    public function activecategorieproduit($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        //exit('tes');
        CategorieProduit::where([['id_cat_prod','=',$id]])->update(['flag_cat_prod' => 1]);

        return redirect('/categorieproduit')->with('success','modification effectué');

    }

    public function desactivecategorieproduit($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        CategorieProduit::where([['id_cat_prod','=',$id]])->update(['flag_cat_prod' => 0]);

        return redirect('/categorieproduit')->with('success','modification effectué');
    }

    public function statistique(){

        $statistiques = DB::table('statistique')->get();

        return view('statistiques.index',compact('statistiques'));
    }

    public function creerstatistique(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $statistique = new Statistique;

            $statistique->libelle_stat = $data['libelle_stat'];
            $statistique->stat_stat = $data['stat_stat'];
            $statistique->id_user = $idutil;
            $statistique->flag_stat = 0;
            $statistique->text_icon = $data['text_icon'];

            if (isset($data['icon_stat'])){

                $filefront = $data['icon_stat'];

                $fileName1 = 'icon_stat'. '_' . rand(111,99999) . '_' . 'icon_stat' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/iconstat/'), $fileName1);

                $statistique->icon_stat = $fileName1;

            }


            $statistique->save();

            return redirect('/statistique')->with('success','enregistrement effectué');

        }

        return view('statistiques.creer');
    }

    public function modifierstatistique(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $statistique = DB::table('statistique')->where([['id_stat','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            Statistique::where([['id_stat','=',$id]])->update([
                'libelle_stat' =>$data['libelle_stat'],'id_user' =>$idutil,
                'stat_stat' =>$data['stat_stat'],'text_icon' =>$data['text_icon']
            ]);

            return redirect('/statistique')->with('success','modification effectué');
        }

        return view('statistiques.modifier',compact('statistique','id'));
    }

    public function activestatistique($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        //exit('tes');
        Statistique::where([['id_stat','=',$id]])->update(['flag_stat' => 1]);

        return redirect('/statistique')->with('success','modification effectué');

    }

    public function desactivstatistique($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Statistique::where([['id_stat','=',$id]])->update(['flag_stat' => 0]);

        return redirect('/statistique')->with('success','modification effectué');
    }

    public function logo(){

        $logos = DB::table('logo')->get();

        return view('logos.index',compact('logos'));
    }

    public function creerlogo(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $logo = new Logo;

            /*$nombre =DB::table('logo')->where([['flag_logo','=',1]])->get();

            $nbre = count($nombre);*/

            if ( $data['valeur'] == 'LOGO'){
                $nombre1 =DB::table('logo')->where([['flag_logo','=',1],['valeur','=','LOGO']])->get();

                $nbre1 = count($nombre1);

                if ($nbre1 == 1){
                    $logo->flag_logo = 0;
                }else{
                    $logo->flag_logo = 1;
                }
            }

            if ( $data['valeur'] == 'EMAIL'){
                $nombre1 =DB::table('logo')->where([['flag_logo','=',1],['valeur','=','EMAIL']])->get();

                $nbre1 = count($nombre1);

                if ($nbre1 == 1){
                    $logo->flag_logo = 0;
                }else{
                    $logo->flag_logo = 1;
                }
            }

            if ( $data['valeur'] == 'CONTACT'){
                $nombre1 =DB::table('logo')->where([['flag_logo','=',1],['valeur','=','CONTACT']])->get();

                $nbre1 = count($nombre1);

                if ($nbre1 == 1){
                    $logo->flag_logo = 0;
                }else{
                    $logo->flag_logo = 1;
                }
            }

            if ( $data['valeur'] == 'RESEAUX SOCIAUX'){
                $nombre1 =DB::table('logo')->where([['flag_logo','=',1],['valeur','=','RESEAUX SOCIAUX']])->get();

                $nbre1 = count($nombre1);

                if ($nbre1 == 1){
                    $logo->flag_logo = 0;
                }else{
                    $logo->flag_logo = 1;
                }
            }

            if ( $data['valeur'] == 'ESPACE CLIENT'){
                $nombre1 =DB::table('logo')->where([['flag_logo','=',1],['valeur','=','ESPACE CLIENT']])->get();

                $nbre1 = count($nombre1);

                if ($nbre1 == 1){
                    $logo->flag_logo = 0;
                }else{
                    $logo->flag_logo = 1;
                }
            }


            if ( $data['valeur'] == 'OUVRIR COMPTE'){
                $nombre1 =DB::table('logo')->where([['flag_logo','=',1],['valeur','=','OUVRIR COMPTE']])->get();

                $nbre1 = count($nombre1);

                if ($nbre1 == 1){
                    $logo->flag_logo = 0;
                }else{
                    $logo->flag_logo = 1;
                }
            }

            if ( $data['valeur'] == 'NEWSLETTER'){
                $nombre1 =DB::table('logo')->where([['flag_logo','=',1],['valeur','=','NEWSLETTER']])->get();

                $nbre1 = count($nombre1);

                if ($nbre1 == 1){
                    $logo->flag_logo = 0;
                }else{
                    $logo->flag_logo = 1;
                }
            }

            /*if ($nbre == 1){
                $logo->flag_logo = 0;
            }else{
                $logo->flag_logo = 1;
            }*/

            $logo->titre_logo = $data['titre_logo'];

            $logo->id_user = $idutil;

            $logo->valeur = $data['valeur'];

            $logo->mot_cle = $data['mot_cle'];

            if (isset($data['logo_logo'])){

                $filefront = $data['logo_logo'];

                $fileName1 = 'logo_logo'. '_' . rand(111,99999) . '_' . 'logo_logo' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/logo/'), $fileName1);

                $logo->logo_logo = $fileName1;

            }


            $logo->save();

            return redirect('/logo')->with('success','enregistrement effectué');

        }

        return view('logos.creer');
    }

    public function modifierlogo(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $logo = DB::table('logo')->where([['id_logo','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            if(isset($data['logo_logo'])){

                 $filefront = $data['logo_logo'];

                 $fileName1 = 'logo_logo'. '_' . rand(111,99999) . '_' . 'logo_logo' . '_' . time() . '.' . $filefront->extension();

                 $filefront->move(public_path('frontend/logo/'), $fileName1);

            Logo::where([['id_logo','=',$id]])->update([
                'titre_logo' =>$data['titre_logo'],'id_user' =>$idutil,
                'valeur' =>$data['valeur'],'mot_cle' =>$data['mot_cle'],
                'logo_logo' => $fileName1
            ]);

            }else{

            Logo::where([['id_logo','=',$id]])->update([
                'titre_logo' =>$data['titre_logo'],'id_user' =>$idutil,
                'valeur' =>$data['valeur'],'mot_cle' =>$data['mot_cle']
            ]);

            }

            return redirect('/logo')->with('success','modification effectué');
        }

        return view('logos.modifier',compact('logo','id'));
    }

    public function activelogo($id=null, $id1=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $id1 = \App\Helpers\Crypt::UrldeCrypt($id1);

        if ($id1 == 'LOGO'){
            $nombre1 =DB::table('logo')->where([['flag_logo','=',1],['valeur','=','LOGO']])->get();

            $nbre1 = count($nombre1);

            if ($nbre1 == 1){
                return redirect('/logo')->with('errors','Vous ne pouvez pas activer plus d un parametre de ce type');
            }else{
            Logo::where([['id_logo','=',$id]])->update(['flag_logo' => 1]);

            return redirect('/logo')->with('success','modification effectué');
        }
        }

        if ($id1 == 'EMAIL'){
            $nombre2 =DB::table('logo')->where([['flag_logo','=',1],['valeur','=','EMAIL']])->get();

            $nbre2 = count($nombre2);

            if ($nbre2 == 1){
                return redirect('/logo')->with('errors','Vous ne pouvez pas activer plus d un parametre de ce type');
            }else{
                Logo::where([['id_logo','=',$id]])->update(['flag_logo' => 1]);

                return redirect('/logo')->with('success','modification effectué');
            }
        }

        if ($id1 == 'CONTACT'){
            $nombre3 =DB::table('logo')->where([['flag_logo','=',1],['valeur','=','CONTACT']])->get();

            $nbre3 = count($nombre3);

            if ($nbre3 == 1){
                return redirect('/logo')->with('errors','Vous ne pouvez pas activer plus d un parametre de ce type');
            }else{
                Logo::where([['id_logo','=',$id]])->update(['flag_logo' => 1]);

                return redirect('/logo')->with('success','modification effectué');
            }
        }

        if ($id1 == 'RESEAUX SOCIAUX'){

            $nombre4 =DB::table('logo')->where([['flag_logo','=',1],['valeur','=','RESEAUX SOCIAUX']])->get();


                Logo::where([['id_logo','=',$id]])->update(['flag_logo' => 1]);

                return redirect('/logo')->with('success','modification effectué');

        }


        if ($id1 == 'ESPACE CLIENT'){

            $nombre5 =DB::table('logo')->where([['flag_logo','=',1],['valeur','=','ESPACE CLIENT']])->get();

            $nbre5 = count($nombre5);

            if ($nbre5 == 1){
                return redirect('/logo')->with('errors','Vous ne pouvez pas activer plus d un parametre de ce type');
            }else{
                Logo::where([['id_logo','=',$id]])->update(['flag_logo' => 1]);

                return redirect('/logo')->with('success','modification effectué');
            }

        }

        if ($id1 == 'OUVRIR COMPTE'){

            $nombre6 =DB::table('logo')->where([['flag_logo','=',1],['valeur','=','OUVRIR COMPTE']])->get();

            $nbre6 = count($nombre6);

            if ($nbre6 == 1){
                return redirect('/logo')->with('errors','Vous ne pouvez pas activer plus d un parametre de ce type');
            }else{
                Logo::where([['id_logo','=',$id]])->update(['flag_logo' => 1]);

                return redirect('/logo')->with('success','modification effectué');
            }

        }

        if ($id1 == 'NEWSLETTER'){

            $nombre7 =DB::table('logo')->where([['flag_logo','=',1],['valeur','=','NEWSLETTER']])->get();

            $nbre7 = count($nombre7);

            if ($nbre7 == 1){
                return redirect('/logo')->with('errors','Vous ne pouvez pas activer plus d un parametre de ce type');
            }else{
                Logo::where([['id_logo','=',$id]])->update(['flag_logo' => 1]);

                return redirect('/logo')->with('success','modification effectué');
            }

        }
        //exit('tes');


    }

    public function desactivelogo($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Logo::where([['id_logo','=',$id]])->update(['flag_logo' => 0]);

        return redirect('/logo')->with('success','modification effectué');
    }

    public function banner(){

        $banners = DB::table('banner')->get();

        return view('banners.index',compact('banners'));
    }

    public function creerbanner(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $nombre =DB::table('banner')->where([['flag_banner','=',1]])->get();

            $nbre = count($nombre);


            $banner = new Banner;

            $banner->titre_banner = $data['titre_banner'];
            if ($nbre == 1){
                $banner->flag_banner = 0;
            }else{
                $banner->flag_banner = 1;
            }

            $banner->id_user = $idutil;

            if (isset($data['image_banner'])){

                $filefront = $data['image_banner'];

                $fileName1 = 'image_banner'. '_' . rand(111,99999) . '_' . 'image_banner' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/banner/'), $fileName1);

                $banner->image_banner = $fileName1;

            }


            $banner->save();

            return redirect('/banner')->with('success','enregistrement effectué');

        }

        return view('banners.creer');
    }

    public function modifierbanner(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $banner = DB::table('banner')->where([['id_banner','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            Banner::where([['id_banner','=',$id]])->update([
                'titre_banner' =>$data['titre_banner'],'id_user' =>$idutil
            ]);

            return redirect('/banner')->with('success','modification effectué');
        }

        return view('banners.modifier',compact('banner','id'));
    }

    public function activebanner($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        $nombre =DB::table('banner')->where([['flag_banner','=',1]])->get();

        $nbre = count($nombre);


        if ($nbre == 1){
            return redirect('/banner')->with('errors','Vous ne pouvez pas activer plus d un conseil regional');
        }else{
            Banner::where([['id_banner','=',$id]])->update(['flag_banner' => 1]);

            return redirect('/banner')->with('success','modification effectué');
        }
        //exit('tes');


    }

    public function desactivebanner($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Banner::where([['id_banner','=',$id]])->update(['flag_banner' => 0]);

        return redirect('/banner')->with('success','modification effectué');
    }


    public function personnel(){

        $personnels = DB::table('personnel')->get();

        return view('personnels.index',compact('personnels'));
    }

    public function creerpersonnel(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $personnel = new Personnel;

            $personnel->nom_personnel = $data['nom_personnel'];
            $personnel->prenom_personnel = $data['prenom_personnel'];
            $personnel->fonction_personnel = $data['fonction_personnel'];
            $personnel->mot_personnel = $data['mot_personnel'];
            $personnel->id_user = $idutil;
            $personnel->date_debut_fonction = new \DateTime($data['date_debut_fonction']);
            $personnel->flag_personnel = 0;

            if (isset($data['image_personnel'])){

                $filefront = $data['image_personnel'];
           // dd($filefront);
                /*$fileName1 = 'image_personnel'. '_' . rand(111,99999) . '_' . 'image_personnel' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/imagepersonnel/'), $fileName1);*/

                /*$ogImage = Image::make($filefront);
                $originalPath = 'frontend/imagepersonnel/';
                $ogImage =  $ogImage->save($originalPath.time().$filefront->getClientOriginalName());*/

                /*$personnel->image_personnel = $fileName1;*/

                        $request_image = $request->file('image_personnel');

                        $tailles = $request_image->getSize();

                        //dd($tailles);

                        if($tailles < 3000000){
                            $image = Image::make($request_image);



                            //dd($tailles);

                            $image_path = public_path('frontend/imagepersonnel/');

                            if (!File::exists($image_path)) {
                                File::makeDirectory($image_path);
                            }

                            $image_name = time().'.'.$request_image->getClientOriginalExtension();

                            // keep ratio height and width
                            /*$image->resize(null, 200, function($constraint) {
                                $constraint->aspectRatio();
                            });*/

                            $image->save($image_path.$image_name);

                            $personnel->image_personnel = $image_name;
                        }else{

                            return redirect('/personnel')->with('errors','le fichier est trop lourd');


                        }



            }


            $personnel->save();

            return redirect('/personnel')->with('success','enregistrement effectué');

        }

        return view('personnels.creer');
    }

    public function modifierpersonnel(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $personnel = DB::table('personnel')->where([['id_personnel','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            if (isset($data['image_personnel'])) {

            $request_image = $request->file('image_personnel');

                                    $tailles = $request_image->getSize();

                                    //dd($tailles);

                                    if($tailles < 3000000){
                                        $image = Image::make($request_image);



                                        //dd($tailles);

                                        $image_path = public_path('frontend/imagepersonnel/');

                                        if (!File::exists($image_path)) {
                                            File::makeDirectory($image_path);
                                        }

                                        $image_name = time().'.'.$request_image->getClientOriginalExtension();

                                        // keep ratio height and width
                                        /*$image->resize(null, 200, function($constraint) {
                                            $constraint->aspectRatio();
                                        });*/

                                        $image->save($image_path.$image_name);

                                        //$personnel->image_personnel = $image_name;
                                    }else{

                                        return redirect('/personnel')->with('errors','le fichier est trop lourd');


                                    }

                /*$filefront = $data['image_personnel'];

                $fileName1 = 'image_personnel'. '_' . rand(111,99999) . '_' . 'image_personnel' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/imagepersonnel/'), $fileName1);*/

              Personnel::where([['id_personnel','=',$id]])->update([
                             'nom_personnel' =>$data['nom_personnel'],'id_user' =>$idutil,
                             'prenom_personnel' =>$data['prenom_personnel'],'fonction_personnel' =>$data['fonction_personnel'],
                             'mot_personnel' =>$data['mot_personnel'],'date_debut_fonction' =>$data['date_debut_fonction'],
                             'date_fin_fonction' =>$data['date_fin_fonction'],'image_personnel' => $image_name
                         ]);

             }else{
              Personnel::where([['id_personnel','=',$id]])->update([
                             'nom_personnel' =>$data['nom_personnel'],'id_user' =>$idutil,
                             'prenom_personnel' =>$data['prenom_personnel'],'fonction_personnel' =>$data['fonction_personnel'],
                             'mot_personnel' =>$data['mot_personnel'],'date_debut_fonction' =>$data['date_debut_fonction'],
                             'date_fin_fonction' =>$data['date_fin_fonction']
                         ]);
             }


            return redirect('/personnel')->with('success','modification effectué');
        }

        return view('personnels.modifier',compact('personnel','id'));
    }

    public function activepersonnel($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        //exit('tes');
        Personnel::where([['id_personnel','=',$id]])->update(['flag_personnel' => 1]);

        return redirect('/personnel')->with('success','modification effectué');

    }

    public function desactivepersonnel($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Personnel::where([['id_personnel','=',$id]])->update(['flag_personnel' => 0]);

        return redirect('/personnel')->with('success','modification effectué');
    }

    public function activepersonnelres($id=null){

        $nombre =DB::table('personnel')->where([['flag_actif_responsable','=',1]])->get();

        $nbre = count($nombre);

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        if ($nbre == 1){
            return redirect('/personnel')->with('errors','Vous ne pouvez pas activer plus d un conseil regional');
        }else{
            Personnel::where([['id_personnel','=',$id]])->update(['flag_actif_responsable' => 1]);

            return redirect('/personnel')->with('success','modification effectué');
        }


    }

    public function desactivepersonnelres($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Personnel::where([['id_personnel','=',$id]])->update(['flag_actif_responsable' => 0]);

        return redirect('/personnel')->with('success','modification effectué');
    }

    public function help(){

        $helps = DB::table('help')->get();

        return view('helps.index',compact('helps'));
    }

    public function creerhelp(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $help = new Help();

            $help->nom_prenom_help = $data['nom_prenom_help'];
            $help->fonction_help = $data['fonction_help'];
            $help->description_help = $data['description_help'];
            $help->flag_help = 0;
            $help->id_user = $idutil;


            if (isset($data['photo_help'])){

                $filefront = $data['photo_help'];

                $fileName1 = 'photo_help'. '_' . rand(111,99999) . '_' . 'photo_help' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/help/'), $fileName1);

                $help->photo_help = $fileName1;

            }


            $help->save();

            return redirect('/help')->with('success','enregistrement effectué');

        }

        return view('helps.creer');
    }

    public function modifierhelp(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $help = DB::table('help')->where([['id_help','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();
            if (isset($data['photo_help'])) {

                            $filefront = $data['photo_help'];

                            $fileName1 = 'photo_help'. '_' . rand(111,99999) . '_' . 'photo_help' . '_' . time() . '.' . $filefront->extension();

                            $filefront->move(public_path('frontend/help/'), $fileName1);

            Help::where([['id_help','=',$id]])->update([
                'nom_prenom_help' =>$data['nom_prenom_help'],'id_user' =>$idutil,
                'fonction_help' =>$data['fonction_help'], 'description_help'  =>$data['description_help'],
                'photo_help' => $fileName1
            ]);

                        }else {

            Help::where([['id_help','=',$id]])->update([
                'nom_prenom_help' =>$data['nom_prenom_help'],'id_user' =>$idutil,
                'fonction_help' =>$data['fonction_help'], 'description_help'  =>$data['description_help']
            ]);
                        }



            return redirect('/help')->with('success','modification effectué');
        }

        return view('helps.modifier',compact('help','id'));
    }

    public function activehelp($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

            Help::where([['id_help','=',$id]])->update(['flag_help' => 1]);

            return redirect('/help')->with('success','modification effectué');

    }

    public function desactivehelp($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Help::where([['id_help','=',$id]])->update(['flag_help' => 0]);

        return redirect('/help')->with('success','modification effectué');
    }

    public function article(){

        $articles = DB::table('article')->join('categorie_article','article.id_categ_article','categorie_article.id_cat_article')->get();

        return view('articles.index',compact('articles'));
    }

    public function creerarticle(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $article = new Article();

            $article->titre_article = $data['titre_article'];
            $article->description_article = $data['description_article'];
            $article->flag_article = 0;
            $article->id_user = $idutil;
            $article->description_detaille = $data['description_detaille'];
            $article->lien_article = $data['lien_article'];
            if (isset($data['lien_video'])){
                $res1 = explode("/", $data['lien_video']);
                $res = 'https://www.youtube.com/embed/' . $res1[3];
                $article->lien_video = $res;
            }

            $article->id_categ_article = $data['id_categ_article'];
            $article->sous_titre = $data['sous_titre'];

            if (isset($data['image_article'])){

                $filefront = $data['image_article'];

                $fileName1 = 'image_article'. '_' . rand(111,99999) . '_' . 'image_article' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/imagearticle/'), $fileName1);

                $article->image_article = $fileName1;

            }



            $article->save();

            return redirect('/article')->with('success','enregistrement effectué');

        }

        $categoriearticles =  DB::select(DB::raw('select  * from categorie_article c where c.flag_cat_article = true order by c.id_cat_article '),

        );
        // $clients = Client::where([['flag_prospect_cli', '=', 1]])->get();
        $categoriearticle = "<option selected > Selectionner une categorie :</option>";
        foreach ($categoriearticles as $comp) {
            $categoriearticle .= "<option value='" . $comp->id_cat_article  . "'>" . $comp->categ_article . "</option>";
        }

        return view('articles.creer',compact('categoriearticle'));
    }

    public function modifierarticle(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $article = DB::table('article')->where([['id_article','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            if(isset($data['lien_video']) and isset($data['image_article'])){

                $res1 = explode("/", $data['fichier_video']);
                $res = 'https://www.youtube.com/embed/' . $res1[3];

                $filefront = $data['image_article'];

                $fileName1 = 'image_article'. '_' . rand(111,99999) . '_' . 'image_article' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/imagearticle/'), $fileName1);

                Article::where([['id_article','=',$id]])->update([
                    'titre_article' =>$data['titre_article'],'id_user' =>$idutil,
                    'description_article' =>$data['description_article'],'sous_titre' =>$data['sous_titre'],
                    'description_detaille' =>$data['description_detaille'],'lien_article' =>$data['lien_article'],
                    'id_categ_article' =>$data['id_categ_article'],'lien_video' =>$res,
                    'image_article' =>$fileName1
                ]);


            }elseif(isset($data['lien_video'])){

                $res1 = explode("/", $data['fichier_video']);
                $res = 'https://www.youtube.com/embed/' . $res1[3];

                Article::where([['id_article','=',$id]])->update([
                    'titre_article' =>$data['titre_article'],'id_user' =>$idutil,
                    'description_article' =>$data['description_article'],'sous_titre' =>$data['sous_titre'],
                    'description_detaille' =>$data['description_detaille'],'lien_article' =>$data['lien_article'],
                    'id_categ_article' =>$data['id_categ_article'],'lien_video' =>$res
                ]);

            }elseif(isset($data['image_article'])){

                $filefront = $data['image_article'];

                $fileName1 = 'image_article'. '_' . rand(111,99999) . '_' . 'image_article' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/imagearticle/'), $fileName1);

                Article::where([['id_article','=',$id]])->update([
                    'titre_article' =>$data['titre_article'],'id_user' =>$idutil,
                    'description_article' =>$data['description_article'],'sous_titre' =>$data['sous_titre'],
                    'description_detaille' =>$data['description_detaille'],'lien_article' =>$data['lien_article'],
                    'id_categ_article' =>$data['id_categ_article'],
                    'image_article' =>$fileName1
                ]);

            }else{
                Article::where([['id_article','=',$id]])->update([
                    'titre_article' =>$data['titre_article'],'id_user' =>$idutil,
                    'description_article' =>$data['description_article'],'sous_titre' =>$data['sous_titre'],
                    'description_detaille' =>$data['description_detaille'],'lien_article' =>$data['lien_article'],
                    'id_categ_article' =>$data['id_categ_article']
                ]);

            }

            //dd($data);die();



            return redirect('/article')->with('success','modification effectué');
        }

        $categoriesactss = DB::table('categorie_article')->where([['id_cat_article','=',$article->id_categ_article]])->first();
//dd($categoriesactss);
        $categoriesacts =  DB::select(DB::raw('select  * from categorie_article c where c.flag_cat_article = true order by c.id_cat_article '),

        );
        // $clients = Client::where([['flag_prospect_cli', '=', 1]])->get();
        $categoriearticle = "<option value='" . $categoriesactss->id_cat_article . "'>" . $categoriesactss->categ_article . "</option>";
        foreach ($categoriesacts as $comp) {
            $categoriearticle .= "<option value='" . $comp->id_cat_article . "'>" . $comp->categ_article . "</option>";
        }

        return view('articles.modifier',compact('article','id','categoriearticle'));
    }

    public function activearticle($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Article::where([['id_article','=',$id]])->update(['flag_article' => 1]);

        return redirect('/article')->with('success','modification effectué');

    }

    public function desactivearticle($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        //dd($id);

        Article::where([['id_article','=',$id]])->update(['flag_article' => 0]);

        return redirect('/article')->with('success','modification effectué');
    }

    public function categoriearticle(){

        $categoriearticles = DB::table('categorie_article')->get();

        return view('categoriearticles.index',compact('categoriearticles'));
    }

    public function creercategoriearticle(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $categoriearticle = new CategorieArticle();

            $categoriearticle->categ_article  = $data['categ_article'];
            $categoriearticle->id_user = $idutil;
            $categoriearticle->flag_cat_article = 1;


            $categoriearticle->save();

            return redirect('/categoriearticle')->with('success','enregistrement effectué');

        }



        return view('categoriearticles.creer');
    }

    public function modifiercategoriearticle(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $categoriearticle = DB::table('categorie_article')->where([['id_cat_article','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            CategorieArticle::where([['id_cat_article','=',$id]])->update(['categ_article' =>$data['categ_article'],'id_user' =>$idutil]);

            return redirect('/categoriearticle')->with('success','modification effectué');
        }

        return view('categoriearticles.modifier',compact('categoriearticle','id'));
    }

    public function activecategoriearticle($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        //exit('tes');
        CategorieArticle::where([['id_cat_article','=',$id]])->update(['flag_cat_article' => 1]);

        return redirect('/categoriearticle')->with('success','modification effectué');

    }

    public function desactivecategoriearticle($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        CategorieArticle::where([['id_cat_article','=',$id]])->update(['flag_cat_article' => 0]);

        return redirect('/categoriearticle')->with('success','modification effectué');
    }


public function categorieagences(){

        $categorieagences = DB::table('categorie_agence')->get();

        return view('categorieagences.index',compact('categorieagences'));
    }

    public function creercategorieagences(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $categorieagence = new CategorieAgence();

            $categorieagence->libelle_cat_agence  = $data['libelle_cat_agence'];
            $categorieagence->flag_cat_agence = 1;


            $categorieagence->save();

            return redirect('/categorieagences')->with('success','enregistrement effectué');

        }



        return view('categorieagences.creer');
    }

    public function modifiercategorieagences(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $categorieagence = DB::table('categorie_agence')->where([['id_cat_agence','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            CategorieAgence::where([['id_cat_agence','=',$id]])->update(['libelle_cat_agence' =>$data['libelle_cat_agence']]);

            return redirect('/categorieagences')->with('success','modification effectué');
        }

        return view('categorieagences.modifier',compact('categorieagence','id'));
    }

    public function activecategorieagences($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        //exit('tes');
        CategorieAgence::where([['id_cat_agence','=',$id]])->update(['flag_cat_agence' => 1]);

        return redirect('/categorieagences')->with('success','modification effectué');

    }

    public function desactivecategorieagences($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        CategorieAgence::where([['id_cat_agence','=',$id]])->update(['flag_cat_agence' => 0]);

        return redirect('/categorieagences')->with('success','modification effectué');
    }


    public function agence(){

        $agences = DB::table('agence')->get();

        return view('agences.index',compact('agences'));
    }

    public function creeragences(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $agence = new Agence();

            $agence->type_agence = $data['type_agence'];
            $agence->id_user = $idutil;
            $agence->nom_agence =  $data['nom_agence'];
            $agence->contact_tel_agence = $data['contact_tel_agence'];
            $agence->contact_mail_agence =  $data['contact_mail_agence'];
            $agence->info_compl_agence = $data['info_compl_agence'];
            $agence->lat_agence = $data['lat_agence'];
            $agence->long_agence =  $data['long_agence'];
            $agence->ordre_agence =  $data['ordre_agence'];

            if (isset($data['image_agence'])){

                $filefront = $data['image_agence'];

                $fileName1 = 'agence'. '_' . rand(111,99999) . '_' . 'agence' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/agence/'), $fileName1);

                $agence->image_agence = $fileName1;

            }


            $agence->save();

            return redirect('/agences')->with('success','enregistrement effectué');

        }

        return view('agences.creer');
    }

    public function modifieragences(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $agence = DB::table('agence')->where([['id_agence','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            if (isset($data['image_agence'])){

                $filefront = $data['image_agence'];

                $fileName1 = 'agence'. '_' . rand(111,99999) . '_' . 'agence' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/agence/'), $fileName1);

                Agence::where([['id_agence','=',$id]])->update(['type_agence' =>$data['type_agence'],'nom_agence' =>$data['nom_agence'],
                    'contact_tel_agence' =>$data['contact_tel_agence'],'contact_mail_agence' =>$data['contact_mail_agence'],
                    'info_compl_agence' =>$data['info_compl_agence'],'lat_agence' =>$data['lat_agence'],
                    'long_agence' =>$data['long_agence'],'image_agence' =>$fileName1,
                    'id_user' =>$idutil,'ordre_agence' =>$data['ordre_agence']]);

            }else{
                Agence::where([['id_agence','=',$id]])->update(['type_agence' =>$data['type_agence'],'nom_agence' =>$data['nom_agence'],
                    'contact_tel_agence' =>$data['contact_tel_agence'],'contact_mail_agence' =>$data['contact_mail_agence'],
                    'info_compl_agence' =>$data['info_compl_agence'],'lat_agence' =>$data['lat_agence'],
                    'long_agence' =>$data['long_agence'],
                    'id_user' =>$idutil,'ordre_agence' =>$data['ordre_agence']]);
            }



            return redirect('/agences')->with('success','modification effectué');
        }

        return view('agences.modifier',compact('agence','id'));
    }

    public function activeagences($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Agence::where([['id_agence','=',$id]])->update(['flag_agence' => 1]);

        return redirect('/agences')->with('success','modification effectué');

    }

    public function desactiveagences($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Agence::where([['id_agence','=',$id]])->update(['flag_agence' => 0]);

        return redirect('/agences')->with('success','modification effectué');
    }

    public function newsletter(){
        $newsletters = DB::table('newsletter')->get();

        return view('newsletter.index', compact('newsletters'));
    }

    public function publicite(){

        $publicites = DB::table('publicite')->get();

        return view('publicites.index',compact('publicites'));
    }

    public function creerpublicite(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $publicite = new Publicite();

            $publicite->lib_pub = $data['lib_pub'];
            $publicite->id_user = $idutil;
            $publicite->descr_pub =  $data['descr_pub'];

            if (isset($data['image_pub'])){

                $filefront = $data['image_pub'];

                $fileName1 = 'publicite'. '_' . rand(111,99999) . '_' . 'publicite' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/publicite/'), $fileName1);

                $publicite->image_pub = $fileName1;

            }


            $publicite->save();

            return redirect('/publicites')->with('success','enregistrement effectué');

        }

        return view('publicites.creer');
    }

    public function modifierpublicite(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $publicite = DB::table('publicite')->where([['id_pub','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            if (isset($data['image_pub'])){

                $filefront = $data['image_pub'];

                $fileName1 = 'publicite'. '_' . rand(111,99999) . '_' . 'publicite' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/publicite/'), $fileName1);

                Publicite::where([['id_pub','=',$id]])->update(['lib_pub' =>$data['lib_pub'],'descr_pub' =>$data['descr_pub'],
                    'image_pub' =>$fileName1, 'id_user' =>$idutil]);

            }else{
                Publicite::where([['id_pub','=',$id]])->update(['lib_pub' =>$data['lib_pub'],'descr_pub' =>$data['descr_pub'],
                     'id_user' =>$idutil]);
            }



            return redirect('/publicites')->with('success','modification effectué');
        }

        return view('publicites.modifier',compact('publicite','id'));
    }

    public function activepublicite($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Publicite::where([['id_pub','=',$id]])->update(['flag_pub' => 1]);

        return redirect('/publicites')->with('success','modification effectué');

    }

    public function desactivepublicite($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Publicite::where([['id_pub','=',$id]])->update(['flag_pub' => 0]);

        return redirect('/publicites')->with('success','modification effectué');
    }

    public function products(Request $request){

        $recherches = '';
        $date1 = 0;
        $date2 = 0;

        if($request->isMethod('post')){

            $data = $request->all();

            $condition = '';

            if (isset($data['date1'])) {
                $date1 = $data['date1'];
                $condition = $condition . ' and cp.date_click > ' . "'$date1'";
            }

            if (isset($data['date2'])) {
                $date2 = $data['date2'];
                $condition = $condition . ' and cp.date_click < ' . "'$date2'";
            }

            $recherches = DB::select(
                DB::raw(
                   'SELECT cap.libelle_cat_prod, p.titre_produit, SUM(cp.count_click) as nombre, cp.date_click   from count_produit cp
                    inner join produit p on cp.id_prod = p.id_produit
                    inner join categorie_produit cap on p.id_cat_produit = cap.id_cat_prod
                    where 1=1 ' . $condition . ' GROUP by cp.id_prod, cp.date_click ' ),
            );

            if(count($recherches)==0){

                            return redirect('/products')
                                ->with('errors', 'Aucun resultat trouvés');
                        }
        }






      return view('products.index', compact('recherches','date1','date2'));
    }


    public function apercuproduits($id=null, $id1=null){

            $condition = '';

            if ($id != 0) {
                $date1 = $id;
                $condition = $condition . ' and cp.date_click > ' . "'$date1'";
            }

            if ($id1 != 0) {
                $date2 = $id1;
                $condition = $condition . ' and cp.date_click < ' . "'$date2'";
            }

            $recherches = DB::select(
                DB::raw(
                   'SELECT cap.libelle_cat_prod, p.titre_produit, SUM(cp.count_click) as nombre, cp.date_click   from count_produit cp
                    inner join produit p on cp.id_prod = p.id_produit
                    inner join categorie_produit cap on p.id_cat_produit = cap.id_cat_prod
                    where 1=1 ' . $condition . ' GROUP by cp.id_prod, cp.date_click ' ),
            );

     return view('products.edit', compact('recherches'));
    }


    public function listescontacts(){

     $contacts = Contact::all();

     //dd($contacts);die();

     return view('contacts.index',compact('contacts'));
    }


}
