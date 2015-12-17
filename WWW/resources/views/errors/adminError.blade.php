@extends('master')

@section('title')
	Error:(
@endsection

@section('content')
	<div class="row" style="margin: 200px;">
		<div class="columns">
			<h2>Whoops, Looks like something went Wrong!</h2>
			<p>There is something wrong with database query.</p>
			<p>Either the id of the requested change is incorrect or it does not exist in the database.</p>
			<p>Click <a href="/back">here</a> to return back to your previous page</p>
			@if( Auth::check() && Auth::user()->privilege == 'admin' )
			<p>Or <a href="/admin">here</a> to return to admin page.</p>
			@endif
		</div>
	</div>
@endsection