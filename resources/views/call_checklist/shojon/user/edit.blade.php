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
                                <input type="file" id="image" name="image" class="account-file-input" accept="image/png, image/jpeg" />
                                
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

                {{-- <div class="form-group col-6" style="display: none">
                    <label for="exampleFormControlInput2">User Name</label>
                    <input type="text" name="user" value="{{ $user[0]->user }}" class="form-control"
                        id="exampleFormControlInput2">
                </div> --}}

                <div class="form-group col-6">
                    <label for="exampleFormControlInput3">Password</label>
                    <input type="password" name="pass" value="{{ $user[0]->pass }}" class="form-control"
                        id="exampleFormControlInput3">
                </div>
                
                <div class="form-group col-6" style="display: none">
                    @if ( auth()->user()->user_group == "ADMIN")
                    <label for="exampleFormControlInput5">User type</label>
                    <select class="form-control" name="user_group" id="exampleFormControlSelect3" readonly>
                        <option value="">- Select User Type -</option>
                        <?php 
                          $user_group_dropdown=array('MHW'=>'MHW','SHOJON'=>'SHOJON', 'Supervisor'=>'Supervisor', 'Therapist'=>'Therapist', 'Psychiatrist'=>'Psychiatrist', 'ADMIN'=>'ADMIN');
                          foreach ($user_group_dropdown as $key => $value) {
                              $selected="";
                              if($user[0]->user_group==$key){
                                 $selected="selected";
                              }
                              echo "<option value='$key' $selected >$value</option>";
                              
                          }
                        ?>
                    </select>
                    @endif
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