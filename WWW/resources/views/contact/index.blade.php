@extends('master')
@section('title')
	Contact Us
@endsection
@section('content')

<div class="row">
	<div class="large-8 large-centered columns">
		<h1>Contact</h1>
		@include('forms.contact')
	</div>
</div>

@endsection