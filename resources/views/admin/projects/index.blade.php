@extends('layouts.app')

@section('page-title', 'Projects')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Projects
                    </h1>
                </div>
            </div>
        </div>
    </div>
    {{-- bottone per creare un nuovo progetto --}}
    <div class="row mb-4">
        <div class="col text-center">
            <a class="btn btn-success" href="{{ route('admin.projects.create')}}">
                Create a new Project +
            </a>
        </div>
    </div>

    {{-- tabella per visualizzare tutti i progetti --}}
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>

                            {{-- aggiunta sezione type in seguito ad aver stabilito la relazione tra project e type --}}
                            <th scope="col" class="text-center">Type</th>

                            <th scope="col">Client</th>
                            <th scope="col">Sector</th>
                            <th scope="col" class="text-center">Published</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($projects as $project)
                                <tr>
                                    <th scope="row">{{ $project->id }}</th>
                                    <td>{{ $project->title }}</td>

                                    {{-- aggiunta sezione type --}}
                                    <td class="text-center">
                                        {{-- se esiste il type associato al progetto --}}
                                        @if (isset($project->type))
                                            {{-- mostrami l'id e il suo titolo --}}
                                            <a href="{{ route('admin.types.show', ['type' => $project->type_id] ) }}">
                                                {{ $project->type_id}} - {{$project->type->title}}
                                            </a>
                                        @else
                                            {{-- altrimenti mostrami un trattino --}}
                                            -
                                        @endif
                                    </td>

                                    <td>{{ $project->client }}</td>
                                    <td>{{ $project->sector }}</td>
                                    {{-- se il progetto è pubblicato 'Yes', altrimenti 'No' --}}
                                    <td class="text-center">{{ $project->published ? 'Yes' : 'No' }}</td>
                                    <td>
                                        {{-- rotta alla view per vedere il progetto, specificando il parametro del singolo progetto --}}
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('admin.projects.show', ['project' => $project->id]) }}">
                                            ໒(⊙ᴗ⊙)७
                                        </a>

                                        {{-- rotta alla view per modificare il progetto, specificando il parametro del singolo progetto --}}
                                        <a class="btn btn-outline-warning btn-sm" href="{{ route('admin.projects.edit', ['project' => $project->id]) }}">
                                            ໒(•ᴗ•)७✎
                                        </a>

                                        {{-- form con rotta a destroy() + parametro, per eliminare il progetto --}}
                                        <form action="{{ route('admin.projects.destroy', ['project'=> $project->id] ) }}" method="POST" class="d-inline-block"
                                            onsubmit="return confirm('Are u sure u want to delete this project? ໒(x‸x)७')"    
                                        >
                                            @csrf
                                            @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm">
                                                    ໒(x‸x)७
                                                </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
@endsection
