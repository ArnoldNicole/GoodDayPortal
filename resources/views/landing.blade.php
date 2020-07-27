@extends('layouts.landing')
@section('content')

<header class="masthead text-white text-center">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <h1 class="mb-3 text-info">Welcome to the <span class="text-danger">Good Day Centre</span> Portal</h1>
      </div>
      <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
        
          <div class="form-row">
            <div class="col-12 col-md-9 mb-2 mb-md-0">
              <input type="email" class="form-control form-control-lg" placeholder="Enter your email...">
            </div>
            <div class="col-12 col-md-3">
              <button type="submit" class="btn btn-block btn-lg btn-primary">Subscribe</button>
            </div>
          </div>
        
      </div>
    </div>
  </div>
</header>

<!-- Icons Grid -->
<section class="features-icons bg-light text-center mt-3 mb-3">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
          <div class="features-icons-icon d-flex">
            <i class="icon-screen-desktop m-auto text-primary"></i>
          </div>
          <h3>Quality</h3>
          <p class="lead mb-0">We deliver the quality</p>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
          <div class="features-icons-icon d-flex">
            <i class="icon-layers m-auto text-primary"></i>
          </div>
          <h3>Motto</h3>
          <p class="lead mb-0">We strive to Excel</p>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
          <div class="features-icons-icon d-flex">
            <i class="icon-check m-auto text-primary"></i>
          </div>
          <h3>Vision</h3>
          <p class="lead mb-0">Be the best academic institution on the galaxy</p>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- Testimonials -->
<section class="testimonials text-center bg-light">
  <div class="container">
    <h2 class="mb-2">What people think about us...</h2>
    <div class="row">
      <div class="col-lg-4">
        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
          <img class="img-fluid w-25 rounded-circle mb-3" src="/img/testimonials-1.jpg" alt="">
          <h5>Margaret E.</h5>
          <p class="font-weight-light mb-0">"This is awesome! Keep the good work going!"</p>
        </div>
      </div> 
    </div>
  </div>
</section>

@endsection