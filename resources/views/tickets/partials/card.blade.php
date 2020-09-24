<div class="card">
        <div class="card-header">
        <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$ticket->id}}" aria-expanded="true" aria-controls="collapseOne">
                {{$ticket->ticket_code}}
            <span class="badge
                @if($ticket->status_id === 1)
                badge-success text-dark
                @elseif($ticket->status_id === 2)
                badge-info
                @elseif($ticket->status_id === 3)
                badge-danger text-dark
                @elseif($ticket->status_id === 4)
                badge-secondary text-dark
                @endif
             ">
                {{-- color-{{$ticket->ticket_status->name}} --}}
                {{$ticket->ticket_status->name}}
            </span>
            </button>
        </h2>
        </div>

        <div id="collapse{{$ticket->id}}" class="collapse" data-parent="#accordion{{$status_name}}">
        <div class="card-body">

            @include('tickets.partials.units-table')
            @include('tickets.partials.summary')
        {{-- <a href="{{route('tickets.show', $ticket->id)}}">View details</a> --}}
                @can('isAdmin')
                <form action="{{route('tickets.destroy', $ticket->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                          <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                      </svg>
                    Delete Request</button>
                </form>
            @endcan
        </div>
        </div>
    </div>
