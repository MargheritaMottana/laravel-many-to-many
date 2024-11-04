@extends('layouts.app')

@section('page-title', 'Create a Project')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Create a Project
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

                    <form action="{{ route('admin.projects.store')}}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                Title <span class="text-danger">*</span>
                            </label>
                            <input value="{{ old('title') }}" type="text" minlength="3" maxlength="64" required id="title" name="title" placeholder="Write the title..." class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">
                                Description <span class="text-danger">*</span>
                            </label>
                            <textarea required minlength="20" maxlength="4096" id="description" name="description" rows="3" placeholder="Write the description..." class="form-control">{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="cover" class="form-label">
                                Cover
                            </label>
                            <input value="{{ old('cover') }}" type="text" minlength="5" maxlength="2048" id="cover" name="cover" placeholder="Insert the link of the image..." class="form-control">
                        </div>

                        <div class="row mb-4">

                            <div class="col">
                                <label for="client" class="form-label">
                                    Client
                                </label>
                                <input value="{{ old('client') }}" type="text" minlength="3" maxlength="64" id="client" name="client" placeholder="Write the Client's name..." class="form-control">
                            </div>
    
                            <div class="col">
                                <label for="sector" class="form-label">
                                    Sector
                                </label>
                                <input value="{{ old('sector') }}" type="text" minlength="3" maxlength="64" id="sector" name="sector" placeholder="Write the sector of the project..." class="form-control">
                            </div>

                            {{-- aggiunta selsct per aggiungere il type --}}
                            <div class="col-2">
                                <label for="type_id" class="form-label">
                                    Type
                                </label>
                                <select id="type_id" name="type_id" class="form-select">
                                    <option 

                                        @if (old('type_id') == null)
                                            selected
                                        @endif

                                        value="" selected disabled> Select a Type </option>

                                    @foreach ($types as $type)
                                        <option 

                                            @if (old('type_id') == $type->id)
                                                selected
                                            @endif

                                            value="{{ $type->id }}"> {{ $type->title }} </option>
                                    @endforeach

                                </select>
                            </div>

                        </div>

                        <div class="form-check mb-5">
                            <input class="form-check-input" type="checkbox" value="1" id="published" name="published"
                                {{-- se la vecchia versione di published era selezionata, allora selezionala --}}
                                @if (old('published')!== null)
                                    checked
                                @endif
                            >
                            <label class="form-check-label" for="published">
                                Published
                            </label>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-outline-success">
                                Submit
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
