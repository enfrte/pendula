<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\SourceSentenceController;
use App\Http\Controllers\FragmentHandlers\LanguageSelect;
use App\Http\Controllers\FragmentHandlers\SentenceUploader;
use App\Http\Controllers\FragmentHandlers\TranslationUploader;

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
Route::resource('sourceSentences', SourceSentenceController::class);
Route::get('add-sentences/{project_id}', [SourceSentenceController::class, 'index']);
Route::delete('delete-project-page/{project_id}/{page_num}', [SourceSentenceController::class, 'deleteProjectPage']);
//Route::post('page-upload', [SourceSentenceController::class, 'pageUpload']);

// Translations
Route::resource('translations', TranslationController::class);
Route::get('translate-sentences/{project_id}', [TranslationController::class, 'index']);


// htmx fragment handlers 
Route::post('languageSearch', LanguageSelect::class);
Route::post('sentence-upload/{project_id}', SentenceUploader::class);
Route::post('translation-upload/{project_id}', TranslationUploader::class);
