<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Imagen;
use App\Services\ImagenService;

class DropzoneController extends Controller
{
     /**
     * Generate Image upload View
     *
     * @return void
     */
    public function dropzone()
    {
        return view('imagen.index');
    }
     
    /**
     * Image Upload Code
     *
     * @return void
     */
    public function dropzoneStore(Request $request)
    {
        $imageName = ImagenService::guardar($request);
        return response()->json(['success'=> $imageName]);
    }
}
