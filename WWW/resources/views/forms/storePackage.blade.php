<form action="/storePackage" method="POST" novalidate>
	{{ csrf_field() }}
	<div class="row">
		<div class="columns large-6">
			<label for="name">Package Name</label>
			<input type="text" id="name" name="name" value="{{ old('name') }}">
			@if($errors->storePackage->first('name'))
		  <span class="alert-box warning">{{$errors->storePackage->first('name')}}</span>
		  @endif
		</div>

		<div class="columns large-6">
			<label for="price">Price</label>
			<input type="number" id="price" name="price" min="1" max="10000" value="{{ old('price') }}">
			@if($errors->storePackage->first('price'))
		  <span class="alert-box warning">{{$errors->storePackage->first('price')}}</span>
		  @endif
		</div>
				    		
		<div class="columns large-6">
			<label for="hours">Hours</label>
			<input type="number" id="hours" name="hours" min="1" max="9" value="{{ old('hours') }}">
			@if($errors->storePackage->first('hours'))
		  <span class="alert-box warning">{{$errors->storePackage->first('hours')}}</span>
		  @endif	
		</div>

		<div class="columns large-6">
			<label for="description">Description</label>
			<textarea id="description" name="description" value="{{ old('description') }}"></textarea>
			@if($errors->storePackage->first('description'))
		  <span class="alert-box warning">{{$errors->storePackage->first('description')}}</span>
		  @endif

		  @if($errors->storePackage->first('subbrand'))
		  <span class="alert-box warning">{{$errors->storePackage->first('subbrand')}}</span>
		  @endif
		</div>

		<div class="columns large-6">		
			<input type="submit" value="Upload new package" class="tiny button radius">
		</div>
	</div>			    		
	
	<input type="hidden" value="{{ $subbrand->id }}" name="subbrand">
	<input type="hidden" value="package" name="package">
</form>