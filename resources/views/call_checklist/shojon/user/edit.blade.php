@extends('call_checklist.app')

@section('content')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Edit user</h2>
    </div>
    <div class="card-body">
        <form  enctype="multipart/form-data">
            @csrf
            {{-- INCULDE Messages Partial --}}
            {{-- @include('partials.messages') --}}
            <div class="row">
                <div class="form-group col-6">
                    <label for="exampleFormControlInput1">Full Name</label>
                    <input type="text" name="full_name" value="{{ $user[0]->full_name }}" class="form-control" id="exampleFormControlInput1">
                </div>
                
                <div class="form-group col-6">
                    <label for="exampleFormControlInput2">User Name</label>
                    <input type="text" name="user" value="{{ $user[0]->user }}" class="form-control" id="exampleFormControlInput2">
                </div>

                {{-- <div class="form-group col-12">
                    <label for="exampleFormControlSelect3">Consultent</label>
                    <select class="form-control" name="consultant_id" value="{{ $user->consultant_id }}" id="exampleFormControlSelect3">
                        <option value=""disabled selected hidden>Consultent</option>
                        @foreach ($consultants as $consultant)
                            
                        <option value="{{ $consultant->id }}">{{ $consultant->name }}</option>
                        @endforeach
                        
                    </select>
                </div> --}}

                <div class="form-group col-6">
                    <label for="exampleFormControlInput3">Password</label>
                    <input type="text" name="pass" value="{{ $user[0]->pass }}" class="form-control" id="exampleFormControlInput3" >
                </div>

                {{-- <div class="form-group col-6">
                    <label for="exampleFormControlInput4">Availed</label>
                    <input type="text" name="availed" value="{{ $user->availed }}" class="form-control" id="exampleFormControlInput4" >
                </div> --}}

                {{-- <div class="form-group col-6">
                    <label for="exampleFormControlInput5">Service type</label>
                    <select class="form-control" name="service_type" id="exampleFormControlSelect3" required>
                        <option value="" >- Select service_type -</option>
                        <?php 
                          $service_type_dropdown=array('service_type1'=>'service_type1','service_type2'=>'service_type2', 'service_type3'=>'service_type3');
                          foreach ($service_type_dropdown as $key => $value) {
                              $selected="";
                              if($user->service_type==$key){
                                 $selected="selected";
                              }
                              echo "<option value='$key' $selected >$value</option>";
                              
                          }
                        ?>                        
                    </select>
                </div> --}}


                {{-- <div class="form-group col-6">
                    <label for="exampleFormControlInput5">Service title</label>
                    <select class="form-control" name="service_title" id="exampleFormControlSelect3" required>
                        <option value="" > - Select service_title - </option>
                        <?php 
                          $service_title_dropdown=array('service_title1'=>'service_title1','service_title2'=>'service_title2', 'service_title3'=>'service_title3');
                          foreach ($service_title_dropdown as $key => $value) {
                              $selected="";
                              if($user->service_title==$key){
                                 $selected="selected";
                              }
                              echo "<option value='$key' $selected >$value</option>";
                              
                          }
                        ?>                        
                    </select>
                </div> --}}
                {{-- <div class="form-group col-6">
                    <label for="exampleFormControlInput6">Regular price</label>
                    <input type="number" class="form-control" name="regular_price" id="exampleFormControlInput6" placeholder="Regular price" min="1" max="50000">
                </div>
                
                <div class="form-group col-6">
                    <label for="exampleFormControlInput7">user price</label>
                    <input type="number" class="form-control"  name="user_price" id="exampleFormControlInput7" placeholder="user price" min="1" max="50000">
                </div> --}}
            </div>
            
            <div class="form-footer pt-4 mt-4">
                <button type="submit" class="btn btn-primary btn-default">Edit</button>
                <button type="submit" class="btn btn-secondary btn-default">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection