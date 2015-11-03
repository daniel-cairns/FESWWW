@extends('master')

@section('content')
  <div class="row" id="seniors">
    <div class="columns">
      <h1>Seniors</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse repellendus, molestias. Blanditiis rerum laboriosam quibusdam maxime rem, perspiciatis fugit voluptatum inventore quisquam possimus eaque dolores odio quis, harum cum nostrum.</p>
    </div>
  </div>

  <div class="row">
    <div class="columns">
      
    </div>
  </div>

  <div class="row">
    <div class="columns">
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

  <div class="row">
    <div class="columns">
      <h2>Packages</h2>
      <ul class="small-block-grid-1 medium-block-grid-3">
        <li>
          <h3>package</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet sapiente soluta tenetur excepturi rem, maiores natus deserunt ratione! Ex enim libero perferendis, quis ratione ducimus impedit molestias ipsa, temporibus animi.</p>
          <a href="packages.html" class="tiny button radius amber">package details</a>
        </li>
        <li>
          <h3>package</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam laudantium quas iusto autem porro quibusdam assumenda ipsum atque animi inventore deleniti sapiente beatae veritatis, nobis eius quis blanditiis odio nulla.</p>
          <a href="packages.html" class="tiny button radius amber">package details</a>
        </li>
        <li>
          <h3>package</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error itaque sit deleniti porro recusandae, voluptate. Eveniet, quaerat ullam reprehenderit, sapiente, consequatur rerum esse dolores, mollitia placeat sint at repellat excepturi.</p>
          <a href="packages.html" class="tiny button radius amber">package details</a>
        </li>
      </ul>
    </div>
  </div>


@endsection