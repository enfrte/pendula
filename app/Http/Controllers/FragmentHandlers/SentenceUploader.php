<?php

namespace App\Http\Controllers\FragmentHandlers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

/**
 * Handles requests from htmx to populate fragments in html. 
 * This one returns the sentences from a project's page, or nothing if nothing has been uploaded.
 */
class SentenceUploader extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $project_id)
    {
        $page_num = $request->page_num;
        //$project_id = $request->project_id;

        $sentence_collection = DB::table('source_sentences')
            ->select('sentence_text')
            ->where('project_id', $project_id)
            ->where('page_num', $page_num)
            ->get();

        $sentences = $sentence_collection->implode('sentence_text', "\n");
        
        return view("sentences/source-sentences", [
            'page_num' => $page_num,
            'sentences' => $sentences,
            'project_id' => $project_id
        ])->fragment('sentence-upload');
    }
}
