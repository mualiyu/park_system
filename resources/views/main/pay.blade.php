@extends('layouts.index')

@section('content')

<div class="contact-page">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <div class="line-dec"></div>
              <h1>Review & and proceed to Payment</h1>
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
		      @if ($msg ?? '')
			      <span class="invalid-feedback" role="alert">
				  <strong>{{ $msg }}</strong>
			      </span>
		      @endif
                <form id="contact form" action="{{route('pay')}}" method="POST">
		  @csrf
                  <div class="row">
                    <div class="col-md-6">
                      <fieldset>
			      <?php $daEx =  explode(' ', date("Y-m-d h:m")); ?>
			      {{-- {{$daEx[0].'T'.$daEx[1]}} --}}
			<label for="time_a">Time of Arival:</label>
                        <span name="time_a" value="" disabled  min="{{$daEx[0].'T'.$daEx[1]}}" class="form-control disabled" id="time_a">{{$transaction->time_A}}</span>
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
                        <span name="time_d"  disabled value="" class="form-control disabled" id="time_d" >{{$transaction->time_D}}</span>
                      </fieldset>
                    </div>
		    <div class="col-md-6">
                      <fieldset>
			<label for="model">Vehicle Model:</label>
                        <input name="model" type="text" disabled value="{{$transaction->model}}" class="form-control" id="model" placeholder="Your Car Model..."  required="">
                      </fieldset>
                    </div>
                    <div class="col-md-6">
                      <fieldset>
			<label for="plate_num">Plate Number:</label>
                        <input name="plate_num" disabled value="{{$transaction->plate_num}}" type="text" class="form-control" id="plate_num" placeholder="Your Car Plate Number..." required="">
                      </fieldset>
                    </div>
                    <div class="col-md-6">
                      <fieldset>
			<div class="form-group">
			<label for="time_a">Choose Park:</label>
                           <div class="form-check">
				   <?php $space = \App\Models\Space::where("id", "=", $transaction->space_id)->get();?>
				   <?php $park = \App\Models\Park::find($space[0]->park_id);?>
				   <label class="" style="font-size: 18px" for="id_{{$park->id}}">
                               <input class="form-check-input" disabled name="park" checked onchange="$('#nn_{{$park->id}}').toggle()" type="radio" value="{{$park->id}}" id="id_{{$park->id}}">
                               {{$park->name}}<small> (NGN{{$park->price/100}})</small>
                               </label>
                           </div>
                           <div class="" id="nn_{{$park->id}}" style="display: block; background:#d7d7d7;">
				<hr>
                               <label class=" mb-1" for="benTax"><small>Select Parking Space</small></label>
                               <select disabled name="space[{{$park->id}}]" class="input-group" id="benTax" placeholder="Select" >
                                   {{-- <option value=''>None</option>
                                   <hr> --}}
                                   <option value="{{$space[0]->id}}">{{$space[0]->name}}</option>
                               </select>
                           </div>
			</div>
                      </fieldset>
                    </div>
		     	<input type="hidden" name="email" value="{{Auth::user()->email}}"> {{-- required --}}
            		<input type="hidden" name="orderID" value="{{$transaction->id}}">
            		<input type="hidden" name="amount" value="{{$park->price}}"> {{-- required in kobo --}}
            		<input type="hidden" name="quantity" value="1">
            		<input type="hidden" name="currency" value="NGN">
            		<input type="hidden" name="metadata" value="{{ json_encode($array = ['trans_id' => $transaction->id, 'space_id'=>$space[0]->id, 'user_id' => Auth::user()->id,]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
            		<input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}

			<div class="col-md-12">
				<fieldset>
			      <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
				  <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
			      </button>
                        {{-- <button type="submit" style="float: right;" id="form-submit" class="button">Pay</button> --}}
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


@section('script')
    
@endsection
