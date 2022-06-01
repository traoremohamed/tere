<?php

namespace App\Http\Controllers;

use App\Models\machine;
use Illuminate\Http\Request;
use App\Models\rapport;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Crypt;
class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=machine::with('rapport')->get();
        return view('machine.index',compact('data'));
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
 
         return view('machine.create',compact('rapports','rapport'));
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
            $machine = new machine();
            $machine->rapport_id = $request->rapport_id;
            $machine->designation = $request->designation;
            $machine->quantite = $request->quantite;
            //dd($intervenant->designation);
            $nombre=count($machine->designation)-1;
           //dd($nombre);
           for($i=0;$i<=$nombre;$i=$i){
            $machine = new machine([$i]);
            $machine->rapport_id = $request->rapport_id;
            $machine->designation = $request->designation[$i];
            $machine->quantite = $request->quantite[$i];
            //$data=[$request->rapport_id,$request->designation[$i],$request->nombre[$i]];
            $machine->save();
            $i++;
           }
          
            return redirect()->route('list-machine')->with('success', 'Enregistrement reussi.');
        }

        return view('machine.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function show(machine $machine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $type = machine::where([['id','=',$id]])->first();
        //dd($type);
        $rapport=rapport::with('machine')->get();
        if ($request->isMethod('post')){
            $machine = machine::find(Crypt::UrldeCrypt($id));
           // dd($intervenant);
            $machine->rapport_id = $request->rapport_id;
            $machine->designation = $request->designation;
            $machine->quantite = $request->quantite;
            $machine->save();
            return redirect()->route('list-machine')->with('success', 'Modification effectuée avec succès.');
        }

        return view('machine.modifier',compact('type','rapport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, machine $machine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function destroy(machine $machine)
    {
        //
    }
}
