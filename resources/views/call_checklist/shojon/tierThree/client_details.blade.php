@extends('call_checklist.app')
@section('title') {{ $data->caller_name }} @endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
<div class="app-title">
    <div>
        <h1><i class="fa-solid fa-user"></i><a href="{{ route('shojon.tireThree.view',$data->id) }}">{{
            $data->caller_name }}</span></a>
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
                                        <label for="validationCustom01" class="form-label"><b>{{ $data->caller_name
                                        }}</b></label>
                                        <br>
                                        <label for="validationCustom01" class="form-label"><b>{{ $data->caller_id
                                        }}</b></label>
                                        <input type="hidden" name="" id="caller_id" value="{{$data->caller_id}}" >
                                        <br>
                                        <label for="validationCustom01" class="form-label"><b>{{ $data->age
                                        }}</b></label>
                                        <br>
                                        <label for="validationCustom01" class="form-label"><b>{{ $data->sex
                                        }}</b></label><br>
                                        <label for="validationCustom01" class="form-label"><b>{{ $data->phone_number
                                        }}</b></label>
                                    </div>
                                </div><br>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <label for="validationCustom01" class="form-label">Date :</label><br>
                                    <label for="validationCustom01" class="form-label">Occupation :</label><br>
                                    <label for="validationCustom01" class="form-label">Location:</label><br>
                                    <label for="validationCustom01" class="form-label">Socio-economic
                                    Status:</label><br>
                                    <label for="validationCustom01" class="form-label">Educational
                                    Qualification:</label><br>
                                    <label for="validationCustom01" class="form-label">Marital Status:</label><br>
                                    <label for="validationCustom01" class="form-label">Session Number :</label><br>
                                </div>
                                <div class="col-md-7">
                                    <label for="validationCustom01" class="form-label"><b>{{ $data->date
                                    }}</b></label><br>
                                    <label for="validationCustom01" class="form-label"><b>{{ $data->occupation
                                    }}</b></label><br>
                                    <label for="validationCustom01" class="form-label"><b>{{ $data->location
                                    }}</b></label><br>
                                    <label for="validationCustom01" class="form-label"><b>{{ $data->socio_economic
                                    }}</b></label><br>
                                    <label for="validationCustom01" class="form-label"><b>{{ $data->education
                                    }}</b></label><br>
                                    <label for="validationCustom01" class="form-label"><b>{{ $data->marital
                                    }}</b></label><br>
                                    <label for="validationCustom01" class="form-label"><b>{{ $data->session
                                    }}</b></label><br>
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
                                    <label for="validationCustom01" class="form-label">  Prescribed Medications:</label><br>
                                    <p>
                                        <b>{{ $data->prescribed_medications }}</b>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-1">
                                <div class="col-md-12">
                                    <label for="validationCustom01" class="form-label">Is Psychotherapy session suggested for the client? </label>
                                    <p>
                                        <b>{{ $data->psychotherapy_session_suggested }}</b>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-1">
                                <div class="col-md-12">
                                    <label for="validationCustom01" class="form-label">Does client have the ability to buy medicine?</label><br>
                                    <p>
                                        <b>{{ $data->client_ability_buy_medicine }}</b>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-1">
                                <div class="col-md-12">
                                    <label for="validationCustom01" class="form-label">Is the client suitable for ? </label><br>
                                    <p>
                                        <b>{{ $data->suitable_session_type }}</b>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="validationCustom01" class="form-label">How useful and effective do you
                                    think the call has been for you? </label><br>
                                    <ul>
                                        @if ($data-> effective != "")
                                        @foreach(explode(';', $data-> effective) as $info)
                                        <li><b>{{$info}}</b></li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-1">
                                <div class="col-md-12">
                                    <label for="validationCustom01" class="form-label">Follow up session Plan:</label><br>
                                    <p><b>{{ $data->session_plan }}</b></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-1">
                                <div class="col-md-12">
                                    <label for="validationCustom01" class="form-label">Session summary :</label><br>
                                    <p><b>{{ $data->session_summary }}</b></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-1">
                                <div class="col-md-12">
                                    <label for="validationCustom01" class="form-label">Physical Test</label><br>
                                    <p><b>{{ $data->physical_test }}</b></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-1">
                                <div class="col-md-12">
                                    <label for="validationCustom01" class="form-label">Schedule Follow up session </label><br>
                                    <table class="table table-bordered border-primary" id="dynamic_field_Treatment">
                                        <thead>
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$data->next_session_date}}</td>
                                                <td>{{$data->next_session_time}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-1">
                                <div class="col-md-12">
                                    <label for="validationCustom01" class="form-label">Message</label><br>
                                    <p><b>{{ $data->message }}</b></p>
                                </div>
                            </div>
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
                                        <label for="validationCustom01" class="form-label">Service Providers
                                        Name:</label><br>
                                        <label for="validationCustom01" class="form-label">Service Providers
                                        ID:</label><br>
                                        <label for="validationCustom01" class="form-label">Call Started :</label><br>
                                        <label for="validationCustom01" class="form-label">Call Ended:</label><br>
                                        <label for="validationCustom01" class="form-label">Duration of Call:</label>
                                    </div>
                                    <div class="col-md-7">
                                        <label for="validationCustom01" class="form-label"><b>{{ $data->program_name
                                        }}</b></label><br>
                                        <label for="validationCustom01" class="form-label"><b>{{
                                            $data->service_providers_name }}</b></label><br><br>
                                        <label for="validationCustom01" class="form-label"><b>{{$data->service_providers_di }}</b></label><br>
                                        <label for="validationCustom01" class="form-label"><b>{{ $data->time_call_started }}</b></label><br>
                                        <label for="validationCustom01" class="form-label"><b>{{ $data->time_call_ended}}</b></label><br>
                                        <label for="validationCustom01" class="form-label"><b>{{ $data->duration}}</b></label>
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
                        <label class="form-label"><b>Mental State Examination</b></label><hr>
                        <div class="row g-2">
                            <div class="col-md-3">
                                <label for="validationCustom01" class="form-label">Appearance:</label>
                            </div>
                            <div class="col-md-9">
                                <label for="validationCustom01" class="form-label"><b>{{ $data->appearance
                                }}</b></label>
                            </div>
                        </div><hr>
                        <div class="row g-2">
                            <div class="col-md-3">
                                <label for="validationCustom01" class="form-label">Behavior:</label>
                            </div>
                            <div class="col-md-9">
                                <label for="validationCustom01" class="form-label"><b>{{ $data->behavior
                                }}</b></label>
                            </div>
                        </div><hr>
                        <div class="row g-2">
                            <div class="col-md-3">
                                <label for="validationCustom01" class="form-label">Speech:</label>
                            </div>
                            <div class="col-md-9">
                                <label for="validationCustom01" class="form-label"><b>{{ $data->speech
                                }}</b></label>
                            </div>
                        </div><hr>
                        <div class="row g-2">
                            <div class="col-md-3">
                                <label for="validationCustom01" class="form-label">Mood and Affect:</label>
                            </div>
                            <div class="col-md-9">
                                <label for="validationCustom01" class="form-label"><b>{{ $data->affect
                                }}</b></label>
                            </div>
                        </div><hr>
                        <div class="row g-2">
                            <div class="col-md-3">
                                <label for="validationCustom01" class="form-label">Thought:</label>
                            </div>
                            <div class="col-md-9">
                                <label for="validationCustom01" class="form-label"><b>{{ $data->thought
                                }}</b></label>
                            </div>
                        </div><hr>
                        <div class="row g-2">
                            <div class="col-md-3">
                                <label for="validationCustom01" class="form-label">Perception:</label>
                            </div>
                            <div class="col-md-9">
                                <label for="validationCustom01" class="form-label"><b>{{ $data->perception
                                }}</b></label>
                            </div>
                        </div><hr>
                        <div class="row g-2">
                            <div class="col-md-3">
                                <label for="validationCustom01" class="form-label">Cognition:</label>
                            </div>
                            <div class="col-md-9">
                                <label for="validationCustom01" class="form-label"><b>{{ $data->cognition
                                }}</b></label>
                            </div>
                        </div><hr>
                        <div class="row g-2">
                            <div class="col-md-3">
                                <label for="validationCustom01" class="form-label">Insight & Judgement:</label>
                            </div>
                            <div class="col-md-9">
                                <label for="validationCustom01" class="form-label"><b>{{ $data->judgement
                                }}</b></label>
                            </div>
                        </div><hr>
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
                                <label for="validationCustom01" class="form-label"><b>{{ $data->problem_duration
                                }}</b></label>
                            </div>
                        </div>
                        <hr>
                        <div class="row g-1">
                            <div class="col-md-12">
                                <label for="validationCustom01" class="form-label">Illness/ problem history
                                </label><br>
                                <p><b>{{ $data->problem_history }}</b></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row g-1">
                            <div class="col-md-12">
                                <label for="validationCustom01" class="form-label">Family History</label><br>
                                <p><b>{{ $data->family_history }}</b></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row g-1">
                            <div class="col-md-12">
                                <label for="validationCustom01" class="form-label">Birth and development history</label><br>
                                <p><b>{{ $data->birth_history }}</b></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row g-1">
                            <div class="col-md-12">
                                <label for="validationCustom01" class="form-label">Substance use history if any</label><br>
                                <p><b>{{ $data->substance_history }}</b></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row g-2">
                            <div class="col-md-5">
                                <label for="validationCustom01" class="form-label">Does the client have suicidal
                                Ideation?</label>
                            </div>
                            <div class="col-md-7">
                                <label for="validationCustom01" class="form-label"><b>{{
                                    $data->suicidal_ideation }}</b></label>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <label for="validationCustom01" class="form-label">Does the client have any
                                    self-harm history? </label>
                                </div>
                                <div class="col-md-7">
                                    <label for="validationCustom01" class="form-label"><b>{{
                                        $data->self_harm_history }}</b></label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        @php
                                        $check_item = json_decode($data->diagnosis);
                                        @endphp
                                        <label for="validationCustom01" class="form-label">Previous psychiatric
                                        diagnosis?</label><br>
                                        <ul>
                                            @if ($check_item != "")
                                            @foreach($check_item as $info)
                                            <li><b>{{$info}}</b></li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <hr>
                                <div class="row g-1">
                                    <div class="col-md-12">
                                        <label for="validationCustom01" class="form-label">Previous Medication History</label><br>
                                        <p><b>{{ $data->previous_medication }}</b></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="validationCustom01" class="form-label">Physical Concern
                                        history:</label><br>
                                        @php
                                        $check_item = json_decode($data->concern_history);
                                        @endphp
                                        <ul>
                                            @if($check_item != "")
                                            @foreach($check_item as $info)
                                            <li><b>{{$info}}</b></li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="validationCustom01" class="form-label">Current Differential
                                        Diagnosis</label><br>
                                        @php
                                        $check_item = json_decode($data->differential_diagnosis);
                                        @endphp
                                        <ul>
                                            @if($check_item != "")
                                            @foreach($check_item as $info)
                                            <li><b>{{$info}}</b></li>
                                            @endforeach
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
            url: "/call-checklist/shojon/referral_table_t3",
            data: {caller_id: caller_id},
            success: function (data) {
                console.log(data);
                $('#content').html(data);
            }
        });
    });
    $(document).ready(function(){
        var caller_id = $("#caller_id").val();
        $.ajax({
            type: "get",
            url: "/call-checklist/shojon/termination_table_t3",
            data: {caller_id: caller_id},
            success: function (data) {
                console.log(data);
                $('#termination_Tb').html(data);
            }
        });
    });
</script>