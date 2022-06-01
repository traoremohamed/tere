<?php

namespace App\Http\Controllers;

use App\Models\consommable;
use Illuminate\Http\Request;
use App\Models\rapport;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Crypt;
class ConsommableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=consommable::with('rapport')->get();
        return view('consommable.index',compact('data'));
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
 
         return view('consommable.create',compact('rapports','rapport'));
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
            $consommable = new consommable();
            $consommable->rapport_id = $request->rapport_id;
            $consommable->designation = $request->designation;
            $consommable->quantite = $request->quantite;
            $consommable->unite = $request->unite;
            //dd($intervenant->designation);
            $nombre=count($consommable->designation)-1;
           //dd($nombre);
           for($i=0;$i<=$nombre;$i=$i){
            $consommable = new consommable([$i]);
            $consommable->rapport_id = $request->rapport_id;
            $consommable->designation = $request->designation[$i];
            $consommable->quantite = $request->quantite[$i];
            $consommable->unite = $request->unite[$i];
            //$data=[$request->rapport_id,$request->designation[$i],$request->nombre[$i]];
            $consommable->save();
            $i++;
           }
          
            return redirect()->route('list-consommable')->with('success', 'Enregistrement reussi.');
        }

        return view('consommable.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\consommable  $consommable
     * @return \Illuminate\Http\Response
     */
    public function show(consommable $consommable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\consommable  $consommable
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $type = consommable::where([['id','=',$id]])->first();
        //dd($type);
        $rapport=rapport::with('consommable')->get();
        if ($request->isMethod('post')){
            $consommable = consommable::find(Crypt::UrldeCrypt($id));
           // dd($intervenant);
            $consommable->rapport_id = $request->rapport_id;
            $consommable->designation = $request->designation;
            $consommable->quantite = $request->quantite;
            $consommable->unite = $request->unite;
            $consommable->save();
            return redirect()->route('list-consommable')->with('success', 'Modification effectuée avec succès.');
        }

        return view('consommable.modifier',compact('type','rapport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\consommable  $consommable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, consommable $consommable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\consommable  $consommable
     * @return \Illuminate\Http\Response
     */
    public function destroy(consommable $consommable)
    {
        //
    }
}
