<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- META SECTION -->
    <title>Cnsytex - Auto Grade System for Programming Assignments</title>            
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
        
    <link rel="icon" href="img/multimedia.png" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- Bootstrap core CSS -->
    {{ Html::style('css/bootstrap/bootstrap.min.css') }}
    <!--external css-->
    {{ Html::style('css/fontawesome/font-awesome.min.css') }}
        
    <!-- Custom styles for this template -->
    {{ Html::style('css/Login/style.css') }}
    {{ Html::style('css/Login/style-responsive.css') }}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

      <div id="login-page">
        @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
        @endif
        @yield('content')
      </div>

    <!-- js placed at the end of the document so the pages load faster -->
    {{ Html::script('js/plugins/jquery/jquery.min.js') }}
    {{ Html::script('js/plugins/bootstrap/bootstrap.min.js') }}

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    {{ Html::script('js/plugins/jquery/jquery.backstretch.min.js') }}

    <script>
        $.backstretch("{{ URL::asset('img/login-bg.jpg') }}", {speed: 500});
    </script>


  </body>
</html>
