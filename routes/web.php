<?php

use App\Http\Controllers\FragmentHandler\LanguageSelect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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

//dd(resolve('App\Languages\Language'));

Route::get('/', function () {
    return view('welcome');
});

Route::resource('projects', ProjectController::class);
//Route::post('/create-project', [ProjectController::class, 'create']);

// htmx fragment handlers 
Route::post('/languageSearch', LanguageSelect::class);
