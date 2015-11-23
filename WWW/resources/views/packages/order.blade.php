@extends('master')
@section('title')
	{{$subbrand->name}} {{$package->name}} Booking
@endsection
@section('content')
	<div class="row">
		<div class="columns">
			<h1>{{$subbrand->name}} Package Booking Request</h1>
			@if( !Auth::check() )
			<form action="/confirm" method="POST" novalidate>
				{{ csrf_field() }}
				<div class="row">
					<div class="columns large-6">
					<h2>Package {{$package->name}}</h2>
						<div>
							<label for="firstName"><h3>First Name</h3></label>
							<input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}">
						</div>
						
						<div>
							<label for="lastName"><h3>Last Name</h3></label>
							<input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}">
						</div>

						<div>
							<label for="email"><h3>Email</h3></label>
							<input type="email" name="email" id="email" value="{{ old('email') }}">
						</div>

						<div>
							<label for="organisation"><h3>Organisation</h3></label>
							<input type="text" id="organisation" name="organisation" value="{{ old('organisation') }}">
						</div>

						<div>
							<label for="comment"><h3>Comments</h3></label>
							<textarea name="comment" id="comment" cols="30" rows="10">{{ old('comment') }}</textarea>
						</div>
						
					</div>
					
					<div class="columns large-6">
          	<h2>Booking Date</h2>
              
              <div>
              	<label for="datepicker"><h3>Date</h3></label>
              	<input type="date" id="datepicker" name="date" value="{{ old('date') }}" class="tiny button radius amber">
              </div>	
          </div>
				</div>	
									
				<input type="hidden" value="{{ $subbrand->id }}" name="subbrand">
				<input type="hidden" value="{{ $package->id }}" name="package">
				<input type="submit" value="Request Booking" name="bookPackage" class="tiny button radius">
			</form>
			@else
			<form action="/userConfirm" method="POST" novalidate>
				{{ csrf_field() }}
				<p>Catergory: {{ $subbrand->name }}</p>
 				<p>Package: {{ $package->name }}</p>
 				<p>Price: {{ $package->price }}</p>
 				<p>Hours: {{ $package->hours }}</p>
 				<p>Product: {{ $package->product }}</p>
 				<div>
         	<label for="datepicker"><h3>Date</h3></label>
        	<input type="date" id="datepicker" name="date" value="{{ old('date') }}">
        </div>	
				<input type="hidden" value="{{ $subbrand->id }}" name="subbrand">
				<input type="hidden" value="{{ $package->id }}" name="package">
				<input type="submit" value="Request Booking" name="userBookPackage" class="tiny button radius">
			</form>
			@endif


		</div>	
	</div>
	
	
@endsection
