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
                                <th style="display: none;">Id</th>                               
                                <th>Unique Id</th>
                                <th>Quiz</th>
                                <th>Name</th>
                                <th>Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($toppers as $key => $team)
                            <tr>
                                <td style="display: none;">{{$team['id']}}</td>
                                <td>{{$team['teams']['unique_id']}}</td>
                                <td>{{$team['quiz']['quiz_name']}}</td>
                                <td>{{$team['teams']['name']}}</td>
                                <td>{{$team['points']}}</td>
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