@extends('master')

@section('content')
	
	<div class="row">
		<div class="columns">
			<h1 class="left">Packages</h1>

			@if( Auth::check() && Auth::user()->privilege == 'admin')
      <a href="" class="tiny button radius amber edit right" data-reveal-id="editModal">Edit Page</a>
      @endif

      <div id="editModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
		    <h2 id="modalTitle">Edit Packages</h2>
		    @foreach( $allPackages as $package)
				<h3>{{$package->name}}</h3>
				<p>{{$package->description}}</p>
				<span>${{$package->price}}</span>
				<span>${{$package->hours}}</span>
				<span>Product: {{$package->product}}</span>
			@endforeach
		    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
		  </div>

		</div>
	</div>
	
	<div class="row">
		<div class="columns">
			@foreach( $allPackages as $package)
				<h1>{{$package->name}}</h1>
				<p>{{$package->description}}</p>
				<span>${{$package->price}}</span>
				<span>${{$package->hours}}</span>
				<span>Product: {{$package->product}}</span>
			@endforeach
		</div>
	</div>
@endsection