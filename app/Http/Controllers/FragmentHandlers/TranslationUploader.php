<?php

namespace App\Http\Controllers\FragmentHandlers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

/**
 * Handles requests from htmx to populate fragments in html. 
 * This one returns the sentences from a project's page, or nothing if nothing has been uploaded.
 */
class TranslationUploader extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $project_id)
    {
        $sourcePageTranslations = DB::table('source_sentences')
        ->leftJoin('translations', 'translations.source_sentence_id', '=', 'source_sentences.id')
        ->join('projects', 'projects.id', '=', 'source_sentences.project_id')
            ->select(
				'source_sentences.id AS source_sentence_id',
				'grouping_index',
				'page_num',
				'sentence_text',
				'translations.id AS translation_id',
				'translations.lang AS translation_lang', 
				'translation', 
				'translator_id',
				'projects.id AS project_id',
				'title',
				'description',
				'projects.lang AS project_lang')
            ->where('projects.id', $project_id)
            ->where('source_sentences.page_num', $request->page_num)
            ->orderBy('grouping_index')
            ->get();

        return view("components/translation/sentenceTranslationComponent", [
            'project_id' => $project_id,
            'landingPage' => ($request->page_num),
            'sourcePageTranslations' => $sourcePageTranslations,
            'sourcePageExists' => $sourcePageTranslations->isNotEmpty() ? true : false,
        ]);
    }
}
