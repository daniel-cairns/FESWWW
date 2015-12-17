<!doctype html>
<html class="no-js" lang="en">
  <head>
    @if( Request::is('/admin/') || Request::is('/account/'))
    <meta name="robots" content="noindex">
    @endif
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FES | @yield('title')</title>
    <!--[if lt IE 9]><scriptsrc="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link href='https://fonts.googleapis.com/css?family=Roboto|Monsieur+La+Doulaise' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/foundation.css"/>
    <link rel="stylesheet" type="text/css" href="/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/slick/slick-theme.css"/>
    <link rel="stylesheet" href="/css/jquery-ui.css">  
    <link rel="stylesheet" href="/css/styles.css">
    <link href='https://api.mapbox.com/mapbox.js/v2.2.3/mapbox.css' rel='stylesheet'/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="/js/vendor/modernizr.js"></script>
    
  </head>

  <body>
    <header>
      
      <div class="heading clearfix">
        <h1><a href="/"><img src="/img/logo/logo.png" alt="Far Edge Studios Logo"></a></h1>
      </div>
    
      <nav class="top-bar" data-topbar role="navigation">
        <ul class="title-area">
          <li class="name">
            <h1><a href="/landing"></a></h1>
          </li>
           
          <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>

        <section class="top-bar-section">
          
          <ul class="right">
            @foreach( \App\Subbrand::all() as $subbrand)
            <li><a href="/subbrand/{{ $subbrand->slug }}">{{ $subbrand->name }}</a></li>
            @endforeach
            <li><a href="/gallery">Gallery</a></li>
            @if( Auth::check() && Auth::user()->privilege == 'admin' )
            <li><a href="/packages">Packages</a></li>
            @endif
            <li><a href="/about">About Us</a></li>
            <li><a href="/contact">Contact Us</a></li>
            <li class="has-dropdown">
              @if( Auth::check())
              <a href="/account">{{ Auth::user()->name }}</a>
              @else
              <a href="/auth/register">Account</a>
              @endif
              <ul class="dropdown">
                @if( !Auth::check())
                <li><a href="#" data-reveal-id="loginModal">Login</a></li>
                <li><a href="#" data-reveal-id="registerModal">Register</a></li>
                @else
                <li><a href="#" data-reveal-id="logoutModal">Logout</a></li>
                  @if( Auth::check() && Auth::user()->privilege == 'admin')
                  <li><a href="/admin">Admin</a></li>
                  @else
                  <li><a href="/account">Account Details</a></li>
                  @endif
                @endif
              </ul>
            </li>
          </ul>

          <div id="loginModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
            @include('forms.login')
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
          </div>

          <div id="logoutModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
            <h2>Logout?</h2>
            <a href="/auth/logout" class="tiny button radius">YES</a>
            <a href="" class="tiny button radius" aria-label="Close">NO</a>
          </div>
                  
        </section>  
      </nav>
    </header>
    
    <main>
    
      @yield('content')      

    </main>
  
    <footer>
      <div class="row">
        <div class="columns large-4">
          <p>Copyright Far Edge Studios {{ date('Y')}} &copy;</p>
        </div>
        <div class="columns large-4">
          <ul>
            <li><h6><a href="">Contact Us</a></h6></li>
            <li><a href="mailto:{{ \App\About::first()->email }}">Email <i class="fa fa-envelope"> {{ \App\About::first()->email }}</i></a></li>
            <li><a href="tel:{{ \App\About::first()->phone }}">Phone <i class="fa fa-phone-square"> {{ \App\About::first()->phone }}</i></a></li>
          </ul>
        </div>
        <div class="columns large-4">
          <ul>
            <li><a href="/sitemap">Sitemap</a></li>
          </ul>
        </div>
      </div>
    </footer>
  
    
   
    <script src="/js/vendor/jquery.js"></script>
    <script src="/js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/slick/slick.min.js"></script>
    <script src="/js/jquery-ui.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="/js/slider.js"></script>
    @if( Request::is('admin'))
    <script src="/js/ajax.js"></script>
    @endif
    @if( Request::is('*/order'))
      <script src="https://maps.googleapis.com/maps/api/js?callback=initMap&libraries=places"
        async defer></script>
      <script src="/js/maps.js"></script>
    @endif
    @if( Request::is('account'))
    <script src="https://maps.googleapis.com/maps/api/js?callback=initMap&libraries=places"
        async defer></script>
    <script src="/js/account.js"></script>  
    @endif 
    
  </body>
</html>
