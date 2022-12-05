<?php

namespace app\Services;
 
use App\Models\Receta;
use App\Models\Imagen;
use App\Models\Seccion;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
 
class RecetaService
{
    ///GENERA LISTA DE RECETAS PARA EL DATATABLE
    public static function index(){ 
        return view('receta.index')->with('recetas',
         Receta::leftjoin('seccions', 'seccions.id', '=', 'recetas.seccion_id')
           ->get(['recetas.id','recetas.nombre AS nombre','recetas.enabled','recetas.published_at','seccions.nombre AS seccion'])
     );
    }

    ///GENERA LISTA DE RECETAS(PUBLICO)
    public static function show(){
        return view('receta.show')->with('recetas',
        Receta::join('seccions', 'seccions.id', '=', 'recetas.seccion_id')
          ->where("recetas.enabled","=",1)
          ->get(['recetas.id','recetas.nombre AS nombre','recetas.descripcion','seccions.nombre AS seccion'])

    );
    }


    ///GENERA DE ID TEMPORAL, AL GENERAR UNA NUEVA RECETA
    public static function nuevo(){ 
        $randomID = abs(crc32(uniqid()));
        while(Receta::select("*")->where('id', $randomID)->exists()){ $randomID = abs(crc32(uniqid())); }
        $response = new Response();
        $response->randomID = $randomID;
        $response->secciones = Seccion::get(['id','nombre']);
        return view('receta.create')->with('response', $response);
    }

     ///BUSCA RECETA, PARA EDITAR
    public static function editar($id){
        $receta = Receta::find($id);
        $receta->secciones=Seccion::get(['id','nombre']);
        return $receta;
    }

    ///GUARDA NUEVA RECETA, RETORNA ID
    public static function guardar(Request $request){
        $receta = new Receta();
        $receta->nombre = $request->get('nombre');
        $receta->descripcion = $request->get('descripcion');
        $receta->enabled = $request->get('enabled')=='1'? 1 : 0;
        $receta->published_at = $request->get('published_at');
        $receta->seccion_id = $request->get('seccion');
        $receta->save();
        return $receta->id;
    }


    ///REEMPLAZA ID TEMPORAL POR ID GENERADO
    public static function actualizarID($temp_id, $id){
        Imagen::where('receta_id',$temp_id)
              ->update(['receta_id' => $id]);
    }

    ///ACTUALIZA RECETA
    public static function actualiza(Request $request, $id){
        $receta = Receta::find($id);
        $receta->nombre = $request->get('nombre');
        $receta->descripcion = $request->get('descripcion');
        $receta->enabled = $request->get('enabled')=='1'? 1 : 0;
        $receta->published_at = $request->get('published_at');
        $receta->seccion_id = $request->get('seccion');
        $receta->save();
    }

    ///ELIMINA RECETA
    public static function elimina($id){
        $receta = Receta::find($id);
        $receta->delete();
    }

    ///HABILITA/DESHABILITA RECETA
    public static function enable($id){
        $receta = Receta::find($id);
        $receta->enabled = !$receta->enabled;
        $receta->save();
    }

    ///AGREGA IMAGEN
     public static function imagen($id,$nombre,$descripcion){
        $imagen = new Imagen();
        $imagen->name = $nombre;
        $imagen->receta_id = $id;
        $imagen->descripcion = "Nombre original del archivo ".$descripcion.", Insertado en la fecha ".date('Y-m-d H:i:s');
        $imagen->enabled = true;    
        $imagen->save();
      }

}

?>