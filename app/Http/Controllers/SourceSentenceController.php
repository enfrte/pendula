<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\SourceSentence;
use Illuminate\Support\Facades\DB;

class SourceSentenceController extends Controller
{
    /**
     * Display a listing of the resource. Set view to the next empty page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project_id)
    {
        $max_page_num = DB::table('source_sentences')
            ->where('project_id', $project_id)
            ->max('page_num');

        return view(
			'sentences/source-sentences', [
                'project_id' => $project_id,
                'nextPageNum' => ($max_page_num + 1),
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
        // echo 'create';
        return view('sentences/source-sentences');
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

        try {
            $sentences = explode(PHP_EOL, $request->sentences);

            foreach( $sentences as $key => $sentence ) {
                $sentence = trim($sentence);
                
                if (empty($sentence)) continue;

                $data[] = [
                    'grouping_index' => $key,
                    'sentence_text' => $sentence,
                    'page_num' => $request->page_num,
                    'project_id' => $request->project_id,
                    'user_id' => 1,
                ];
            }

            if (empty($data)) throw new Exception("No sentences found");
            
            DB::table('source_sentences')->insert( $data );

            //return redirect("add-sentences/$request->project_id");
            //return $this->index($request->project_id);

            $max_page_num = DB::table('source_sentences')
                ->where('project_id', $request->project_id)
                ->max('page_num');

            return view(
				'sentences/source-sentences',
                [
                    'project_id' => $request->project_id,
                    'nextPageNum' => ($max_page_num + 1),
                ]
            )->fragment('main');
        } 
        catch (\Throwable $th) {
            echo $th->getMessage();
        }
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

        return view('sentences/source-sentences', [
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

    public function deleteProjectPage($project_id, $page_num)
    {
        DB::table('source_sentences')
            ->where('page_num', $page_num)
            ->where('project_id', $project_id)
            ->delete();
        
        return view(
			'sentences/source-sentences',
            [
                'project_id' => $project_id,
                'nextPageNum' => $page_num,
            ]
        )->fragment('main');
    }

}
