@extends('master')
@section('title')
	Packages
@endsection
@section('content')
	
	<div class="row">
		<div class="columns">
			<h1 class="left">Packages</h1>
		</div>
	</div>
	
	@foreach( $subbrands as $subbrand)
	<div class="row" data-equalizer>
		<div class="columns">
			<h2>{{$subbrand->name}}</h2>
			<ul class="medium-block-grid-3">
				@foreach( $allPackages as $package)
					<li>
						<h3>{{$package->name}}</h3>
						<p data-equalizer-watch>{{$package->description}}</p>
						<a href="package/{{$package->name}}" class="tiny button radius amber">Package Details</a>
					</li>
				@endforeach				
			</ul>
			<hr>
		</div>
	</div>
	@endforeach
@endsection