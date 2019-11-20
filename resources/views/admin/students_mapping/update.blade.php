@extends('layouts.app')
@section('content')
<section class="content-header">
    <h1>
        Team-Student
        <small>Mapping Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Team-Student Mapping</li>
    </ol>
</section>
<section class="content">
    <div class="row ">
        <div class="col-xs-1"></div>
        <div class="col-xs-10">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Team-Student Mapping Records</h3>
                </div>
                <div class="box-body">
                    <form action="{{route('student.update',$students['id'])}}" method="post">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <div class="form-group ">
                            <label for="name" >Student Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$students['name']}}"  autocomplete="name" autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group ">
                            <label for="email" >Student Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$students['email']}}"  autocomplete="email" autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group ">
                            <label for="team_id" >Team</label>
                                <select id="team_id" class="form-control @error('team_id') is-invalid @enderror" name="team_id" autocomplete="team_id" autofocus>
                                    <option>Select Team</option>
                                    @foreach($teams as $team)
                                    <option {{$team->id == $students['team_id']  ? 'selected' : ''}} value="{{$team['id']}}">{{$team['name']}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('team_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('team_id') }}</strong>
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


<script src="{{asset('js/jquery-1.11.3.min.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">



@endsection
