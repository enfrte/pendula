<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Languages\Language;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project_id)
    {
        $lastSourcePage = DB::table('source_sentences')
            ->where('project_id', $project_id)
            ->max('page_num');

        $sourcePageTranslations = DB::table('source_sentences')
            ->leftJoin('translations', 'translations.source_sentenece_id', '=', 'source_sentences.id')
            ->join('projects', 'projects.id', '=', 'source_sentences.project_id')
            ->select('*')
            ->where('projects.id', $project_id)
            ->where('source_sentences.page_num', $lastSourcePage)
            ->orderBy('grouping_index')
            ->get();

        return view( 'translations',
            [
                'project_id' => $project_id,
                'landingPage' => ($lastSourcePage),
                'languages' => Language::getIsoLanguages(),
                'sourcePageTranslations' => $sourcePageTranslations,
                'sourcePageExists' => $sourcePageTranslations->isNotEmpty() ? true : false,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'translation_lang' => $request->source_lang,
            'translation' => $request->translation,
            'source_sentenece_id' => $request->source_sentenece_id,
            'translator_id' => 1,
        ];

        DB::table('translations')->insert($data);

        DB::table('users')
            ->where('id', 1)
            ->update(['saved_translation_lang' => '']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function show(Translation $translation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function edit(Translation $translation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Translation $translation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Translation $translation)
    {
        //
    }
}
