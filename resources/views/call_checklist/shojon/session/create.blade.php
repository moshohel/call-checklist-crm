@extends('call_checklist.app')

@section('content')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Appointment Form</h2>
    </div>
    <div class="card-body">
        <form action="{{ route("session.store", [$referral->unique_id, $referral->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- INCULDE Messages Partial --}}
            {{-- @include('partials.messages') --}}
            <div class="row">
                <div class="form-group col-3">
                    <label for="exampleFormControlInput1">Name</label>
                    <input type="text" name="name" class="form-control" readonly id="exampleFormControlInput1" value="{{ $referral->name }}">
                </div>
                
                <div class="form-group col-3">
                    <label for="exampleFormControlInput1">Client ID</label>
                    <input type="text" name="unique_id" class="form-control" readonly id="exampleFormControlInput1" value="{{ $referral->unique_id }}">
                </div>

                <div class="col-md-6 col-3">
                    <label for="validationCustom01" class="form-label">Referral To:</label>
                    <input type="text" class="form-control" readonly id="referr_to" name="referr_to" value="{{ $referral->referr_to }}">
                </div>

                <input type="hidden" name="referr_from" value="{{ $referral->referr_from }}">
                <input type="hidden" name="age" value="{{ $referral->age }}">
                <input type="hidden" name="phone_number" value="{{ $referral->phone_number }}">
                <input type="hidden" name="phone_number_two" value="{{ $referral->phone_number_two }}">
                <input type="hidden" name="reason_for_therapy" value="{{ $referral->reason_for_therapy }}">
                

                <div class="form-group col-3">
                    <label for="exampleFormControlInput2">Phone</label>
                    <input type="number" name="phone" class="form-control" readonly id="exampleFormControlInput2" value="{{ $referral->phone_number }}">
                </div>

                <div class="form-group col-3">
                    <label for="exampleFormControlInput5">Preferred Time - </label>
                    <input type="text" name="preferred_time" class="form-control" readonly id="exampleFormControlInput5" value="{{ $referral->preferred_time }}">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput3">Upcoming Appointment Date</label>
                    <input type="date" name="session_date" class="form-control"  id="exampleFormControlInput3">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput3">Upcoming Appointment Time</label>
                    <input type="time" name="session_time" class="form-control"  id="exampleFormControlInput3">
                </div>

                
                <div class="form-group col-6">
                    <label for="exampleFormControlSelect5">Call Status</label>
                    <select class="form-control" name="status" id="exampleFormControlSelect5" >
                        <option value=""disabled selected hidden>Call Status</option>
                        <option value="Successful call">Successful call </option>
                        <option value="Unsuccessful call">Unsuccessful call </option>
                        <option value="Not answered">Not answered</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput3">How many times tried to reach the client: </label>
                    <input type="text" name="number_of_time_called_to_client" class="form-control"  id="exampleFormControlInput3" >
                </div> 

                <div class="col-lg-6">
                    <label for="exampleFormControlSelect5">Communication mode</label>
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="communication_medium" value="Audio" required>Audio
                                </label>
                              </div>
                              <div class="form-check-inline">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="communication_medium" value="Video" required>Video
                                </label>
                              </div>
                            
                        </div>
                    </div>
                </div>

                
                <div class="form-group col-6">
                    <label for="appointment_status">Appointment Status</label>
                    <select class="form-control" name="appointment_status_flag" id="appointment_status_flag" onchange="addForm(this.value)" required>
                        
                        <option value=""disabled selected hidden>Status</option>
                        <option value="Confirmed appointment">Confirmed appointment</option>
                        <option value="Decline">Decline</option>
                        <option value="Drop Out">Drop Out</option>
                        <option value="Other">Other</option>
                    </select>
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
@endsection

@section('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        ShowSessionBox();
    });

    function ShowSessionBox() {
        var radio = document.getElementById("chkSession");
        var Box = document.getElementById("SessionBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function addForm(values) {
            var element = document.getElementById('guestDetails');
            element.innerHTML = "" //empty 

            if(values == "Decline")
            {
                element.innerHTML = ""
                element.innerHTML += `<label for="exampleFormControlInput3">Decline Reason </label>
                                <input type="text" name="appointment_decline_reason" class="form-control"  id="exampleFormControlInput3" required>`;
            }
            else if(values == "Other")
            {
                element.innerHTML = ""
                element.innerHTML += `<label for="exampleFormControlInput3">Other Reason </label>
                                <input type="text" name="appointment_other_reason" class="form-control"  id="exampleFormControlInput3" required>`;
            }

            else if(values == "Drop Out")
            {
                element.innerHTML = "";   
            }

            else if(values == "Confirmed appointment")
            {
                element.innerHTML = "";
                
            }

    }
</script>
@endsection
    
