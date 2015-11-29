@extends('master')
@section('title')
	{{$subbrand->name}} {{$package->name}} Booking
@endsection
@section('content')
	<div class="row">
		<div class="columns ">
			<h1 class="">{{$subbrand->name}} Package Booking Request</h1>
			
			
				<div class="row">
					<div class="columns">
						<h2>Package {{$package->name}}</h2>
					</div>	
				</div>
			@if( !Auth::check() )
				<div class="row">
					<div class="columns centered large-6">
						<form action="/confirm" method="POST" novalidate>
							{{ csrf_field() }}
							<div>
								<label for="firstName"><h3>First Name</h3></label>
								<input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}">
							</div>
							@if($errors->confirm->first('new_password'))
        				<span class="alert-box warning">{{$errors->confirm->first('new_password')}}</span>
    					@endif
							
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
							
	            <div>
	            	<label for="datepicker"><h3>Booking Date</h3></label>
	            	<input type="date" id="datepicker" name="date" value="{{ old('date') }}" class="tiny button radius amber">
	            </div>
													
							<input type="hidden" value="" name="location" id="location">
		          <input type="hidden" value="{{ $subbrand->id }}" name="subbrand">
							<input type="hidden" value="{{ $package->id }}" name="package">
							<input type="submit" value="Request Booking" name="bookPackage" class="tiny button radius">	
						</form>
            
          </div>
					
					<div class="columns large-6">
						<h3>Location</h3>
						<input type="text" id="search">
											
        		<div id='map2'></div>
        			<small>*Pleaase only enter the location for your booking request. No personal details at this point</small>
						<div>
							<span id="mapMessage"></span>	
						</div>
        		
        		<input type="button" id="reset" value="Reset the Map" class="tiny button radius">
        		
					  <div id="infoPanel">
					    <b>Marker status:</b>
					    <div id="markerStatus"><i>Click and drag the marker.</i></div>
					    <b>Closest matching address:</b>
					    <div id="address"></div>
					  </div>
	          
	        </div>   
				</div>	
			@else
				<div class="row">
					<div class="columns large-6">
						<form action="/userConfirm" method="POST" novalidate>
							{{ csrf_field() }}
							<p>Catergory: {{ $subbrand->name }}</p>
			 				<p>Package: {{ $package->name }}</p>
			 				<p>Price: {{ $package->price }}</p>
			 				<p>Hours: {{ $package->hours }}</p>
			 				<p>Product: {{ $package->product }}</p>
			 				<div>
			         	<label for="datepicker"><h3>Date</h3></label>
			        	<input type="date" id="datepicker" name="date" value="{{ old('date') }}" class="radius">
			        </div>

			        <div>
								<label for="comment"><h3>Comments</h3></label>
								<textarea name="comment" id="comment" cols="30" rows="10">{{ old('comment') }}</textarea>
							</div>
							<input type="hidden" value="" name="location" id="location">
							<input type="hidden" value="{{ $subbrand->id }}" name="subbrand">
							<input type="hidden" value="{{ $package->id }}" name="package">
							<input type="submit" value="Request Booking" name="userBookPackage" class="tiny button radius">
						</form>
					</div>

					<div class="columns large-6">
						<h3>Location</h3>
						<input type="text" id="search">
											
        		<div id='map2'></div>
        			<small>*Pleaase only enter the location for your booking request. No personal details at this point</small>
						<div>
							<span id="mapMessage"></span>	
						</div>
        		
        		<input type="button" id="reset" value="Reset the Map" class="tiny button radius">
        		
					  <div id="infoPanel">
					    <b>Marker status:</b>
					    <div id="markerStatus"><i>Click and drag the marker.</i></div>
					    <b>Closest matching address:</b>
					    <div id="address"></div>
					  </div>
	          
	        </div>   		
				</div>	
				
			@endif


		</div>	
	</div>
	

@endsection
