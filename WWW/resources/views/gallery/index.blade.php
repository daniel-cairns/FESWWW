@extends('master')
@section('title')
  Gallery
@endsection
@section('content')
  <div class="row">
    <div class="columns">
      <h1>Gallery</h1> 
    </div>
  </div>
  @foreach( $subbrands as $subbrand)
  <div class="row">
    <div class="columns">
      <h2>{{$subbrand->name}}</h2>
      <div class="row gallerySlider">
      @forelse( $subbrand->images as $image )
      <div class="columns large-3">
        <a href="#" data-reveal-id="modal{{ $image->id }}">
          <img src="/img/gallery/{{$image->name}}" alt="{{ $image->description }}">
        </a>
      </div>
      @empty
      <div class="columns">
        <h6>Sorry there a no images found for the {{ $subbrand->name }} category.</h6>
      </div>   
      @endforelse
      </div>
        @foreach( $subbrand->images as $image )
        <div id="modal{{ $image->id }}" class="reveal-modal" data-reveal aria-labelledby="modal{{ $image->id }}" aria-hidden="true" role="dialog">
            <h2 id="modal{{ $image->id }}">{{ $image->description }}</h2>
            <img src="/img/original/{{$image->name}}" alt="">
            <a class="close-reveal-modal" aria-label="Close">&#215;</a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endforeach
 
  
<script>
  
</script>
@endsection