@extends('master')
@section('title')
	Admin
@endsection
@section('content')
	<div class="row">
		<div class="columns">
			<h1>Administration Page</h1>
			<div class="row">
				<div class="columns">
					<h2>Clients</h2>
					<select name="" id="">
						@foreach( $users as $user)
						<option value="{{$user->id}}">{{$user->name}}</option>
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="row">
				<div class="columns">
				@foreach( $subbrands as $subbrand )
					<ul class="accordion" data-accordion="myAccordionGroup">
				    <li class="accordion-navigation">
				      <a href="#panel{{$subbrand->id}}"><h2>{{$subbrand->name}}</h2></a>
				      <div id="panel{{$subbrand->id}}" class="content">
								<form action="admin" enctype="multipart/form-data" novalidate>
									{{ csrf_field() }}
							    <div class="row">
										
										<div class="columns">
											<h2>Upload an Image to the {{$subbrand->name}} page</h2>
										</div>		
							      
							      <div class="columns large-6">
								      <label for="photo"><h2>Image</h2></label>
								      <input type="file" name="photo" class="tiny button radius">
								      {{$errors->first('photo')}}
								    </div>

								    <div class="columns large-6">
								      <label for="description"><h2>Image Description</h2></label>
								      <input type="text" id="description" name="description" placeholder="Image Description">
								      {{$errors->first('description')}}
								    </div>
								  </div>  
		          		
		          		<input type="hidden" value="{{$subbrand->id}}" name="subbrand">
							    <input type="submit" value="Upload a new Image" name="image{{$subbrand->id}}" class="tiny button radius">
								</form>
								<hr>
					      <h2>Current Images</h2>
					      <ul class="medium-block-grid-4">
					    		@foreach( $subbrand->images as $image )	
					    		<li>
					    			<img src="/img/original/{{$image->name}}" alt="{{$image->description}}">
					    			<span>{{$image->description}}</span>
					    		</li>
					    		@endforeach	
					    	</ul>
				      </div>
				    </li>
				  </ul>
  			@endforeach		
				</div>
			</div>
	
		</div>	
	</div>
@endsection