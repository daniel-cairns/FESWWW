<form action="/removeSlider" method="POST" novalidate>
	{{ csrf_field() }}
	<ul class="small-block-grid-5">
	@foreach( $subbrand->sliders as $slider )
		<li>
			<div>
				<label for="slider{{ $slider->id }}">{{ $slider->description }}
				<img src="/img/gallery/{{ $slider->name }}" alt="{{ $slider->description }}"></label>	
			</div>
			
			<div>
				<input type="checkbox" value="{{ $slider->id }}" id="slider{{ $slider->id }}" name="slider[]">
			</div>
		</li>
  @endforeach	
	</ul>

	<div>
		@if($errors->removeSlider->first('slider'))
    <span class="alert-box warning">{{$errors->removeSlider->first('slider')}}</span>
    @endif

		@if($errors->removeSlider->first('subbrand'))
    <span class="alert-box warning">{{$errors->removeSlider->first('subbrand')}}</span>
    @endif
  </div>
  
	<input type="hidden" value="{{ $subbrand->slug }}" name="subbrandSlug">
	<input type="hidden" value="{{ $subbrand->id }}" name="subbrandId">
	<input type="submit" value="Remove images from slider" class="tiny button radius warning">
</form>