@extends('call_checklist.app')
@section('title') {{ $data->caller_name }} @endsection
@section('content')
<div class="app-title">
	<div>
		<h1><i class="fa fa-tags"></i> {{ $data->caller_name }}</h1>
	</div>
</div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-7">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Client Details</h3> 
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row g-2">
            {{-- <div class="col-md-3 bg-primary">
              <div class="card-block text-center text-white">
                  <i class="fa-solid fa-user-nurse fa-7x mt-5"></i>
              </div>
          </div> --}}
          <div class="col-md-9">
            <div class="row g-2">
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">Name :</label>
                    <br>
                    <label for="validationCustom01" class="form-label">Client ID :</label>
                    <br>
                    <label for="validationCustom01" class="form-label">Age :</label>
                    <br>
                    <label for="validationCustom01" class="form-label">Gender :</label><br>
                    <label for="validationCustom01" class="form-label">Phone:</label>
                    <br>

                </div>
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label"><b>{{ $data->caller_name }}</b></label>
                    <br>
                    <label for="validationCustom01" class="form-label"><b>{{ $data->caller_id }}</b></label>
                    <input type="hidden" name="" id="caller_id" value="{{$data->caller_id}}" >
                    <br>
                    <label for="validationCustom01" class="form-label"><b>{{ $data->age }}</b></label>
                    <br>
                    <label for="validationCustom01" class="form-label"><b>{{ $data->sex }}</b></label><br>
                    <label for="validationCustom01" class="form-label"><b>{{ $data->phone_number }}</b></label>
                </div>
            </div><br>
        </div>
    </div><hr>
    <div class="col-md-12">
        <div class="row g-2">
            <div class="col-md-5">
                <label for="validationCustom01" class="form-label">Date :</label><br>
                <label for="validationCustom01" class="form-label">Occupation :</label><br>
                <label for="validationCustom01" class="form-label">Location:</label><br>
                <label for="validationCustom01" class="form-label">Socio-economic Status:</label><br>
                <label for="validationCustom01" class="form-label">Where/how did the Client hear about SHOJON:</label><br>
                <label for="validationCustom01" class="form-label">Call Type :</label><br>
                <label for="validationCustom01" class="form-label">Caller :</label><br>
                <label for="validationCustom01" class="form-label">Distress Rating: </label><br>
                <label for="validationCustom01" class="form-label">GHQ:</label><br>
            </div>
            <div class="col-md-7">
                <label for="validationCustom01" class="form-label"><b>{{ $data->date }}</b></label><br>
                <label for="validationCustom01" class="form-label"><b>{{ $data->occupation }}</b></label><br>
                <label for="validationCustom01" class="form-label"><b>{{ $data->location }}</b></label><br>
                <label for="validationCustom01" class="form-label"><b>{{ $data->socio_economic }}</b></label><br>
                <label for="validationCustom01" class="form-label"><b>{{ $data->hear_about_shojon }}</b></label><br><br>
                <label for="validationCustom01" class="form-label"><b>{{ $data->call_Type }}</b></label><br>
                <label for="validationCustom01" class="form-label"><b>{{ $data->caller }}</b></label><br>
                <label for="validationCustom01" class="form-label"><b>{{ $data->distress }}</b></label><br>
                <label for="validationCustom01" class="form-label"><b>{{ $data->who }} %</b></label><br>
            </div>
        </div><br>
    </div>
</div>
</div>
<div class="card card-primary">
<!-- /.card-header -->
<div class="card-body">
  <div class="col-md-12">
      <div class="row">
     <div class="col-md-12">
        <label for="validationCustom01" class="form-label">Internal Referral:</label><br>
        <ul>
        	@if($data->internal_referr !="")
            <li><b>{{ $data->internal_referr }}</b></li> 
            @endif  
        </ul>
    </div>
</div><hr>
<div class="row g-1">
 <div class="col-md-12">
     <label for="validationCustom01" class="form-label">Reason for referral:</label><br>
     <label class="form-control">
      <label for="validationCustom01" style="color:black;" class="form-label"><b>{{
      	$data->reason_for_referral
      }}</b></label>
  </label>
</div>
</div><hr>
<div class="row">
     <div class="col-md-12">
        <label for="validationCustom01" class="form-label">External Referral:</label><br>
        <ul>
        	@if($data->name_of_agency !="")
            <li><b>{{ $data->name_of_agency }}</b></li> 
            @endif  
        </ul>
    </div>
</div><hr>

</div>
</div>
</div>  
</div>
<div class="col-md-5">
    <!-- Form Element sizes -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Others Info</h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-12">
                <div class="row g-2">
                    <div class="col-md-5">
                        <label for="validationCustom01" class="form-label">Program Name:</label><br>
                        <label for="validationCustom01" class="form-label">Service Providers Name:</label><br>
                        <label for="validationCustom01" class="form-label">Service Providers ID:</label><br>
                        <label for="validationCustom01" class="form-label">Call Started :</label><br>
                        <label for="validationCustom01" class="form-label">Call Ended:</label><br>
                        <label for="validationCustom01" class="form-label">Duration of Call:</label>
                    </div>
                    <div class="col-md-7">
                       <label for="validationCustom01" class="form-label"><b>{{ $data->program_name }}</b></label><br>
                       <label for="validationCustom01" class="form-label"><b>{{ $data->service_providers_name }}</b></label><br><br>
                       <label for="validationCustom01" class="form-label"><b>{{ $data->service_providers_di }}</b></label><br>
                       <label for="validationCustom01" class="form-label"><b>{{ $data->time_call_started }}</b></label><br>
                       <label for="validationCustom01" class="form-label"><b>{{ $data->time_call_ended }}</b></label><br>
                       <label for="validationCustom01" class="form-label"><b>{{ $data->duration }}</b></label>
                   </div>
               </div>
           </div>
       </div>
       
   </div> 
