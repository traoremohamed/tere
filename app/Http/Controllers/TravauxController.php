<?php

namespace App\Http\Controllers;

use App\Models\travaux;
use Illuminate\Http\Request;
use App\Models\rapport;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Crypt;

class TravauxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=travaux::with('rapport')->get();
        return view('travaux.index',compact('data'));
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
 
         return view('travaux.create',compact('rapports','rapport'));
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
            $travaux = new travaux();
            $travaux->rapport_id = $request->rapport_id;
            $travaux->designation = $request->designation;
            $travaux->quantite = $request->quantite;
            $travaux->unite = $request->unite;
            //dd($intervenant->designation);
            $nombre=count($travaux->designation)-1;
           //dd($nombre);
           for($i=0;$i<=$nombre;$i=$i){
            $travaux = new travaux([$i]);
            $travaux->rapport_id = $request->rapport_id;
            $travaux->designation = $request->designation[$i];
            $travaux->quantite = $request->quantite[$i];
            $travaux->unite = $request->unite[$i];
            //$data=[$request->rapport_id,$request->designation[$i],$request->nombre[$i]];
            $travaux->save();
            $i++;
           }
          
            return redirect()->route('list-travaux')->with('success', 'Enregistrement reussi.');
        }

        return view('travaux.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\travaux  $travaux
     * @return \Illuminate\Http\Response
     */
    public function show(travaux $travaux)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\travaux  $travaux
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $type = travaux::where([['id','=',$id]])->first();
        //dd($type);
        $rapport=rapport::with('travaux')->get();
        if ($request->isMethod('post')){
            $travaux = travaux::find(Crypt::UrldeCrypt($id));
           // dd($intervenant);
            $travaux->rapport_id = $request->rapport_id;
            $travaux->designation = $request->designation;
            $travaux->quantite = $request->quantite;
            $travaux->unite = $request->unite;
            $travaux->save();
            return redirect()->route('list-travaux')->with('success', 'Modification effectuée avec succès.');
        }

        return view('travaux.modifier',compact('type','rapport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\travaux  $travaux
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, travaux $travaux)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\travaux  $travaux
     * @return \Illuminate\Http\Response
     */
    public function destroy(travaux $travaux)
    {
        //
    }
}
