@extends('master')
@section('title')
	Confirmed Contact Request
@endsection
@section('content')

<div class="row">
	<div class="large-8 large-centered columns">
		<h1>Thank You For Contacting Us</h1>
		<h2>Your Request has been sent</h2>
		<hr>
		<h2>For: {{ $data['firstname'] }} {{ $data['lastname'] }}</h2>
		<hr>
		<h2>Email: {{ $data['email'] }}</h2>
		<hr>
		<h2>Phone: {{ $data['phone'] }}</h2>
		<hr>
		<h2>Comments: {{ $data['comment'] }}</h2>
	</div>
</div>

@endsection