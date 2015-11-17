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