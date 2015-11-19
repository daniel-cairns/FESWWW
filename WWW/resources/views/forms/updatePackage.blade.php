<form action="updatePackage" method="POST" enctype="multipart/form-data" novalidate>
  {{ csrf_field() }}

	<div>
		<label for="name">Title/Name</label>
		<input type="text" name="name" id="name" value="{{ old($package->name) }}" placeholder="{{ $package->name }}">
	</div>
	@if($errors->updatePackage->first('name'))
		<span class="alert-box warning">{{$errors->updatePackage->first('name')}}</span>
	@endif
	
	<div>
		<label for="description">Description</label>
		<input type="text" name="description" id="description" value="{{ old($package->description) }}" placeholder="{{ $package->description }}">
	</div>
	@if($errors->updatePackage->first('description'))
		<span class="alert-box warning">{{$errors->updatePackage->first('description')}}</span>
	@endif
	
	<div>
		<label for="price">Price</label>
		<input type="number" name="price" id="price" value="{{ old($package->price) }}" placeholder="{{ $package->price }}">
	</div>
	@if($errors->updatePackage->first('price'))
		<span class="alert-box warning">{{$errors->updatePackage->first('price')}}</span>
	@endif

	<div>
		<label for="hours">Hours</label>
		<input type="number" name="hours" id="hours" value="{{ old($package->hours) }}" placeholder="{{ $package->hours }}">
	</div>
	@if($errors->updatePackage->first('hours'))
		<span class="alert-box warning">{{$errors->updatePackage->first('hours')}}</span>
	@endif
	
	<div>
		<label for="product">Product</label>
		<select name="product" id="product">
			<option value="">Current product {{ $package->product }}...</option>	
			@foreach( $products as $product )
				<option value="{{ $product->id }}">{{ $product->name }}</option>
			@endforeach
		</select>
	</div>
	@if($errors->updatePackage->first('product'))
		<span class="alert-box warning">{{$errors->updatePackage->first('product')}}</span>
	@endif

	<input type="hidden" value="{{ $package->id }}" name="package">
	<input type="submit" value="Update the Package" name="updatePackage" class="tiny button radius">
</form>