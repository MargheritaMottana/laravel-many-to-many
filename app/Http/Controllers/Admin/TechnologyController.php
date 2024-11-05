<?php

namespace App\Http\Controllers\Admin;

// model
use App\Models\Technology;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::get();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // richiedo tutti i dati con validazione backend
        $data = $request->validate([
            'title'=> 'required|min:3|max:64',
        ]);
        
        // aggiunto lo slug perché non l'ho messo nel form
        $data['slug'] = str()->slug($data['title']);

        $technology = Technology::create($data);

        return redirect()->route('admin.technologies.show', ['technology' => $technology->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        // richiedo tutti i dati con validazione backend
        $data = $request->validate([
            'title'=> 'required|min:3|max:64',
        ]);
        
        // aggiunto lo slug perché non l'ho messo nel form
        $data['slug'] = str()->slug($data['title']);

        $technology->update($data);

        return redirect()->route('admin.technologies.show', ['technology' => $technology->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect()->route('admin.technologies.index');
    }
}