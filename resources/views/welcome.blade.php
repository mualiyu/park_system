@extends('layouts.index')

@section('content')
    <!-- Banner Starts Here -->
    <div class="banner">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="caption">
              <h2>Parking Reservation System</h2>
              <div class="line-dec"></div>
              <p><strong>Online Vehicle Parking Reservation (OVPRS)</strong> system enables you to manage your car park wherever you are.. 
              <br><br>Please tell your friends and family about <a rel="nofollow" href="{{url('/')}}">OVPRS</a> site. Thank you.</p>
              <div class="main-button">
                <a href="{{url('/register')}}">Get Started Now!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->
@endsection
