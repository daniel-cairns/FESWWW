@extends('master')

@section('content')
  <div class="row">
    <div class="columns">
        
    </div>
  </div>

  <div class="row">
    <div class="columns">
      <h1>Gallery</h1>
      <h2>Weddings</h2>

      <ul class="small-block-grid-2 medium-block-grid-4">
        <li><a href="#" data-reveal-id="myModal"><img src="img/gallery/wed-page-cut-2.jpg" alt=""></a></li>
        <li><a href="#" data-reveal-id="myModal"><img src="img/gallery/wed-page-cut-3.jpg" alt=""></a></li>
        <li><a href="#" data-reveal-id="myModal"><img src="img/gallery/wed-page-cut.jpg" alt=""></a></li>
      </ul>
    </div>
  </div>

  <div class="row">
    <div class="columns">
      <h2>Portraits</h2>  
      <ul class="small-block-grid-2 medium-block-grid-4">
        <li><a href="#" data-reveal-id="myModal"><img src="img/gallery/wed-page-cut-2.jpg" alt=""></a></li>
        <li><a href="#" data-reveal-id="myModal"><img src="img/gallery/wed-page-cut-3.jpg" alt=""></a></li>
        <li><a href="#" data-reveal-id="myModal"><img src="img/gallery/wed-page-cut.jpg" alt=""></a></li>
      </ul>
    </div>
  </div>

  <div id="myModal" class="reveal-modal grey" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    <div class="fade">
      <div><img src="img/gallery/wed-page-cut-2.jpg" alt=""></div>
      <div><img src="img/gallery/wed-page-cut-3.jpg" alt=""></div>
      <div><img src="img/gallery/wed-page-cut.jpg" alt=""></div>
    </div>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
  </div>
@endsection