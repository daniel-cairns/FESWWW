@extends('master')

@section('content')
	<div class="row">
		<div class="columns">
			<h1>Admin</h1>
			@foreach( $users as $user)
			{{$user->name}}
			@endforeach
		</div>
	</div>

	
@endsection