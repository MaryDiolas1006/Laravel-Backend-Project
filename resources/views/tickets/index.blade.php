@extends('layouts.app')
@section('content')
    <div class="container-fluid tickets-container">
        <div class="row justify-content-center">
            <div class="col-12 ">
                <h1 class="text-center">
                    All Requests
                </h1>
            </div>
            @if(count($tickets) === 0)
                <div class="col-8 mt-4 mx-auto">
                    @include('partials.no-entry-alert', [
                        'title' => 'tickets'
                    ])
                </div>
            @endif
        </div>

        {{-- alert message --}}
        @includeWhen(Session::has('message'), 'partials.alert')

        {{-- requests section start --}}
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-3 pl-5">
                <button  id="studentBtn" class="btn btn-md color-All btn-block" type="button" data-toggle="collapse" data-target="#allTickets" aria-expanded="true" aria-controls="allTickets">All</button>
                <button id="student-view" class="btn btn-md  btn-block" type="button" data-toggle="collapse" data-target="#pendingTickets" aria-expanded="false" aria-controls="pendingTickets">Pending</button>
                <button id="studentBadge"  class="btn btn-md color-Approved btn-block" type="button" data-toggle="collapse" data-target="#approvedTickets" aria-expanded="false" aria-controls="approvedTickets">Approved</button>
                <button class="btn btn-md btn-danger btn-block" type="button" data-toggle="collapse" data-target="#declinedTickets" aria-expanded="false" aria-controls="declinedTickets">Declined</button>
                <button class="btn btn-md btn-secondary btn-block" type="button" data-toggle="collapse" data-target="#completedTickets" aria-expanded="false" aria-controls="completedTickets">Completed</button>
            </div>
            <div class="col-md-8 mt-4 mt-lg-0 col-lg-9">
                <div id="accordion">
                    @include('tickets.partials.tickets-all')
                    @include('tickets.partials.tickets-pending')
                    @include('tickets.partials.tickets-approved')
                    @include('tickets.partials.tickets-declined')
                    @include('tickets.partials.tickets-completed')
                </div>
            </div>
        </div>
        {{-- requests section end --}}
    </div>
@endsection
