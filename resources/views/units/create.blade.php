@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1 class="text-center">
					Add Unit
				</h1>
			</div>
		</div>

		{{-- unit section --}}
		<div class="row">
			<div class="col-12 col-md-10 col-lg-6 mx-auto">
				{{-- add unit form --}}
				<form
					action="{{ route('units.store') }}"
					method="post"
					enctype="multipart/form-data"
				>
					@csrf

					{{-- name --}}
					@include('units.partials.form-group',[
						'name' => 'control_code',
						'type' => 'text',
						'classes' => ['form-control', 'form-control-sm']
					])

					{{-- price --}}
					@include('units.partials.form-group',[
						'name' => 'subject_id',
						'type' => 'number',
						'classes' => ['form-control', 'form-control-sm']
					])

					<button class="btn btn-sm btn-primary mt-3">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
							<path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
						</svg>
					Add Unit</button>

				</form>
				{{-- add unit form end --}}
			</div>
		</div>
		{{-- add unit section end --}}
	</div>
@endsection