</div>
<div class="card card-primary">
 <!--  <div class="card-header">
    <h3 class="card-title">ASSESSMENT</h3>
</div> -->
<div class="card-body">

    <div class="row">
        <div class="col-md-12">
      <div class="row">
     <div class="col-md-12">
        <label for="validationCustom01" class="form-label">Primary Reason for Calling </label><br>
        <ul>
        	@if($data->primary_reason !="")
            <li><b>{{ $data->primary_reason }}</b></li> 
            @endif  
        </ul>
    </div>
</div><hr>
     <div class="row">
     <div class="col-md-12">
     	@php
        $check_item = json_decode($data->secondary_reason);
        @endphp
        <label for="validationCustom01" class="form-label">Secondary reason  </label><br>
        <ul>
        	@if ($check_item != "")
            @foreach($check_item as $info) 
            <li><b>{{$info}}</b></li>
            @endforeach
            @endif  
        </ul>
    </div> 
</div><hr>
<div class="row">
     <div class="col-md-12">
     	@php
        $check_item = json_decode($data->mental_illness_diagnosis);
        @endphp
        <label for="validationCustom01" class="form-label">Does the client have any mental illness diagnosis?</label><br>
        <ul>
        	@if ($check_item != "")
            @foreach($check_item as $info) 
            <li><b>{{$info}}</b></li>
            @endforeach
            @endif  
        </ul>
    </div>
</div><hr>
 <div class="row g-2">
     <div class="col-md-5">
         <label for="validationCustom01" class="form-label">Does the client have suicidal risk:</label>
     </div>
     <div class="col-md-7">
         <label for="validationCustom01" class="form-label"><b>{{$data->suicidal_risk}}</b></label>
     </div>
 </div><hr>
 <div class="row">
     <div class="col-md-12">
        <label for="validationCustom01" class="form-label">How effective the session went for the client? (Client rating of effectiveness)</label><br>
        <ul>
        	@if($data->effective !="")
            <li><b>{{ $data->effective }}</b></li> 
            @endif  
        </ul>
    </div>
</div><hr>
 <div class="row">
     <div class="col-md-12">
        <label for="validationCustom01" class="form-label"><b>Call Ddescription</b></label><br>
        <ul>
            @if($data->call_description !="")
            <li><b>{{ $data->call_description }}</b></li> 
            @endif  
        </ul>
    </div>
</div><hr>
 <div class="row">
     <div class="col-md-12">
        <label for="validationCustom01" class="form-label"><b>Message</b></label><br>
        <ul>
            @if($data->message !="")
            <li><b>{{ $data->message }}</b></li> 
            @endif  
        </ul>
    </div>
</div>
</div>
</div>
</div> 
</div>
</div>  
</div>
</div>
</section>
<section>
 <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">REFERRAL TABLE</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-hover table-bordered table-responsive" id="sampleTablereferral">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Referr Fom</th>
                            <th class="text-center">Referr To</th>
                            <th class="text-center">Client Name</th>
                            <th class="text-center">Client ID</th>
                            <th class="text-center"> Age </th>
                            <th class="text-center"> Phone Number </th>
                            <th class="text-center"> Emergency Number </th>
                            <th class="text-center"> Reason for Therapy </th>
                            <th class="text-center"> Preferred time for session </th>
                            <th class="text-center"> Financial affordability </th>
                            <th class="text-center"> Therapist preference </th>
                            <th class="text-center"> Referral Types </th>
                             
                        </tr>
                        </thead>
                        <tbody id="content">

                        </tbody>
                    </table>
        </div> 
    </div> 
</div>  
</div>
</div>      
</section> 
<section>
 <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">TERMINATION TABLE</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-hover table-bordered table-responsive" id="sampleTabletarmination">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Project name</th>
                            <th class="text-center">Counselor name</th>
                            <th class="text-center">Client name</th>
                            <th class="text-center">Client ID</th>
                            <th class="text-center">Main reason for termination</th>
                            <th class="text-center"> Source of termination Decision </th>
                            <th class="text-center"> Referred date </th>
                            <th class="text-center"> Date of first contact </th>
                            <th class="text-center"> Date of last session </th>
                            <th class="text-center"> No of sessions </th>
                            <th class="text-center"> Treatment session summary </th>
                            <th class="text-center"> Distress Rating </th>
                            <th class="text-center"> Wellbeing scale rating </th>
                            <th class="text-center"> Psychological tools rating </th>
                            <th class="text-center"> Counselor overall feedback </th>
                            <th class="text-center"> Clients core learning from the session </th>
                            
                        </tr>
                        </thead>
                        <tbody id="termination_Tb">
                           
                        </tbody>
                    </table>
        </div> 
    </div> 
</div>  
</div>
</div>      
</section>  
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTablereferral').DataTable();</script>
    <script type="text/javascript">$('#sampleTabletarmination').DataTable();</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>  
<script>
    $(document).ready(function(){
        var caller_id = $("#caller_id").val();
        $.ajax({
            type: "get",
            url: "/call-checklist/shojon/referral_table",
            data: {caller_id: caller_id},
            success: function (data) {
                console.log(data);
                $('#content').html(data);
            }
        });
    });
    $(document).ready(function(){
        $.ajax({
            type: "get",
            url: "/call-checklist/shojon/termination_table",
            success: function (data) {
                console.log(data);
                $('#termination_Tb').html(data);
            }
        });
    });
</script>