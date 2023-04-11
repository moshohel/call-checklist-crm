<div class="form-group col-md-4 col-sm-12">
    <label for="exampleFormControlInput3">Phone number</label>
    <input type="number" name="phone_number" class="form-control" value="{{$newPatient->phone_number}}"
        id="exampleFormControlInput3">
</div>

<div class="form-group col-md-4 col-sm-12">
    <label for="exampleFormControlInput2">Client Name</label>
    <input type="text" class="form-control" name="client_name" placeholder="Enter client name"
        value="{{$newPatient->name}}">
</div>


<div class="form-group col-md-4 col-sm-12">
    <label for="exampleFormControlInput2">Client Id</label>
    <input type="text" class="form-control" name="client_id" placeholder="Enter client name" value="{{ $uniqueid }}">
</div>