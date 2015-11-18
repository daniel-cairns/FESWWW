<form action="/updateCaption" method="POST" novalidate>
	{{ csrf_field() }}
	<label for="caption"><h3>Edit Caption</h3></label>
	<input type="text" id="caption" name="caption">
	<input type="hidden" value="{{$subbrand->slug}}" name="subbrandSlug">
	<input type="hidden" value="{{$subbrand->id}}" name="subbrandId">
	<input type="submit" value="Update Caption" name="updateCaption" class="tiny button radius">
</form>