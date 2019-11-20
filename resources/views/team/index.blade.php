@extends('layouts.app')

<style>
.item1 { grid-area: header; }
.item2 { grid-area: menu; }
.item5 { grid-area: footer; }

.grid-container {
  display: grid;
   grid-gap: 10px;
  padding: 10px;
}

.grid-container > div {
  background-color: rgba(255, 255, 255, 0.8);
  text-align: center;
  padding: 20px 0;
  font-size: 23px;
}

.gridReview >.page-link {
      border: 3px solid #dee2e6 !important;
          max-width: 100%;
}

.gridReview{
      padding-top: 38px;    
}
</style>
@section('content')
<?php
// $to = $quizTeamMap['start_date'].' '.$quizTeamMap['start_time'];
$to = Carbon\Carbon::parse($quizTeamMap['start_date'] . $quizTeamMap['start_time']);

$date1 = new DateTime($currentTime);
$date2 = new DateTime($to);
$rest = date_diff($date1,$date2);

// var_dump($date1 == $date2);
// echo "<br>";
// var_dump($date1 < $date2);
// echo "<br>";
// var_dump($date1 > $date2);
// die();

$diffInMinutes = $to->diffInMinutes($currentTime);

$resTime =  $quizTeamMap['session_time'] - $diffInMinutes;
if($resTime < 0){
  
}else if($date1 > $date2){
  $resTime = $quizTeamMap['session_time'] - $diffInMinutes;
}else{
  $resTime =$quizTeamMap['session_time'];
}


$diffInHours = $to->diffInHours($currentTime);


?>

<div class="container">
    <div class="row">
       <!--  <div id="example">00:10</div>
        <div class="timer" id="countdown"></div> -->
        <div class="timer timer-example" data-minutes-left="{{$resTime }}"></div>
    </div>
    <div class="row justify-content-center">

        <div class="col-md-8">
            <h3 class="text-center">{{$quizTeamMap['quiz']['quiz_name']}}</h3>
            <div class="card">
            	<form action="{{route('exam.store')}}" method="post" id="ExamForm">
            		@csrf
                    <input type="hidden" name="team_id" value="{{Auth::user()['id']}}">
                    <input type="hidden" name="quiz_id" value="{{$quizTeamMap['quiz']['id']}}">
	            	  <!--  @foreach($Question as $key=>$ques)
          					<div class="privew">
          					    <div class="questionsBox">                                    
          					        <div class="questions">                                            
                              <h6>Ques:</h6><span>{!!htmlspecialchars_decode($ques['description'])!!}</span>
          					        	
          					        	<input type="hidden" name="questId[]" value="{{$ques['id']}}">
          					        </div>
                            @if($ques['format'] == "file")
            					        <ul class="answerList">
            					        	@foreach(json_decode($ques['option']) as $key => $option)
            					            <li>
            					                <label>
            					                    <input type="radio" name="answer[{{$ques['id']}}]" value="{{$key}}" id="answerGroup_0"> <img src="/{{$option}}" style="width: 12%;"></label>
            					            </li>
          					            @endforeach
            					        </ul>
          					        @else
                              <ul class="answerList">
                                  @foreach(json_decode($ques['option']) as $key => $option)
                                  <li>
                                      <label>
                                          <input type="radio" name="answer[{{$ques['id']}}]" value="{{$key}}" id="answerGroup_0"> 
                                          {{$option}}
                                      </label>
                                  </li>
                                  @endforeach
                              </ul>
                            @endif
          					    </div>
          					</div>
        					      @endforeach
                  {{$Question->links()}} -->
                  <div id="table_data">
                  @include('team.pagination_data')
                </div>
					   <button  class="btn btn-info" disabled id="BtnSubmit" style="float: right;" type="submit">Submit</button>

				</form>                
            </div>
        </div>

        <div class="col-md-4">
            <div class="row grid-container pagination gridReview">
                @foreach($questionRaw as $key=>$ques)

                      @if($examination_raw->checkQuestion($ques['id']) == "reviewed")
                        <a data-quizid="" id="{{$ques['id']}}" style="background-color: orange;color: white;" href="http://localhost:8000/teams/exam?page={{$key+1}}" rel="next" class="page-link">
                            <div class="item3">{{$ques['id']}}</div>  
                            <p id="Answered_{{$ques['id']}}">Reviewed</p>
                        </a>
                        @else
                        <a data-quizid="" id="{{$ques['id']}}" style="background-color: white;" href="http://localhost:8000/teams/exam?data-id={{$ques['id']}}&page={{$key+1}}" rel="next" class="page-link">
                            <div class="item3">{{$ques['id']}}</div> 
                            @if($examination_raw->checkQuestion($ques['id']) == "answered") 
                            <p id="Answered_{{$ques['id']}}">Answered</p> 
                            @else
                            <p style="opacity: 0;" id="Answered_{{$ques['id']}}">Answered</p> 
                            @endif
                        </a>
                        @endif
                    
                @endforeach
            </div>
        </div>
        
    </div>
</div>
<div id="AlertModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="" id="Message">
          
        </div>
         <h4 class="modal-title text-center">Alert Message</h4>
          <p class="alertMsg">You've lost your time </p>
        <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <a >Go to Home</a>
                </div>
            </div>
      </div>
      
    </div>

  </div>
</div>

<script src="{{asset('js/jquery.min.js')}}"></script>

