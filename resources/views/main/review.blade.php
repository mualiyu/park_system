@extends('layouts.index')

@section('style')
<style>
tr[disabled] {
   filter: blur(1px);
  pointer-events: none;
  background: rgba(0, 0, 0, 0.4);
  border-radius: 10px;
}
</style>   
@endsection

@section('content')
<div class="contact-page">
      <div class="container">
	      <br>
        <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Transaction Record</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-nowrap">
                                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select
                                            class="form-control form-control-sm custom-select custom-select-sm">
                                            <option value="10" selected="">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>&nbsp;</label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search"
                                            class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
				<table class="table my-0" id="dataTable">
                                <thead>
					<tr>
						<th>Park Name</th>
                                        <th>Space</th>
                                        <th>Price</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
					<th>Payment</th>
                                        <th>Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($transactions as $t)
				<?php $space = \App\Models\Space::find($t->space_id);
					$park = \App\Models\Park::find($space->park_id);
					// $end = explode('T', $t->time_D);
					$endTime = $t->time_D;
					// $end['0'].' '.$end[1].':00';
					
					if ($endTime < now()) {
						$disable = "Disabled";
						// echo "yess";
					}else {
						$disable = " ";
						// echo "no";
					}
					?>
					
				   <tr {{$endTime > now() ? "":"Disabled"}}>
				       <td>{{$park->name}}</td>
				       <td>{{$space->name}}</td>
				       <td>NGN{{$park->price/100}}</td>
				       <td>{{$t->time_A}}</td>
				       <td>{{$endTime}}</td>
				       <td>
					@if ($t->payment_status)
					   <span class="btn btn-success disabled">Paid</span>
					@else
					   <a href="{{route('show_pay',['id'=>$t->id])}}" class="btn btn-{{$endTime > now() ? "primary":"secondary disabled"}}">Pay now</span>
				       @endif</td>

				       <td>
					@if ($t->status)
					   <span class="btn btn-success">Active</span>
					@else
					   <span class="btn btn-warning {{$endTime > now() ? "":" disabled"}}">Inactive</span>
				       @endif</td>
				   </tr>
				   @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Park Name</th>
                                        <th>Space</th>
                                        <th>Price</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
					<th>Payment</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
      </div>
    </div>

@endsection
