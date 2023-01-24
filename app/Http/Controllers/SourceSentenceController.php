<?php

namespace App\Http\Controllers;

use App\Models\SourceSentence;
use Illuminate\Http\Request;

class SourceSentenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SourceSentence  $sourceSentence
     * @return \Illuminate\Http\Response
     */
    public function show(SourceSentence $sourceSentence)
    {
        //
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
