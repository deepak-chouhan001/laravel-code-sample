<!DOCTYPE html>
<html>

<!-- Mirrored from adminlte.io/themes/AdminLTE/pages/examples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Mar 2019 04:54:59 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Quiz | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('assets/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('assets/plugins/iCheck/square/blue.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a ><b>Admin</b>Login</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
                    <form method="POST" id="formSubmit" action="{{ route('authentication.user') }}">
                        {{csrf_field()}}

                        <div class="form-group has-feedback"> 
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter email">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif                          
                        </div>

                        <div class="form-group has-feedback">
                            
                                <input id="phone_no" type="text" class="form-control" name="phone_no" required autocomplete="phone_no"  placeholder="Ex: 917387635429">
                                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                                @if ($errors->has('phone_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_no') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group has-feedback">
                                <button type="button" class="btn btn-primary btn-block btn-flat" id="btnLogin">
                                    {{ ('Login') }}
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="" id="Message">
          
        </div>
         <h4 class="modal-title text-center">Verify Your OTP</h4>
       <form method="POST" action="{{ route('otp.verification') }}" >
           {{csrf_field()}}

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">OTP</label>

                <div class="col-md-6">
                    <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror" name="otp" value="{{ old('otp') }}" required autocomplete="otp" autofocus>
                    
                    @if ($errors->has('otp'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('otp') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-sm-11" style="display: flex;justify-content: center;">
                    <button type="button" id="otpForm" class="btn btn-primary" style="width: 19%;">
                        Verify
                    </button>
                </div>
            </div>
        </form>
        <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <a style="color: #3490dc;cursor: pointer;text-decoration: underline;" id="ResendBtn">Resend OTP?</a>
                </div>
            </div>
        </div>
      
    </div>

  </div>
</div>

<script src="{{asset('assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script type="text/javascript">

    $(document).on("click", "#btnLogin,#ResendBtn", function(){
        if($('#email').val().length == '' || $('#phone_no').val() == ''){
           alert("All Fields are Required");
        }
        
       $.ajax({
        url :"{{route('phone.verify')}}" ,
        type :"POST",
        data :{email:$('#email').val(),phone_no:$('#phone_no').val()},
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-CSRF-Token', $('input[name="_token"]').val());
        },
        success :function(res){
            if(res === "success"){
                $('#myModal').modal({backdrop: 'static', keyboard: false});
                $("#myModal").modal('show');
                $("#Message").attr('class','alert alert-success');
                $("#Message").show();
                $("#Message").html("OTP send successfully.");
             console.log(res);
            }else{
                alert("Otp not send.Please try again");
                // location.reload();
            }
        },
        error:function(error){

            alert(error.responseJSON['message']);
            // location.reload();
        }
       });
       
        
    });

    $(document).on("click", "#otpForm", function(e){
        var otp = $("#otp").val();
        var email = $("#email").val();
       $.ajax({
        url :"{{route('otp.verification')}}",
        type :"POST",
        data:{email:email ,opt:otp},
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-CSRF-Token', $('input[name="_token"]').val());
        },
        success :function(res){
            
            if(res === "verified"){
                $("#formSubmit").submit();
                console.log("verified");
            }else if(res === "expired"){
                $("#Message").attr('class','alert alert-danger');
                $("#Message").show();
                 $("#Message").html("Your Otp is expired .Please resend otp OR login again.");
            }else{
                $("#Message").attr('class','alert alert-danger');
                $("#Message").show();
                $("#Message").html("Wrong OTP..");
            }
            
        },
        error:function(error){
            console.log(error);
        }
       });
       e.preventDefault();
        
    });

setTimeout(function(){ 


}, 9000);

</script>

<!-- Bootstrap 3.3.7 -->
<script src="{{asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('assets/plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>

</html>
