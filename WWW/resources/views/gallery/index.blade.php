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
  @foreach( $images as $image)
  <img src="img/original/{{$image->name}}" alt="">
  <p>{{$image->description}}</p>
  @endforeach
  @foreach( $subbrands as $subbrand)

  <div class="row">
    <div class="columns">
      
      <h2>{{$subbrand->name}}</h2>

      <ul class="small-block-grid-2 medium-block-grid-4">
        <li><a href="#" data-reveal-id="myModal"><img src="img/gallery/wed-page-cut-2.jpg" alt=""></a></li>
        <li><a href="#" data-reveal-id="myModal"><img src="img/gallery/wed-page-cut-3.jpg" alt=""></a></li>
        <li><a href="#" data-reveal-id="myModal"><img src="img/gallery/wed-page-cut.jpg" alt=""></a></li>
        <li><a href="#" data-reveal-id="myModal"><img src="img/gallery/wed-page-cut.jpg" alt=""></a></li>
      </ul>
    </div>
  </div>

  @endforeach
  
@endsection