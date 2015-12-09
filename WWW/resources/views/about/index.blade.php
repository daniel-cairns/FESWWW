@extends('master')
@section('title')
	About Us
@endsection
@section('content')
	<div class="slider">
	  @foreach( $images as $image )
	  <div style="background-image: url(img/original/{{ $image->name }});"><caption>capture your day</caption></div>
	  @endforeach
  </div>

  <div class="caption">
    <h1>Capture Your Day...</h1>
  </div>
	<div class="row">
		<div class="columns">
			<h1>About Us</h1>
			<p>{{ $about->description }}</p>	
		</div>
	</div>
	
@endsection

