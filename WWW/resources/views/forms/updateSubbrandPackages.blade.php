<form action="/updateSubbrandPackages" method="POST" novalidate>
	{{ csrf_field() }}
	<ul class="small-block-grid-4">
	@foreach( $packages as $package)
		<li>
			<label for="packageId{{ $package->id }}"><h5>{{ $package->name }}</h5></label>
			<input type="checkbox" name="packageId[]" id="packageId{{ $package->id }}" value="{{ $package->id }}">
			<input type="hidden" name="subbrandId[]" value="{{ $subbrand->id }}">
		</li>
	@endforeach
	</ul>
	<input type="submit" class="tiny button radius">
</form>