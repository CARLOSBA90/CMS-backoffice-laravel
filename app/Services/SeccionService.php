<?php

namespace app\Services;
 
use App\Models\Seccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
 
class SeccionService
{

    ///GUARDA NUEVA SECCION, RETORNA ID
    public static function guardar(Request $request){
        $seccion = new Seccion();
        $seccion->nombre = $request->get('nombre');
        $seccion->enabled = $request->get('enabled')=='1'? 1 : 0;
        $seccion->save();
        return $seccion->id;
    }


    ///ACTUALIZA SECCION
    public static function actualiza(Request $request, $id){

        $seccion = Seccion::find($id);
        $seccion->nombre = $request->get('nombre');
        $seccion->enabled = $request->get('enabled')=='1'? 1 : 0;
        $seccion->save();
    }

    ///ELIMINA SECCION
    public static function elimina($id){
        /// CONDICIONAR PARA NO ELIMINAR SI TIENE AL MENOS UNA RECETA
        $seccion = Seccion::find($id);
        $seccion->delete();
    }

    ///HABILITA/DESHABILITA SECCION
    public static function enable($id){
        $seccion = Seccion::find($id);
        $seccion->enabled = !$seccion->enabled;
        $seccion->save();
    }

}

?>