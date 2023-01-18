<?php
namespace app\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Seccion;
use App\Models\Receta;
 
class PublicService
{
    public static function index(){

        $seccions = Seccion::where("enabled","=",1)->get(['id','nombre']);
       /// FALTA: PUBLICIDAD, Y RECETAS

       $recetas = Receta::join('seccions', 'seccions.id', '=', 'recetas.seccion_id')
       ->where('seccions.enabled', 1)
       ->where('recetas.enabled', 1)
       ->orderByDesc('recetas.id')
      
       ->get(['recetas.id','recetas.nombre AS nombre','recetas.enabled','recetas.resumen as resumen','seccions.nombre AS seccion','recetas.created_at AS fecha'])
       ->paginate(5)
       ;

        return view('frontend.index',compact('seccions', 'recetas'));
    }

}

?>