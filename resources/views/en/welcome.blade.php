<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/fontawesome/css/fontawesome-all.css') }}" rel="stylesheet">
        
        <!--BOOTSTRAP
        <link href="{{ asset('css/bootstrap/bootstrap.css') }}" rel="stylesheet">-->
        <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
        
        <!--Stylesheet
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">   -->     
        
        <!--Javascript-->
        <script src="{{ asset('js/jQuery-3.3.1.js') }}"></script>
    </head>
    <body>     
        <!--Menu-->
        <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">API Restfull - Jos&eacute; Carlos Fernandes</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/users">Home <span class="sr-only">(Manual)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/users/list">List</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Contact Me</a>
                </li>
              </ul>              
            </div>
        </nav><!-- Menu END-->
        
        
  
        <!--<div class="flex-center position-ref full-height">-->
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="content">
                <div class="card">
                    <div class="card-header text-center text-white bg-dark">
                        <span class="col-sm-12 col-md-12 col-lg-12">
                            @yield('title_content')  &nbsp;                            
                        </span>                        
                    </div>
                    <div class="card-body">
                      @yield('conteudo')                      
                    </div>
                  </div>
                
            </div>
        </div>
        
        <!--Scripts-->
        <script src="{{ asset('js/bootstrap/bootstrap.js') }}"></script>
    </body>
</html>
