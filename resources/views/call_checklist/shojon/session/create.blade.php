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
                    <label for="exampleFormControlInput3">Appointment Date</label>
                    <input type="date" name="session_date" class="form-control"  id="exampleFormControlInput3">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput3">Appointment Time</label>
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

                {{-- <div class="form-group">
                    <label class="control-label" for="Session_Number"><b>Session Number (mandatory single select
                            )</b></label>
                    @php $types = ['1st session', '2nd session', '3rd session', '4th session', '6th session', '7th
                    session','8th session','8th session','9th session','10th session','Last session']; @endphp
                    <div class="form-control @error('Session_Number') is-invalid @enderror">
                        <label>
                            @foreach($types as $item)
                            @if((old('Session_Number') == $item))
                            <input type="radio" name="Session_Number" value="{{ $item }}" checked="checked"
                                onclick="ShowSessionBox()" />
                            @else
                            <input type="radio" name="Session_Number" value="{{ $item }}" onclick="ShowSessionBox()" />
                            @endif
                            {{ $item }}
                            <br>
                            @endforeach
                            <input type="radio" id="chkSession" name="Session_Number" onclick="ShowSessionBox()" />
                            Other (please explain)
                        </label>
                        <span id="SessionBox" style="display: none;">
                            <input class="form-control" type="text" name="other_Session_Number"
                                value=""
                                placeholder="Explain" />
                        </span>
                    </div>
                    @error('Session_Number') {{ $message }} @enderror
                </div> --}}

            </div>
            
            <div class="form-footer pt-4 mt-4">
                <button type="submit" class="btn btn-primary btn-default">Submit</button>
                
            </div>
        </form>
    </div>
</div>
@endsection

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
</script>