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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Team-Quiz Detail</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <tr>
                            <th>Name</th>
                            <td>{{$students['name']}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$students['email']}}</td>
                        </tr>
                        <tr>
                            <th>Team</th>
                            <td>{{$students['team']['name']}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection