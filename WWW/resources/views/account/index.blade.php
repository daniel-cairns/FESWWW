@extends('master')
@section('title')
	Profile {{ $user->name }}
@endsection
@section('content')
<div class="row">
	<div class="columns">
		<h1>Hello {{ $user->name }}</h1>
		<h2>Account Details</h2>
		<p>Username {{ $user->name }}</p>
		<h2>Ordered Packages</h2>
		<ul class="small-block-grid-3">
		@foreach( $user->packages as $package)
			<li>
				<h5>{{ $package->name }}</h5>
				<p>{{ $package->description }}</p>
				<p>Price: {{ $package->price }}</p>
				<p>Hours: {{ $package->hours }}</p>
				<p>Product: {{ $package->product }}</p>
				
				@foreach( $packages as $booking)
				
					@if( $package->id == $booking->package_id  )
						<p>Date Booked: {{ $booking->booking_date }}</p>
					@endif

				@endforeach

				<form action="/cancelPackage" method="POST" novalidate>
					{{ csrf_field() }}
					<input type="hidden" value="{{ $package->id }}" name="package_id">
					<input type="submit" name="cancelPackage" value="Cancel Booking" class="tiny button radius">					
				</form>
			</li>	
		@endforeach
		</ul>
		<h2>Images</h2>
	</div>
</div>
@endsection
