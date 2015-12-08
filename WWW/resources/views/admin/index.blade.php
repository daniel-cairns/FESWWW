@extends('master')
@section('title')
	Admin
@endsection
@section('content')
	<div class="row">
		<div class="columns large-6">
			<h1>Administration Page</h1>
		</div>

		<div class="columns large-6">
			@if( session('error'))
			<span class="alert-box warning">{{ session('error')}}</span>
			@endif
			@if( session('message'))
			<span class="alert-box success">{{ session('message')}}</span>
			@endif
		</div>
	</div>		
	
	<div class="row">
		<div class="columns">
			<h2>Subbrands</h2>
		</div>	
	</div>
	
	<div class="row">	
		<div class="columns">
		<ul class="accordion" data-accordion="myAccordionGroup">
		@foreach( $subbrands as $subbrand )
			<li class="accordion-navigation">
	      <a href="#panel{{$subbrand->id}}"><h2>{{$subbrand->name}}</h2></a>
		    <div id="panel{{$subbrand->id}}" class="content">
						
				@include('forms.storeImage')
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
	    					<a href="#" data-reveal-id="UpdateModal{{ $image->id }}" class="tiny button radius">Update Image</a>
	    				</div>

	    				<div class="columns small-6">	
            		<a href="#" data-reveal-id="RemoveModal{{ $image->id }}" class="tiny button radius warning">Remove Image</a>			
	    				</div>
	    			</div>
	    		</li>

	    		<div id="UpdateModal{{ $image->id }}" class="reveal-modal" data-reveal aria-labelledby="UpdateModal{{ $image->id }}" aria-hidden="true" role="dialog">
					  <h2 id="UpdateModal{{ $image->id }}">Update Image</h2>
					  <ul class="small-block-grid-2">
					  	<li>
								<h2>Description</h2>
					  		<p>{{ $image->description }}</p>
					  	</li>
					  	<li><img src="/img/gallery/{{ $image->name }}" alt=""></li>
					  </ul>
					  @include('forms.updateImage')
					  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
					</div>

					<div id="RemoveModal{{ $image->id }}" class="reveal-modal" data-reveal aria-labelledby="RemoveModal{{ $image->id }}" aria-hidden="true" role="dialog">
					  <h2 id="RemoveModal{{ $image->id }}">Remove {{ $image->description }} Image</h2>
					  <img src="/img/original/{{ $image->name }}" alt="">
				 		<p>Are you sure you want to remove this image and all it's details from your records?</p>
						@include('forms.removeImage')
				  </div>
	    		
	    		@endforeach	
	    	</ul>
				<hr>
									
				<div class="row">
					<div class="columns">
						<h2>Current Packages</h2>
						<div class="row" data-equalizer="{{ $subbrand->id }}">
							@foreach($subbrand->packages as $package)
            	<div class="columns large-4" >
	             	<h3>{{$package->name}}</h3>
	              <p data-equalizer-watch="{{ $subbrand->id }}">{{$package->description}}</p>
	              <p>Price ${{ $package->price }}</p>
	              <p>Hours {{ $package->hours}}</p>
								@foreach( $package->products as $product)
	              <p>Product: {{ $product->name }}</p>
	              @endforeach
	              <a href="#" data-reveal-id="{{ camel_case($package->name) }}UpdateModal" class="tiny button radius">Update Package</a>
	              <a href="#" data-reveal-id="{{ camel_case($package->name) }}RemoveModal" class="tiny button radius warning">Remove Package</a>
            	</div>
                        	
	           	<div id="{{ camel_case($package->name) }}UpdateModal" class="reveal-modal" data-reveal aria-labelledby="{{ camel_case($package->name) }}" aria-hidden="true" role="dialog">
							  <h2 id="{{ $package->name }}">Update {{ $package->name }} Package</h2>
								@include('forms.updatePackage')
							  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
							</div>

							<div id="{{ camel_case($package->name) }}RemoveModal" class="reveal-modal" data-reveal aria-labelledby="{{ camel_case($package->name) }}" aria-hidden="true" role="dialog">
							  <h2 id="{{ $package->name }}">Remove {{ $package->name }} Package</h2>
						 		<p>Are you sure you want to remove this package and all it's details from your records?</p>
								@include('forms.removePackage')
						  </div>
		          @endforeach
						</div>
				  </div>
        </div>

	    	<div class="row">
	    		<div class="columns">
		    		<h2>Create a new package for the {{$subbrand->name}} Catergory</h2>
		    		
			    	@include('forms.storePackage')
		    		
		    	</div>	
      	</div>

      	<div class="row">
      		<div class="columns">
      			<h2>Add an Existing Package to the {{ $subbrand->name }} Catergory</h2>
      			@include('forms.updateSubbrandPackages')
      		</div>
      	</div>
		    
	    </li>
			@endforeach
		</ul>	
	</div>
</div>

<div class="row">
	<div class="columns">
		<h2>Packages</h2>
		<hr>
		@if( $errors->packageAssociation->first('subbrands'))
			<p class="alert-box warning">{{ $errors->packageAssociation->first('subbrands') }}</p>
		@endif
		@if( $errors->packageAssociation->first('package'))
			<p class="alert-box warning">{{ $errors->packageAssociation->first('package') }}</p>
		@endif
		<ul class="small-block-grid-3">
		@foreach( $packages as $package)
			<li>
				<h3>{{ $package->name }}</h3>
				<h6>Related subbrands</h6>
				<form action="/packageAssociation" method="POST" novalidate>
					{{ csrf_field() }}
					<ul class="small-block-grid-1">
						@forelse( $package->subbrands as $subbrand )
						<li>
							<label for="{{ $subbrand->id }}">{{ $subbrand->name }}
								<input type="checkbox" id="{{ $subbrand->id }}" name="subbrands[]" value="{{ $subbrand->id }}">
							</label>
						</li>
						@empty
							<li>No Subbrands curently associated with this package</li>
						@endforelse
						<li><input type="submit" class="tiny button radius" value="Remove Subbrands"></li>
						<li><a href="#" data-reveal-id="deleteModal{{ $package->id }}" class="tiny button warning radius">Delete Package</a></li>
					</ul>
					<input type="hidden" value="{{ $package->id }}" name="package">
				</form>
			</li>
		@endforeach

		</ul>	
	</div>
</div>	


@foreach( $packages as $package)
<div id="deleteModal{{ $package->id }}" class="reveal-modal" data-reveal aria-labelledby="{{ $package->name }}" aria-hidden="true" role="dialog">
  <h2 id="{{ $package->name }}">{{ $package->name }}</h2>
  <p class="lead">Are you sure you want delete this package?</p>
  <form action="deletePackage" method="POST" novalidate>
  	{{ csrf_field() }}
		<input type="hidden" value="{{ $package->id }}" name="packageId">
		<input type="submit" value="Delete" class="tiny button radius">  	
  </form>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
@endforeach


				
<div class="row">
	<div class="columns">
		@include('ajax.ajax')
	</div>
</div>

@endsection