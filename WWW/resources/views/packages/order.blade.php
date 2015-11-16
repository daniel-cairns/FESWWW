@extends('master')
@section('title')
	{{$subbrand->name}} {{$package->name}} Booking
@endsection
@section('content')
	<div class="row">
		<div class="columns">
			<h1>{{$subbrand->name}} Package Booking</h1>
			<h2>Package {{$package->name}}</h2>
			<form action="confirm" method="POST" novalidate>
				{{ csrf_field() }}
				<input type="hidden" value="{{ $subbrand->id }}">
				<input type="hidden" value="{{ $package->id }}">
				<input type="submit" value="Request Booking" name="book_package" class="tiny button radius">
			</form>		
		</div>	
	</div>
	
@endsection
