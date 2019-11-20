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
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Team-Quiz Detail</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <tr>
                            <th>Quiz Name</th>
                            <td>{{$quiz_teamMaps['quiz']['quiz_name']}}</td>
                        </tr>
                        <tr>
                            <th>Team</th>
                            <td>{{$quiz_teamMaps['team']['name']}}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>{{$quiz_teamMaps['start_date']}}</td>
                        </tr>
                        <tr>
                            <th>Time</th>
                            <td>{{$quiz_teamMaps['start_time']}}</td>
                        </tr>
                        <tr>
                            <th>Session time</th>
                            <td>{{$quiz_teamMaps['hours']}} Hours {{$quiz_teamMaps['minutes']}} Minutes</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($quiz_teamMaps->isEnable())
                                    Enabled
                                @else
                                    Disabled
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection