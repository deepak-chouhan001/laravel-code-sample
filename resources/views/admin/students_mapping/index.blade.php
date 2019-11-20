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
                  <h3 class="box-title">Team-Quiz Mapping Records</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="display: none;">Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Team</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $key => $quiz_teamMap)
                            <tr>
                                <td style="display: none;">{{$quiz_teamMap['id']}}</td>
                                <td>{{$quiz_teamMap['name']}}</td>
                                <td>{{$quiz_teamMap['email']}}</td>
                                <td>{{$quiz_teamMap['team']['name']}}</td>
                                <td>
                                    <div class="btn-group-horizontal">
                                        <a href="{{route('student.show',$quiz_teamMap['id'])}}"><button type="button" class="btn btn-default"><i class="fa fa-eye"></i></button></a>
                                        <a href="{{route('student.edit',$quiz_teamMap['id'])}}"><button type="button" class="btn btn-info"><i class="fa fa-edit"></i></button></a>
                                        <a onclick="event.preventDefault();document.getElementById('Delete-form_{{$quiz_teamMap["id"]}}').submit();"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                            <form id="Delete-form_{{$quiz_teamMap['id']}}" action="{{ route('student.destroy',$quiz_teamMap['id']) }}" method="POST" style="display: none;">
                                                {{method_field('delete')}}
                                                {{csrf_field()}}
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