@extends('layouts.app')

@section('page-title', 'Technologies')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Technologies
                    </h1>
                </div>
            </div>
        </div>
    </div>
    {{-- bottone per creare un nuovo technology --}}
    <div class="row mb-4">
        <div class="col text-center">
            <a class="btn btn-success" href="{{ route('admin.technologies.create')}}">
                Create a new Technology +
            </a>
        </div>
    </div>

    {{-- tabella per visualizzare tutti le technology --}}
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Linked Projects</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($technologies as $technology)
                                <tr>
                                    <th scope="row">{{ $technology->id }}</th>
                                    <td>{{ $technology->title }}</td>

                                    {{-- aggiunta colonna per linkare ai progetti che hanno delle technology --}}
                                    <td>
                                        {{-- conteggio di quanti progetti sono collegati alle technology --}}
                                        {{ count($technology->projects) }}
                                    </td>

                                    <td>
                                        {{-- rotta alla view per vedere la technology, specificando il parametro della singola technology --}}
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('admin.technologies.show', ['technology' => $technology->id]) }}">
                                            ໒(⊙ᴗ⊙)७
                                        </a>

                                        {{-- rotta alla view per modificare il technology, specificando il parametro della singola technology --}}
                                        <a class="btn btn-outline-warning btn-sm" href="{{ route('admin.technologies.edit', ['technology' => $technology->id]) }}">
                                            ໒(•ᴗ•)७✎
                                        </a>

                                        {{-- form con rotta a destroy() + parametro, per eliminare la technology --}}
                                        <form action="{{ route('admin.technologies.destroy', ['technology'=> $technology->id] ) }}" method="POST" class="d-inline-block"
                                            onsubmit="return confirm('Are u sure u want to delete this technology? ໒(x‸x)७')"    
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
