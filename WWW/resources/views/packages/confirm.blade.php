@extends('master')
@section('title')
	Confirm Booking For {{ $subbrand->name }}, {{ $package->name }}
@endsection
@section('content')
<div class="row">
 	<div class="columns">
 		<form action="/sendConfirm" method="POST" novalidate>
 		{{ csrf_field() }}
 			
			<input type="hidden" value="{{ $order['firstName'] }}" name="firstName">
			<input type="hidden" value="{{ $order['lastName'] }}" name="lastName">
			<input type="hidden" value="{{ $order['email'] }}" name="email">
			<input type="hidden" value="{{ $order['organisation'] }}" name="oragnisation">
			<input type="hidden" value="{{ $order['comments'] }}" name="comments">
			<input type="hidden" value="{{ $order['date'] }}" name="date">
 			<input type="hidden" value="{{ $package->id }}" name="package">
			<input type="hidden" value="{{ $subbrand->id }}" name="subbrand">
 			
 			
 			<input type="submit" name="sendConfirm" value="Confirm">
 		
 		</form>
	</div>
</div>
@endsection