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
                  <h3 class="box-title">Quiz Records</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="display: none;">Id</th>
                                <th>Name</th>
                                <th>Assigned points</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizs as $key => $quiz)
                            <tr>
                                <td style="display: none;">{{$quiz['id']}}</td>
                                <td>{{$quiz['quiz_name']}}</td>
                                <td>{{$quiz['points']}}</td>
                                <td>
                                    <div class="btn-group-horizontal">
                                        <a href="{{route('get.question',$quiz['id'])}}"><button type="button" class="btn btn-default">View Questions</button></a>
                                        <a href="{{route('quiz.show',$quiz['id'])}}"><button type="button" class="btn btn-default"><i class="fa fa-eye"></i></button></a>
                                        <a href="{{route('quiz.edit',$quiz['id'])}}"><button type="button" class="btn btn-info"><i class="fa fa-edit"></i></button></a>
                                        <a onclick="event.preventDefault();document.getElementById('Delete-form_{{$quiz["id"]}}').submit();"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                            <form id="Delete-form_{{$quiz['id']}}" action="{{ route('quiz.destroy',$quiz['id']) }}" method="POST" style="display: none;">
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