<form action="/removePackage" method="POST">
{{ csrf_field() }}

	<input type="hidden" value="{{ $package->id }}" name="package_id">

	<input type="hidden" value="{{ $subbrand->id }}" name="subbrand_id">

	<input type="submit" class="tiny button radius" name="removePackage" value="Yes">

	@if($errors->removePackage->first('package_id'))
		<span class="alert-box warning">{{$errors->removePackage->first('package_id')}}</span>
	@endif

	@if($errors->removePackage->first('subbrand_id'))
		<span class="alert-box warning">{{$errors->removePackage->first('subbrand_id')}}</span>
	@endif

	<a href="" class="tiny button radius" aria-label="Close">No</a>
		
</form>