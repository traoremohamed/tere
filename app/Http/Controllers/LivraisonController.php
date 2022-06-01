<?php

namespace App\Http\Controllers;

use App\Models\livraison;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Crypt;
use App\Models\rapport;

class LivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=livraison::with('rapport')->get();
        return view('livraison.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rapport=rapport::all();
 
        $rapports = "";
                 foreach ($rapport as $data ) {
                             $rapports .= "<option value='".$data->id."'>".$data->titre." => ".$data->nomprojet."=> ".$data->datejour."</option>";
                  }
 
         return view('livraison.create',compact('rapports','rapport'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $livraison = new livraison();
            $livraison->rapport_id = $request->rapport_id;
            $livraison->designation = $request->designation;
            $livraison->datelivraison = $request->datelivraison;
            $livraison->save();
            return redirect()->route('list-livrable')->with('success', 'Enregistrement reussi.');
        }

        return view('livraison.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\livraison  $livraison
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\livraison  $livraison
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $type = livraison::where([['id','=',$id]])->first();
        //dd($type);
        $rapport=rapport::with('livraison')->get();
        if ($request->isMethod('post')){
            $livraison = livraison::find(Crypt::UrldeCrypt($id));
           // dd($intervenant);
            $livraison->rapport_id = $request->rapport_id;
            $livraison->designation = $request->designation;
            $livraison->datelivraison = $request->datelivraison;
            $livraison->save();
            return redirect()->route('list-livrable')->with('success', 'Modification effectuée avec succès.');
        }

        return view('livraison.modifier',compact('type','rapport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\livraison  $livraison
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, livraison $livraison)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\livraison  $livraison
     * @return \Illuminate\Http\Response
     */
    public function destroy(livraison $livraison)
    {
        //
    }
}
