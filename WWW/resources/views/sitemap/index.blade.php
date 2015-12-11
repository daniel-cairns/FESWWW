@extends('master')
@section('title')
  Sitemap
@endsection
@section('content')
	<div class="row">
		<div class="columns">
			<h1>Sitemap</h1>
			<ul>
			@foreach( $subbrands as $subbrand)
				<li><a href="/subbrand/{{ $subbrand->slug }}">{{ $subbrand->name }}</a>
					<ul>
					@foreach( $subbrand->packages as $package)
						<li><a href="/subbrand/{{ $subbrand->slug }}/{{ $subbrand->slug }}">{{ $package->name }}</a></li>
					@endforeach
					</ul>
				</li>
			@endforeach
				<li><a href="/gallery">Gallery</a></li>
				<li><a href="/packages">Packages</a></li>
				<li><a href="/about">About Us</a></li>
				<li><a href="/contact">Contact</a></li>
			</ul>

		</div>
	</div>	
		
@endsection