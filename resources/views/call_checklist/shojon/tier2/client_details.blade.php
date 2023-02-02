@extends('call_checklist.app')
@section('title') {{ $data->caller_name }} @endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
<div class="app-title">
    <div>
        <h1><i class="fa-solid fa-user"></i><a href="">{{ $data->caller_name }}</span></a>
        </h1>
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
                <label for="validationCustom01" class="form-label">Educational Qualification:</label><br>
                <label for="validationCustom01" class="form-label">Marital Status:</label><br>
                <label for="validationCustom01" class="form-label">Session Number :</label><br>
                <label for="validationCustom01" class="form-label">Distress Rating: </label><br>
                <label for="validationCustom01" class="form-label">Rating of wellbeing:</label><br>
            </div>
            <div class="col-md-7">
                <label for="validationCustom01" class="form-label"><b>{{ $data->date }}</b></label><br>
                <label for="validationCustom01" class="form-label"><b>{{ $data->occupation }}</b></label><br>
                <label for="validationCustom01" class="form-label"><b>{{ $data->location }}</b></label><br>
                <label for="validationCustom01" class="form-label"><b>{{ $data->socio_economic }}</b></label><br>
                <label for="validationCustom01" class="form-label"><b>{{ $data->education }}</b></label><br>
                <label for="validationCustom01" class="form-label"><b>{{ $data->marital }}</b></label><br>
                <label for="validationCustom01" class="form-label"><b>{{ $data->session }}</b></label><br>
                <label for="validationCustom01" class="form-label"><b>{{ $data->distress }}</b></label><br>
                <label for="validationCustom01" class="form-label"><b>{{ $data->WHO }} %</b></label><br>
            </div>
        </div><br>
    </div>
</div>
</div>
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">TREATMENT/MANAGEMENT</h3>
</div>
<!-- /.card-header -->
<div class="card-body">
  <div class="col-md-12">
     <div class="row g-1">
         <div class="col-md-12">
             <label for="validationCustom01" class="form-label">Client’s Expectation from therapy:</label><br>
             <label class="form-control">
              <label for="validationCustom01" style="color:black;" class="form-label"><b>{{ $data->therapy }}</b></label>
          </label>
      </div>
  </div><hr>
  <div class="col-md-12">
     <table class="table table-bordered border-primary" id="dynamic_field_Treatment">
        <thead>
            <tr>
              <th scope="col">Predisposing Factor</th>
              <th scope="col">Precipitatory factor</th>
              <th scope="col">Perpetuating factor</th>
              <th scope="col">Protective Factor</th>
          </tr>
      </thead>
      <tbody>
        @if ($data->predisposing != "" && $data->precipitatory != "" && $data->perpetuating != "" && $data->protective != "" )
        @foreach(explode(';', $data->predisposing) as $key1 => $info1)
        @foreach(explode(';', $data->precipitatory) as $key2 =>$info2)
        @foreach(explode(';', $data->perpetuating) as $key3 =>$info3)
        @foreach(explode(';', $data->protective) as $key4 =>$info4)
        @if($key1 === $key2 && $key2 === $key3 && $key3 === $key4)
        <tr> 
         <td>{{$info1}}</td>
         <td>{{$info2}}</td>
         <td>{{$info3}}</td>
         <td>{{$info4}}</td>
     </tr>
     @endif
     @endforeach
     @endforeach
     @endforeach
     @endforeach
     @endif
 </tbody> 
</table>  
</div>
<div class="row g-1">
 <div class="col-md-12">
     <label for="validationCustom01" class="form-label">Short term Goal :</label><br>
     <label class="form-control">
      <label for="validationCustom01" style="color:black;" class="form-label"><b>{{ $data->short_term }}</b></label>
  </label>
</div>
</div><hr>
<div class="row g-1">
 <div class="col-md-12">
     <label for="validationCustom01" class="form-label">Long term goal :</label><br>
     <label class="form-control">
      <label for="validationCustom01" style="color:black;" class="form-label"><b>{{ $data->long_term }}</b></label>
  </label>
</div>
</div><hr>
<div class="row g-1">
 <div class="col-md-12">
     <label for="validationCustom01" class="form-label">Intervention:</label><br>
     <label class="form-control">
      <label for="validationCustom01" style="color:black;" class="form-label"><b>{{ $data->intervention }}</b></label>
  </label>
</div>
</div><hr>
<div class="row g-1">
 <div class="col-md-12">
     <label for="validationCustom01" class="form-label">Homework:</label><br>
     <label class="form-control">
      <label for="validationCustom01" style="color:black;" class="form-label"><b>{{ $data->homework }}</b></label>
  </label>
</div>
</div><hr>
<div class="row">
 <div class="col-md-12">
     <label for="validationCustom01" class="form-label">How useful and effective do you think the call has been for you? </label><br>
     <ul>
         @if ($data-> effective != "")
         @foreach(explode(';', $data-> effective) as $info) 
         <li><b>{{$info}}</b></li>
         @endforeach
         @endif
     </ul>
 </div>
</div><hr>
<div class="row g-1">
 <div class="col-md-12">
     <label for="validationCustom01" class="form-label">Next session plan:</label><br>
     <label class="form-control">
      <label for="validationCustom01" style="color:black;" class="form-label"><b>{{ $data->session_plan }}</b></label>
  </label>
</div>
</div><hr>
<div class="row g-1">
 <div class="col-md-12">
     <label for="validationCustom01" class="form-label">Session summary :</label><br>
     <label class="form-control">
      <label for="validationCustom01" style="color:black;" class="form-label"><b>{{ $data->session_summary }}</b></label>
  </label>
