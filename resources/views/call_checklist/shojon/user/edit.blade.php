@extends('call_checklist.app')

@section('content')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Edit user</h2>
    </div>

    <div class="card-body">
        @include('call_checklist.partials.messages')
        <form method="POST" action="{{ route('user.update', $user[0]->user_id) }}" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="d-flex">
                    <div class="row">

                        <div class="rounded-circle col" style="width: 10%; margin-right: 2em;">
                            <img src="{{asset('Image/Profile/'.$user[0]->image )}}" alt="user image">
                        </div>
                        <div class="button-wrapper col">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="image" name="image" class="account-file-input"
                                    accept="image/png, image/jpeg" />

                            </label>
                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG.</p>
                        </div>
                        <div class="col" style="float:right;">
                            <label for="exampleFormControlInput5">User type</label>
                            <h3>{{ $user[0]->user_group }}</h3>
                        </div>
                        <div class="col" style="float:right;">
                            <label for="exampleFormControlInput5">User name</label>
                            <h3>{{ $user[0]->user }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label for="exampleFormControlInput1">Full Name</label>
                    <input type="text" name="full_name" value="{{ $user[0]->full_name }}" class="form-control"
                        id="exampleFormControlInput1">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput3">Password</label>
                    <input type="password" name="pass" value="{{ $user[0]->pass }}" class="form-control"
                        id="exampleFormControlInput3">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput2">Email</label>
                    <input type="email" name="email" value="{{ $user[0]->email }}" class="form-control"
                        id="exampleFormControlInput2">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput2">Designation</label>
                    <input type="text" name="designation" value="{{ $user[0]->designation }}" class="form-control"
                        id="exampleFormControlInput2">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput2">Gender</label>
                    <input type="text" name="gender" value="{{ $user[0]->gender }}" class="form-control"
                        id="exampleFormControlInput2">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput2">Age</label>
                    <input type="number" name="age" value="{{ $user[0]->age }}" class="form-control" min="18" max="110"
                        id="exampleFormControlInput2">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput2">Job location</label>
                    <input type="text" name="job_location" value="{{ $user[0]->job_location }}" class="form-control"
                        id="exampleFormControlInput2">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput2">Contact Number</label>
                    <input type="number" name="contact_number" value="{{ $user[0]->contact_number }}" min="9999999"
                        max="99999999999" class="form-control" id="exampleFormControlInput2">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput2">BMDC Reg number</label>
                    <input type="text" name="bmdc_reg_number" value="{{ $user[0]->bmdc_reg_number }}"
                        class="form-control" id="exampleFormControlInput2">
                </div>

                <div class="col-md-6 col-sm-12 mb-2">
                    <label for="exampleFormControlSelect5">Contact number has whatsapp</label>
                    <div class="card card-default">
                        <div class="card-body">

                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="contact_number_has_whatsapp"
                                        value="YES" {{ ($user[0]->contact_number_has_whatsapp=="YES")? "checked" : "" }}
                                    required>YES
                                </label>
                            </div>

                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="contact_number_has_whatsapp"
                                        value="NO" {{ ($user[0]->contact_number_has_whatsapp=="NO")? "checked" : "" }}
                                    required>NO
                                </label>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <label class="form-label"> E-Signature </label>
                    <div class="d-flex">
                        <div class="row">
                            <div class="rounded-circle col-2" style="width: 10%; margin-right: 2em;">
                                <img src="{{asset('Image/e_signature/'.$user[0]->e_signature )}}" alt="user image">
                            </div>

                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Change E-Signature</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="e_signature" name="e_signature" class="account-file-input"
                                    accept="image/png, image/jpeg" />
                            </label>

                        </div>
                    </div>
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