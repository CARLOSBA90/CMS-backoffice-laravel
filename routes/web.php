<?php

use Illuminate\Support\Facades\Route;
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
*/

Route::get('/', 'App\Http\Controllers\PublicController@index');

//Route::get('/{seccion}','App\Http\Controllers\PublicController@seccion');



//-------------MIDDLEWARE-------------------//
Route::middleware([
    'auth:sanctum'/*,
    config('jetstream.auth_session'),
    'verified'*/
])->group(function () {
    Route::get('/entrada/cocina', function () {
        return view('dash.index');
    })->name('dash');


//-------------SECCIONES-----------------------//
Route::resource('entrada/cocina/seccion','App\Http\Controllers\SeccionController');
Route::get('entrada/cocina/seccion/enable/{id}', 'App\Http\Controllers\SeccionController@enable');
//------------------------------------------//


//-------------RECETAS-----------------------//
Route::resource('entrada/cocina/recetas','App\Http\Controllers\RecetaController');
Route::get('entrada/cocina/recetas/enable/{id}', 'App\Http\Controllers\RecetaController@enable');
Route::get('entrada/cocina/recetas/imagen/{id}/{nombre}/{descripcion}', 'App\Http\Controllers\RecetaController@imagen');
Route::get('entrada/cocina/recetas/elimina/portada/{id}', 'App\Http\Controllers\RecetaController@eliminaImagen');
//------------------------------------------//

//-------------IMAGENES-----------------------//
Route::get('entrada/cocina/dropzone', [DropzoneController::class, 'dropzone']);
Route::post('entrada/cocina/dropzone/store', [DropzoneController::class, 'dropzoneStore'])->name('dropzone.store');

//------------------------------------------//

//-------------CONFIG-----------------------//
Route::resource('entrada/cocina/config','App\Http\Controllers\ConfigController');
Route::get('entrada/cocina/config','App\Http\Controllers\ConfigController@index');
//------------------------------------------//


});

//------------------------------------------//


//Auth::routes();
