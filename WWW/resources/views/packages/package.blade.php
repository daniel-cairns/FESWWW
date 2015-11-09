@extends('master')

@section('content')
	
	<div class="row">
		<div class="columns">
			<h1 class="left">{{$package->name}}</h1>
			@if( Auth::check() && Auth::user()->privilege == 'admin')
      <a href="" class="tiny button radius amber edit right" data-reveal-id="editModal">Edit Package</a>
      @endif
    </div>  
  </div>
  <div class="row">
		<div class="columns">    
			<p>{{$package->description}}</p>
			<span>${{$package->price}}</span>
			<span>${{$package->hours}}</span>
			<span>Product: {{$package->product}}</span>		
		</div>
	</div>
	
	<div id="editModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
		
		<a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>
	

@endsection