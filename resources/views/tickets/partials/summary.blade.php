{{-- table start --}}
<div class="table-responsive">
	<table class="table table-hover table-striped">
		{{-- ticket code --}}
		<tr>
			<td>Request Code</td>
			<td><a href="{{route('tickets.show', $ticket->id)}}"><i class="fas fa-tag"></i> {{$ticket->ticket_code}} </a></td>
		</tr>
		{{-- ticket code end --}}

        <tr>
            <td>Username</td>
            <td>{{$ticket->user->name}}</td>
        </tr>
		{{-- Status start --}}
		<tr>
			<td>Status</td>
			<td>
                {{ $ticket->ticket_status->name }}
                @can('isAdmin')
                    @include('tickets.partials.edit-status')
                @endcan
			</td>
		</tr>
        {{-- Status end --}}

        {{-- Date Requested --}}
		<tr>
			<td>Date Requested</td>
			<td>{{$ticket->created_at}}</td>
		</tr>
        {{-- Date Requested end --}}

        {{-- Date Needed --}}
		<tr>
			<td>Date Needed</td>
			<td>{{$ticket->date_needed}}</td>
		</tr>
        {{-- Date Needed end --}}

         {{-- Date to return --}}
		<tr>
			<td>Date to return</td>
			<td>{{$ticket->date_returned}}</td>
		</tr>
		{{-- Date to return end --}}

	</table>
</div>
{{-- table end --}}
