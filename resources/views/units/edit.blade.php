@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-10 col-lg-9 col-md-8 ml-auto p-4">
            {{-- header --}}
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">
                        Edit {{$unit->control_code}} Unit
                    </h1>
                </div>
            </div>
            {{-- end header --}}

            {{-- unit list --}}
            <div class="row mt-5">
                <div class="col-8 col-sm-6 mx-auto">
                    <form action="{{ route('units.update', $unit->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- control code --}}
                        <div class="form-group">
                            <label for="control_code">Code</label>
                            <input type="text" name="control_code_show" id="control_code_show"
                                class="form-control form-control-sm" value="{{$unit->control_code}}">
                            {{-- <input type="hidden" name="control_code" id="control_code" value="{{$unit->control_code}}"> --}}
                        </div>

                        {{-- item model --}}
                        <div class="form-group">
                            <label for="category">Subject Category</label>
                            <select id="category" name="category" class="form-control" disabled>
                                <option value="{{$unit->subject_id}}">{{$unit->subject->name}}</option>
                            </select>
                            <input type="hidden" name="subject_id" id="subject_id" value="{{$unit->subject_id}}">
                        </div>

                        {{-- image --}}
                        {{-- @include('units.partials.form-group',[
                        'title' => 'Image',
						'name' => 'image',
						'type' => 'file',
						'classes' => ['form-control-file', 'form-control-sm']
                    ]) --}}

                        <label for="status_id">Status</label>
                        <select name="status_id" id="status_id" class="form-control form-control-sm">
                            @foreach($statuses as $status)
                            <option value="{{$status->id}}" {{ $status->id === $unit->status_id ? "selected" : ""}}>
                                {{$status->name}}
                            </option>
                            @endforeach
                        </select>
                        @error('status_id')
                        <small class="d-block invalid-feedback">
                            <strong>
                                {{ $message }}
                            </strong>
                        </small>
                        @enderror

                        <button class="btn btn-md btn-warning my-2">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pen" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                          </svg>
                        Edit Unit</button>

                    </form>
                </div>
            </div>
            {{-- end unit list --}}
        </div>
    </div>
    <div style="position: absolute; top: 4rem; right: 1rem;">
        <!-- Then put toasts within -->
        @include('subjects.partials.toast')
    </div>
</div>
@endsection
