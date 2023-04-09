<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DropzoneController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

****************************************
Cuando agregamos rutas con recursos(los recursos siempre deben ir de ultimo para no causar conflicto con el recurso)
****************************************
*/

Route::get('/', 'App\Http\Controllers\PublicController@index');



//-------------MIDDLEWARE-------------------//
Route::middleware([
    'auth:sanctum'
])->group(function () {
    Route::get('/entrada/cocina', function () {
        return view('dash.index');
    })->name('dash');


//-------------SECCIONES-----------------------//
Route::get('entrada/cocina/seccion/enable/{id}', 'App\Http\Controllers\SeccionController@enable');
Route::resource('entrada/cocina/seccion','App\Http\Controllers\SeccionController');
//------------------------------------------//


//-------------RECETAS-----------------------//
Route::get('entrada/cocina/recetas/enable/{id}', 'App\Http\Controllers\RecetaController@enable');
Route::get('entrada/cocina/recetas/imagen/{id}/{nombre}/{descripcion}', 'App\Http\Controllers\RecetaController@imagen');
Route::get('entrada/cocina/recetas/elimina/portada/{id}', 'App\Http\Controllers\RecetaController@eliminaImagen');
Route::resource('entrada/cocina/recetas','App\Http\Controllers\RecetaController');
//------------------------------------------//

//-------------CONFIG-----------------------//
Route::get('entrada/cocina/config/ebanner','App\Http\Controllers\ConfigController@ebanner');
Route::resource('entrada/cocina/config','App\Http\Controllers\ConfigController');
//------------------------------------------//


//-------------IMAGENES-----------------------//
Route::get('entrada/cocina/dropzone', [DropzoneController::class, 'dropzone']);
Route::post('entrada/cocina/dropzone/store', [DropzoneController::class, 'dropzoneStore'])->name('dropzone.store');

//------------------------------------------//




});

//Route::auth();
//------------------------------------------//

