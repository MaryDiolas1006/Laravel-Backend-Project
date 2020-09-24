<div class="collapse show" id="allTickets" data-parent="#accordion">
    <div class="accordion" id="accordionAll">

    {{-- tickets card start --}}
    @foreach($tickets as $ticket)
        @include('tickets.partials.card', [
            'status_name' => 'All'
        ])
    @endforeach
    {{-- tickets card start --}}
    </div>
 </div>
