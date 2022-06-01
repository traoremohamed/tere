<?php

namespace App\Http\Controllers;

use App\Models\intervenant;
use App\Models\rapport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Crypt;
class IntervenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=intervenant::with('rapport')->get();
        return view('intervenant.index',compact('data'));
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
 
         return view('intervenant.create',compact('rapports','rapport'));
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
            $intervenant = new intervenant();
            $intervenant->rapport_id = $request->rapport_id;
            $intervenant->designation = $request->designation;
            $intervenant->nombre = $request->nombre;
            //dd($intervenant->designation);
            $nombre=count($intervenant->designation)-1;
           //dd($nombre);
           for($i=0;$i<=$nombre;$i=$i){
            $intervenant = new intervenant([$i]);
            $intervenant->rapport_id = $request->rapport_id;
            $intervenant->designation = $request->designation[$i];
            $intervenant->nombre = $request->nombre[$i];
            //$data=[$request->rapport_id,$request->designation[$i],$request->nombre[$i]];
            $intervenant->save();
            $i++;
           }
          
            return redirect()->route('list-intervenant')->with('success', 'Enregistrement reussi.');
        }

        return view('intervenant.index');
           
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\intervenant  $intervenant
     * @return \Illuminate\Http\Response
     */
    public function show(intervenant $intervenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\intervenant  $intervenant
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //$id = Crypt::UrldeCrypt($id);
        $type = intervenant::where([['id','=',$id]])->first();
        //dd($type);
        $rapport=rapport::with('intervenant')->get();
        if ($request->isMethod('post')){
            $intervenant = intervenant::find(Crypt::UrldeCrypt($id));
           // dd($intervenant);
            $intervenant->rapport_id = $request->rapport_id;
            $intervenant->designation = $request->designation;
            $intervenant->nombre = $request->nombre;
            $intervenant->save();
            return redirect()->route('list-intervenant')->with('success', 'Modification effectuée avec succès.');
        }

        return view('intervenant.modifier',compact('type','rapport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\intervenant  $intervenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, intervenant $intervenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\intervenant  $intervenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(intervenant $intervenant)
    {
        //
    }
}
