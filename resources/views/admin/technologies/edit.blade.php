@extends('layouts.app')

@section('page-title', 'Edit '.$technology->title)

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Edit {{$technology->title}}
                    </h1>
                </div>
            </div>
        </div>
    </div>

    {{-- aggiunti errori --}}
    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                 {{-- ciclo per vigualizzare tutti gli errori --}}
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('admin.technologies.update', ['technology' => $technology->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                Title <span class="text-danger">*</span>
                            </label>
                            <input value="{{ old('title', $technology->title) }}" type="text" minlength="3" maxlength="64" required id="title" name="title" placeholder="Write the title..." class="form-control">
                        </div>

                        <div class="d-flex justify-content-start">

                            <div class="me-3">
                                <button type="submit" class="btn btn-outline-warning">
                                    Submit
                                </button>
                            </div>
    
                            {{-- "bottone per annullare le modifiche" --}}
                            <div class="me-3">
                                <a href="{{ route('admin.technologies.show', ['technology' => $technology->id])}}" type="submit" class="btn btn-outline-success">
                                    Cancel
                                </a>
                            </div>

                            {{-- rotta alla index per vedere tutta la lista delle technologies --}}
                            <a class="btn btn-outline-primary" href="{{ route('admin.technologies.index') }}">
                                ▤
                            </a>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
