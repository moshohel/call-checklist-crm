@extends('call_checklist.app')

@section('content')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Reschedule/Cancelation</h2>
    </div>

    <div class="card-body">
        @include('call_checklist.partials.messages')
        <form method="POST" action="{{ route('session.rescheduleOrCancelationStore') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 col-sm-12 mb-2">
                    <label for="exampleFormControlSelect5">Request Type</label>
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="request_type" value="Cancelation" required>Cancelation
                                </label>
                              </div>
                              <div class="form-check-inline">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="request_type" value="Reshedule" required>Reshedule
                                </label>
                              </div>
                            
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <label for="exampleFormControlInput1">Reason</label>
                    <textarea class="form-control" name="reason" cols="40" rows="2" required></textarea>
                </div>
                <div class="form-group col-md-4 col-sm-12">
                    <label for="exampleFormControlInput1">Full Name</label>
                    <input type="text" name="client_name"  class="form-control"
                        id="exampleFormControlInput1" required>
                </div>

                <div class="form-group col-md-4 col-sm-12">
                    <label for="exampleFormControlInput3">Phone number</label>
                    <input type="number" name="phone_number"  class="form-control" value="{{ $phone_number }}"
                        id="exampleFormControlInput3">
                </div>
                
                <div class="form-group col-md-4 col-sm-12">
                    <label for="exampleFormControlInput2">Client Id</label>
                    <input type="text" name="unique_id"  class="form-control"
                        id="exampleFormControlInput2" required>
                </div>
                
                <div class="form-group col-md-4 col-sm-12">
                    <label for="exampleFormControlInput1">Previous Session Time</label>
                    <input type="time" name="previous_session_time"  class="form-control"
                        id="exampleFormControlInput1">
                </div>

                <div class="form-group col-md-4 col-sm-12">
                    <label for="exampleFormControlInput1">Previous Session Date</label>
                    <input type="date" name="previous_session_date"  class="form-control"
                        id="exampleFormControlInput1">
                </div>

                <div class="form-group col-md-4 col-sm-12">
                    <label for="exampleFormControlInput1">Requested Session Time</label>
                    <input type="time" name="requested_session_time"  class="form-control"
                        id="exampleFormControlInput1">
                </div>

                <div class="form-group col-md-4 col-sm-12">
                    <label for="exampleFormControlInput1">Requested Session Date</label>
                    <input type="date" name="requested_session_date"  class="form-control"
                        id="exampleFormControlInput1">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlSelect3">Consultent Name (Must)</label>
                    <select class="form-control" name="therapist_or_psychiatrist_user_id"
                        id="exampleFormControlSelect3" required>
                        <option value="" disabled selected hidden>Consultent</option>
                        @foreach ($consultants as $consultant)
                        <option value="{{ $consultant->user_id }}">{{ $consultant->full_name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="form-footer pt-4 mt-4">
                <button type="submit" class="btn btn-primary btn-default">Save Change</button>
                <button type="reset" value="Reset" class="btn btn-secondary btn-default">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection