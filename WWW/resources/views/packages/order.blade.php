@extends('master')
@section('title')
	{{$subbrand->name}} {{$package->name}} Booking
@endsection
@section('content')
	<div class="row">
		<div class="columns ">
			<h1 class="">{{$subbrand->name}} Package Booking Request</h1>
			
			@if( session('error'))
			<span class="alert-box warning">{{ session('error') }}</span>
			@endif
				<div class="row">
					<div class="columns">
						<h2>Package {{$package->name}}</h2>
					</div>	
				</div>
			@if( !Auth::check() )
				<div class="row">
					<div class="columns large-6">
						<form action="/confirm" method="POST" novalidate>
							{{ csrf_field() }}
							<div>
								<label for="firstName"><h3>First Name</h3></label>
								<input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}">
							</div>
							@if($errors->confirm->first('firstName'))
        				<span class="alert-box warning">{{$errors->confirm->first('firstName')}}</span>
    					@endif
							
							<div>
								<label for="lastName"><h3>Last Name</h3></label>
								<input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}">
							</div>
							@if($errors->confirm->first('lastName'))
        				<span class="alert-box warning">{{$errors->confirm->first('lastName')}}</span>
    					@endif

							<div>
								<label for="email"><h3>Email</h3></label>
								<input type="email" name="email" id="email" value="{{ old('email') }}">
							</div>
							@if($errors->confirm->first('email'))
        				<span class="alert-box warning">{{$errors->confirm->first('email')}}</span>
    					@endif

							<div>
								<label for="organisation"><h3>Organisation</h3></label>
								<input type="text" id="organisation" name="organisation" value="{{ old('organisation') }}">
							</div>
							@if($errors->confirm->first('organisation'))
        				<span class="alert-box warning">{{$errors->confirm->first('organisation')}}</span>
    					@endif

							<div>
								<label for="comment"><h3>Comments</h3></label>
								<textarea name="comment" id="comment" cols="30" rows="10">{{ old('comment') }}</textarea>
							</div>
							@if($errors->confirm->first('comment'))
        				<span class="alert-box warning">{{$errors->confirm->first('comment')}}</span>
    					@endif

						</div>
						
						<div class="columns large-6">
	            
	            <div>
	            	<label for="datepicker"><h3>Booking Date</h3></label>
	            	<input type="date" id="datepicker" name="date" value="{{ old('date') }}" class="tiny button radius">
	            </div>
	            
	            @if($errors->confirm->first('date'))
        				<span class="alert-box warning">{{$errors->confirm->first('date')}}</span>
    					@endif

	            <div>
								<div>
									<h3>Location</h3>
									<div class="row">
										<div class="columns small-6">
											<input type="text" id="search">
										</div>	
										<div class="columns small-6">
											<div id="searchAddress" class="tiny radius button">Search</div>
											<input type="button" id="reset" value="Reset the Map" class="tiny button radius">
										</div>	
									</div>
								</div>	
								<div>
									<span id="mapMessage"></span>
								</div>			
	        			
	        			<div id='map2'>
	        				
	        			</div>
        				<small>*Pleaase only enter the location for your booking request. No personal details at this point</small>
								<div>
									<div id="infoPanel">
									  <div style="display:none">
									  	<b>Marker status:</b>
									  	<div id="markerStatus"><i>Click and drag the marker.</i></div>
									  </div> 
								    <b>Closest matching address:</b>
								    <div id="address"></div>
								    @if($errors->confirm->first('location'))
			        				<span class="alert-box warning">{{$errors->confirm->first('location')}}</span>
			    					@endif
								  </div>
		      			</div> 
		          </div>
													
							<input type="hidden" value="" name="location" id="location">
		          <input type="hidden" value="{{ $subbrand->id }}" name="subbrand">
							<input type="hidden" value="{{ $package->id }}" name="package">
							<input type="hidden" value="" id="sendAddress" name="sendAddress">
							<input type="submit" value="Request Booking" name="bookPackage" class="tiny button radius">	
						</form>
            
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
					</div>		
					<div class="columns large-6">
						
						<div>
							<h3>Location</h3>
							<div class="row">
								<div class="columns small-6">
									<input type="text" id="search">
								</div>	
								<div class="columns small-6">
									<div id="searchAddress" class="tiny radius button">Search</div>
									<input type="button" id="reset" value="Reset the Map" class="tiny button radius">
								</div>	
							</div>
						</div>	
						
						<div>
							<span id="mapMessage"></span>
						</div>			
      			
	        	<div id='map2'>
	        				
	        	</div>
        		<small>*Pleaase only enter the location for your booking request. No personal details at this point</small>
						<div>
							<div id="infoPanel">
							  <div style="display:none">
							  	<b>Marker status:</b>
							  	<div id="markerStatus"><i>Click and drag the marker.</i></div>
							  </div> 
						    <b>Closest matching address:</b>
						    <div id="address"></div>
						    @if($errors->confirm->first('location'))
	        				<span class="alert-box warning">{{$errors->confirm->first('location')}}</span>
	    					@endif
						  </div>
      			</div>
      			<div>
							<input type="submit" value="Request Booking" name="userBookPackage" class="tiny button radius">	
						</div> 
	        </div>   			
					
					<input type="hidden" value="" name="location" id="location">
					<input type="hidden" value="{{ $subbrand->id }}" name="subbrand">
					<input type="hidden" value="{{ $package->id }}" name="package">
					
					<input type="hidden" value="" id="sendAddress" name="sendAddress">
				</form>
					
			</div>	
				
			@endif


		</div>	
	</div>
	

@endsection
