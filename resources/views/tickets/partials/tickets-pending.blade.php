<div class="collapse" id="pendingTickets" data-parent="#accordion">
    <div class="accordion" id="accordionPending">

    {{-- tickets card start --}}
    @foreach($tickets as $ticket)
        @if($ticket->status_id === 1)
            @include('tickets.partials.card',[
                'status_name' => $ticket->ticket_status->name
            ])
        @endif
    @endforeach
    {{-- tickets card start --}}
    </div>
 </div>
