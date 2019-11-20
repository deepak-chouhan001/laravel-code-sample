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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Quiz Details</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <tr>
                            <th>Name</th>
                            <td>{{$quiz['quiz_name']}}</td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>
                                @if($quiz->isLive())
                                    Live Quiz
                                @else
                                    Sample Quiz
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($quiz->isEnable())
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