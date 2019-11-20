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
    <div class="row ">
        <div class="col-xs-1"></div>
        <div class="col-xs-10">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Team-Quiz Mapping Records</h3>
                </div>
                <div class="box-body">
                	<form action="{{route('mapping.store')}}" method="post">
                		{{csrf_field()}}
                    	<div class="form-group row">
                            <label for="quiz_id" class="col-md-4 col-form-label text-md-right">Quizzes</label>

                            <div class="col-md-6">
                                <select id="quiz_id" type="text" class="form-control" name="quiz_id" value="{{ old('quiz_id') }}"  autocomplete="quiz_id" autofocus>
                                    <option value="">Choose Quiz</option>
                                    @foreach($quizes as $quiz)
                                    <option value="{{$quiz['id']}}">{{$quiz['quiz_name']}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('quiz_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quiz_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="team_id" class="col-md-4 col-form-label text-md-right">Team</label>

                            <div class="col-md-6">
                                <select id="team_id" class="form-control" name="team_id" value="{{ old('team_id') }}"  autocomplete="team_id" autofocus>
                                    <option value="">Select Team</option>
                                    @foreach($teams as $team)                                
                                       @if(count($team['members']) >= 1 && $teamMap->check($team->id))
                                        <option value="{{$team['id']}}">{{$team['name']}}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('team_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('team_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">Session Date & Time</label>

                            <div class="col-md-6">
                                <input id="start_date" type="text" class="form-control" name="start_date"  autocomplete="start_date" autofocus>
                                
                                @if ($errors->has('start_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hours" class="col-md-4 col-form-label text-md-right">Session time</label>
                            <div class="col-md-3">
                                <input id="hours" type="number" class="form-control @error('hours') is-invalid @enderror" placeholder="Hours" name="hours"  autocomplete="hours" autofocus>
                                @if ($errors->has('hours'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hours') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <input id="minutes" type="number" class="form-control @error('minutes') is-invalid @enderror" placeholder="Minutes" name="minutes"  autocomplete="minutes" autofocus>
                                @if ($errors->has('minutes'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('minutes') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
        				<button class="btn btn-info pull-right" type="submit">Submit</button>
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

