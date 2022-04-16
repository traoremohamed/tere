<?php

namespace App\Http\Controllers;

use App\Helpers\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeContract;
use DB;
use Hash;
use Auth;
use Session;
use Image;
use File;

class TypeContratController extends Controller
{
    public function index(){

        $types = TypeContract::all();

        return view('typecontrat.index', compact('types'));
    }

    public function create(Request $request){





        if ($request->isMethod('post')) {

            $request->validate([
                'libelle_type_contrat' => 'required',
                'code_type_contrat' => 'required',
            ]);

            TypeContract::create($request->all());
            return redirect()->route('typecontrat')->with('success', 'Enregistrement reussi.');
        }

        return view('typecontrat.create');

    }

    public function edit(Request $request, $id=null){

        $id = Crypt::UrldeCrypt($id);

        $type = TypeContract::where([['id_type_contrat','=',$id]])->first();

        if ($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            TypeContract::where([['id_type_contrat','=',$id]])->update([
                'libelle_type_contrat' =>$data['libelle_type_contrat'],
                'code_type_contrat' =>$data['code_type_contrat'],
                'flag_type_contrat' =>$data['flag_type_contrat']
            ]);
            return redirect()->route('typecontrat')->with('success', 'Enregistrement reussi.');
        }

        return view('typecontrat.edit',compact('type'));
    }
}