</div>
</div><hr>
<div class="row g-1">
 <div class="col-md-12">
     <label for="validationCustom01" class="form-label">Schedule next session:</label><br>
     <label class="form-control">
      <label for="validationCustom01" style="color:black;" class="form-label"><b>session_date</b></label>
  </label>
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
  <div class="card-header">
    <h3 class="card-title">ASSESSMENT</h3>
</div>
<div class="card-body">

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered border-primary" id="dynamic_field_Treatment">
                        <thead>
                            <tr>
                              <th scope="col">Symptoms</th>
                              <th scope="col">Severity</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                        $counter = 0;
                        @endphp
                        @if ($data->symptoms != "" && $data->severity != "")
                        @foreach(explode(';', $data->symptoms) as $key1 => $info)
                        @foreach(explode(';', $data->severity) as $key2 =>$infoSev)
                        @if($key1 === $key2)
                        <tr> 
                         <td>{{$info}}</td>
                         <td>{{$infoSev}}</td>
                     </tr>
                     @endif
                     @endforeach
                     @endforeach
                     @endif
                 </tbody> 
             </table>  
         </div>
     </div>
     <div class="row g-2">
         <div class="col-md-5">
             <label for="validationCustom01" class="form-label">Problem duration:</label>
         </div>
         <div class="col-md-7">
             <label for="validationCustom01" class="form-label"><b>{{ $data->problem_duration }}</b></label>
         </div>
     </div><hr>
     <div class="row g-1">
         <div class="col-md-12">
             <label for="validationCustom01" class="form-label">Illness/ problem history </label><br>
             <label class="form-control">
              <label for="validationCustom01" style="color:black;" class="form-label"><b>{{ $data->problem_history }}</b></label>
          </label>
      </div>
  </div><hr>
  <div class="row g-1">
     <div class="col-md-12">
         <label for="validationCustom01" class="form-label">Family History</label><br>
         <label class="form-control">
             <label for="validationCustom01" style="color:black;" class="form-label"><b>{{ $data->family_history }}</b></label>
         </label>
     </div>
 </div><hr>
 <div class="row g-2">
     <div class="col-md-5">
         <label for="validationCustom01" class="form-label">Does the client have suicidal Ideation?</label>
     </div>
     <div class="col-md-7">
         <label for="validationCustom01" class="form-label"><b>{{ $data->suicidal_ideation }}</b></label>
     </div>
 </div><hr>
 <div class="row g-2">
     <div class="col-md-5">
         <label for="validationCustom01" class="form-label">Does the client have any self-harm history? </label>
     </div>
     <div class="col-md-7">
         <label for="validationCustom01" class="form-label"><b>{{ $data->self_harm_history }}</b></label>
     </div>
 </div><hr>
 <div class="row g-2">
     <div class="col-md-5">
         <label for="validationCustom01" class="form-label">Present Continuation of Psychiatric Medication:</label>
     </div>
     <div class="col-md-7">
         <label for="validationCustom01" class="form-label"><b>{{ $data->psychiatric_medication }}</b></label>
     </div>
 </div><hr>
 <div class="row">
     <div class="col-md-12">
        @php
        $check_item = json_decode($data->diagnosis);
        @endphp
        <label for="validationCustom01" class="form-label">Previous psychiatric diagnosis?</label><br>
        <ul>
            @if ($data->differential_diagnosis != "")
            @foreach($check_item as $info) 
            <li><b>{{$info}}</b></li>
            @endforeach
            @endif   
        </ul>
    </div>
</div><hr>
<div class="row g-1">
 <div class="col-md-12">
     <label for="validationCustom01" class="form-label">Mention the name of medicine if any:</label><br>
     <label class="form-control">
         <label for="validationCustom01" style="color:black;" class="form-label"><b>{{ $data->name_of_medicine }}</b></label>
     </label>
 </div>
</div><hr>
<div class="row">
 <div class="col-md-12">
     <label for="validationCustom01" class="form-label">Physical Concern history:</label><br>
     @php
     $check_item = json_decode($data->concern_history);
     @endphp
     <ul>
      @if($data->concern_history != "")
      @foreach($check_item as $info) 
      <li><b>{{$info}}</b></li>
      @endforeach
      @endif
  </ul>
</div>
</div><hr>
<div class="row">
 <div class="col-md-12">
     <label for="validationCustom01" class="form-label">Current Differential Diagnosis</label><br>
     @php
     $check_item = json_decode($data->differential_diagnosis);
     @endphp
     <ul>
        @if($data->differential_diagnosis != "")
        @foreach($check_item as $info) 
        <li><b>{{$info}}</b></li>
        @endforeach
        @endif
    </ul>
</div>
</div><hr>
<div class="row">
 <div class="col-md-12">
     <label for="validationCustom01" class="form-label">Psychometric Tool Name:</label><br>
     <ul>
         <li><b>{{ $data->tool_name }}</b></li>
     </ul>
 </div>
</div><hr>
<div class="row g-1">
 <div class="col-md-12">
     <label for="validationCustom01" class="form-label">Psychometric Tool score </label><br>
     <label class="form-control">
         <label for="validationCustom01" style="color:black;" class="form-label"><b>{{ $data->score }}</b></label>
     </label>
 </div>
</div><hr>
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

        </div> 
    </div> 
</div>  
</div>
</div>      
</section>            
@endsection