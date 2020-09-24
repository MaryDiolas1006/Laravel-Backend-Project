<form action="{{route('tickets.update', $ticket->id)}}" method="post" class=" border p-3">
	@csrf
	@method("PUT")
	<label for="status_id">Edit:</label>
	<select name="status_id" id="status_id" class="form-control form-control-sm">
        @foreach($statuses as $status)
        <option value="{{$status->id}}">{{$status->name}}</option>
        @endforeach
	</select>
	<button class="btn btn-sm btn-outline-primary my-1">
		<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pen" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
		</svg>
	Edit Status</button>
</form>
