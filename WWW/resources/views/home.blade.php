<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FES | Homepage</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto|Monsieur+La+Doulaise|Codystar|Monda|Great+Vibes' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/foundation.css" />
    <link rel="stylesheet" href="css/styles-landing.css" />
    <script src="/js/vendor/modernizr.js"></script>
  </head>
  <body>
  
  @if( !Auth::check())
  <div id="landing">
    <h1><img src="img/logo/logo.png" alt=""></h1>
    <div>
      <h2 id="enter">Enter</h2>
    </div>  
  </div>
  @endif
  
  @if( !Auth::check())
  <div id="logo">
    <img src="img/logo/logo.png" alt="">
    <a href="#" data-reveal-id="loginModal">Login</a>
    <a href="#" data-reveal-id="registerModal">Register</a>
  </div>
  @else
  <div id="logo" style="display:block;">
    <img src="img/logo/logo.png" alt="">
    <li><a href="#" data-reveal-id="logoutModal">Logout</a></li>
  </div>
  @endif

  <div id="loginModal" class="reveal-modal" data-reveal aria-labelledby="modaltitle" aria-hidden="true" role="dialog">
    <form action="/auth/login" method="post" novalidate>
      {{csrf_field()}}

      <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="email@photos.com" value="{{ old('email') }}">
        {{ $errors->first('email')}}
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        {{ $errors->first('password')}}
      </div>
      <input type="submit" value="Login" class="tiny button">
    </form>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
  </div>

  <div id="registerModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    <form action="/auth/register" method="post" novalidate>
      {{csrf_field()}}

      <div>
        <label for="name">Username</label>
        <input type="text" name="name" id="name" placeholder="Your Username" value="{{ old('name') }}">
        {{ $errors->first('name')}}
      </div>
      <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="email@photos.com" value="{{ old('email') }}">
        {{ $errors->first('email')}}
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        {{ $errors->first('password')}}
      </div>
      <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation">
      </div>
      <div>
        <input type="hidden" name="privilege" value="user">
      </div>
      <input type="submit" value="Register" class="tiny button">
    </form>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
  </div>

  <div id="logoutModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    <h2>Logout?</h2>
    <a href="/auth/logout" class="tiny button radius">YES</a>
    <a href="" class="tiny button radius" aria-label="Close">NO</a>
  </div>
    
    <div id="content" class="clearfix">
      
      @foreach( $subbrands as $subbrand )
      <div id="{{$subbrand->name}}" class="image-box clearfix">
        <img src="img/landing/{{$subbrand->photo}}" alt="{{$subbrand->name}} landing image">
        <div class="hover-window">  
          <div class="hover-window-text">
            <a href="subbrand/{{ $subbrand->slug }}"><h1>{{$subbrand->name}}</h1>
            <p>{{$subbrand->landing_description}}</p></a>
            
            @if( Auth::check() && Auth::user()->privilege == 'admin')
            <a href="#" data-reveal-id="{{$subbrand->name}}Modal">edit</a>
            @endif

          </div>
        </div>  
      </div>

      <div id="{{$subbrand->name}}Modal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
        <h2 id="modalTitle">{{$subbrand->name}} Image Update</h2>
        
        <form action="/home" method="post" enctype="multipart/form-data" novalidate>
          {{ csrf_field() }}
          <div>
            <label for="landing_description">Caption</label>
            <input type="text" id="landing_description" name="landing_description" value="{{$subbrand->landing_description}}">
            {{$errors->first('landing_description')}}
          </div>

          <div>
            <label for="photo">Image</label>
            <input type="file" name="photo" class="tiny button radius">
            {{$errors->first('photo')}}
          </div>
           <input type="hidden" name="subbrandName" value="{{$subbrand->name}}">      
          <input type="submit" value="Update {{$subbrand->name}} landing page content" name="landing" class="tiny button radius">

        </form>
        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
      </div>
      @endforeach
          
    </div>  <!-- end #content -->
    
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
    <script>
      $("#enter").click(function(){
        $("#landing").toggle("slow");
        $("#logo").toggle("slow");
      });
    </script>
  </body>
</html>