<div class="card">
	<div class="card-header">
		@if ($count === 1)
			<h4>Best Pilot of {{ ucfirst($rperiod) }} By {{ ucfirst($type) }}</h4>
		@else
			<h4>Top {{ $count }} Pilots of {{ ucfirst($rperiod) }} By {{ ucfirst($type) }}</h4>
		@endif
	</div>
	<div class="card-body">
	@if(count($tpilots) > 0)	
		<table class="table table-hover table-striped text-center">
		@if($count > 1)
			<tr>
				<th class="text-left">Name</th>
				<th>{{ ucfirst($type) }}</th>
			</tr>
		@endif
		@foreach($tpilots as $tp)			
			<tr>
				<td class="text-left"><a href="{{ route('frontend.users.show.public', [$tp->user_id]) }}">{{ $tp->user->name_private }}</a></td>
			@if($type == 'time')
				<td> @minutestotime($tp->totals) </td>
			@elseif($type == 'distance')
				<td> @if (setting('units.distance') === 'km') {{ number_format($tp->totals * 1.852) }} @else {{ number_format($tp->totals) }} @endif {{ setting('units.distance') }} </td>
			@else
				<td> {{ number_format($tp->totals) }} </td>
			@endif				
			</tr>
		@endforeach
		</table>
	@else
		No Stats Available
	@endif
	</div>
</div>