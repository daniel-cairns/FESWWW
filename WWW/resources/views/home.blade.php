<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FES</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto|Monsieur+La+Doulaise|Codystar|Monda|Great+Vibes' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/foundation.css" />
    <link rel="stylesheet" href="css/styles-landing.css" />
    <script src="/js/vendor/modernizr.js"></script>
  </head>
  <body>

  <div id="landing">
    <h1><img src="img/logo/logo.png" alt=""></h1>
    <div>
      <h2 id="enter">Enter</h2>
    </div>  
  </div>

  <div id="logo">
    <img src="img/logo/logo.png" alt="">
    @if( !Auth::check());
    <a href="#" data-reveal-id="loginModal">Login</a>
    <a href="#" data-reveal-id="registerModal">Register</a>
    @endif
  </div>

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
  </div>
    
    <div id="content" class="clearfix">
    
      <div id="weddings" class="image-box">
        <img src="img/landing/wedding-home.jpg" alt="">
        <div class="hover-window">  
          <div class="hover-window-text">
            <a href="subbrand/weddings"><h1>Weddings</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore voluptas explicabo similique cupiditate, adipisci corrupti ullam rerum ipsum quo! Obcaecati, incidunt, officia. Maxime distinctio, harum excepturi, neque quam architecto reprehenderit.</p></a>
            
            @if( Auth::user()->privilege == 'admin')
            <a href="#" data-reveal-id="weddingsModal">edit</a>
            @endif

          </div>
        </div>  
      </div>

      <div id="weddingsModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
        <h2 id="modalTitle">Wedding Image Update</h2>
        <form action="/home" method="post" enctype="multipart/form-data" novalidate>
          {{ csrf_field() }}
          
          <label for="photo">Image</label>
          
          <input type="file" name="photo" class="tiny button radius">
          
          <input type="submit" value="Update Image" name="" class="tiny button radius">

        </form>
      </div>

      <div id="portraits" class="image-box clearfix">
        <img src="img/landing/portrait-home.jpg" alt="">
        <div class="hover-window">  
          <div class="hover-window-text">
            <a href="subbrand/portraits"><h1>Portraits</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore voluptas explicabo similique cupiditate, adipisci corrupti ullam rerum ipsum quo! Obcaecati, incidunt, officia. Maxime distinctio, harum excepturi, neque quam architecto reprehenderit.</p></a>
            @if( Auth::user()->privilege == 'admin')
            <a href="#" data-reveal-id="portraitsModal">edit</a>
            @endif

          </div>
        </div>  
      </div>

      <div id="portraitsModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
        portraits
      </div>
      
      <div id="seniors" class="image-box clearfix">
        <img src="img/landing/senior-home.jpg" alt="">
        <div class="hover-window">  
          <div class="hover-window-text">
            <a href="subbrand/seniors"><h1>Seniors</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore voluptas explicabo similique cupiditate, adipisci corrupti ullam rerum ipsum quo! Obcaecati, incidunt, officia. Maxime distinctio, harum excepturi, neque quam architecto reprehenderit.</p></a>
            @if( Auth::user()->privilege == 'admin')
            <a href="#" data-reveal-id="seniorsModal">edit</a>
            @endif

          </div>
        </div>  
      </div>

      <div id="seniorsModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
        seniors
      </div>
      
      <div id="commercial" class="image-box clearfix">
        <img src="img/landing/commercial-home.jpg" alt="">
        <div class="hover-window">  
          <div class="hover-window-text">
            <a href="subbrand/commercial"><h1>Commercial</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore voluptas explicabo similique cupiditate, adipisci corrupti ullam rerum ipsum quo! Obcaecati, incidunt, officia. Maxime distinctio, harum excepturi, neque quam architecto reprehenderit.</p></a>
            @if( Auth::user()->privilege == 'admin')
            <a href="#" data-reveal-id="commercialModal">edit</a>
            @endif

          </div>
        </div>  
      </div>

      <div id="commercialModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
        commercial
      </div>
      
      <div id="models" class="image-box">
        <img src="img/landing/model-home.jpg" alt="">
        <div class="hover-window">  
          <div class="hover-window-text">
            <a href="subbrand/models"><h1>Models</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore voluptas explicabo similique cupiditate, adipisci corrupti ullam rerum ipsum quo! Obcaecati, incidunt, officia. Maxime distinctio, harum excepturi, neque quam architecto reprehenderit.</p></a>

            @if( Auth::user()->privilege == 'admin')
            <a href="#" data-reveal-id="modelsModal">edit</a>
            @endif

          </div>
        </div>  
      </div>

      <div id="modelsModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
        models
      </div>
    
    </div>  <!-- end #content -->
    
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
    <script>
      $("#enter").click(function(){
        $("#landing").toggle( "slow" );
        $("#logo").toggle("slow");
      });
    </script>
  </body>
</html>