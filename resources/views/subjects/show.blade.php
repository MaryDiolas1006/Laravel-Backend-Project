@extends('layouts.app')

@section('content')
<div class="container" aria-live="polite" aria-atomic="true">
    {{-- alert message --}}
    @includeWhen(Session::has('message'), 'partials.alert')
    {{-- end of alert message --}}

    <div class="row">
        {{-- item details and create item unit --}}
        <div class="col-12 col-md-4 col-lg-3 mx-auto mb-5 bg-info">
            <img src="{{ secure_asset('images/subjects/' . $subject->image) }}" alt="" class="img-fluid">
            <div class="bottom-border pb-3">
                <h1>{{$subject->name}}</h1>
                <h4>Category: 
                    <span class="badge badge-warning">{{$subject->category->name}}</span></h4>
                <p class="lead mb-2">Stocks Available: {{$subject->available_stocks}} / {{$subject->total_stocks}}</p>
            </div>
            @can('isAdmin')
            @include('subjects.partials.create-unit')
            @endcan
                @can('isAdmin')
                <a href="{{route('subjects.edit', $subject->id)}}" class=" btn btn-sm btn-warning mb-4">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pen" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                  </svg>
                    Edit {{$subject->name}}</a>
                <form action="{{ route('subjects.destroy', $subject->id) }}" method="post" class="d-inline-block w-auto mt-0 mt-md-1">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-sm btn-danger mb-4">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                          <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                      </svg>
                     Delete {{$subject->name}}</button>
                </form>
                @endcan
        </div>

        {{-- end of item details and create item unit --}}
        <div class="col-12 col-md-6 col-lg-9">
            <div class="row">
                {{-- no units alert --}}
                @if(count($units) === 0)
                <div class="col-8 mt-4 mx-auto">
                    @include('partials.no-entry-alert', [
                    'title' => 'units'
                    ])
                </div>
                @endif
                {{-- end no units alert --}}

                {{-- units section --}}
                @foreach($units as $unit)
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 mb-2">
                    {{-- unit card --}}
                    <div class="card">

                        {{-- <img src="{{ url($unit->image) }}" alt="" class="card-img-top"> --}}
                        {{-- <img src="{{ asset('images/units/' . $unit->image) }}" alt="" class="card-img-top"> --}}
                        <div class="card-body bg-info">
                            <h4 class="card-title">
                                {{ $unit->control_code }}
                            </h4>
                            <h5>Category:
                                <span class="badge badge-warning ">{{$unit->subject->category->name}}</span>
                            </h5>
                            <h5>Subject:
                                <span class="badge color-Item ">{{$unit->subject->name}}</span>
                            </h5>
                            <h5 class="card-text mb-0">
                                Status: <span class="badge
                                                @if($unit->status_id === 1)
                                                    badge-success
                                                @elseif($unit->status_id === 2)
                                                    badge-danger                                               
                                                @endif
                                            ">{{ $unit->unit_status->name }}</span>
                            </h5>
                        </div>
                        <div class="card-footer bg-info text-white">
                            @if($unit->status_id === 1)
                                @include('units.partials.request-btn')
                            @endif
                            @can('isAdmin')
                            @include('units.partials.edit-btn')
                            @include('units.partials.delete-form')
                            @endcan
                        </div>
                    </div>
                    {{-- unit card end --}}
                </div>
                @endforeach
                {{-- units section end --}}
            </div>
        </div>
    </div>
    {{-- toast --}}
    <div style="position: absolute; top: 4rem; right: 1rem;">
        <!-- Then put toasts within -->
        @include('subjects.partials.toast')
    </div>

    {{--  end of toast --}}
</div>

@if(Session::has('show'))
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ secure_asset('js/toast.js') }}"></script>
@endif
@endsection
