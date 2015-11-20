@extends('master')
@section('title')
	Login
@endsection
@section('content')
	<div class="row">
		<div class="columns">
			@include('forms.login')
		</div>
	</div>
@endsection	