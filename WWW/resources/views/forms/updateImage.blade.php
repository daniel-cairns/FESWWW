<form action="updateImage" enctype="multipart/form-data" method="POST" novalidate>
	{{ csrf_field() }}
	<div>
		<label for="image">Image Update</label>
		<input type="file" id="image" name="photo" class="tiny button radius" >		
	</div>
	@if($errors->updateImage->first('image'))
		<span class="alert-box warning">{{$errors->updateImage->first('image')}}</span>
	@endif

	<div>
		<label for="description">Description Update</label>
		<input type="text" id="description" name="description" value="{{ old($image->description) }}" placeholder="{{ $image->description }}">
	</div>
	
	@if($errors->updateImage->first('description'))
		<span class="alert-box warning">{{$errors->updateImage->first('description')}}</span>
	@endif

	@if($errors->updateImage->first('image'))
		<span class="alert-box warning">{{$errors->updateImage->first('image')}}</span>
	@endif

	@if($errors->updateImage->first('subbrand'))
		<span class="alert-box warning">{{$errors->updateImage->first('subbrand')}}</span>
	@endif
		
	<input type="hidden" value="{{ $image->id }}" name="image">
	<input type="hidden" value="{{ $subbrand->id }}" name="subbrand">
	<input type="hidden" name="MAX_FILE_SIZE" value="5000000">
	<input type="submit" value="Update Image" name="updateImage" class="tiny button radius">
</form>