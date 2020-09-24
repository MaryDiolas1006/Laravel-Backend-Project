<div class="row">
	<div class="col-12">
		{{-- table start --}}
		<div class="table-responsive">
			<table class="table table-info table-striped table-hover">
				<thead>
					<tr>
                        <th>Category</th>
                        <th>Subject</th>
						<th>Requested Unit</th>
					</tr>
				</thead>
				<tbody>
					@foreach($ticket->units as $unit)
						{{-- product row start --}}
						<tr>
							<td>{{$unit->subject->category->name}}</td>
							<td>{{$unit->subject->name}}</td>
							<td>{{$unit->control_code}}</td>
						</tr>
						{{-- product row end --}}
					@endforeach
				</tbody>
			</table>
		</div>
		{{-- table end --}}
	</div>
</div>
