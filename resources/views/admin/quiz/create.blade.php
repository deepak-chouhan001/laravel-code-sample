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
                	<form action="{{route('quiz.store')}}" method="post">
                		{{csrf_field()}}
                    	<div class="form-group ">
                            <label for="quiz_name" >Quiz Name</label>
                                <input id="quiz_name" type="text" class="form-control" name="quiz_name" value="{{ old('quiz_name') }}"  autocomplete="quiz_name" autofocus>

                                @if ($errors->has('quiz_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quiz_name') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group ">
                            <label for="quiz_type" >Quiz Type</label>
                                <select id="quiz_type" class="form-control" name="quiz_type" autocomplete="quiz_type" autofocus>
                                    <option value="">Choose one</option>
                                    <option value="0">Sample Quiz</option>
                                    <option value="1">Live Quiz</option>
                                </select>
                                @if ($errors->has('quiz_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quiz_type') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group ">
                            <label for="points" >Quiz Mark</label>
                                <input id="points" type="number" class="form-control" name="points" value="{{ old('points') }}" autocomplete="points" autofocus>

                                @if ($errors->has('points'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('points') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group ">
                            <label for="status" >Status</label>
                                Active <input id="status" type="radio" name="status" value="1"  autocomplete="status" autofocus>
                                De-Active<input id="status" type="radio" name="status" value="0"  autocomplete="status" autofocus>

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