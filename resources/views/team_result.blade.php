@extends('layouts.app2')

@section('content')
<style type="text/css">
    #header{
            background: rgba(52, 59, 64, 0.9);
    padding: 20px 0;
    height: 72px;
    transition: all 0.5s;
    }
    .details{
        bottom: 0 !important;
    }
.tabs-left > .nav-tabs {
  border-bottom: 0;
}

.tab-content > .tab-pane,
.pill-content > .pill-pane {
  display: none;
}

.tab-content > .active,
.pill-content > .active {
  display: block;
}

.tabs-left > .nav-tabs > li {
  float: none;
}

.tabs-left > .nav-tabs > li > a {
  min-width: 74px;
  margin-right: 0;
  margin-bottom: 3px;
}

.tabs-left > .nav-tabs {
  float: left;
  margin-right: 19px;
  border-right: 1px solid #ddd;
}

.tabs-left > .nav-tabs > li > a {
  margin-right: -1px;
  -webkit-border-radius: 4px 0 0 4px;
     -moz-border-radius: 4px 0 0 4px;
          border-radius: 4px 0 0 4px;
}

.tabs-left > .nav-tabs > li > a:hover,
.tabs-left > .nav-tabs > li > a:focus {
  border-color: #eeeeee #dddddd #eeeeee #eeeeee;
}

.tabs-left > .nav-tabs .active > a,
.tabs-left > .nav-tabs .active > a:hover,
.tabs-left > .nav-tabs .active > a:focus {
  border-color: #ddd transparent #ddd #ddd;
  *border-right-color: #ffffff;
}
</style>
<main id="main">
    <section id="portfolio">
      
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h3 class="section-title">Exam Schedules</h3>
          <p class="section-description"></p>
        </div>
        <div class="row">

          <div class="col-lg-12">
            <ul id="portfolio-flters">
              @foreach($quizTeamMaps as $quizTeamMap)
              <li data-filter=".filter-web-{{$quizTeamMap['id']}}">{{$quizTeamMap['quiz']['quiz_name']}}</li>
              @endforeach
            </ul>
          </div>
        </div>

        <div class="row" id="portfolio-wrapper">

          @foreach($quizTeamMaps as $quizTeamMap)
          <div class="col-lg-3 col-md-6 portfolio-item filter-web-{{$quizTeamMap['id']}}">
            
            <a @if($quizTeamMap['status'] == 0) href="{{route('exam.byId',$quizTeamMap['id'])}}" @endif>
              <img src="{{asset('assets/img/portfolio/user-dummy.png')}}" alt="">
              <div class="details" style="height: 200px;">
                <h4>{{$quizTeamMap['quiz']['quiz_name']}}</h4>
                <span><b>Status:</b> {{$quizTeamMap->status()}}</span>
                <span><b>Points:</b> {{$quizTeamMap->points($quizTeamMap['quiz_id'],$quizTeamMap['team_id'])}}</span>
                <span><b>Exam Time:</b> {{$quizTeamMap['start_date']}} {{$quizTeamMap['start_time']}}</span>
              </div>
            </a>
           
          </div>
          @endforeach
        </div>

      </div>
    </section>
    <section id="portfolio">
    </section>

</main>       
 
@endsection
