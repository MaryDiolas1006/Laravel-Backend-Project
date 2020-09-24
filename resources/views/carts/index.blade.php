@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-10 col-lg-9 col-md-8 mx-auto p-4">
            {{-- header --}}
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="text-center lead display-4">
                        Request Form
                    </h1>
                </div>
            </div>
            {{-- end header --}}

            {{-- alert message --}}
            @includeWhen(Session::has('message'), 'partials.alert')

            {{-- request basket list --}}
            <div class="row mt-5 justify-content-center">

                @if(!Session::has('cart'))
                {{-- alert start --}}
                <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Your request is empty!</strong>
                </div>
                {{-- alert end --}}
                @else
                {{-- start of request row --}}

                    <div class="col-12 col-lg-10">
                        {{-- start request table --}}

                        <table class="table bg-info table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Subject</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- start item row --}}
                                @foreach($units as $unit)
                                <tr>
                                    <td>{{$unit->subject->category->name}}</td>
                                    <td>{{$unit->subject->name}}</td>
                                    <td>{{$unit->control_code}}</td>
                                    <td>
                                        <h5>
                                            <span class="badge
                                                @if($unit->status_id === 1)
                                                    badge-success
                                                @elseif($unit->status_id === 2)
                                                    badge-danger
                                                @endif
                                            ">{{$unit->unit_status->name}}
                                            </span>
                                        </h5>
                                    </td>
                                    <td>
                                        <form action="{{route('cart.destroy', $unit->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                              </svg>
                                            Remove</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                {{-- end item row --}}
                            </tbody>
                        </table>

                        {{-- end request table --}}
                    </div>

                    {{-- start of dates --}}
                    <div class="col-12 col-sm-8 mx-auto text-center">
                        <form action="{{route('tickets.store')}}" method="POST" class="mb-5">
                            @csrf
                            <div class="row align-items-center">
                                <div class="col align-self-start text-left">
                                    <div class="form-group">
                                        <label for="date_needed">Date needed</label>
                                        <input required="" type="date" name="date_needed" id="date_needed"
                                            class="form-control date">
                                    </div>
                                    @error('date_needed')
                                        <small class="d-block invalid-feedback">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </small>
                                    @enderror
                                </div>
                                <div class="col align-self-start text-left">
                                    <div class="form-group">
                                        <label for="date_returned">Date to return</label>
                                        <input required="" type="date" name="date_returned" id="date_returned"
                                            class="form-control date">
                                    </div>
                                    @error('date_returned')
                                        <small class="d-block invalid-feedback">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" value="{{count($units ?? '')}}" name="countUnits" id="countUnits">
                            <button class="btn btn-primary btn-md">Submit</button>

                        </form>
                    </div>
                    {{-- end of dates --}}
                    {{-- clear cart --}}
                    <div class="col-12">
                        <form action="{{ route('cart.clear')}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-md btn-danger">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                              </svg>
                            Clear request</button>
                        </form>
                    </div>


                {{-- end of request row --}}
                @endif


            </div>
            {{-- end request basket list --}}
        </div>
    </div>
</div>

@if(Route::CurrentRouteNamed('cart.index'))
<script type="text/javascript" src="{{ secure_asset('js/date.js') }}"></script>
@endif
@endsection
