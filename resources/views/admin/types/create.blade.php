@extends('layouts.app')

@section('page-title', 'Create a Type')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Create a Type
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

                    <form action="{{ route('admin.types.store')}}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                Title <span class="text-danger">*</span>
                            </label>
                            <input value="{{ old('title') }}" type="text" minlength="3" maxlength="64" required id="title" name="title" placeholder="Write the title..." class="form-control">
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
