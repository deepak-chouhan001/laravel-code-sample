@foreach($Question as $key=>$ques)
<div class="privew">
    <div class="questionsBox">                                    
        <div class="questions">                                            
          
            <div><strong>{{$ques['id']}} : </strong>
            {!!htmlspecialchars_decode($ques['description'])!!}</div>
          
          <input type="hidden" name="questId[]" value="{{$ques['id']}}">
        </div>
         
        @if($ques['format'] == "file")
          <ul class="answerList">
            @foreach(json_decode($ques['option']) as $key1 => $option)
              <li>
                  <label>
                      <input type="radio" data-id="{{$ques['id']}}" onchange="radioChange(this)" class="radio_{{$ques['id']}}" @if($examination_raw->getAnswer($ques['id'])['answer_id'] == $key1) checked @endif  name="answer[{{$ques['id']}}]" value="{{$key1}}" id="{{$ques['id']}}"> <img src="/{{$option}}" style="width: 12%;"></label>
              </li>
            @endforeach
          </ul>
        @else

          <ul class="answerList">
              @foreach(json_decode($ques['option']) as $key2 => $option)
              <li>
                  <label>
                      <input data-id="{{$ques['id']}}" class="radio_{{$ques['id']}}" onchange="radioChange(this)" @if($examination_raw->getAnswer($ques['id'])['answer_id'] == $key2) checked @endif type="radio" name="answer[{{$ques['id']}}]" value="{{$key2}}" id="{{$ques['id']}}"> 
                      {{$option}}
                  </label>
              </li>
              @endforeach
          </ul>
        @endif
    </div>
    <button type="button" data-qId="{{$ques['id']}}" onclick="reviewBtnClick(this)" class="btn btn-info reviewBtn">Set To Review</button>

</div>
<?php
$params = array('data-id' => $ques['id']);
?>

@endforeach

{{$Question->appends($params)->links()}}