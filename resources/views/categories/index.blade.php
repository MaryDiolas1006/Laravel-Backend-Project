@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-10 col-lg-9 col-md-8 mx-auto p-4">
            {{-- header --}}
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="text-center lead display-4">
                        Categories
                    </h1>
                </div>
                @if(count($categories) === 0)
                    <div class="col-8 mt-4 mx-auto">
                        @include('partials.no-entry-alert', [
                            'title' => 'models'
                        ])
                    </div>
                @endif
            </div>
            {{-- end header --}}

            {{-- alert message --}}
            @includeWhen(Session::has('message'), 'partials.alert')



            {{-- category list --}}
            <div class="row mt-5">

                @foreach($categories as $category)
                {{-- card --}}
                <div class="col-12 col-sm-6 col-md-4">
                    @include('categories.partials.card')
                </div>
                {{-- end card --}}
                @endforeach


            </div>
            {{-- end category list --}}
        </div>
    </div>
</div>
@endsection

