@extends('master')
@section('title')
	Confirm Booking For {{ $subbrand->name }}, {{ $package->name }}
@endsection
@section('content')
<div class="row">
 	<div class="columns">
 		<h2>Confirm Package Booking </h2>
 		@if( $subbrand->name == 'weddings')
 		{
			<h4>Congratulations on getting married</h4>
 		}
 		@endif
 		<h5 class="samll button radius warning">Please check your booking details before submitting</h5>
 		<p>Catergory: {{ $subbrand->name }}</p>
 		<p>Package: {{ $package->name }}</p>
 		<p>Price: {{ $package->price }}</p>
 		<p>Hours: {{ $package->hours }}</p>
 		<p>Product: {{ $package->product }}</p>
 		<p></p>
 		<h5 class="samll button radius warning">Your Details</h5> 		
		<p>Name: {{ $order['firstName']}} {{ $order['lastName']}}</p>
		<p>Email: {{ $order['email'] }}</p>
		<p>Organisation: {{ $order['organisation'] }}</p>
		<p>Comments:</p>
		<p>{{ $order['comment'] }}</p>
		<p>{{ $order['date'] }}</p>
		<p>{{ $order['sendAddress'] }}</p>
		<form action="/sendConfirm" method="POST" novalidate>
 		{{ csrf_field() }}
 			
			<input type="hidden" value="{{ $order['firstName'] }}" name="firstName">
			<input type="hidden" value="{{ $order['lastName'] }}" name="lastName">
			<input type="hidden" value="{{ $order['email'] }}" name="email">
			<input type="hidden" value="{{ $order['organisation'] }}" name="oragnisation">
			<input type="hidden" value="{{ $order['comment'] }}" name="comments">
			<input type="hidden" value="{{ $order['date'] }}" name="date">
 			<input type="hidden" value="{{ $package->id }}" name="package">
			<input type="hidden" value="{{ $subbrand->id }}" name="subbrand">
			<input type="hidden" value="{{ $order['location']}}" name="location">
 						
 			<input type="submit" name="sendConfirm" value="Confirm" class="tiny button radius">
 		
 		</form>
	</div>
</div>
@endsection