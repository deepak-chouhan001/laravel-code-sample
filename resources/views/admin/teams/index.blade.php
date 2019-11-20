@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        Team
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Team</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Team Records</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td style="display: none;">Id</td>
                                <th>Unique Id</th>
                                <th>Name</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teams as $key => $team)
                            <tr>
                                <td style="display: none;">{{$team['id']}}</td>
                                <td>{{$team['unique_id']}}</td>
                                <td>{{$team['name']}}</td>
                                <td>{{$team['team_password']}}</td>
                                <td>
                                    <div class="btn-group-horizontal">
                                        <a href="{{route('team.show',$team['id'])}}"><button type="button" class="btn btn-default"><i class="fa fa-eye"></i></button></a>
                                        <a href="{{route('team.edit',$team['id'])}}"><button type="button" class="btn btn-info"><i class="fa fa-edit"></i></button></a>
                                        <a onclick="event.preventDefault();document.getElementById('Delete-form_{{$team["id"]}}').submit();"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                            <form id="Delete-form_{{$team['id']}}" action="{{ route('team.destroy',$team['id']) }}" method="POST" style="display: none;">
                                                {{csrf_field()}}
                                                {{method_field('delete')}}
                                            </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

	            	


@endsection