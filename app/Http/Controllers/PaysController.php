<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pays;
use DB;
use Hash;
use Auth;
use Session;
use Image;
use File;

class PaysController extends Controller
{
    public function pays(){

        $pays = Pays::all();

       // dd($pays);

        return view('pays.index',compact('pays'));
    }
}
