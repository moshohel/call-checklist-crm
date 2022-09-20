@extends('layouts.layout')

@section('content')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Edit Package</h2>
    </div>
    <div class="card-body">
        <form action="{{ route("patient.update", $patient->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- INCULDE Messages Partial --}}
            {{-- @include('partials.messages') --}}
            <div class="row">
                <div class="form-group col-6">
                    <label for="exampleFormControlInput1">Name</label>
                    <input type="text" name="name" value="{{ $patient->name }}" class="form-control" id="exampleFormControlInput1">
                </div>
                
                <div class="form-group col-6">
                    <label for="exampleFormControlInput2">Phone</label>
                    <input type="number" name="phone" value="{{ $patient->phone }}" class="form-control" id="exampleFormControlInput2">
                </div>

                <div class="form-group col-12">
                    <label for="exampleFormControlSelect3">Consultent</label>
                    <select class="form-control" name="consultant_id" value="{{ $patient->consultant_id }}" id="exampleFormControlSelect3">
                        <option value=""disabled selected hidden>Consultent</option>
                        @foreach ($consultants as $consultant)
                            
                        <option value="{{ $consultant->id }}">{{ $consultant->name }}</option>
                        @endforeach
                        
                    </select>
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput3">Address</label>
                    <input type="text" name="address" value="{{ $patient->address }}" class="form-control" id="exampleFormControlInput3" >
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput4">Email</label>
                    <input type="text" name="email" value="{{ $patient->email }}" class="form-control" id="exampleFormControlInput4" >
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput5">Department</label>
                    {{-- <input type="text" name="department" value="{{ $patient->department }}" class="form-control" id="exampleFormControlInput5"> --}}
                    <select class="form-control" name="department" id="exampleFormControlSelect3" required>
                        <option value="" >- Select Department -</option>
                        <?php 
                          $department_dropdown=array('cardiologist'=>'Cardiologist','urologist'=>'Urologist', 'gynecology'=>'Gynecology');
                          foreach ($department_dropdown as $key => $value) {
                              $selected="";
                              if($patient->department==$key){
                                 $selected="selected";
                              }
                              echo "<option value='$key' $selected >$value</option>";
                              # code...
                          }
                        ?>
                        
                    </select>
                </div>

                {{-- <div class="form-group col-6">
                    <label for="exampleFormControlInput6">Regular price</label>
                    <input type="number" class="form-control" name="regular_price" id="exampleFormControlInput6" placeholder="Regular price" min="1" max="50000">
                </div>
                
                <div class="form-group col-6">
                    <label for="exampleFormControlInput7">patient price</label>
                    <input type="number" class="form-control"  name="patient_price" id="exampleFormControlInput7" placeholder="patient price" min="1" max="50000">
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