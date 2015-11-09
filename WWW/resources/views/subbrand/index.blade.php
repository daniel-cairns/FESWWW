@extends('master')
@section('title')

@section('content')
	<div class="slider">
    <div style="background-image: url(/img/slider/commercial.jpg);"><caption>capture your day</caption></div>
    <div style="background-image: url(/img/slider/wedding1.jpg);"><caption>capture your day</caption></div>
    <div style="background-image: url(/img/slider/wedding2.jpg);"><caption>capture your day</caption></div>
  </div>

  <div class="caption">
    <h1>{{$result->caption}}</h1>
  </div>

  <div class="row" id="{{$result->name}}">
    <div class="columns">
      <h1 class="left">{{$result->name}}</h1>
      
      @if( Auth::check() && Auth::user()->privilege == 'admin')
      <a href="" class="tiny button radius amber edit right" data-reveal-id="editModal">Edit Page</a>
      @endif
      
    </div>
  </div>

  <div id="editModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    <h2 id="modalTitle">Edit {{$result->name}}</h2>
    <h3>Slider</h3>
    <h3>Gallery</h3>
    <h3>Caption</h3>
    <h3>Description</h3>
    <h3>Packages</h3>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
  </div>

  <div class="row">
    <div class="columns">
      <p>{{$result->description}}</p>
    </div>
  </div>
  
  <div class="row">
    <div class="columns">
      <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">
        <li><a href="#" data-reveal-id="myModal"><img src="/img/gallery/wed-page-cut-2.jpg" alt=""></a></li>
        <li><a href="#" data-reveal-id="myModal"><img src="/img/gallery/wed-page-cut-3.jpg" alt=""></a></li>
        <li><a href="#" data-reveal-id="myModal"><img src="/img/gallery/wed-page-cut.jpg" alt=""></a></li>
      </ul>
    </div>
  </div>

  <div id="myModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    <div class="fade">
      <div class="row">
        <div class="columns">
          <div><img src="/img/gallery/wed-page-cut-2.jpg" alt=""></div>
          <div><img src="/img/gallery/wed-page-cut-3.jpg" alt=""></div>
          <div><img src="/img/gallery/wed-page-cut.jpg" alt=""></div>
        </div>  
      </div> 
 
    </div>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
  </div>

  <div class="row" >
    <div class="columns">
      <h2>Packages</h2>
      <div class="row" data-equalizer>
        @foreach($brandPackage as $package)
            
            <div class="columns medium-6 large-4" >
              <h3>{{$package->name}}</h3>
              <p data-equalizer-watch>{{$package->description}}</p>
              <a href="/packages/{{$package->name}}" class="tiny button radius amber">package details</a>
            </div>
            
        @endforeach
      </div>
      
    </div>
  </div>
@endsection