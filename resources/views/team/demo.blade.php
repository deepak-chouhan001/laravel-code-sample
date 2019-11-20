<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Quiz</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

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
    <link rel="stylesheet" href="{{asset('assets/js/Simple-jQuery-Form-Wizard-with-Input-Validation-Simple-Form/simpleform.css')}}">
<link rel="stylesheet" href="{{asset('assets/js/Simple-jQuery-Form-Wizard-with-Input-Validation-Simple-Form/simpleform.css')}}">

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
    justify-content: center;
    margin-bottom: 34px;
}
.swal-icon img {
    max-width: 14%;
    max-height: 74%;
}
</style>
</head>

<body>
<?php
$examTime = $quizTeamMap['start_date'];
$mytime = new Carbon\Carbon;
$mytime->tz('Asia/Kolkata');
$to = $mytime->parse($examTime);

$now = new DateTime('Asia/Kolkata');
$date = new DateTime($examTime, new DateTimeZone('Asia/Kolkata'));

$diffInMinutess = $date->diff($now);

$diffInDay = $diffInMinutess->format('%d');
$diffInHours = $diffInMinutess->format('%h');


$diffInMinutes = $diffInMinutess->format('%i');


$diffInSeconds = $diffInMinutess->format('%s');
$diffInYear = $diffInMinutess->format('%y');
            $diffInMonth = $diffInMinutess->format('%m');
// $resTime = $diffInHours * 60 + $diffInMinutes;

if($date < $now){
  if($diffInYear){
    $leftTime = (($diffInYear * 365 * 30 * 24 * 60) * ($diffInMonth * 30 * 24 * 60) * ($diffInDay * 24 * 60) + $diffInHours * 60 + $diffInMinutes);
    $resTime = 0;
  }elseif($diffInMonth){
    $leftTime = (($diffInMonth * 30 * 24 * 60) * ($diffInDay * 24 * 60) + $diffInHours * 60 + $diffInMinutes);
    $resTime = 0;
  }elseif($diffInDay){
    $leftTime = ( ($diffInDay * 24 * 60) + $diffInHours * 60 + $diffInMinutes);
    $resTime = $quizTeamMap['session_time'] - $leftTime;
  }else{
    $leftTime = $diffInHours * 60 + $diffInMinutes;
    $resTime = $quizTeamMap['session_time'] - $leftTime;
  }
  
}elseif($date > $now){
  $seconds = ($diffInHours * 60 * 60 + ($diffInMinutes *60 )+ $diffInSeconds) * 1000;
 $leftTime = (($diffInHours * 60 )+ $diffInMinutes);
  $resTime = $quizTeamMap['session_time'];
  
}
// dd("ddd");

?>

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
              @if(Auth::check())
              <li><a href="{{route('team.logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                    <form id="logout-form" action="{{ route('team.logout') }}" method="POST" style="display: none;">
                        {{csrf_field()}}
                        <input type="hidden" name="userid" value="{{Auth::user()['id']}}">
                    </form>
              </li>
              @endif 
            </ul>
          </nav><!-- #nav-menu-container -->
        </div>
    </header>
    <!-- #header -->

  	<main id="main">
  	    <section id="about">
  	      	<div class="container">
  	      		<div class="row about-container">
  	      			<div class="timer timer-example" data-minutes-left="{{$resTime }}"></div>
  	      		</div>
  		        <div class="row about-container">

  		        	<div class="col-md-8 col-sm-5 mb-xs-24">	

                  @if($resTime <= 0)
                  <div class="alert alert-danger">Your exam time is over.</div>
                  <h5><a href="{{route('dashboard')}}">Back to home</a></h5>
                  @endif	
                  <div class="alert alert-info" id="infoALert" style="display: none;">Please keep this window open.Your exam will be at {{$to}} .</div>        		
  			        	  <form action="{{route('exam.store')}}" method="post" id="testform3" >
    			        		{{csrf_field()}}
                      <input type="hidden" name="quiz_id" value="{{$quizTeamMap->quiz['id']}}">
    			        		<input type="hidden" name="map_id" value="{{$quizTeamMap['id']}}">
    			        		<input type="hidden" name="team_id" value="{{Auth::user()['id']}}">
  			        		  @foreach($Question as $key=>$ques)
                      <input type="hidden" name="questId[]" value="{{$ques['id']}}">
      							  <fieldset id="data_{{$ques['id']}}" class="data_{{$ques['id']}}">
      								  <div class="questionsBox">                                    
      							      <div class="questions">
      							        <div>
                              <strong>{{$key+1}} : </strong>{!!htmlspecialchars_decode($ques['description'])!!}
                            </div>
    							        </div>
      							      @if($ques['format'] == "file")
      							        <ul class="answerList">
      							          @foreach(json_decode($ques['option']) as $key1 => $option)
      							            <li>
      							              <label>
      							                <input type="radio" data-id="{{$ques['id']}}" class="radio_{{$ques['id']}}" @if($examination_raw->getAnswer($ques['id'])['answer_id'] == $key1) checked @endif  name="answer[{{$ques['id']}}]" value="{{$key1}}" id="{{$ques['id']}}"> <img src="/{{$option}}" style="width: 12%;">
                                  </label>
      							            </li>
      							          @endforeach
      							        </ul>
      							      @else
      							        <ul class="answerList">
      							          @foreach(json_decode($ques['option']) as $key2 => $option)
      							            <li>
      							              <label>
      							                <input type="radio"  data-id="{{$ques['id']}}" class="radio_{{$ques['id']}}" @if($examination_raw->getAnswer($ques['id'])['answer_id'] == $key2) checked @endif  name="answer[{{$ques['id']}}]" value="{{$key2}}" id="{{$ques['id']}}"> 
      							                      {{$option}}</label>
      							            </li>
      							          @endforeach
      							        </ul>
      							      @endif
      							    </div>
      							    <button type="button" data-qId="{{$ques['id']}}" class="btn btn-info reviewBtn">Set To Review</button>
      							  </fieldset>
  							      @endforeach								
  						      </form>
  					    </div>
  					    <div class="col-md-4 col-sm-5 mb-xs-24" style="">
  			        	<div class="row">
  			        		@foreach($questionRaw as $key=>$ques)
  			        		  @if($examination_raw->checkQuestion($ques['id']) == "reviewed")
  						  		    <div class="col-sm-4 questionLi " id="#data_{{$ques['id']}}">
  						  			    <a style="background-color: orange;color: white;" rel="next" class="page-link">
  			                    <div class="item3">{{$key+1}}</div>  
  			                    <p id="Answered_{{$ques['id']}}" style="font-size: 15px;" class="answerLi">Reviewed</p>
  			                  </a>
  						  		    </div>
  						  	    @else
  						  		    <div class="col-sm-4 questionLi " data-index="{{$key}}" id="#data_{{$ques['id']}}">
  						  			    <a style="background-color: white;" rel="next" class="page-link">
  			                    <div class="item3">{{$key+1}}</div> 
  			                      @if($examination_raw->checkQuestion($ques['id']) == "answered") 
  			                        <p id="Answered_{{$ques['id']}}" class="answerLi">Answered</p> 
  			                      @else
  			                        <p style="opacity: 0;font-size: 15px;" class="answerLi" id="Answered_{{$ques['id']}}">Answered</p> 
  			                      @endif
  			                  </a>
  						  		    </div>
  						  	    @endif
  						  	  @endforeach
  						    </div>
  			        </div>
  		        </div> 
  	    	</div>
  		  </section>
        <section id="team">
        </section>
        <section id="team"></section>
  	</main>
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
        <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
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
  <script src="{{asset('assets/js2/main.js')}}"></script>



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
<script src="{{asset('assets/js/countdown-timer-controls/jquery-countdown-timer-control.js')}}"></script>

