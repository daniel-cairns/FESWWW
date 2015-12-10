@extends('master')
@section('title')
  {{$subbrand->name}}
@endsection
@section('content')
	<div class="slider">
    @foreach( $subbrand->sliders as $slider )
    <div style="background-image: url(/img/original/{{ $slider->name }});"><caption>{{ $slider->description }}</caption></div>
    @endforeach
  </div>

  <div class="caption">
    <h1>{{ ucfirst(trans($subbrand->caption)) }}</h1>
  </div>

  <div class="row" id="{{$subbrand->name}}">
    <div class="columns medium-4">
      <h1 class="left">{{$subbrand->name}}</h1>
    </div>  
      @if( session('message'))
      <div class="alert-box success columns medium-4">{{ session('message')}}</div>
      @endif
      @if( session('error'))
      <div class="alert-box warning columns medium-4">{{ session('error')}}</div>
      @endif
      @if( Auth::check() && Auth::user()->privilege == 'admin')
      <div class="columns medium-4">
        <a href="#" class="tiny button radius amber edit right" data-reveal-id="editModal">Edit Page</a>
      </div>
      @endif
      
    </div>
  </div>

  <div id="editModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    <h2 id="modalTitle">Edit the {{$subbrand->name}} page content.</h2>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    <ul class="tabs" data-tab role="tablist">
      <li class="tab-title active" role="presentation"><a href="#panel2-1" role="tab" tabindex="0" aria-selected="true" aria-controls="panel2-1"><h5>Slider</h5></a></li>
      <li class="tab-title" role="presentation"><a href="#panel2-2" role="tab" tabindex="0" aria-selected="false" aria-controls="panel2-2"><h5>Gallery</h5></a></li>
      <li class="tab-title" role="presentation"><a href="#panel2-3" role="tab" tabindex="0" aria-selected="false" aria-controls="panel2-3"><h5>Caption</h5></a></li>
      <li class="tab-title" role="presentation"><a href="#panel2-4" role="tab" tabindex="0" aria-selected="false" aria-controls="panel2-4"><h5>Description</h5></a></li>
      <li class="tab-title" role="presentation"><a href="#panel2-5" role="tab" tabindex="0" aria-selected="false" aria-controls="panel2-5"><h5>Packages</h5></a></li>
    </ul>
    <div class="tabs-content">
      <section role="tabpanel" aria-hidden="false" class="content active" id="panel2-1">
        <h3>Update Slider</h3>
        @include('forms.updateSlider')
        <h3>Delete from Slider</h3>
        @include('forms.removeSlider')
      </section>
      <section role="tabpanel" aria-hidden="true" class="content" id="panel2-2">
        <ul class="medium-block-grid-4">
        @forelse( $subbrand->images as $image ) 
          <li>
            <div class="row">
              <div class="columns">
                <img src="/img/gallery/{{$image->name}}" alt="{{$image->description}}">
                <span>{{$image->description}}</span>  
              </div>
            </div>

            <div class="row">
              <div class="columns small-6">
                <a href="#" data-reveal-id="UpdateModal{{ $image->id }}" class="tiny button radius">Update Image</a>
              </div>

              <div class="columns small-6"> 
                <a href="#" data-reveal-id="RemoveModal{{ $image->id }}" class="tiny button radius warning">Remove Image</a>      
              </div>
            </div>
          </li>

          <div id="UpdateModal{{ $image->id }}" class="reveal-modal" data-reveal aria-labelledby="UpdateModal{{ $image->id }}" aria-hidden="true" role="dialog">
            <h2 id="UpdateModal{{ $image->id }}">Update Image</h2>
            <ul class="small-block-grid-2">
              <li>
                <h2>Description</h2>
                <p>{{ $image->description }}</p>
              </li>
              <li><img src="/img/gallery/{{ $image->name }}" alt=""></li>
            </ul>
            @include('forms.updateImage')
            <a class="close-reveal-modal" aria-label="Close">&#215;</a>
          </div>

          <div id="RemoveModal{{ $image->id }}" class="reveal-modal" data-reveal aria-labelledby="RemoveModal{{ $image->id }}" aria-hidden="true" role="dialog">
            <h2 id="RemoveModal{{ $image->id }}">Remove {{ $image->description }} Image</h2>
            <img src="/img/original/{{ $image->name }}" alt="">
            <p>Are you sure you want to remove this image and all it's details from your records?</p>
            @include('forms.removeImage')
          </div>
          @empty 
          <li>No images in the gallery yet. Add images on the admin page.</li>
          
          @endforelse 
        </ul>
      </section>
      <section role="tabpanel" aria-hidden="true" class="content" id="panel2-3">
        @include('forms.updateSubbrandCaption')
      </section>
      <section role="tabpanel" aria-hidden="true" class="content" id="panel2-4">
        @include('forms.updateSubbrandDescription')
      </section>
      <section role="tabpanel" aria-hidden="true" class="content" id="panel2-5">
        @forelse($subbrand->packages as $package)
        <div class="columns large-4" >
          <h3>{{$package->name}}</h3>
          <p data-equalizer-watch="{{ $subbrand->id }}">{{$package->description}}</p>
          <p>Price ${{ $package->price }}</p>
          <p>Hours {{ $package->hours}}</p>
          <a href="#" data-reveal-id="{{ camel_case($package->name) }}UpdateModal" class="tiny button radius">Update Package</a>
          <a href="#" data-reveal-id="{{ camel_case($package->name) }}RemoveModal" class="tiny button radius warning">Remove Package</a>
        </div>
                    
        <div id="{{ camel_case($package->name) }}UpdateModal" class="reveal-modal" data-reveal aria-labelledby="{{ camel_case($package->name) }}" aria-hidden="true" role="dialog">
          <h2 id="{{ $package->name }}">Update {{ $package->name }} Package</h2>
          @include('forms.updatePackage')
          <a class="close-reveal-modal" aria-label="Close">&#215;</a>
        </div>

        <div id="{{ camel_case($package->name) }}RemoveModal" class="reveal-modal" data-reveal aria-labelledby="{{ camel_case($package->name) }}" aria-hidden="true" role="dialog">
          <h2 id="{{ $package->name }}">Remove {{ $package->name }} Package</h2>
          <p>Are you sure you want to remove this package and all it's details from your records?</p>
          @include('forms.removePackage')
        </div>
        @empty
        <div class="columns large-4" >
          <p>No packages yet. Add a package on the admin page.</p>
        </div>
        @endforelse
      </section>
    </div>
  </div>

  <div class="row">
    <div class="columns">
      <p>{{$subbrand->description}}</p>
    </div>
  </div>
  
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
  
  @if( count($subbrand->packages) > 0 )
  <div class="row" >
    <div class="columns">
      @if( Request::is('subbrand/commercial'))
      <h2>Pricing Options</h2>
      @else
      <h2>Packages</h2>
      @endif
      <div class="row" data-equalizer>
      @forelse($subbrand->packages as $package)
            
        <div class="columns medium-6 large-4" >
          <h3>{{$package->name}}</h3>
          <p data-equalizer-watch>{{$package->description}}</p>
          <a href="/subbrand/{{$subbrand->slug }}/{{$package->slug}}" class="tiny button radius amber">package details</a>
        </div>
      
      @empty
        
        <div class="columns">
          <h6>Sorry there are no packages for the {{ $subbrand->name }} category</h6>
        </div>
          
      @endforelse
      </div>
    </div>
  </div>
  @endif

@endsection