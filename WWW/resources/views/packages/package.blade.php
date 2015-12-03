@extends('master')
@section('title')
	{{$package->name}}
@endsection
@section('content')
	<div class="row">
		<div class="columns">
			<h1 class="left">{{$subbrand->name}} Catergory</h1>
		</div>
	</div>
	<div class="row">
		<div class="columns">
			<h2 class="left">{{$package->name}} Package</h2>
			@if( Auth::check() && Auth::user()->privilege == 'admin')
      <a href="" class="tiny button radius amber edit right" data-reveal-id="editModal">Edit Package</a>
      @endif
    </div>  
  </div>
  <div class="row">
		<div class="columns">    
			<p>{{$package->description}}</p>
			<h3>Price</h3>
			<p>${{$package->price}}</p>
			<h3>Dedicated Hours</h3>
			<p>${{$package->hours}}</p>
			<h3>Availabe Products</h3>
			<p>{{$package->product}}</p>
			<a href="{{$package->slug}}/order" class="tiny button radius">Request a Booking</a>
		</div>
	</div>
	
	<div>
		
	</div>
	<div id="editModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
		@include('forms.updatePackage')
		
		<a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>
	

@endsection