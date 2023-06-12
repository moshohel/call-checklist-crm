@extends('call_checklist.app')

@section('content')
<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Create New User') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="full_name" class="col-form-label text-md-right">{{ __('Full Name')
                                    }}</label>
                                <span class="red-star">★</span>
                                <div>
                                    <input id="full_name" type="text"
                                        class="form-control @error('full_name') is-invalid @enderror" name="full_name"
                                        value="{{ old('full_name') }}" required autocomplete="full_name" autofocus>

                                    @error('full_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="user" class="col-form-label text-md-right">{{ __('User Name')
                                    }}</label>
                                <span class="red-star">★</span>
                                <div>
                                    <input id="user" type="text"
                                        class="form-control @error('user') is-invalid @enderror" name="user"
                                        value="{{ old('user') }}" required autocomplete="user" autofocus>

                                    @error('user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label class=" col-form-label text-md-right" for="image"> Image</label>
                                <span class="red-star">★</span>
                                <div>
                                    <input type="file" class="form-control" name="image" id="image"
                                        accept="image/png, image/gif, image/jpeg">
                                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG.</p>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="user_group" class="col-form-label text-md-right">{{ __('User Type')
                                    }}</label>
                                <span class="red-star">★</span>
                                <div>
                                    <select class="form-control" name="user_group" id="user_group" required>
                                        <option value="" disabled="" selected="" hidden="">User Type</option>
                                        <option value="MHW">MHW</option>
                                        <option value="SHOJON">SHOJON Admin</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Therapist">Therapist</option>
                                        <option value="Psychiatrist">Psychiatrist</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="password" class=" col-form-label text-md-right">{{ __('Password')
                                    }}</label>
                                <span class="red-star">★</span>
                                <div>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="password-confirm" class=" col-form-label text-md-right">{{
                                    __('Confirm
                                    Password') }}</label>
                                <span class="red-star">★</span>
                                <div>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleFormControlInput2">Email</label>
                                <input type="email" name="email" class="form-control" id="exampleFormControlInput2">
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleFormControlInput2">Designation</label>
                                <input type="text" name="designation" class="form-control"
                                    id="exampleFormControlInput2">
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleFormControlInput2">Gender</label>
                                <input type="text" name="gender" class="form-control" id="exampleFormControlInput2">
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleFormControlInput2">Age</label>
                                <input type="number" name="age" class="form-control" min="18" max="110"
                                    id="exampleFormControlInput2">
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleFormControlInput2">Job location</label>
                                <input type="text" name="job_location" class="form-control"
                                    id="exampleFormControlInput2">
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleFormControlInput2">Contact Number</label>
                                <input type="number" name="contact_number" min="9999999" max="99999999999"
                                    class="form-control" id="exampleFormControlInput2" required>
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleFormControlInput2">BMDC Reg number</label>
                                <input type="text" name="bmdc_reg_number" class="form-control"
                                    id="exampleFormControlInput2">
                            </div>

                            <div class="col-md-6 col-sm-12 mb-2">
                                <label for="exampleFormControlSelect5">Contact number has whatsapp</label>
                                <div class="card card-default">
                                    <div class="card-body">

                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input"
                                                    name="contact_number_has_whatsapp" value="YES" required>YES
                                            </label>
                                        </div>

                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input"
                                                    name="contact_number_has_whatsapp" value="NO" required>NO
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label class="form-label"> E-Signature </label>
                                <div class="d-flex">
                                    <div class="row">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Change E-Signature</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="e_signature" name="e_signature"
                                                class="account-file-input" accept="image/png, image/jpeg" />
                                        </label>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection