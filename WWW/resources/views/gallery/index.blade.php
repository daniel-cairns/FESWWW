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
      <ul class="small-block-grid-2 medium-block-grid-4">
      @foreach( $subbrand->images as $image)
        <li>
          <a href="#" data-reveal-id="{{studly_case($image->description)}}Modal">
            <img src="img/gallery/{{$image->name}}" alt="{{$image->description}}">
            <p>{{$image->description}}</p>
          </a>
        </li>     
      @endforeach
      </ul>
    </div>
  </div>
  @endforeach
  
  @foreach( $subbrands as $subbrand)
    @foreach( $subbrand->images as $image)
      <div id="{{studly_case($image->description)}}Modal" class="reveal-modal" data-reveal aria-labelledby="{{$image->id}}" aria-hidden="true" role="dialog">
        <h2 id=""></h2>
        <img src="/img/gallery/{{$image->name}}" alt="">
        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
      </div>
    @endforeach
  @endforeach  
<script>
  
</script>
@endsection