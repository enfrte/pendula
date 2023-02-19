<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Translator;
use App\Languages\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    private $user_id = 1; // To do: User accounts

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('projects', [
            'projects' => Project::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-project', [
            'languages' => Language::getIsoLanguages(),
        ]);
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
                $incomingFields = $request->validate([
                    'title' => 'required',
                    'source_lang' => 'required',
                ]);

                $incomingFields['title'] = strip_tags($incomingFields['title']);
                $incomingFields['source_lang'] = strip_tags($incomingFields['source_lang']);
                $incomingFields['description'] = strip_tags($request->input('description'));
                $incomingFields['user_id'] = $this->user_id; //auth()->id();

                $project = Project::create($incomingFields);

                // Store creator as a translator
                $translatorColumns = [
                    'user_id' => $this->user_id,
                    'project_id' => $project->id
                ];

                Translator::create($translatorColumns);
            });

            return redirect('/projects');
        } 
        catch (\Throwable $th) {
            //$request->session()->flash('status', 'Error!');
            echo $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects', [
            'projects' => Project::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('create-project', [
            'project' => Project::find($project->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        try {
            $incomingFields = $request->validate([
                'title' => 'required',
            ]);

            $incomingFields['title'] = strip_tags($incomingFields['title']);
            $incomingFields['description'] = strip_tags($request->input('description'));

            $project->update($incomingFields);
            return redirect('/projects');
        } catch (\Throwable $th) {
            //$request->session()->flash('status', 'Task was successful!');
            echo $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // The id from the uri (passed to route) was used to create the project instance
        $project->delete();
        
        return;
    }

}
