<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\SourceSentenceController;
use App\Http\Controllers\FragmentHandlers\LanguageSelect;
use App\Http\Controllers\FragmentHandlers\LanguageSelect2;
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

// Test
Route::get('/test', [TestController::class, 'index']);
Route::get('/fragmentTest', [TestController::class, 'fragmentTest']);

// Home
Route::get('/', [ProjectController::class, 'index']);

// Projects
Route::resource('projects', ProjectController::class);

// Sentences upload
Route::resource('sourceSentences', SourceSentenceController::class);
Route::get('add-sentences/{id}', [SourceSentenceController::class, 'index']);
Route::delete('delete-project-page/{id}/{page_num}', [SourceSentenceController::class, 'deleteProjectPage']);
//Route::post('page-upload', [SourceSentenceController::class, 'pageUpload']);

// Translations
Route::put('translations/{translation_id}', [TranslationController::class, 'update']);
Route::resource('translations', TranslationController::class);
Route::get('translate-sentences/{id}', [TranslationController::class, 'index']);

// htmx fragment handlers 
Route::post('languageSearch', LanguageSelect::class);
Route::post('sentence-upload/{id}', SentenceUploader::class);
Route::post('translation-upload/{id}', TranslationUploader::class);

Route::post('languageSearch2', LanguageSelect2::class);
