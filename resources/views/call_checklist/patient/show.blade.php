@extends('call_checklist.app')

@section('content')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        @if(isset($patient->name)) 
            <h2>Detail of - {{ $patient->name }}</h2>
        @endif
    </div>
    <div class="card-body">
        <div class="" id="recent-orders">
            <table class="table table-responsive table-responsive-large" style="width:100%" id="sampleTable">
                <tr>
                    <th class="d-none d-md-table-cell">Name</th>
                    @if(isset($patient->name)) 
                    <td>{{ $patient->name }}</td>
                    @endif
                </tr>
                <tr>
                    <th class="d-none d-md-table-cell">Phone</th>
                    @if(isset($patient->phone_number)) 
                    <td>{{ $patient->phone_number }}</td>
                    @endif
                </tr>
                <tr>
                    <th class="d-none d-md-table-cell">Client ID</th>
                    @if(isset($patient->unique_id)) 
                    <td>{{ $patient->unique_id }}</td>
                    @endif
                </tr>
                <tr>
                    <th class="d-none d-md-table-cell">Gender</th>
                    @if(isset($patient->sex)) 
                    <td>{{ $patient->sex }}</td>
                    @endif
                </tr>
                <tr>
                    <th class="d-none d-md-table-cell">Age</th>
                    @if(isset($patient->age)) 
                    <td>{{ $patient->age }}</td>
                    @endif
                </tr>
                {{-- <tr>
                    <th class="d-none d-md-table-cell">Occupotion</th>
                    @if(isset($patient->occupotion)) 
                    <td>{{ $patient->occupotion }}</td>
                    @endif
                </tr>
                <tr>
                    <th class="d-none d-md-table-cell">Department</th>
                    @if(isset($patient->department)) 
                    <td>{{ $patient->department }}</td>
                    @endif
                </tr> --}}
                {{-- <tr>
                    <th class="d-none d-md-table-cell">Consultant</th>
                    <td>{{ $consultant->name }}</td>
                </tr>
                --}}
                <tr>
                    <th class="d-none d-md-table-cell">Created At</th>
                    @if(isset($patient->created_at)) 
                    <td>{{ $patient->created_at }}</td>
                    @endif
                </tr>
            </table>
        </div>
        {{-- <div class="modal-body">
            <form action="{!! route('patient.delete', $patient->id) !!}" method="get">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">Permanent Delete</button>
            </form>
        </div> --}}
        @if( (auth()->user()->user_group == "Supervisor"))
        <div class="row">
            <div class="col">

                <a href="{{ route('patient.edit', $patient->id) }}" class='btn btn-info'>Edit</a>
            </div>
            <div class="col">

                <a href="#deleteModal{{ $patient->id }}" data-toggle="modal" class="btn btn-danger">Delete</a>
            </div>
            <div class="col">
                <p class='btn btn-info' id="two" > Reffer - Tier 2 </p>
            </div>
            <div class="col">
                <p class='btn btn-info' id="three" > Reffer - Tier 3 </p>
            </div>
        </div>
        @endif

        <div class="modal fade" id="deleteModal{{ $patient->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are sure to delete?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{!! route('patient.delete', $patient->id) !!}" method="get">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">Permanent Delete</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="card card-default">
    
    <div class="card-body">
        <form id="_referral_form" method="POST" action="{{ route('referral.store') }}" style="display: none">
            @csrf
            <div class="modal-body">
                <div class="row g-2">
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Referral To:</label>
                        <input type="text" class="form-control" readonly id="referral_to" name="referral_to" value="">
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Referral From:</label>
                        
                        <select class="form-control" name="referral_from" id="referral_from" >
                            <option value="" disabled="" selected="" hidden="">From</option>
                            {{-- <option value="Admin">Admin</option> --}}
                            <option value="Shojon Tier 1">Shojon Tier 1</option>
                            <option value="Shojon Tier 2">Shojon Tier 2</option>
                            <option value="Shojon Tier 3">Shojon Tier 3</option>
                            
                        </select>
                    </div>
                    
                </div>
                <hr>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">Client ID:</label>
                        @if(isset($patient->unique_id)) 
                            <input type="text" class="form-control" name="client_id" readonly value="{{ $patient->unique_id }}">
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">Client Name:</label>
                        @if(isset($patient->name)) 
                            <input type="text" class="form-control" name="client_name" readonly value="{{ $patient->name }}">
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">Age:</label>
                        @if(isset($patient->age)) 
                        <input type="text" class="form-control" name="age" readonly value="{{ $patient->age }}">
                        @endif
                    </div>
                </div><br>
                <div class="row g-2">
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Phone Number:</label>
                        @if(isset($patient->phone_number)) 
                        
                        <input type="number" class="form-control" name="phone_number" value="{{ $patient->phone_number }}">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Emergency number in case of unavailability:</label>
                        <input type="number" class="form-control" name="Emergency_number" placeholder="Emergency number">
                    </div>
                </div><br>
                <div class="row g-2">
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Reason for therapy:</label>
                        <input type="text" class="form-control" name="reason_for_therapy" placeholder="Reason for therapy">
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Preferred time for session:</label>
                        <input type="datetime-local" class="form-control" name="preferred_time"
                            placeholder="Preferred time for session">
                    </div>
                </div><br>
                <div class="row g-2">
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Financial affordability:</label>
                        <input type="text" class="form-control" name="Financial" placeholder="Financial affordability">
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Therapist preference:</label>
                        <input type="text" class="form-control" name="preferred_therapist_or_psychiatrist"
                            placeholder="Therapist preference">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
<script type="text/javascript" src="{{ asset('backend/js/jquery-3.2.1.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}

{{-- <script>
    config ={
        enableTime: true,
        dateFormat: "Y-m-d (h:i K)",
    }
    flatpickr("input[type=datetime-local]", config);
</script> --}}
<script type="text/javascript">
    $(document).ready(function(){

        $("#two").click(function(){
            $("#_referral_form").show();
            $("#referral_to").val("Shojon Tier 2");
            // $("#referral_to").removeClass("text-info");
            // $("#referral_to").addClass("text-primary");
            $("#referral_to").css("background-color", "#affef6");
            
        });

        $("#three").click(function(){
            $("#_referral_form").show();
            $("#referral_to").val("Shojon Tier 3");
            // $("#referral_to").removeClass("text-primary");
            // $("#referral_to").addClass("text-info");
            $("#referral_to").css("background-color", "#affedc");
        });

    //    $('#_referral_form').on('submit',function(e){
    //      e.preventDefault();
    //         $.ajax({
    //             type:"POST",
    //             url: '{{ route('call_checklist.shojon.Referral_form') }}',
    //             data:$('#_referral_form').serialize(),
    //             success:function(response){
    //               console.log(response)
    //               $('#ReferralModal').modal('hide')
    //               alert("Referral save successfully");
    //             },
    //             error:function(error)
    //             {
    //               console.log(error)
    //               alert("Referral not save");
    //             }
  
    //           });
    //    });
    });
</script>
@endsection