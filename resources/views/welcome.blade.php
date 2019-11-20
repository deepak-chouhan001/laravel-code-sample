@extends('layouts.app2')
@section('content')
<!--==========================
    Hero Section
  ============================-->

  <section id="hero">
    <div class="hero-container">
    	
      <h1>Welcome to Quiz Contest</h1>
      <h2>We are here to provide best online quizzes for our customers.</h2>
      <a href="{{route('team.login')}}" class="btn-get-started">Get Started</a>
    </div>
  </section>

@endsection