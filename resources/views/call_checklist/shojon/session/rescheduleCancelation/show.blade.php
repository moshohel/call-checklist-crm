@extends('call_checklist.app')

@section('content')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        @if(isset($rescheduleOrCancelation->client_name))
        <h2>Request Detail</h2>
        @endif
    </div>
    <div class="card-body">
        <div class="" id="recent-orders">
            <table class="table table-responsive table-responsive-large" style="width:100%" id="sampleTable">
                <tr>
                    <th>Name</th>
                    @if(isset($rescheduleOrCancelation->client_name))
                    <td>{{ $rescheduleOrCancelation->client_name }}</td>
                    @endif
                </tr>
                <tr>
                    <th>Phone</th>
                    @if(isset($rescheduleOrCancelation->phone_number))
                    <td>{{ $rescheduleOrCancelation->phone_number }}</td>
                    @endif
                </tr>
                <tr>
                    <th>Client ID</th>
                    @if(isset($rescheduleOrCancelation->unique_id))
                    <td>{{ $rescheduleOrCancelation->unique_id }}</td>
                    @endif
                </tr>
                <tr>
                    <th>Request Type</th>
                    @if ( $rescheduleOrCancelation->reshedule_request )
                    <td>
                        Reshedule request
                    </td>
                    @else
                    <td>
                        Cancelation request
                    </td>
                    @endif


                </tr>
                <tr>
                    <th>Reason</th>
                    @if(isset($rescheduleOrCancelation->reason))
                    <td>{{ $rescheduleOrCancelation->reason }}</td>
                    @endif
                </tr>
                <tr>
                    <th>Status</th>
                    @if(isset($rescheduleOrCancelation->status))
                    <td>{{ $rescheduleOrCancelation->status }}</td>
                    @endif
                </tr>
                {{-- <tr>
                    <th>Previous session time</th>
                    @if(isset($rescheduleOrCancelation->previous_session_time))
                    <td>{{ $rescheduleOrCancelation->previous_session_time }}</td>
                    @endif
                </tr>
                <tr>
                    <th>Previous session date</th>
                    @if(isset($rescheduleOrCancelation->previous_session_date))
                    <td>{{ $rescheduleOrCancelation->previous_session_date }}</td>
                    @endif
                </tr> --}}
                @if ( $rescheduleOrCancelation->reshedule_request )

                <th>Requested session date</th>
                @if(isset($rescheduleOrCancelation->requested_session_date))
                <td>{{ $rescheduleOrCancelation->requested_session_date }}</td>
                @endif

                <th>Requested session time</th>
                @if(isset($rescheduleOrCancelation->requested_session_time))
                <td>{{ $rescheduleOrCancelation->requested_session_time }}</td>
                @endif

                @endif

                <tr>
                    <th>Created At</th>
                    @if(isset($rescheduleOrCancelation->created_at))
                    <td>{{ $rescheduleOrCancelation->created_at }}</td>
                    @endif
                </tr>
            </table>
        </div>

        @if( (auth()->user()->user_group == "Supervisor") || (auth()->user()->user_group == "Therapist") ||
        (auth()->user()->user_group == "Psychiatrist"))
        <div class="row">
            {{-- <div class="col">
                <a href="{{ route('patient.edit', $rescheduleOrCancelation->id) }}" class='btn btn-info'>Edit</a>
            </div> --}}
            <div class="col">
                <a href="#deleteModal{{ $rescheduleOrCancelation->id }}" data-toggle="modal"
                    class="btn btn-danger">Cancel the Session</a>
            </div>
            <div class="col">
                <p class='btn btn-info' id="two"> Reschedule </p>
            </div>
        </div>
        @endif

        <div class="modal fade" id="deleteModal{{ $rescheduleOrCancelation->id }}" tabindex="-1" role="dialog"
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
                        <form action="{!! route('patient.delete', $rescheduleOrCancelation->id) !!}" method="get">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">Sure!!! You want to Cancel the Session</button>
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
        <form id="_referral_form" action="{{ route('session.update', [$rescheduleOrCancelation->id,
            $rescheduleOrCancelation->therapist_or_psychiatrist_user_id]) }}" method="post"
            enctype="multipart/form-data" style="display: none">
            @csrf
            <div class="card-header card-header-border-bottom">
                <h2>Reschedule Appointment</h2>
            </div>
            <div class="row">
                <div class="form-group col-3">
                    <label for="exampleFormControlInput1">Name</label>
                    @if(isset($rescheduleOrCancelation->client_name))
                    <input type="text" class="form-control" name="client_name" readonly
                        value="{{ $rescheduleOrCancelation->client_name }}">
                    @endif
                </div>

                <div class="form-group col-3">
                    <label for="exampleFormControlInput1">Client ID</label>
                    @if(isset($rescheduleOrCancelation->unique_id))
                    <input type="text" class="form-control" name="client_id" readonly
                        value="{{ $rescheduleOrCancelation->unique_id }}">
                    @endif
                </div>

                <div class="form-group col-3">
                    <label for="exampleFormControlInput2">Phone</label>
                    @if(isset($rescheduleOrCancelation->phone_number))
                    <input type="number" class="form-control" name="phone_number"
                        value="{{ $rescheduleOrCancelation->phone_number }}">
                    @endif
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput3">Upcoming Appointment Date</label>
                    <input type="date" name="session_date" class="form-control" id="exampleFormControlInput3">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput3">Upcoming Appointment Time</label>
                    <input type="time" name="session_time" class="form-control" id="exampleFormControlInput3">
                </div>

                <div class="col-lg-6">
                    <label for="exampleFormControlSelect5">Communication mode</label>
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="communication_medium"
                                        value="Audio" required>Audio
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="communication_medium"
                                        value="Video" required>Video
                                </label>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="form-group col-6" id="guestDetails">

                </div>

            </div>

            <div class="form-footer pt-4 mt-4">
                <button type="submit" class="btn btn-primary btn-default">Submit</button>

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