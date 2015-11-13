@extends('master')
@section('title')
	Admin
@endsection
@section('content')
	<div class="row">
		<div class="columns">
			<h1>Administration Page</h1>
		</div>
	</div>		
	
	<div class="row">
		<div class="columns">
			<h2>Clients</h2>
			<hr>
		</div>
	</div>	
	
	<div class="row">
		<div class="columns large-6">
			<select name="" id="">
				@foreach( $users as $user)
				<option value="{{$user->id}}">{{$user->name}}</option>
				@endforeach
			</select>
		</div>
		
		<div class="columns large-6">
			@foreach( $messages as $message)
			<p>{{$message->message}}</p>
			@endforeach
		</div>
	</div>

	<div class="row">
		<div class="columns">
			<h2>Subbrands</h2>
		</div>	
	</div>
	
	<div class="row">	
		<div class="columns">
		@foreach( $subbrands as $subbrand )
			<ul class="accordion" data-accordion="myAccordionGroup">
		    <li class="accordion-navigation">
		      <a href="#panel{{$subbrand->id}}"><h2>{{$subbrand->name}}</h2></a>
		      <div id="panel{{$subbrand->id}}" class="content">
						<form action="image" method="POST" enctype="multipart/form-data" novalidate>
							{{ csrf_field() }}
					    <div class="row">
								<div class="columns">
									<h2>Upload an Image to the {{$subbrand->name}} page</h2>
								</div>		
					      
					      <div class="columns large-6">
						      <label for="photo"><h2>Image</h2></label>
						      <input type="file" name="photo" class="tiny button radius">
						      @if(count($errors) > 0)
						      <span class="alert-box warning">{{$errors->first('photo')}}</span>
						      @endif
						    </div>

						    <div class="columns large-6">
						      <label for="description"><h2>Image Description</h2></label>
						      <input type="text" id="description" name="description" placeholder="Image Description">
						      @if(count($errors) > 0)
						      <span class="alert-box warning">{{$errors->first('description')}}</span>
						      @endif
						    </div>
						  </div>  
	        		
	        		<input type="hidden" value="{{$subbrand->id}}" name="subbrand">
	        		<input type="hidden" value="image" name="image">
					    <input type="submit" value="Upload a new Image" name="image{{$subbrand->id}}" class="tiny button radius">
						</form>
						<hr>
			      
			      <h2>Current Images</h2>
			      <ul class="medium-block-grid-4">
			    		@foreach( $subbrand->images as $image )	
			    		<li>
			    			<div class="row">
			    				<div class="columns">
			    					<img src="/img/gallery/{{$image->name}}" alt="{{$image->description}}">
			    					<span>{{$image->description}}</span>	
			    				</div>
			    			</div>

			    			<div class="row">
			    				<div class="columns small-6">
			    					<a href="#" data-reveal-id="{{ camel_case($image->description) }}UpdateModal" class="tiny button radius">Update Image</a>
			    				</div>
			    				<div class="columns small-6">	
	              		<a href="#" data-reveal-id="{{ camel_case($image->description) }}RemoveModal" class="tiny button radius warning">Remove Image</a>			
			    				</div>
			    			</div>
			    		</li>
			    		<div id="{{ camel_case($image->description) }}UpdateModal" class="reveal-modal" data-reveal aria-labelledby="{{ camel_case($image->description) }}" aria-hidden="true" role="dialog">
								  <h2 id="{{ $image->description }}">Update {{ $image->description }} Image</h2>
								  <img src="/img/original/{{ $image->name }}" alt="">
								  <form action="updatePackage">
								  	
								  </form>
								  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
								</div>

								<div id="{{ camel_case($image->description) }}RemoveModal" class="reveal-modal" data-reveal aria-labelledby="{{ camel_case($image->description) }}" aria-hidden="true" role="dialog">
								  <h2 id="{{ $image->description }}">Remove {{ $image->description }} Image</h2>
								  <img src="/img/original/{{ $image->name }}" alt="">
							 		<p>Are you sure you want to remove this image and all it's details from your records?</p>
									<form action="removeImage" method="POST" novalidate>
									{{ csrf_field() }}
										<input type="hidden" value="{{ $image->id }}" name="image_id">
										<input type="hidden" value="{{ $subbrand->id }}" name="subbrand_id">
										<input type="submit" class="tiny button radius" name="removePackage" value="Yes">
										@if(count($errors) > 0)
					      			<span class="alert-box warning">{{$errors->first('image_id')}}</span>
					      		@endif
					      		<a href="" class="tiny button radius" aria-label="Close">No</a>
										
							 		</form>
							  </div>

			    		@endforeach	
			    	</ul>
						<hr>
						
						<h2>Current Packages</h2>
						<ul class="medium-block-grid-3">
				    	@foreach($subbrand->packages as $package)
	              <li>
	              	<h3>{{$package->name}}</h3>
	              	
	              	<p data-equalizer-watch>{{$package->description}}</p>
	              	
	              	<p>Price ${{ $package->price }}</p>
	              	
	              	<p>Hours {{ $package->hours}}</p>
									@foreach( $package->products as $product)
	              	<p>Product: {{ $product->name }}</p>
	              	@endforeach
	              	<a href="#" data-reveal-id="{{ camel_case($package->name) }}UpdateModal" class="tiny button radius">Update Package</a>
	              	
	              	<a href="#" data-reveal-id="{{ camel_case($package->name) }}RemoveModal" class="tiny button radius warning">Remove Package</a>
              	</li>
              	
              	<div id="{{ camel_case($package->name) }}UpdateModal" class="reveal-modal" data-reveal aria-labelledby="{{ camel_case($package->name) }}" aria-hidden="true" role="dialog">
								  <h2 id="{{ $package->name }}">Update {{ $package->name }} Package</h2>
								  <form action="updatePackage">
								  	
								  </form>
								  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
								</div>

								<div id="{{ camel_case($package->name) }}RemoveModal" class="reveal-modal" data-reveal aria-labelledby="{{ camel_case($package->name) }}" aria-hidden="true" role="dialog">
								  <h2 id="{{ $package->name }}">Remove {{ $package->name }} Package</h2>
							 		<p>Are you sure you want to remove this package and all it's details from your records?</p>
									<form action="removePackage" method="POST">
									{{ csrf_field() }}
										<input type="hidden" value="{{ $package->id }}" name="package_id">
										<input type="hidden" value="{{ $subbrand->id }}" name="subbrand_id">
										<input type="submit" class="tiny button radius" name="removePackage" value="Yes">
										@if(count($errors) > 0)
					      			<span class="alert-box warning">{{$errors->first('id')}}</span>
					      		@endif
					      		<a href="" class="tiny button radius" aria-label="Close">No</a>
										
							 		</form>
							  </div>

		          @endforeach
			    	</ul>
			    
			    	<h2>Create a new package</h2>
			    	<form action="package" method="POST" novalidate>
				    	{{ csrf_field() }}
				    	<div class="row">
				    		
				    		<div class="columns large-6">
				    			<label for="name">Package Name</label>
				    			<input type="text" id="name" name="name">
				    			@if(count($errors) > 0)
						      <span class="alert-box warning">{{$errors->first('name')}}</span>
						      @endif
				    		</div>
				    		
				    		<div class="columns large-6">
				    			<label for="price">Price</label>
				    			<input type="number" id="price" name="price" min="1" max="10000">
				    			@if(count($errors) > 0)
						      <span class="alert-box warning">{{$errors->first('price')}}</span>
						      @endif
				    		</div>
				    				    		
				    		<div class="columns large-6">
				    			<label for="hours">Hours</label>
				    			<input type="number" id="hours" name="hours" min="1" max="9">
				    			@if(count($errors) > 0)
						      <span class="alert-box warning">{{$errors->first('hours')}}</span>
						      @endif	
				    		</div>
								
								<div class="columns large-6">
									<label for="product">Product</label>
									<select name="product" id="product" name="product">
										<option>Select a product type</option>
										@foreach( $products as $product)
											<option value="{{ $product->id }}">{{ $product->name }}</option>
										@endforeach	
									</select>
									@if(count($errors) > 0)
						      <span class="alert-box warning">{{$errors->first('product')}}</span>
						      @endif
								</div>
								<div class="columns large-6">		
				    			<input type="submit" value="Upload new package" class="tiny button radius">
				    		</div>								
				    		<div class="columns large-6">
				    			<label for="description">Description</label>
				    			<textarea id="description" name="description"></textarea>
				    		</div>
				     	</div>
				     	<input type="hidden" value="{{ $subbrand->id }}" name="subbrand">
				     	<input type="hidden" value="package" name="package">
			    	</form>

		      </div>
		    </li>
		  </ul>
		@endforeach		
	</div>
</div>
				
			
@endsection