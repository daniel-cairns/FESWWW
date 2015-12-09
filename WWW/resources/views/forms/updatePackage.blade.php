<form action="/updatePackage" method="POST" enctype="multipart/form-data" novalidate>
  {{ csrf_field() }}

	<div>
		<label for="name">Title/Name</label>
		<input type="text" name="name" id="name" value="{{ old('name') ? old('name') : $package->name }}" placeholder="{{ $package->name }}">
	</div>
	@if($errors->updatePackage->first('name'))
		<span class="alert-box warning">{{$errors->updatePackage->first('name')}}</span>
	@endif
	
	<div>
		<label for="description">Description</label>
		<textarea type="text" name="description" id="description" placeholder="{{ $package->description }}">{{ old('description') ? old('description') : $package->description }}</textarea>
	</div>
	@if($errors->updatePackage->first('description'))
		<span class="alert-box warning">{{$errors->updatePackage->first('description')}}</span>
	@endif
	
	<div>
		<label for="price">Price</label>
		<input type="number" name="price" id="price" value="{{ old('price') ? old('price') : $package->price }}" placeholder="{{ $package->price }}">
	</div>
	@if($errors->updatePackage->first('price'))
		<span class="alert-box warning">{{$errors->updatePackage->first('price')}}</span>
	@endif

	<div>
		<label for="hours">Hours</label>
		<input type="number" name="hours" id="hours" value="{{ old('hours') ? old('hours') : $package->hours }}" placeholder="{{ $package->hours }}">
	</div>
	@if($errors->updatePackage->first('hours'))
		<span class="alert-box warning">{{$errors->updatePackage->first('hours')}}</span>
	@endif
	
	<div>
		<label for="product">Product</label>
		<select name="product" id="product">
			<option>Current product {{ $package->product }}...</option>	
			@foreach( $products as $product )
				<option value="{{ $product->id }}">{{ $product->name }}</option>
			@endforeach
		</select>
	</div>
	@if($errors->updatePackage->first('product'))
		<span class="alert-box warning">{{$errors->updatePackage->first('product')}}</span>
	@endif
	@if($errors->updatePackage->first('package'))
		<span class="alert-box warning">{{$errors->updatePackage->first('package')}}</span>
	@endif
	


	<input type="hidden" value="{{ $package->id }}" name="package">

	<input type="submit" value="Update the Package" name="updatePackage" class="tiny button radius">
</form>