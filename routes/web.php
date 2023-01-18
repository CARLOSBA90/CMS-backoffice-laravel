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

/*
Route::get('test', function () {
    
});*/



//-------------MIDDLEWARE-------------------//
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/cocina', function () {
        return view('dash.index');
    })->name('dash');


//-------------SECCIONES-----------------------//
Route::resource('cocina/seccion','App\Http\Controllers\SeccionController');
Route::get('cocina/seccion/enable/{id}', 'App\Http\Controllers\SeccionController@enable');
//------------------------------------------//


//-------------RECETAS-----------------------//
Route::resource('/cocina/recetas','App\Http\Controllers\RecetaController');
Route::get('/cocina/recetas/enable/{id}', 'App\Http\Controllers\RecetaController@enable');
Route::get('/cocina/recetas/imagen/{id}/{nombre}/{descripcion}', 'App\Http\Controllers\RecetaController@imagen');
//------------------------------------------//

//-------------IMAGENES-----------------------//
Route::get('cocina/dropzone', [DropzoneController::class, 'dropzone']);
Route::post('cocina/dropzone/store', [DropzoneController::class, 'dropzoneStore'])->name('dropzone.store');

//------------------------------------------//

});

//------------------------------------------//


//Auth::routes();
