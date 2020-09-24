@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-10 col-lg-9 col-md-8 mx-auto p-4">
                {{-- header --}}
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center">
                            Units
                        </h1>
                    </div>
                    @if(count($units) === 0)
                        <div class="col-8 mt-4 mx-auto">
                            @include('partials.no-entry-alert', [
                                'title' => 'units'
                            ])
                        </div>
                    @endif
                </div>
                {{-- end header --}}

                {{-- alert message --}}
                @includeWhen(Session::has('message'), 'partials.alert')

                {{-- unit list --}}
                <div class="row mt-5">
                    <div class="col-12 mx-auto">
                        <div class="row">
                            @foreach($units as $unit)
                            <div class="col-12 col-sm-6 col-md-4 mb-3">
                                {{-- unit card --}}
                                <div id="card" class="card">
                                    <img src="{{ asset('images/units/' . $unit->image) }}" alt="" class="card-img-top">
                                    <div class="card-body">
                                        <h4 class="card-title text-center">
                                            {{ $unit->control_code }}
                                        </h4>
                                        <h5>Category:
                                            <span class="badge badge-warning ">{{$unit->subject->category->name}}</span>
                                        </h5>
                                        <h5>Subject:
                                            <span class="badge">{{$unit->subject->name}}</span>
                                        </h5>
                                        <h6 class="card-text mb-0">
                                            Status:	<span
                                                    class="badge-{{$unit->status_id === 1 ? "success" : ($unit->status_id === 2 ? "danger" : "")}}
                                                       {{--  @if($unit->status_id === 1)
                                                            color-Available
                                                        @elseif($unit->status_id === 2)
                                                            color-NotAvailable --}}
                                                        {{-- @endif --}}
                                                    ">{{ $unit->unit_status->name }}</span>
                                        </h6>
                                    </div>
                                    <div class="card-footer bg-info">
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
                        </div>
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

@if(Session::has('show'))
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ secure_asset('js/toast.js') }}"></script>
@endif
@endsection
