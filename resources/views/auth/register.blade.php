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

                        <div class="form-group row">
                            <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>
                            <span class="red-star">★</span>
                            <div class="col-md-6">
                                <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}" required autocomplete="full_name" autofocus>

                                @error('full_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>
                            <span class="red-star">★</span>
                            <div class="col-md-6">
                                <input id="user" type="text" class="form-control @error('user') is-invalid @enderror" name="user" value="{{ old('user') }}" required autocomplete="user" autofocus>

                                @error('user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="image"> Image</label>
                            <span class="red-star">★</span>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="image" id="image" accept="image/png, image/gif, image/jpeg">
                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG.</p>
                            </div>
                          </div>
                        <div class="form-group row">
                            <label for="user_group" class="col-md-4 col-form-label text-md-right">{{ __('User Type') }}</label>
                            <span class="red-star">★</span>
                            <div class="col-md-6">
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

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <span class="red-star">★</span>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <span class="red-star">★</span>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
