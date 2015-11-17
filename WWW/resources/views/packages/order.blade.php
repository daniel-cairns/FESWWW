@extends('master')
@section('title')
	{{$subbrand->name}} {{$package->name}} Booking
@endsection
@section('content')
	<div class="row">
		<div class="columns">
			<h1>{{$subbrand->name}} Package Booking Request</h1>
			<h2>Package {{$package->name}}</h2>
			<form action="/confirm" method="POST" novalidate>
				{{ csrf_field() }}
				<div class="row">
					<div class="columns large-6">
						<div>
							<label for="">First Name</label>
							<input type="text">
						</div>
						
						<div>
							<label for="">Last Name</label>
							<input type="text">
						</div>

						<div>
							<label for="">Organisation</label>
							<input type="text">
						</div>

						<div>
							<label for="email">Email</label>
							<input type="email" name="email" id="email">
						</div>
						
						<div>
							<label for="comment">Comments</label>
							<textarea name="comment" id="comment" cols="30" rows="10"></textarea>
						</div>
					</div>
					
					<div class="columns large-6">
						<label for="date">Booking Date</label>
						<input id="startdate" name="startdate" min="date('Y-m-d')" max="2018-01-01" type="date">
					
						<label for="date">Booking End Date</label>
						<input id="startdate" name="startdate" min="date('Y-m-d')" max="2018-01-01" type="date">
					</div>
				</div>	
									
				<input type="hidden" value="{{ $subbrand->id }}">
				<input type="hidden" value="{{ $package->id }}">
				<input type="submit" value="Request Booking" name="book_package" class="tiny button radius">
			</form>		
		</div>	
	</div>
	
@endsection
