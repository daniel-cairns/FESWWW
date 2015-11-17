<form action="storePackage" method="POST" novalidate>
	{{ csrf_field() }}
	<div class="row">
		<div class="columns large-6">
			<label for="name">Package Name</label>
			<input type="text" id="name" name="name">
			@if(count($errors) > 0)
		  <span class="alert-box warning">{{$errors->first('name')}}</span>
		  @endif
		</div>

		<div class="columns large-6">
			<label for="price">Price</label>
			<input type="number" id="price" name="price" min="1" max="10000">
			@if(count($errors) > 0)
		  <span class="alert-box warning">{{$errors->first('price')}}</span>
		  @endif
		</div>
				    		
		<div class="columns large-6">
			<label for="hours">Hours</label>
			<input type="number" id="hours" name="hours" min="1" max="9">
			@if(count($errors) > 0)
		  <span class="alert-box warning">{{$errors->first('hours')}}</span>
		  @endif	
		</div>

		<div class="columns large-6">
			<label for="product">Product</label>
			<select name="product" id="product" name="product">
				<option>Select a product type</option>
				@foreach( $products as $product)
					<option value="{{ $product->id }}">{{ $product->name }}</option>
				@endforeach	
			</select>
			@if(count($errors) > 0)
		  <span class="alert-box warning">{{$errors->first('product')}}</span>
		  @endif
		</div>

		<div class="columns large-6">		
			<input type="submit" value="Upload new package" class="tiny button radius">
		</div>

		<div class="columns large-6">
			<label for="description">Description</label>
			<textarea id="description" name="description"></textarea>
		</div>
	</div>			    		
	
	<input type="hidden" value="{{ $subbrand->id }}" name="subbrand">
	<input type="hidden" value="package" name="package">
</form>