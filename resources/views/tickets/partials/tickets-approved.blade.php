<div class="collapse" id="approvedTickets" data-parent="#accordion">
    <div class="accordion" id="accordionApproved">

    {{-- tickets card start --}}
    @foreach($tickets as $ticket)
        @if($ticket->status_id === 2)
            @include('tickets.partials.card',[
                'status_name' => $ticket->ticket_status->name
            ])
        @endif
    @endforeach
    {{-- tickets card start --}}
    </div>
 </div>
