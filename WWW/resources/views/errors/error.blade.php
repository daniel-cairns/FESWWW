@extends('master')

@section('title')
	Error:(
@endsection

@section('content')
	<div class="row" style="margin: 200px;">
		<div class="columns">
			<h2>Whoops, Looks like something went Wrong!</h2>
			<p>It appears that your request does not match our records</p>
			<p>Click <a href="/back">here</a> to return back to your previous page</p>
			@if ( Auth::check() && Auth::user()->privilege == 'admin' )
				<p>Or <a href="/admin">here</a> to return to admin page.</p>
			@elseif( Auth::check())
				<p>Or <a href="/account">here</a> to return to your account page.</p>
			@endif
		</div>
		</div>
	</div>
@endsection
