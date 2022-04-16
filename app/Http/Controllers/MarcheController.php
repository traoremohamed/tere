<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use Auth;
use Session;
use Image;
use File;

class MarcheController extends Controller
{
    public function index(){

        $marches = DB::table('marche')
            ->join('type_contract','marche.id_type_cont','type_contract.id_type_contrat')
            ->join('type_marche','marche.id_type_marc','type_marche.id_type_marche')
            ->join('pays','marche.id_pays','pays.id_pays')
            ->get();

        return view('marche.index',compact('marches'));
    }

    public  function  create(Request $request){

        return view('marche.create');
    }

    public function edit(Request $request, $id=null){

        return view('marche.edit');
    }
}
