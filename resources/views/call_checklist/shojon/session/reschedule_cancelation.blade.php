@extends('call_checklist.app')

@section('content')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Reschedule Cancelation</h2>
    </div>

    <div class="card-body">
        @include('call_checklist.partials.messages')
        <form method="POST" action="{{ route('user.update', $user[0]->user_id) }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="form-group col-6">
                    <label for="exampleFormControlInput1">Full Name</label>
                    <input type="text" name="full_name"  class="form-control"
                        id="exampleFormControlInput1">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput2">User Name</label>
                    <input type="text" name="user"  class="form-control"
                        id="exampleFormControlInput2">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput3">Password</label>
                    <input type="text" name="pass"  class="form-control"
                        id="exampleFormControlInput3">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlSelect3">Consultent</label>
                    <select class="form-control" name="referred_therapist_or_psychiatrist_user_id" value=""
                        id="exampleFormControlSelect3">
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