<?php

namespace App\Http\Controllers\Admin;

// model
use App\Models\Type;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::get();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
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

        $type = Type::create($data);

        return redirect()->route('admin.types.show', ['type' => $type->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        // richiedo tutti i dati con validazione backend
        $data = $request->validate([
            'title'=> 'required|min:3|max:64',
        ]);
        
        // aggiunto lo slug perché non l'ho messo nel form
        $data['slug'] = str()->slug($data['title']);

        $type->update($data);

        return redirect()->route('admin.types.show', ['type' => $type->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index');
    }
}
