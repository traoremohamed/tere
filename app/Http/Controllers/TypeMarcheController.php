<?php

namespace App\Http\Controllers;

use App\Helpers\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeMarche;
use DB;
use Hash;
use Auth;
use Session;
use Image;
use File;

class TypeMarcheController extends Controller
{
    public function index(){

        $types = TypeMarche::all();

        return view('typemarche.index', compact('types'));
    }

    public function create(Request $request){





        if ($request->isMethod('post')) {

            $request->validate([
                'libelle_type_marche' => 'required',
                'code_type_marche' => 'required',
            ]);

            TypeMarche::create($request->all());
            return redirect()->route('typemarche')->with('success', 'Enregistrement reussi.');
        }

        return view('typemarche.create');

    }

    public function edit(Request $request, $id=null){

        $id = Crypt::UrldeCrypt($id);

        $type = TypeMarche::where([['id_type_marche','=',$id]])->first();

        if ($request->isMethod('post')){
                $data = $request->all();
                //dd($data);
            TypeMarche::where([['id_type_marche','=',$id]])->update([
                'libelle_type_marche' =>$data['libelle_type_marche'],
                'code_type_marche' =>$data['code_type_marche'],
                'flag_type_marche' =>$data['flag_type_marche']
            ]);
            return redirect()->route('typemarche')->with('success', 'Enregistrement reussi.');
        }

        return view('typemarche.edit',compact('type'));
    }
}
