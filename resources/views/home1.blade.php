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
</style>
<main id="main">
    <section id="portfolio">
      <div class="container wow fadeInUp">
        <div class="text-center">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
        <div class="section-header">
          <h3 class="section-title">Profile</h3>
          <p class="section-description"></p>
        </div>
        <div class="row">

          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter=".filter-data" class="filter-active">Team Detail</li>
              <li data-filter=".filter-web">Members</li>
            </ul>
          </div>
        </div>

        <div class="row" id="portfolio-wrapper">
          <div class="col-lg-8 col-md-6 portfolio-item filter-data" id="Details">
            <a >
              <!-- <img src="{{asset('assets/img/portfolio/app1.jpg')}}" alt=""> -->
              <div class="details" style="height: 200px;">
                <h4><b>Name</b>: {{Auth::user()['name']}}</h4>
                <h4><b>Id</b>: {{Auth::user()['unique_id']}}</h4>
                <h4><b>Members</b>: {{count($students)}}</h4>
                <h4><b>Quizzes</b>: {{count(Auth::user()->quizzes)}}</h4>
                <h4><b>Percentage By Quiz </b> : &nbsp;
                <?php $count = 1; ?>
                @if($myMarks)
                @foreach($myMarks as $key => $myMark)
                   {{$count}} - {{Auth::user()->quizDetail($key)['quiz_name']}} ({{$myMark}} % )
                  <?php $count ++; ?>
                  <br>
                @endforeach
                @else
                  0
                @endif
                </h4>
              </div>
            </a>
          </div>

          @foreach($students as $student)
          <div class="col-lg-3 col-md-6 portfolio-item filter-web">
            <a >
              <img src="{{asset('assets/img/portfolio/user-dummy.png')}}" alt="">
              <div class="details">
                <h4>{{$student['name']}}</h4>
                <span>{{$student['email']}}</span>
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
