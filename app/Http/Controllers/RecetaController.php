<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receta;
use App\Services\RecetaService;


class RecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            return RecetaService::index(); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           return RecetaService::nuevo();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);

        RecetaService::actualizarID(
                          $request->get('id'), 
                          RecetaService::guardar($request)); /// primero guarda, luego actualiza
        return redirect(route('recetas.index'));//
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return RecetaService::show();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return view('receta.edit')->with('receta',RecetaService::editar($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  
        $this->validation($request);
        RecetaService::actualiza($request,$id);
        return redirect(route('recetas.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RecetaService::elimina($id);
        return redirect(route('recetas.index'));
    }

    public function validation(Request $request)
    {
          $validated = $request->validate([
            'nombre' => 'required|max:300',   ///|unique:recetas /// a futuro evitar que se borren datos del form
            'descripcion' => 'required|max:4000',
        ]);
    }

    public function enable($id)
    {
        RecetaService::enable($id);
        return 1;
    }

    
    public function imagen($id,$nombre,$descripcion)
    {
      /// T0D0, VALIDACION PARA NO RE-INSERTAR UNA IMAGEN DOS VECES EN BBDD(CONTROLADO EN JAVASCRIPT)
        RecetaService::imagen($id,$nombre,$descripcion);
        return 1;
    }

    public function eliminaImagen($id)
    {
        return RecetaService::eliminaImagen($id);
    }
}
