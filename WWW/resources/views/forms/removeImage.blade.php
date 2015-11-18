<form action="removeImage" method="POST" novalidate>
	{{ csrf_field() }}
	<input type="hidden" value="{{ $image->id }}" name="image_id">
	<input type="hidden" value="{{ $subbrand->id }}" name="subbrand_id">
	<input type="submit" class="tiny button radius" name="removeImage" value="Yes">
	@if($errors->removeImage->first('image_id'))
		<span class="alert-box warning">{{$errors->removeImage->first('image_id')}}</span>
	@endif
	<a href="" class="tiny button radius" aria-label="Close">No</a>
</form>