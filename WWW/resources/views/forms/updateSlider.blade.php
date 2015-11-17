<form action="/updateSlider" method="POST" enctype="multipart/form-data" novalidate>
	{{ csrf_field() }}
	<ul class="small-block-grid-5">
	@foreach( $subbrand->images as $image )
		<li>
			<div>
				<label for="image{{ $image->id }}">{{ $image->description }}</label>
			</div>
			<div>
				<img src="/img/gallery/{{ $image->name }}" alt="{{ $image->description }}">
			</div>
			<div>
				<input type="checkbox" value="{{ $image->id }}" id="image{{ $image->id }}">		
			</div>
		</li>	
	@endforeach	
	</ul>
	<input type="hidden" value="{{ $subbrand->id }}" name="subbrand">
	<input type="submit" value="Add images to slider" class="tiny button radius">
</form>