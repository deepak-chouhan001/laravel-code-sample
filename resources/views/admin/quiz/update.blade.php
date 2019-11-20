@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        Quiz
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Quiz</li>
    </ol>
</section>
<section class="content">
    <div class="row ">
        <div class="col-xs-1"></div>
        <div class="col-xs-10">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Quiz</h3>
                </div>
                <div class="box-body">
                	<form action="{{route('quiz.update',$quiz['id'])}}" method="post">
                		{{csrf_field()}}
                        
                        {{method_field('put')}}
    	            	<div class="form-group ">
                            <label for="quiz_name" >Quiz Name</label>
                                <input id="quiz_name" type="text" class="form-control" name="quiz_name" value="{{$quiz['quiz_name']}}" autocomplete="quiz_name" autofocus>

                                @if ($errors->has('quiz_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quiz_name') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group ">
                            <label for="quiz_type" >Quiz Type</label>
                                <select id="quiz_type" class="form-control" name="quiz_type" value="{{ old('quiz_type') }}"  autocomplete="quiz_type" autofocus>
                                    <option value="">Choose one</option>
                                    <option value="0" {{$quiz->quiz_type == 0  ? 'selected' : ''}}>Sample Quiz</option>
                                    <option {{$quiz->quiz_type == 1  ? 'selected' : ''}} value="1">Live Quiz</option>
                                </select>

                                @if ($errors->has('quiz_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quiz_type') }}</strong>
                                    </span>
                                @endif
                        </div>


                        <div class="form-group ">
                            <label for="points" >Quiz Mark</label>
                                <input id="points" type="text" class="form-control" name="points" value="{{$quiz['points']}}" autocomplete="points" autofocus>

                                @if ($errors->has('phone_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('points') }}</strong>
                                    </span>
                                @endif
                        </div>                    
                        <div class="form-group ">
                            <label for="status" >Status</label>
                                Active <input id="status" {{$quiz->status == 1  ? 'checked' : ''}} type="radio" name="status" value="1"  autocomplete="status" autofocus>
                                De-Active<input id="status" {{$quiz->status == 0  ? 'checked' : ''}} type="radio" name="status" value="0"  autocomplete="status" autofocus>

                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                        </div>
    					<button class="btn btn-info pull-right" type="submit">Submit</button>
    				</form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection