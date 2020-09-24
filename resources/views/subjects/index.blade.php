@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-10 col-lg-9 col-md-8 mx-auto p-4">
                {{-- header --}}
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="text-center lead display-4">
                            Subjects
                        </h1>
                       
                    </div>
                    @if(count($subjects) === 0)
                        <div class="col-8 mt-4 mx-auto">
                            @include('partials.no-entry-alert', [
                                'title' => 'items'
                            ])
                        </div>
                    @endif
                </div>
                {{-- end header --}}

                {{-- alert message --}}
                @includeWhen(Session::has('message'), 'partials.alert')

                {{-- category list --}}
                <div class="row mt-5">

                    @foreach($subjects as $subject)
                    {{-- card --}}
                    <div class="col-12 col-sm-6 col-md-4">
                        @include('subjects.partials.card')
                    </div>
                    {{-- end card --}}
                    @endforeach


                </div>
                {{-- end category list --}}
            </div>
        </div>
	</div>
@endsection
