<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Quiz</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{asset('assets/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{asset('assets/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/lib/animate/animate.min.css')}}" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="{{asset('assets/css2/style.css')}}" rel="stylesheet">
  <link href="{{asset('assets/js/Signup-Form-Wizard-jQuery-multiStepForm/css/multi-form.css')}}" rel="stylesheet">

  <!-- =======================================================
    Theme Name: Regna
    Theme URL: https://bootstrapmade.com/regna-bootstrap-onepage-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>

  <!--==========================
  Header
  ============================-->
    <header id="header">
        <div class="container">

          <div id="logo" class="pull-left">
            <a href="{{url('/')}}"><img src="{{asset('assets/img/imagessss.jpg')}}" style="width: 24%;" alt="" title="" /></a>
          </div>

          <nav id="nav-menu-container">
            <ul class="nav-menu">
              <li class="@if (\Request::is('/')) ? menu-active @endif"><a href="{{url('/')}}">Home</a></li>
              <li class="@if (\Request::is('toppers')) ? menu-active @endif"><a href="{{route('team.toppers')}}">Toppers</a></li>
              @if(Auth::check())
              <li class="@if (\Request::is('teams/quizzes')) ? menu-active @endif"><a href="{{url('teams/quizzes')}}">Take Exam</a></li> 
              <li class="@if (\Request::is('teams/dashboard')) ? menu-active @endif"><a href="{{route('dashboard')}}">{{Auth::user()['name']}}</a></li> 
              <li ><a href="{{route('team.logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                    <form id="logout-form" action="{{ route('team.logout') }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="userid" value="{{Auth::user()['id']}}">
                    </form>
              </li> 
              @else
              <li class="@if (\Request::is('team/login')) ? menu-active @endif"><a href="{{route('team.login')}}">Team Login</a></li>
              @endif 
              
              
            </ul>
          </nav><!-- #nav-menu-container -->
        </div>
    </header>
    <!-- #header -->

    @yield('content')
  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Quiz</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Regna
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      -->
        
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="{{asset('assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('assets/lib/jquery/jquery-migrate.min.js')}}"></script>
  <script src="{{asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/lib/easing/easing.min.js')}}"></script>
  <script src="{{asset('assets/lib/wow/wow.min.js')}}"></script>
  <script src="{{asset('assets/lib/waypoints/waypoints.min.js')}}"></script>
  <script src="{{asset('assets/lib/counterup/counterup.min.js')}}"></script>
  <script src="{{asset('assets/lib/superfish/hoverIntent.js')}}"></script>
  <script src="{{asset('assets/lib/superfish/superfish.min.js')}}"></script>

  <!-- Contact Form JavaScript File -->
  <script src="{{asset('assets/js/sweetalert.min.js')}}" integrity="sha256-KsRuvuRtUVvobe66OFtOQfjP8WA2SzYsmm4VPfMnxms=" crossorigin="anonymous"></script>
  <script src="{{asset('assets/contactform/contactform.js')}}"></script>
  
  <link rel="stylesheet" href="{{asset('assets/js/Simple-jQuery-Form-Wizard-with-Input-Validation-Simple-Form/simpleform.css')}}">
<link rel="stylesheet" href="{{asset('assets/js/Simple-jQuery-Form-Wizard-with-Input-Validation-Simple-Form/simpleform.css')}}">


<script src="{{asset('assets/js/Simple-jQuery-Form-Wizard-with-Input-Validation-Simple-Form/simpleform.js')}}"></script>
<script src="{{asset('assets/js/Simple-jQuery-Form-Wizard-with-Input-Validation-Simple-Form/simpleform.min.js')}}"></script>
<script type="text/javascript">
    $("#testform3").simpleform({
        speed : 500,
        transition : 'none',
        progressBar : false,
        showProgressText : true,
        previous :'Back',
    });
</script>
</body>
</html>
