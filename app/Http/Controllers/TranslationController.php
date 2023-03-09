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
            ->leftJoin('translations', 'translations.source_sentence_id', '=', 'source_sentences.id')
            ->join('projects', 'projects.id', '=', 'source_sentences.project_id')
            ->select(
				'source_sentences.id AS source_sentence_id',
				'source_sentences.sentence_text',
				'translations.id AS translation_id',
				'translations.lang AS translation_lang', 
				'translation', 
				'translator_id', 
				'projects.id AS project_id')
            ->where('projects.id', $project_id)
            ->where('source_sentences.page_num', $lastSourcePage)
            ->orderBy('grouping_index')
            ->get();

        $saved_translation_lang = DB::table('users')
            ->where('id', 1)
            ->pluck('saved_translation_lang')
            ->first(); 

        return view(
			'translations/translations',
            [
                'project_id' => $project_id,
                'landingPage' => ($lastSourcePage),
                'languages' => Language::getIsoLanguages(),
                'sourcePageTranslations' => $sourcePageTranslations,
                'sourcePageExists' => $sourcePageTranslations->isNotEmpty() ? true : false,
                'saved_translation_lang' => $saved_translation_lang,
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
        try {
            DB::transaction(function () use ($request) 
            {
                $translationData = [
					'lang' => $request->lang,
                    'translation' => $request->translation,
                    'source_sentence_id' => $request->source_sentence_id,
                    'translator_id' => 1,
                ];

                $translationInsert = Translation::create($translationData);

                // Update the users translation lang to prefill when needed
                DB::table('users')
                    ->where('id', 1)
                    ->update(['saved_translation_lang' => $request->lang]);

                return view(
					'components/form-fields/translationUploadButton', 
					[	
						'translation_id' => $translationInsert->id,
						'source_sentence_id' => $request->source_sentence_id,
					]
				);
            });
        } catch (\Throwable $th) {
            //return view('translations/translations', ['errorMessage' => 'Failed to save translation.']);
        }
        
        
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
        $foo = $translation;

		return;
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
		try {
			DB::transaction(function () use ($request) {
				$translation = Translation::findOrFail($request->translation_id);
				$translation->lang = $request->lang;
				$translation->translation = $request->translation;
				$translation->save();

				// Update the users translation lang to prefill when needed
				DB::table('users')
				->where('id', 1)
				->update(['saved_translation_lang' => $request->lang]);
			});
			
			return view(
				'components/form-fields/translationUploadButton',
				[
					'translation_id' => $request->translation_id,
					'source_sentence_id' => $request->source_sentence_id,
				]
			);
		} catch (\Throwable $th) {
			//return view('translations/translations', ['errorMessage' => 'Failed to save translation.']);
		}

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
