@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Team 
        <small>Update Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Team</li>
      </ol>
    </section>
    <section class="content">
        <div class="row ">
            <div class="col-xs-1"></div>
            <div class="col-xs-10">
                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Team</h3>
                    </div>
                    <div class="box-body">
                    	<form action="{{route('team.update',$teams['id'])}}" method="post">
                    		{{csrf_field()}}                   
                            {{method_field('put')}}
        	            	<div class="form-group ">
                                <label for="name" >Team Name</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$teams['name']}}"  autocomplete="name" autofocus>

                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="old_password" >Old Password</label>
                                    <input id="old_password" type="password"class="form-control " name="old_password" autocomplete="old_password" autofocus />
                                    @if ($errors->has('old_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="password" >New Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password" autofocus />
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                             <div class="form-group ">
                                <label for="password_confirmation" >Confirm Password</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" autocomplete="password_confirmation" autofocus />
                                    @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="status">Status</label>
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