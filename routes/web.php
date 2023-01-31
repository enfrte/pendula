<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SourceSentenceController;
use App\Http\Controllers\FragmentHandlers\LanguageSelect;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

// Home
Route::get('/', [ProjectController::class, 'index']);

// Projects
Route::resource('projects', ProjectController::class);

// Sentences upload
//Route::get('add-sentences/{id}', [SourceSentenceController::class, 'create']);
//Route::resource('sourceSentences', SourceSentenceController::class);

// htmx fragment handlers 
Route::post('languageSearch', LanguageSelect::class);
