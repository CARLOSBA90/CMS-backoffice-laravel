<?php

namespace app\Services;
 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Seccion;
 
class PublicService
{
    public static function index(){

        $seccions = Seccion::where("enabled","=",1)->get(['id','nombre']);
       /// FALTA: PUBLICIDAD, Y RECETAS
    
        return view('frontend.index',compact('seccions'));
    }

}

?>