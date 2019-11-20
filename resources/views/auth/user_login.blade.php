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
<style type="text/css">
    #header{
            background: rgba(52, 59, 64, 0.9);
    padding: 20px 0;
    height: 72px;
    transition: all 0.5s;
    }
    .details{
        bottom: 0 !important;
    }
    .timer{
    display: -webkit-inline-box;
    font-size: xx-large;
}

</style>
<section id="contact">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h3 class="section-title">Team login</h3>
          <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </div>
      </div>
      <div class="container wow fadeInUp mt-5">
        <div class="row justify-content-center">


          <div class="col-lg-8 col-md-8">
            <div class="form">
              <div id="sendmessage">Your message has been sent. Thank you!</div>
              <div id="errormessage"></div>
              @if($errors->all())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">                               
                            {{ $error }}                                
                    </div>
                  @endforeach
              @endif
                  <form method="POST" id="formSubmit" action="{{ route('team.login') }}">
                      {{csrf_field()}}
                      <div class="form-group ">
                          <label for="team_id" >Team Id</label>
                              <input id="team_id" type="text" class="form-control " name="team_id" value="{{ old('team_id') }}"  autocomplete="team_id" autofocus>

                              @if ($errors->has('team_id'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('team_id') }}</strong>
                                  </span>
                              @endif
                      </div>
                      <div class="form-group ">
                          <label for="password" >Password</label>
                              <input id="password" type="password" class="form-control" name="password"  autocomplete="current-password">

                              @if ($errors->has('password'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                      </div>
                      <div class="form-group  mb-0">
                          <button type="submit" class="btn btn-primary" id="btnLogin">
                             Login
                          </button>
                      </div>
                  </form>
            </div>
          </div>

        </div>

      </div>
    </section>


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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha256-KsRuvuRtUVvobe66OFtOQfjP8WA2SzYsmm4VPfMnxms=" crossorigin="anonymous"></script>
  <script src="{{asset('assets/contactform/contactform.js')}}"></script>
  <script src="{{asset('assets/js2/main.js')}}"></script>
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
