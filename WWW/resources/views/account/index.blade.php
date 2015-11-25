@extends('master')
@section('title')
	Profile {{ $user->name }}
@endsection
@section('content')
<div class="row">
	<div class="columns">
		
		<h1>Hello {{ $user->name }}</h1>
		
		<div class="row">
		
			<div class="columns large-6">
				<h2>Account Details</h2>
				<h2>Ordered Packages</h2>
			</div>
		
			<div class="columns large-6">
				@if( session('message'))
				<div class="alert-box success">
				{{ session('message')}}		
				</div>
				@endif
			</div>	
		
		</div>
		<div class="row" data-equalizer>
			<div class="columns">
				<ul class="small-block-grid-3">
					@foreach($user->boughtPackages as $boughtPackage)
						
						<li>
							<h5>{{ $boughtPackage->package->name }}</h5>
							<p data-equalizer-watch>{{ $boughtPackage->package->description }}</p>
							<p>Price: {{ $boughtPackage->package->price }}</p>
							<p>Hours: {{ $boughtPackage->package->hours }}</p>
							<p>Product: {{ $boughtPackage->package->product}}</p>
							<p>Booking Date: {{ \Carbon\Carbon::parse( $boughtPackage->booking_date )->toFormattedDateString() }}</p>
							
							<a href="#" data-reveal-id="modal{{ $boughtPackage->id }}" class="tiny button radius">Cancel Booking</a>
 					  </li>

					@endforeach
				</ul>

				@foreach($user->boughtPackages as $boughtPackage)
				<div id="modal{{ $boughtPackage->id }}" class="reveal-modal" data-reveal aria-labelledby="modal{{ $boughtPackage->id }}" aria-hidden="true" role="dialog">
				  <h2 id="modal{{ $boughtPackage->id }}">Are you sure you want to cancel this Booking</h2>
				  <h5>{{ $boughtPackage->package->name }}</h5>
					<p data-equalizer-watch>{{ $boughtPackage->package->description }}</p>
					<p>Price: {{ $boughtPackage->package->price }}</p>
					<p>Hours: {{ $boughtPackage->package->hours }}</p>
					<p>Product: {{ $boughtPackage->package->product}}</p>
					<p>Booking Date: {{ \Carbon\Carbon::parse( $boughtPackage->booking_date )->toFormattedDateString() }}</p>
				  <form action="/cancelPackage" method="POST" novalidate>
						{{ csrf_field() }}
						<input type="hidden" value="{{ $boughtPackage->id }}" name="package_id">
						<input type="submit" name="cancelPackage" value="Cancel Booking" class="tiny button radius">					
					</form>
				  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
				</div>
				@endforeach

			</div>
		</div>
		
		<div class="row">
			<div class="columns">
				<h2>Images</h2>
				<ul class="small-block-grid-4">
					@foreach( $images as $image)
					<li><img src="/img/users/{{ $image->name }}" alt=""></li>

					@endforeach
				</ul>
			</div>
		</div>
				
	</div>
</div>
@endsection
