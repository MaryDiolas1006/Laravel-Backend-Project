@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-10 col-lg-9 col-md-8 mx-auto p-4">
            {{-- header --}}
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="text-center lead display-4">
                        Create Subjects
                    </h1>
                </div>
            </div>
            {{-- end header --}}

            {{-- Create item --}}
            <div class="row mt-5">
                <div class="col-12 col-md-6 mx-auto">
                    {{-- form --}}
                    <form action="{{ route('subjects.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="name">Subject name:</label>
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

                        <p class="my-3"></p>

                        {{-- item_model_id --}}
                        <label for="category_id">Subject category:</label>
                        <select name="category_id" id="category_id" class="form-control form-control-sm mt">
                            @foreach($categories as $category)
                                <option value="{{ $category->id}}">{{ $category->name}}</option>
                            @endforeach
                        </select>

                        <p class="my-3"></p>

                        {{-- image --}}
                        @include('subjects.partials.form-group',[
                            'name' => 'image',
                            'type' => 'file',
                            'classes' => ['form-control-file', 'form-control-sm']
                        ])

                        <button class="btn btn-md btn-primary mt-2">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                              <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                          </svg>
                            Create subject
                        </button>
                    </form>
                    {{-- end form --}}
                </div>

            </div>
            {{-- end Create item --}}
        </div>
    </div>
</div>
@endsection
