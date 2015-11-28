<form action="/updateSlider" method="POST" enctype="multipart/form-data" novalidate>
	{{ csrf_field() }}
	<ul class="small-block-grid-5">
	@forelse( $subbrand->images as $image )
		
		<li>
			<div>
				<label for="image{{ $image->id }}">{{ $image->description }}
				<img src="/img/gallery/{{ $image->name }}" alt="{{ $image->description }}"></label>	
			</div>
			
			<div>
				<input type="checkbox" value="{{ $image->id }}" id="image{{ $image->id }}" name="image[]">
			</div>
		</li>
		
		@empty	
		<li>No slider images yet. Add images to the gallery on the admin page.</li>
	@endforelse
	</ul>
	
	<div>
		@if($errors->updateSlider->first('image'))
    <span class="alert-box warning">{{$errors->updateSlider->first('image')}}</span>
    @endif

		@if($errors->updateSlider->first('subbrand'))
    <span class="alert-box warning">{{$errors->storeSlider->first('subbrand')}}</span>
    @endif

  </div>
  
	<input type="hidden" value="{{ $subbrand->slug }}" name="subbrandSlug">
	<input type="hidden" value="{{ $subbrand->id }}" name="subbrandId">
	<input type="submit" value="Add images to slider" class="tiny button radius">
</form>