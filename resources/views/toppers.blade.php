@extends('layouts.app2')
@section('content')
<!--==========================
    Hero Section
  ============================-->
  <!-- <section id="hero">
    <div class="hero-container">
      <h1>Welcome to Quiz</h1>
      <h2>We are here to provide best online quizzes for our customers.</h2>
      <a href="#about" class="btn-get-started">Get Started</a>
    </div>
  </section> --><!-- #hero -->
<style type="text/css">
  #header{
    background: rgba(52, 59, 64, 0.9);
    padding: 20px 0;
    height: 72px;
    transition: all 0.5s;
  }
</style>
  <main id="main">
 
    
    <!--==========================
      Team Section
    ============================-->
    <section id="team">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h3 class="section-title">Toppers</h3>
          <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </div>
        <div class="row">
            @if(count($finalResult))
            @foreach($finalResult as $results)
            <div class="col-lg-3 col-md-6">
                <div class="member">
                    <div class="pic"><img src="{{asset('assets/img/portfolio/user-dummy.png')}}" alt=""></div>
                    <h4>{{$results['teams']['name']}}</h4>
                    <span>{{$results->getPercent($results['team_id'],$results['quiz_id'])}} %</span>
                    <span>{{$results['quiz']['quiz_name']}}</span>
                    <!-- <div class="social">
                        <a href=""><i class="fa fa-twitter"></i></a>
                        <a href=""><i class="fa fa-facebook"></i></a>
                        <a href=""><i class="fa fa-google-plus"></i></a>
                        <a href=""><i class="fa fa-linkedin"></i></a>
                    </div> -->
                </div>
            </div>
          @endforeach
          @else
            <div class="col-lg-3 col-md-6">
                <div class="alert alert-info">
                No toppers found
                </div>
            </div>
          @endif
        </div>

      </div>
    </section><!-- #team -->
    <section id="team">
    </section>
    <section id="team">
    </section>

  </main>

@endsection