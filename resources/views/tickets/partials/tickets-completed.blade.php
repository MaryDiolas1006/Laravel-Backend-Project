<div class="collapse" id="completedTickets" data-parent="#accordion">
    <div class="accordion" id="accordionCompleted">

    {{-- tickets card start --}}
    @foreach($tickets as $ticket)
        @if($ticket->status_id === 4)
            @include('tickets.partials.card',[
                'status_name' => $ticket->ticket_status->name
            ])
        @endif
    @endforeach
    {{-- tickets card start --}}
    </div>
 </div>
