<?php

namespace App\Http\Controllers;

use App\Models\rapport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Crypt;
class RapportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=rapport::all();
        return view('rapport.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
         return view('rapport.create');
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
            $rapport = new rapport();
            $rapport->titre = $request->titre;
            $rapport->nomprojet = $request->nomprojet;
            $rapport->datejour = $request->datejour;
            $rapport->nomchef = $request->nomchef;
            $rapport->contact = $request->contact;
            $rapport->save();
            return redirect()->route('list-rapport')->with('success', 'Enregistrement reussi.');
           }

        return view('rapport.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rapport  $rapport
     * @return \Illuminate\Http\Response
     */
    public function show(rapport $rapport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rapport  $rapport
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $type = rapport::where([['id','=',$id]])->first();
        //dd($type);
        if ($request->isMethod('post')){
            $rapport = rapport::find(Crypt::UrldeCrypt($id));
            $rapport->titre = $request->titre;
            $rapport->nomprojet = $request->nomprojet;
            $rapport->datejour = $request->datejour;
            $rapport->nomchef = $request->nomchef;
            $rapport->contact = $request->contact;
            $rapport->save();
            return redirect()->route('list-rapport')->with('success', 'Modification effectuée avec succès.');
        }

        return view('rapport.modifier',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rapport  $rapport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rapport $rapport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rapport  $rapport
     * @return \Illuminate\Http\Response
     */
    public function destroy(rapport $rapport)
    {
        //
    }
}
