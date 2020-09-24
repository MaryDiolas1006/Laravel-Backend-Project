@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-10 col-lg-9 col-md-8 ml-auto p-4">
            {{-- header --}}
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="text-center lead display-4">
                        Create Category
                    </h1>
                </div>
            </div>
            {{-- end header --}}

            {{-- Create model--}}
            <div class="row mt-5">
                <div class="col-12 col-md-6 mx-auto">
                    {{-- form --}}
                    <form action="{{ route('categories.store') }}" method="post">
                        @csrf
                        <label for="name">Category name:</label>
                        <input type="text" name="name" id="name"
                            class="
                                form-control
                                form-control-sm
                                @error('name')
									is-invalid
								@enderror
                            "
                        required>
                        @error('name')
                            <small class="d-block invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                        <button id="createBtn" class="btn btn-md w-25 btn-primary mt-2">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                              <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                          </svg>
                            Add Category
                        </button>
                    </form>
                    {{-- end form --}}
                </div>

            </div>
            {{-- end Create model --}}
        </div>
    </div>
</div>
@endsection
