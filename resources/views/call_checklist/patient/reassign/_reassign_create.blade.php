@extends('call_checklist.app')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"/>
<div class="app-title">
	<div>
		<h1><i class="fa fa-tags"></i> Doctors Reassign</h1>
	</div>
</div>


<div class="row">
	<!-- left column -->
	<div class="col-md-12 mx-auto">
		<div class="tile">
			<div class="row">
				<div class="col-md-6">
					<label class="control-label"><b><h5>Client ID :</h5></b></label>
					<label class="control-label"><b><h5>{{$requesrt->unique_id}}</h5></b></label>
				</div>
				<div class="col-md-6">
					<label class="control-label"><b><h5>Phone Nomber : </h5></b></label>
					<label class="control-label"><b><h5>{{ $requesrt->phone_number }}</h5></b></label>
				</div>
			</div><hr>
			<div class="row">
				<div class="col-md-12">
					<label class="form-label"><b><h5>Reason: </h5></b></label>
					<label class="form-label">
						@if($requesrt->reason_for_reassing !="")
						<b>{{$requesrt->reason_for_reassing}}</b> 
						@endif 
					</label>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<!-- left column -->
	<div class="col-md-12 mx-auto">
		<div class="tile" style="background-color:#DCDCDC">
			<div class="tile-body">
				<div class="row g-3">
					<div class="col-md-4">
						<label class="form-label"><b>Client Name : </b></label>
						<label class="form-label"><b>{{ $session->name }}</b></label>
					</div>
					<div class="col-md-4">
						<label class="form-label"><b>Age : </b></label>
						<label class="form-label"><b>{{ $session->age }}</b></label>
					</div>
					<div class="col-md-4">
						<label class="form-label"><b>Phone Number : </b></label>
						<label class="form-label"><b>{{ $session->phone_number }}</b></label>
					</div>
				</div><hr>
				<div class="row g-3">
					<div class="col-md-4">
						<label class="form-label"><b>Reason for Therapy : </b></label>
						<label class="form-label"><b>{{ $session->reason_for_therapy }}</b></label>
					</div>
					<div class="col-md-4">
						<label class="form-label"><b>Date / Time : </b></label>
						<label class="form-label"><b>{{ $session->session_date }}/{{$session->session_time}}</b></label>
					</div>
					<div class="col-md-4">
						<label class="form-label"><b>Appointment Status : </b></label>
						<label class="form-label"><b>{{ $session->appointment_status_flag }}</b></label>
					</div>
				</div><hr>
				<div class="row g-2">
					<div class="col-md-6">
						<label class="form-label"><b>Therapist and Psychiatrist : </b></label>
						<label class="form-label"><b>{{ $session->therapist_or_psychiatrist }}</b></label>
					</div>
					<div class="col-md-6">
						<label class="form-label"><b>Session Status : </b></label>
						<label class="form-label"><b>{{ $session->session_taken }}</b></label>
					</div>
				</div>
			</div><hr>
			<div class="col-md-12">
				<p style="text-align:right;">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
						Doctors Reassign
					</button>
				</p>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Assign Counselor</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('reassign.store') }}" method="POST">
				@csrf
				<div class="modal-body">
					<input type="hidden" name="unique_id" value="{{ $requesrt->unique_id }}">
					<input type="hidden" name="session_id" value="{{ $requesrt->session_id }}">
					
					<input type="hidden" name="reassign_list_id" value="{{ $requesrt->id }}">
					<div class="form-group col-12">
						<label for="exampleFormControlSelect3">Consultent</label>
						<select class="form-control" name="referred_therapist_or_psychiatrist_user_id" value=""
						id="exampleFormControlSelect3">
						<option value="" disabled selected>Select Consultent</option>
						@foreach ($consultants as $consultant)
						<option value="{{ $consultant->user_id }}">{{ $consultant->full_name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Assign</button>
			</div>
		</form>
	</div>
</div>
</div>

@endsection