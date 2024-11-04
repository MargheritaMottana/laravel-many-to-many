@extends('layouts.app')

@section('page-title', $type->title)

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class=" text-success">
                        {{ $type->title }}
                    </h1>

                    <h6>
                        {{-- modificato il formato della data --}}
                        Created at {{ $type->created_at->format('d/m/Y - H:i')}}
                    </h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-body">
                    <ul>
                        <li>
                            ID: {{ $type->id }}
                        </li>

                        <li>
                            Slug: {{ $type->slug }}
                        </li>

                        {{-- aggunta sezione per vedere quali progetti sono collegati al type --}}
                        <li>
                            Linked Projects:

                            {{-- se ci sono post collegati --}}
                            @if ($type->projects()->count() > 0)
                                <ul>
                                    @foreach ($type->projects as $project)
                                        <li>
                                            <a href="{{ route('admin.projects.show', ['project'=> $project->id] ) }}">
                                                {{ $project->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                            {{-- altrimenti --}}
                            @else
                                None
                            @endif
                        </li>
                    </ul>

                    {{-- rotta alla index per vedere tutta la lista di type --}}
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('admin.types.index') }}">
                        ▤
                    </a>

                    {{-- rotta alla view per modificare il progetto, specificando il parametro del singolo progetto --}}
                    <a class="btn btn-outline-warning btn-sm" href="{{ route('admin.types.edit', ['type' => $type->id]) }}">
                        ໒(•ᴗ•)७✎
                    </a>

                    {{-- form con rotta a destroy() + parametro, per eliminare il progetto --}}
                    <form action="{{ route('admin.types.destroy', ['type'=> $type->id] ) }}" method="POST" class="d-inline-block"
                        onsubmit="return confirm('Are u sure u want to delete this type? ໒(x‸x)७')"    
                    >
                        @csrf
                        @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">
                                ໒(x‸x)७
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
