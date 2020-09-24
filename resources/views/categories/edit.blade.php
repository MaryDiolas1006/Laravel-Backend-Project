@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-10 col-lg-9 col-md-8 ml-auto p-4">
            {{-- header --}}
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="text-center lead display-4">
                        Edit {{$category->name}} Category
                    </h1>
                </div>
            </div>
            {{-- end header --}}

            {{-- edit item --}}
            <div class="row mt-5">
                <div class="col-12 col-md-6 mx-auto">
                    {{-- form --}}
                    <form action="{{ route('categories.update', $category->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <label for="name">Category name:</label>
                        <input type="text" name="name" id="name" class="form-control
								form-control-sm
								@error('name')
									is-invalid
								@enderror
                                " value="{{ $category->name }}" autofocus autocomplete="name" required>
                        @error('name')
                            <small class="d-block invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                        <button id="edit_level" class="btn btn-md btn-warning mt-2">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pen" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                          </svg>
                        Edit</button>
                    </form>
                    {{-- end form --}}
                </div>

            </div>
            {{-- end edit item --}}
        </div>
    </div>
</div>
@endsection
