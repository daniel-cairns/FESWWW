<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FES | Weddinggs</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto|Monsieur+La+Doulaise' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/foundation.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/vendor/modernizr.js"></script>
  </head>

  <body>
    <header>
      
      <div class="heading clearfix">
        
          <h1><a href="/landing"><img src="img/logo/logo.png" alt="Far Edge Studios Logo"></a></h1>
          

     
      <form action="index.php" method="get">
        <input type="hidden" name="page" value="search">
        <div class="row collapse postfix-round">
          <div class="small-8 columns">
            <input type="search" name="query" placeholder="Search">
          </div>
          <div class="small-4 columns">
            <button class="button postfix-round">Search</button>
          </div>
        </div>
        
      </form>
  
        
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
            <li><a href="/weddings">Weddings</a></li>
            <li><a href="/portraits">Portraits</a></li>
            <li><a href="/seniors">Seniors</a></li>
            <li><a href="/commercial">Commercial</a></li>
            <li><a href="/models">Models</a></li>
            <li><a href="/gallery">Gallery</a></li>
            <li><a href="/packages">Packages</a></li>
            <li><a href="/about">About Us</a></li>
            <li class="has-dropdown">
              <a href="#"data-reveal-id="accountModal">Account</a>
              <ul class="dropdown">
                <li><a href="#" data-reveal-id="loginModal">Login</a></li>
                <li><a href="#" data-reveal-id="registerModal">Register</a></li>
                <li><a href="#" data-reveal-id="contactModal">Contact</a></li>
              </ul>
            </li>
          </ul>
          
          <!-- Left Nav Section -->
          
        </section>  
      </nav>
      
      <div class="slider">
        <div style="background-image: url(img/slider/commercial.jpg);"><caption>capture your day</caption></div>
        <div style="background-image: url(img/slider/wedding1.jpg);"><caption>capture your day</caption></div>
        <div style="background-image: url(img/slider/wedding2.jpg);"><caption>capture your day</caption></div>
      </div>

      <div class="caption">
        <h1>Capture Your Day...</h1>
      </div>
    </header>
    
    <main>
    
    @yield('content')      

    </main>
        
    <footer>
      <p>Copyright Far Edge Studios 2015 &copy;</p>
    </footer>
   
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script>
      $(document).ready(function(){
        $('.slider').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 5000,
        });
        $('.fade').slick({
          infinite: true,
          speed: 500,
          fade: true,
          cssEase: 'linear'
        });  
      });
    </script> 
  </body>
</html>
