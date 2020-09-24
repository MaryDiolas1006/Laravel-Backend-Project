<div class="collapse" id="declinedTickets" data-parent="#accordion">
    <div class="accordion" id="accordionDeclined">

    {{-- tickets card start --}}
    @foreach($tickets as $ticket)
        @if($ticket->status_id === 3)
            @include('tickets.partials.card',[
                'status_name' => $ticket->ticket_status->name
            ])
        @endif
    @endforeach
    {{-- tickets card start --}}
    </div>
 </div>
