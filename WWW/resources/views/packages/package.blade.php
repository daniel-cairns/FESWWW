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
	
	<div id="editModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
		<form action="packages/{{$package->name}}" novalidate>
		{{ csrf_field() }}
			<div>
				<label for="title">Title</label>
				<input type="text" id="title" name="title" value="{{$package->name}}">
			</div>
			<div>
				<label for="description">Description</label>
				<input type="text" id="description" name="description" value="{{$package->description}}">
			</div>
			<div>
				<label for="price">Price</label>
				<input type="number" id="price" name="price" min="0" max="1000" value="{{$package->price}}">
			</div>
			<div>
				<label for="hours">Hours</label>
				<input type="number" id="hours" name="hours" value="{{$package->hours}}">
			</div>
			<div>
				<label for="product">Product</label>
				<select name="pr" id="product">
					<option value="">Hardcopy</option>
					<option value="">Digital</option>
					<option value="">Download</option>
				</select>
			</div>

			<input type="submit" value="Update Package" name="update_package" class="tiny button radius amber">
		</form>
		<a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>
	

@endsection