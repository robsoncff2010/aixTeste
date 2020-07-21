<?php

use App\Http\Resources\CepController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::any('lista/search', 'ListaAlunosController@search')->name('lista.search')->middleware(['auth']);
Route::any('materia/search', 'MateriaController@search')->name('materia.search')->middleware(['auth']);

Route::resource('lista','ListaAlunosController')->middleware(['auth']);
Route::resource('materia','MateriaController')->middleware(['auth']);
Route::resource('xml','importXMLController')->middleware(['auth']);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