<!-- <script src="//code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
<script src="{{asset('js/Digital-Countdown-Clock-jQuery/countdown-timer.js')}}"></script>
<script src="{{asset('js/Digital-Countdown-Clock-jQuery/countdown-timer.min.js')}}"></script>
<script src="{{asset('js/countdown-timer-controls/jquery-countdown-timer-control.js')}}"></script>

<script type="text/javascript">

//Ajax Pagination to load question per page.
$(document).ready(function(){

  $(document).on('click', '.pagination a', function(event){
    event.preventDefault(); 
    var page = $(this).attr('href').split('page=')[1];
    var dataId = $(this).attr('href').split('data-id=')[1];
    var dataId = dataId.split('&')[0];
      console.log($(this).last());
    ///////////////////////////////////////////////////

        var radioValue = $("input[name='answer["+dataId+"]']:checked").val();
        if(radioValue){
            // alert("Your are a - " + radioValue);
            var ques_id = dataId;
            var quiz_id = "{{$quizTeamMap['quiz']['id']}}";
            var team_id = "{{Auth::user()['id']}}";
            var answer_id = radioValue;

              /*$.ajax({
                    url:"{{route('save.raw.answer')}}",
                    type:"post",
                    data:{team_id:team_id,ques_id:ques_id,quiz_id:quiz_id,answer_id:answer_id},
                    beforeSend: function(xhr) {
                      xhr.setRequestHeader('X-CSRF-Token', $('input[name="_token"]').val());
                    },
                    success:function(res){
                      if(res == "success"){
                        var reviewBox = [];
                        var demo = $(".gridReview").find('a');

                        reviewBox = demo.map(function(){ return $(this).attr('id') }); 
                          // console.log(demo[0]);
                          $.each( reviewBox, function( key, value ) {
                              if(value === ques_id) {
                                // $(demo[key]).css({"background-color":"white"});
                                $("#Answered_"+value).css({"opacity":1});
                                $("#Answered_"+value).html("Answered");
                              }
                                
                          });
                      }
                    
                    },
                    error:function(xhr){
                       console.log(xhr);
                    }
              });*/
        }

    ///////////////////////////////////////////
      if(page === "{{count($questionRaw)}}"){
        $("#BtnSubmit").attr('disabled',false);

      }else{
        $("#BtnSubmit").attr('disabled',true);
      }
    fetch_data(page);
      
  });

  function fetch_data(page)
  {
      $.ajax({
        url:"/teams/pagination/fetch_data?page="+page,
        success:function(data)
        {
          $('#table_data').html(data);
        }
      });

    


  } 
});

/////////////////////////////////////////////////
//TO add review question in database
var thisVal;
var answerArr = [];
function reviewBtnClick(thisVal){
  var id = thisVal.getAttribute('data-qid');
  
    
    var reviewBox = [];
    var demo = $(".gridReview").find('a');

    reviewBox = demo.map(function(){ return $(this).attr('id') }); 
    $.each( reviewBox, function( key, value ) {

      if(id === value){
        var team_id = "{{Auth::user()['id']}}";
        var ques_id = value;
        var answer_id = 0;
        if($(".radio_"+value).is(":checked")) 
              answer_id = $(".radio_"+value+":checked").val(); 
        
        var quiz_id = "{{$quizTeamMap['quiz']['id']}}";
        $.ajax({
          url:"{{route('save.raw')}}",
          type:"post",
          data:{team_id:team_id,ques_id:ques_id,quiz_id:quiz_id,answer_id:answer_id},
          beforeSend: function(xhr) {
            xhr.setRequestHeader('X-CSRF-Token', $('input[name="_token"]').val());
          },
          success:function(res){
            console.log(res);
          },
          error:function(xhr){
             console.log(xhr);
          }
        });
        $(demo[key]).css({"color":"white", "background-color":"orange"});
        $("#Answered_"+value).css({"opacity":1});
                      $("#Answered_"+value).html("Reviewed");
      }
    });    
}


//////////////////////////////////////////////////
//Timer jquery
var myDate = new Date("{{$to}}");

myDate.setMinutes(myDate.getMinutes() + 10);

// console.log(myDate.getMinutes());
var myTimer = $('.timer-example').startTimer({
    onComplete: function(element){
      $("#ExamForm").submit();
    }
});

var timeSet = "{{$resTime}}" * 1000;

<?php if($resTime < 0){ ?>

// $("#AlertModel").modal('show');
<?php } elseif($date1 > $date2){ ?>
// myTimer.trigger('start');

<?php }else{ ?>
setInterval(function() {
   
    // myTimer.trigger('start');
}, timeSet);
<?php } ?>
// myTimer.trigger('start');


/*var myDate = new Date("{{$to}}");

myDate.setHours(myDate.getHours() + 10);

console.log(myDate);

setTimeout(function(){
    $("#countdown").countdown(myDate, function (event) {
          $(this).html(
              event.strftime(
                  '<div class="timer-wrapper"><div class="time">%D</div><span class="text">days</span></div><div class="timer-wrapper"><div class="time">%H</div><span class="text">hrs</span></div><div class="timer-wrapper"><div class="time">%M</div><span class="text">mins</span></div><div class="timer-wrapper"><div class="time">%S</div><span class="text">sec</span></div>'
              )
          );
        });
},3000);*/
 
</script>
@endsection

