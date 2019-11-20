@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Question
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Question</li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-1"></div>
        <div class="col-xs-10">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Question</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{ route('question.store') }}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group ">
                                <label for="name" >Question</label>
                                    <textarea id="local-upload" name="description"></textarea>
                                    <input type='hidden' name='fileupload' id='fileupload' >

                                    @if ($errors->has('fileupload'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fileupload') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="quiz_id" >Quiz</label>
                                    <select id="quiz_id" class="form-control " name="quiz_id" required autocomplete="quiz_id" autofocus>
                                        <option value="">Choose One quiz</option>
                                        @foreach($quizes as $quiz)
                                            <option value="{{$quiz['id']}}">{{$quiz['quiz_name']}}</option>
                                        @endforeach
                                    </select>
                                   @if ($errors->has('quiz_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quiz_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="name" >Answer</label>
                                    <input id="answer" type="text" class="form-control" name="answer" value="{{ old('answer') }}" required autocomplete="answer" autofocus>

                                   @if ($errors->has('answer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answer') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="name" >Option Format</label>
                                    Text <input class="option_format" required name="format" type="radio" value="text" >
                                    Image<input class="option_format" required name="format"  type="radio" value="file" >

                                    @if ($errors->has('format'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('format') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="name">Option A</label>
                                <input id="answer" type="text" class="form-control optionFormat " name="option[A]" value="{{ old('answer') }}" required autocomplete="answer" autofocus>

                                @if ($errors->has('option[A]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('option[A]') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="name">Option B</label>
                                    <input id="answer" type="text" class="form-control optionFormat " name="option[B]" value="{{ old('answer') }}" required autocomplete="answer" autofocus>

                                    @if ($errors->has('option[B]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('option[B]') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="name" >Option C</label>
                                    <input id="answer" type="text" class="form-control optionFormat " name="option[C]" value="{{ old('answer') }}" required autocomplete="answer" autofocus>

                                    @if ($errors->has('option[C]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('option[C]') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="name" >Option D</label>
                                    <input id="answer" type="text" class="form-control optionFormat " name="option[D]" value="{{ old('answer') }}" required autocomplete="answer" autofocus>

                                    @if ($errors->has('option[D]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('option[D]') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="status" >Status</label>
                                Active <input id="status" type="radio" name="status" value="1"  autocomplete="status" autofocus>
                                De-Active<input id="status" type="radio" name="status" value="0"  autocomplete="status" autofocus>

                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>                  
                            <button class="btn btn-info pull-right" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{asset('assets/bower_components/jquery/dist/jquery.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function(){
    $(".option_format").change(function(){
        var val = $(this).val();
        $(".optionFormat").attr('type',val);
    });
});
</script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector : '#local-upload',
        plugins : 'image',
        toolbar : 'image',

        images_upload_url : '{{route("image.upload")}}',
        automatic_uploads : false,

        images_upload_handler : function(blobInfo, success, failure) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '{{route("image.upload")}}');

            xhr.onload = function() {
                var json;

                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.file_path != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                success(json.file_path);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            // formData.append('X-CSRF-Token', '{{csrf_token()}}');
            
                
            xhr.setRequestHeader('X-CSRF-Token', '{{csrf_token()}}');
                
            xhr.send(formData);
        },
    });
</script>
@endsection
