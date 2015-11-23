@extends('master')
@section('title')
	Profile {{ $user->name }}
@endsection
@section('content')
<div class="row">
	<div class="columns">
		<h1>Hello {{ $user->name }}</h1>
		<h2>Account Details</h2>
		<p>Username {{ $user->name }}</p>
		<h2>Packages</h2>
		
			@foreach( $user->packages as $package)
			<p>{{$package->name}}</p>	
			@endforeach
		
		<h2>Images</h2>
	</div>
</div>
@endsection
