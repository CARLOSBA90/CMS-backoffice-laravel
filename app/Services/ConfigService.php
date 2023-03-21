<?php
namespace app\Services;
use App\Models\Receta;
use App\Models\Imagen;
use App\Models\Seccion;
use App\Models\Response;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
 
class ConfigService{
    ///Lista de configuraciones
    public static function index(){ 
     return view('dash.config')->with('configs',Config::all());
    }


    ///GUARDAR TODO
    public static function store(Request $request){
        $array = $request->all();
        foreach ($array as $key => $item) {
            // haz algo aquí con los elementos del array
            Config::where('llave', '=', $key)->update(array('valor' => $item));
        }
        
        return view('dash.config')->with('configs',Config::all());
    }


    public static function eliminaBanner(){
        $config = Config::where('llave', 'Banner')->first();
        $config->delete();
    }
/*



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

      public static function eliminaImagen($id){
        $receta = Receta::find($id);
        $path =  public_path() ."/images/portada/".$receta->imagen_portada;
        $receta->imagen_portada = null;
       
        if(file_exists($path)){
        File::delete($path);
        $receta->save();
        return 1;
         }

        return 0;
    }*/

}

?>