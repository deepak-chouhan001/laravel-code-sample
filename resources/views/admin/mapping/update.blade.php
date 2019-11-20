@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        Team-Quiz 
        <small>Mapping Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Team-Quiz Mapping</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-1"></div>
        <div class="col-xs-10">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Team-Quiz Mapping Records</h3>
                </div>
                <div class="box-body">
                	<form action="{{route('mapping.update',$QuizTeamMap['id'])}}" method="post">
                		{{csrf_field()}}
                        {{method_field('put')}}
                        <div class="box-body">
        	            	<div class="form-group ">
                                <label for="quiz_id" >Team-Quiz Mapping</label>
                                    <select id="quiz_id" type="text" class="form-control" name="quiz_id" value="{{ old('quiz_id') }}"  autocomplete="quiz_id" autofocus>
                                        <option value="">Choose Quiz</option>
                                        @foreach($quizes as $quiz)
                                        <option {{$quiz->id == $QuizTeamMap['quiz_id']  ? 'selected' : ''}}  value="{{$quiz['id']}}">{{$quiz['quiz_name']}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('quiz_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quiz_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="team_id" >Quiz Type</label>
                                    <select id="team_id" class="form-control" name="team_id" value="{{ old('team_id') }}"  autocomplete="team_id" autofocus>
                                        <option value="">Choose Team</option>
                                        @foreach($teams as $team)    
                                            @if(count($team['members']) >= 1)
                                            <option {{$team->id == $QuizTeamMap['team_id']  ? 'selected' : ''}} value="{{$team['id']}}">{{$team['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @if ($errors->has('team_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('team_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="start_date" >Sesstion Date & Time</label>
                                    <input id="start_date" type="text" class="form-control" value="{{$QuizTeamMap['start_date']}}" min="{{Carbon\Carbon::today()->toDateString()}}" name="start_date"  autocomplete="start_date" autofocus>
                                    
                                    @if ($errors->has('start_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <label for="hours" class="col-xs-2">Session time</label>
                                    <div class="col-xs-4">
                                        <input id="hours" type="number" class="form-control" name="hours" value="{{$QuizTeamMap['hours']}}"  autocomplete="hours" autofocus>
                                        @if ($errors->has('hours'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hours') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                    <div class="col-xs-5">
                                        <input id="minutes" type="number" class="form-control" name="minutes" value="{{$QuizTeamMap['minutes']}}" autocomplete="minutes" autofocus>
                                        @if ($errors->has('minutes'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('minutes') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                </div>
                            </div>
                            
        					<button class="btn btn-info pull-right" type="submit">Submit</button>
                        </div>
        			</form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{asset('assets/js/jquery-1.11.3.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">



<script type="text/javascript">
$(document).ready(function(){
    $('input.timepicker').timepicker({
        timeFormat: 'HH:mm:ss',
        dropdown :true,
        scrollbar: true,
        interval: 60 // 15 minutes

    });
    $("#quiz_id").change(function(){
            var quiz_id = $(this).val();
            $.ajax({
                url:"/admin/get/ajax/"+quiz_id,
                type:"GET",
                success:function(response){
                    // console.log(response);
                     $('#team_id').empty();
                     $("#team_id").append('<option value="">Select Team</option>');
                    for(var i=0;i < response.length;i++){
                        // console.log(response[i].id);

                        $('#team_id').append('<option value="' + response[i].id + '">' + response[i].name + '</option>');
                    }
                },
                error:function(xhr){
                    console.log(xhr);
                }
            });
    });
});
</script>

@endsection