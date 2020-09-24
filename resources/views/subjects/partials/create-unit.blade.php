<div class="row">
    <div class="col-12">
        <h4 class="text-center lead">
            Add {{$subject->name}} Unit
        </h4>
    </div>
</div>

{{-- unit section --}}
<div class="row">
    <div class="col-12">
        {{-- add unit form --}}
        <form action="{{ route('units.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- control code--}}
            <div class="form-group">
                <label for="control_code">Unit Code</label>
                <div class="input-group mb-3">
                    {{-- <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-control-code">{{$item->id}}-</span>
                    </div> --}}
                    <input type="text" name="control_code" id="control_code"
                        class="
                            form-control
                            @error('control_code')
									is-invalid
							@enderror
                        "
                        placeholder="Code" aria-label="Control-Code"
                        aria-describedby="basic-control-code" required
                    >
                    @error('control_code')
                        <small class="d-block invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>


            {{-- item model --}}
            <div class="form-group">
                <label for="category">Unit Subject</label>
                <select id="category" name="category" class="form-control" disabled>
                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                </select>
                <input type="hidden" name="subject_id" id="subject_id" value="{{$subject->id}}">
            </div>

            <button class="btn btn-block btn-primary my-3">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
              </svg>
             Add {{$subject->name}} Unit</button>

        </form>
        {{-- add unit form end --}}
    </div>
</div>
{{-- add unit section end --}}
