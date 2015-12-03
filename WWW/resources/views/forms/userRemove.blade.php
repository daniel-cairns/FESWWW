<form action="userRemove" method="POST" novalidate>
	{{ csrf_field() }}
	
	<input type="hidden" value="" id="userRemove" name="userId">
	<input type="submit" value="Remove User" class="tiny button radius">
	
	@if( $errors->userRemove->first('userId'))
		<span class="alert-box warning">{{$errors->userRemove->first('userId')}}</span>
	@endif

</form>