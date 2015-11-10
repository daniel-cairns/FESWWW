@extends('master')
@section('title')
	Admin
@endsection
@section('content')
	<div class="row">
		<div class="columns">
			<h1>Admin</h1>
			@foreach( $users as $user)
			{{$user->name}}
			@endforeach
		</div>
	</div>
	
	@foreach($images as $image) 
	{{$image->name}}
	{{$image->description}}
	@endforeach
	
	<div class="row">
		<div class="columns">
		<form action="admin" method="post" enctype="multipart/form-data" novalidate>
	    {{ csrf_field() }}
	    <div>
	      <label for="photo">Image</label>
	      <input type="file" name="photo" class="tiny button radius">
	      {{$errors->first('photo')}}
	    </div>

	    <div>
	      <label for="description">Image Description</label>
	      <input type="text" id="description" name="description" placeholder="Image Description">
	      {{$errors->first('description')}}
	    </div>

	    <div>
	    		
	    </div>
	          
	    <input type="submit" value="Upload a new Image" name="image" class="tiny button radius">
    </form>
		</div>
	</div>
	
@endsection