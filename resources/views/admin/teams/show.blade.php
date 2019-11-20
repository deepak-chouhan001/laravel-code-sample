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
                  <h3 class="box-title">Team Details</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <tr>
                            <th>Unique Id</th>
                            <td>{{$teams['unique_id']}}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{$teams['name']}}</td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td>{{$teams['team_password']}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection