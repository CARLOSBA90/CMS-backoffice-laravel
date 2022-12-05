<?php
namespace app\Services;
use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
 
class ImagenService
{
    ///NUEVA IMAGEN EN SERVIDOR
    public static function guardar(Request $request){
        $image = $request->file('file');
        $filename = uniqid();
        $imageName = $filename.'.'.$image->extension();
        $image->move(public_path('images'),$imageName);

        return $imageName;
    }

}

?>