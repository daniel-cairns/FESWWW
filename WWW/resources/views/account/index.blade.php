@extends('master')
@section('title')
	Profile {{ $user->name }}
@endsection
@section('content')
<div class="row">
	<div class="columns">
		
		<h1>Hello {{ $user->name }}</h1>
		
		<div class="row">
		
			<div class="columns large-4">
				<h2>Account Details</h2>
				
				<h5>Username</h5>
				<p>{{ Auth::user()->name }} <a href="#" data-reveal-id="userNameModal" class="right">edit</a></p>
				
				<h5>Email</h5>
				<p>{{ Auth::user()->email}} <a href="#" data-reveal-id="emailModal" class="right">edit</a></p>
							
				<h5>Password</h5>
				<p>******* <a href="#" data-reveal-id="passwordModal" class="right">edit</a></p>	
				
			</div>

			<div id="userNameModal" class="reveal-modal" data-reveal aria-labelledby="userNameModal" aria-hidden="true" role="dialog">
			  <h2 id="userNameModal">Edit Username</h2>
			  @include('forms.usernameReset')	
			  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
			</div>

			<div id="emailModal" class="reveal-modal" data-reveal aria-labelledby="emailModal" aria-hidden="true" role="dialog">
			  <h2 id="emailModal">Edit Email</h2>
			  @include('forms.emailReset')
			  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
			</div>

			<div id="passwordModal" class="reveal-modal" data-reveal aria-labelledby="passwordModal" aria-hidden="true" role="dialog">
			  <h2 id="passwordModal">Edit Password</h2>
			  @include('forms.passwordReset')
			  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
			</div>

			<div class="columns large-4">
				
			</div>
		
			<div class="columns large-4 right">
				@if( session('message'))
				<div class="alert-box success">
				{{ session('message')}}		
				</div>
				@endif
				@if( session('error'))
				<div class="alert-box warning">
				{{ session('error')}}		
				</div>
				@endif
			</div>	
		
		</div>
		<div class="row" data-equalizer>
			<div class="columns">
			<h2>Ordered Packages</h2>
				<ul class="small-block-grid-3">
					@forelse($user->boughtPackages as $boughtPackage)
						
						<li>
							<h5>{{ $boughtPackage->package->name }}</h5>
							<p data-equalizer-watch>{{ $boughtPackage->package->description }}</p>
							<p>Price: {{ $boughtPackage->package->price }}</p>
							<p>Hours: {{ $boughtPackage->package->hours }}</p>
							<p>Product: {{ $boughtPackage->package->product}}</p>
							<p>Booking Date: {{ \Carbon\Carbon::parse( $boughtPackage->booking_date )->toFormattedDateString() }}</p>
							<p>Location: {{ $boughtPackage->location }}</p>
							<div class="row">
								<div class="columns">
									<div class="map" data-location="{{ $boughtPackage->location}}" data-id="{{ $boughtPackage->id }}" id="map{{ $boughtPackage->id}}">
								
									</div>
								</div>
							</div>
							<div class="row">
								<div class="columns">
									<a href="#" data-reveal-id="modal{{ $boughtPackage->id }}" class="tiny button radius">Cancel Booking</a>
								</div>
							</div>
							
							
							
 					  </li>
					@empty
						<li>No packages order yet. Click <a href="/packages">here</a> to view whats on offer.</li>
					@endforelse
				</ul>

				@forelse($user->boughtPackages as $boughtPackage)
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
				@empty

				@endforelse

			</div>
		</div>
		
		<div class="row">
			<div class="columns">
				<h2>Images</h2>
				<ul class="small-block-grid-4">
					@forelse( $images as $image)
					<li><img src="/img/users/{{ $image->name }}" alt=""></li>
					@empty
					<li>Your Images are still being processed</li>
					@endforelse
				</ul>
			</div>
		</div>
				
	</div>
</div>
@endsection
