<!doctype html>
<html class="no-js" lang="en">
  <head>
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
           <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
          <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>

        <section class="top-bar-section">
          <!-- Right Nav Section -->
          <ul class="right">
            <li><a href="/subbrand/weddings">Weddings</a></li>
            <li><a href="/subbrand/portraits">Portraits</a></li>
            <li><a href="/subbrand/seniors">Seniors</a></li>
            <li><a href="/subbrand/commercial">Commercial</a></li>
            <li><a href="/subbrand/models">Models</a></li>
            <li><a href="/gallery">Gallery</a></li>
            <li><a href="/packages">Packages</a></li>
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
                  <li><a href="account">Account Details</a></li>
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
      <p>Copyright Far Edge Studios 2015 &copy;</p>
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
    <script src="/js/ajax.js"></script>
    
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZ0VWodrY3LUSGSa4ECslrhPDCsIHbjmI&libraries=places">
    </script>
    

    <script src="/js/maps.js"></script>
 
  </body>
</html>
