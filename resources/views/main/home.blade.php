@extends('layouts.index')

@section('content')

<div class="contact-page">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <div class="line-dec"></div>
              <h1>Reserve Parking Space</h1>
            </div>
          </div>
          <div class="col-md-12">
            <div class="right-content">
              <div class="container">
		      @if (session('errors'))
			      <span class="invalid-feedback" role="alert">
				  <strong>{{ $errors }}</strong>
			      </span>
		      @endif
                <form id="contact" action="{{route('create_reserve')}}" method="post">
			@csrf
                  <div class="row">
                    <div class="col-md-6">
                      <fieldset>
			      <?php $daEx =  explode(' ', date("Y-m-d h:m")); ?>
			      {{-- {{$daEx[0].'T'.$daEx[1]}} --}}
			<label for="time_a">Time of Arival:</label>
                        <input name="time_a" type="datetime-local" min="{{$daEx[0].'T'.$daEx[1]}}" class="form-control" id="time_a"  required="">
			@error('time_a')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
		</fieldset>
                    </div>
                    <div class="col-md-6">
                      <fieldset>
			<label for="time_d">Time of dupature:</label>
                        <input name="time_d" type="datetime-local" class="form-control" id="time_d" placeholder="Your email..." required="">
                      </fieldset>
                    </div>
		    <div class="col-md-6">
                      <fieldset>
			<label for="model">Vehicle Model:</label>
                        <input name="model" type="text" class="form-control" id="model" placeholder="Your Car Model..."  required="">
                      </fieldset>
                    </div>
                    <div class="col-md-6">
                      <fieldset>
			<label for="plate_num">Plate Number:</label>
                        <input name="plate_num" type="text" class="form-control" id="plate_num" placeholder="Your Car Plate Number..." required="">
                      </fieldset>
                    </div>
		    @if (count($parks))
                    <div class="col-md-6 	">
                      <fieldset>
			<div class="form-group">
			<label for="time_a">Choose Park:</label>
			@foreach ($parks as $park)
                           <div class="form-check">
				   <label class="" style="font-size: 18px" for="id_{{$park->id}}">
                               <input class="form-check-input" name="park" onchange="$('#nn_{{$park->id}}').toggle()" type="radio" value="{{$park->id}}" id="id_{{$park->id}}">
                               {{$park->name}}<small> (NGN{{$park->price/100}})</small>
                               </label>
                           </div>
                           <div class="" id="nn_{{$park->id}}" style="display: none; background:#d7d7d7;">
				<hr>
                               <label class=" mb-1" for="benTax"><small>Select Parking Space</small></label>
                               <select name="space[{{$park->id}}]" class="input-group" id="benTax" placeholder="Select" >
				<?php $spaces = \App\Models\Space::where("park_id", "=", $park->id)->get();?>
                                   {{-- <option value=''>None</option>
                                   <hr> --}}
                                   @if ($spaces)

                                   @foreach ($spaces as $space)
				   <?php $trans = \App\Models\Transaction::where("space_id", "=", $space->id)->get();?>
				   @if (!count($trans) > 0 )
                                   <option value="{{$space->id}}">{{$space->name}}</option>
				   @else
				    <option value="" >select</option>  
				   @endif
                                   @endforeach

				   @endif
				   @if (!count($spaces) > 0)
                                   <option value="" >select</option>
                                   @endif
                               </select>
                           </div>
                        @endforeach
			</div>
                      </fieldset>
                    </div>
		    @endif
                    <div class="col-md-12">
                      <fieldset>
                        <button type="submit" style="float: right;" id="form-submit" class="button">Proceed to Pay</button>
                      </fieldset>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
