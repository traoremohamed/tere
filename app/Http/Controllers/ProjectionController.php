<?php

namespace App\Http\Controllers;

use App\Models\projection;
use App\Models\rapport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Crypt;
class ProjectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=projection::all();
        return view('projection.index',compact('data'));
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
 
         return view('projection.create',compact('rapports','rapport'));
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
            $projection = new projection();
            $projection->rapport_id = $request->rapport_id;
            $projection->designation = $request->designation;
            $projection->dateprojection = $request->dateprojection;
            //dd($intervenant->designation);
            $nombre=count($projection->designation)-1;
           //dd($nombre);
           for($i=0;$i<=$nombre;$i=$i){
            $projection = new projection([$i]);
            $projection->rapport_id = $request->rapport_id;
            $projection->designation = $request->designation[$i];
            $projection->dateprojection = $request->dateprojection[$i];
            //$data=[$request->rapport_id,$request->designation[$i],$request->nombre[$i]];
            $projection->save();
            $i++;
           }
          
            return redirect()->route('list-projection')->with('success', 'Enregistrement reussi.');
        }

        return view('projection.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\projection  $projection
     * @return \Illuminate\Http\Response
     */
    public function show(projection $projection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\projection  $projection
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $type = projection::where([['id','=',$id]])->first();
        //dd($type);
        $rapport=rapport::with('projection')->get();
        if ($request->isMethod('post')){
            $projection = projection::find(Crypt::UrldeCrypt($id));
           // dd($intervenant);
            $projection->rapport_id = $request->rapport_id;
            $projection->designation = $request->designation;
            $projection->dateprojection = $request->dateprojection;
            $projection->save();
            return redirect()->route('list-projection')->with('success', 'Modification effectuée avec succès.');
        }

        return view('projection.modifier',compact('type','rapport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\projection  $projection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, projection $projection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\projection  $projection
     * @return \Illuminate\Http\Response
     */
    public function destroy(projection $projection)
    {
        //
    }
}
