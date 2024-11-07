<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

// controller
use App\Http\Controllers\Controller;

// helpers
use Illuminate\Support\Facades\Storage;

// model
use App\Models\{
    Project,
    Type,
    Technology,
};

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // aggiungo type
        $types = Type::all();

        // aggiungo technology
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // richiedo tutti i dati con validazione backend
        $data = $request->validate([
            'title'=> 'required|min:3|max:64',
            'description'=> 'required|min:20|max:4096',
            // 'cover'=> 'nullable|url|min:5|max:2048',

            // aggiunta validazione cover - file
            'cover'=> 'nullable|image|max:2048',

            'client'=> 'nullable|min:3|max:64',
            'sector'=> 'nullable|min:3|max:64',
            'published'=> 'nullable|in:1,0,true,false',

            // se nella tabella type, esiste come valore della colonna id
            'type_id'=>'nullable|exists:types,id',

            // tecnologie
            'technologies'=>'nullable|array|exists:technologies,id',
        ]);
        
        // aggiunto lo slug perché non l'ho messo nel form
        $data['slug'] = str()->slug($data['title']);
        // verifico che per il valore booleano, sia effettivamente passato qualcosa
        $data['published'] = isset($data['published']);

        if( isset($data['cover']) ){
            // aggiunto percorso relativo dell'immagine
            $img_path = Storage::put('uploads', $data['cover']);
            //salvo il percorso nel database
            $data['cover'] = $img_path;
        };

        $project = Project::create($data);

        // sincronizzo id delle tecnologie con i progetti
        $project->technologies()->sync($data['technologies'] ?? []);

        return redirect()->route('admin.projects.show', ['project' => $project->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // aggiungo type
        $types = Type::all();

        // aggiungo technology
        $technologies = Technology::get();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'=> 'required|min:3|max:64',
            'description'=> 'required|min:20|max:4096',
            // 'cover'=> 'nullable|url|min:5|max:2048',

            // aggiunta validazione cover - file
            'cover'=> 'nullable|image|max:2048',

            'client'=> 'nullable|min:3|max:64',
            'sector'=> 'nullable|min:3|max:64',
            'published'=> 'nullable|in:1,0,true,false',

            // se nella tabella type, esiste come valore della colonna id
            'type_id'=>'nullable|exists:types,id',

            // tecnologie
            'technologies'=>'nullable|array|exists:technologies,id',

            // delete cover
            'delete-cover' => 'nullable',
        ]);
        
        $data['slug'] = str()->slug($data['title']);
        $data['published'] = isset($data['published']);

        // Se c'è già posso rimuoverla
        // Se c'è già posso sostituirla
        // Posso aggiungerla se non c'è

        // se l'utente mi ha passato cover
        if( isset($data['cover']) ){

            // se cover è diverso da null
            if($project->cover){
                // cancello cover precedente
                Storage::delete($project->cover);
                $project->cover = null;
            }

            $img_path = Storage::put('uploads', $data['cover']);
            $data['cover'] = $img_path;
        }
        else if (isset($data['delete-cover'])){
            if($project->cover){
                Storage::delete($project->cover);
                $project->cover = null;
            }
        }

        $project->update($data);

        // sincronizzo id delle tecnologie con i progetti
        $project->technologies()->sync($data['technologies'] ?? []);

        return redirect()->route('admin.projects.show', ['project' => $project->id]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        // se cover è diverso da null
        if($project->cover){
            // cancello cover precedente
            Storage::delete($project->cover);
        }

        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