<script type="text/javascript">
$(document).ready(function(){

  ///////////////////////////////
  $('.submit-button').click(function(){
        swal({
          title: "Are you sure want to submit the exam?",
          text: "You will not be able to revert it back.",
          icon: "warning",
          buttons: [
            'No, cancel it!',
            'Yes ,sure'
          ]
        }).then(function(isConfirm) {
          if (isConfirm) {
            $("#testform3").submit();
            // swal("Deleted!", "Your item deleted.", "success");
          } else {
            swal("Cancelled", "You Cancelled", "error");
          }
      });
    
  });
  ////////////////
	$('.questionLi').each(function(){
		$(this).click(function(){
			var id = $(this).attr('id');
			// $(this).css({'background-color':'#ddd'}).siblings().css({'background-color':'white'});


			$(id).show().siblings("fieldset").hide();
		});
	});

	$('.reviewBtn').each(function(){
		$(this).click(function(){
			var id = $(this).attr('data-qId');
			
			$(".radio_"+id).prop('checked', false);
			$("#Answered_"+id).css({"opacity":1});
            $("#Answered_"+id).html("Reviewed");
			
		});
	});

	$('input[type=radio]').each(function(){
		$(this).click(function(){
			var id = $(this).attr('id');

            $("#Answered_"+id).css({"opacity":1});
            $("#Answered_"+id).html("Answered");
			
		});
	});


	//////////////////////////////////////////////////
	//Timer jquery
	var myDate = new Date("{{$to}}").getTime();
	var nowDate = new Date().getTime();
	var t = myDate - nowDate;
	
	var myTimer = $('.timer-example').startTimer({
	    onComplete: function(element){
        swal({
          title: "Ooopppsss Time is over!",
          text: "Better luck next Time.",
          icon: '{{asset("assets/img/thumb-up-cartoon-png_246633.jpg")}}'
        });
	      $("#testform3").submit();
	    }
	});

	var timeSet = "{{$resTime}}" * 1000;
	var seconds = "{{$diffInSeconds}}" * 1000;
  
	$("#testform3").hide();
	<?php if($resTime <= 0){ ?>

		swal({
          title: "Are you wanna go on home page?",
          text: "Bcoz your exam time out.",
          icon: "warning",
          buttons: [
            'No, cancel it!',
            'Yes'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
            swal({
              title: 'Great!',
              text: 'Click OK to go on home.',
              icon: 'success'
            }).then(function() {
              window.location = "{{url('teams/dashboard')}}";
            });
          } else {
            swal("Cancelled", "Sorry!!! Better luck next time.", "error");
          }
        });
	// $("#AlertModel").modal('show');
	<?php } elseif($now > $date){ ?>
    $("#testform3").show();
		$("#infoALert").hide();
		myTimer.trigger('start');

	<?php }else{ ?>
    $("#infoALert").show();
		setTimeout(function() {
        $("#testform3").show();
		   	$("#infoALert").hide();
		    myTimer.trigger('start');
		}, "{{$seconds}}");
	<?php } ?>
});
</script>
</body>
</html>