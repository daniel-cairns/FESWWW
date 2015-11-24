<form action="/updateDescription">
	{{ csrf_field() }}
	<label for="description"><h3>Edit Description</h3></label>
	<input type="text" id="description" name="description" placeholder="{{ $subbrand->description}}">
	<input type="hidden" value="{{$subbrand->slug}}" name="subbrandSlug">
	<input type="hidden" value="{{$subbrand->id}}" name="subbrandId">
	<input type="submit" value="Update Description" name="updateDescription" class="tiny button radius">
</form>