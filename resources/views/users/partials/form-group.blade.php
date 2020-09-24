<div class="form-group">
	<label for="{{ $name }}">{{$title}}</label>
	<input type="{{$type}}" name="{{ $name }}" id="{{ $name }}" class="
        @error($name) is-invalid @enderror
        @foreach($classes as $class)
			{{ $class }}
		@endforeach
	"
		autofocus
		value="{{ isset($value) ? $value : ''}}"
    >

    @error($name)
	<small class="d-block invalid-feedback">
		<strong>
			{{ $message }}
		</strong>
	</small>
	@enderror
</div>
