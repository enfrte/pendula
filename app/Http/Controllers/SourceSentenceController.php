<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SourceSentence;
use Illuminate\Support\Facades\DB;

class SourceSentenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project_id)
    {
        $pages = DB::table('source_sentences')
            ->select('page_num')
            ->where('project_id', $project_id)
            ->get();
        /* $max_page = $pages->max('page_num');
        $pagination = $pages->paginate();
        if ( empty($pages) ) {
        } */
        //$foo = $pages->paginate();
        //dd($pages);
        return view(
            'source-sentences', ['project_id' => $project_id]
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // echo 'create';
        return view('source-sentences');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sentences = [];
        $data = [];
		$sentences = explode(PHP_EOL, $request->sentences);
		
		foreach( $sentences as $key => $sentence ) {
			$data[] = [
                'grouping_index' => $key,
                'sentence_text' => $sentence,
                'page_num' => $request->page_num,
                'project_id' => $request->project_id,
                'user_id' => 1,
			];
		}
        
        DB::table('source_sentences')->insert( $data );
        return view('source-sentences');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SourceSentence  $sourceSentence
     * @return \Illuminate\Http\Response
     */
    public function show(SourceSentence $sourceSentence)
    {
        //$sentences = DB::table('source_sentences')->get();
        // If no page number, 
        //... $sourceSentence->project_id

        // If page number
        //... $sourceSentence->page_num

        // Query db
        // SELECT * 
        // FROM source_sentences 
        // WHERE $sourceSentence->project_id 
        // AND page_num = $sourceSentence->page_num
        // ORDER BY grouping_index ASC

        // Setup pagination
        //...
        
        $project_id = $sourceSentence->project_id;

        return view('source-sentences', [
            'sentences', ['project_id' => $project_id]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SourceSentence  $sourceSentence
     * @return \Illuminate\Http\Response
     */
    public function edit(SourceSentence $sourceSentence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SourceSentence  $sourceSentence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SourceSentence $sourceSentence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SourceSentence  $sourceSentence
     * @return \Illuminate\Http\Response
     */
    public function destroy(SourceSentence $sourceSentence)
    {
        //
    }

}
