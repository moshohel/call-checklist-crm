@extends('call_checklist.app')
@section('content')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
    <label class="control-label h3" for="sex"><b>Client ID : </b><b>{{ $getuniqueId->unique_id }}</b></label>                 
    <div class="card-body">
        <form action="{{ route('patient.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-6">
                    <label for="exampleFormControlInput1">Name</label>
                    <input type="text" name="name" required class="form-control" id="exampleFormControlInput1"
                        placeholder="patient name">
                    <input type="hidden" name="uniqueId" value="{{ $getuniqueId->unique_id }}">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput2">Phone</label>
                    <input type="number" name="phone_number" class="form-control" readonly
                    value="{{$number}}">
                </div>

                <div class="form-group col-6">
                    <label class="control-label" for="sex"><b>Sex: <span class="required">*</span></b></label>
                    @php $types = ['Male','Female','LGBTQ','Others']; @endphp
                    <select name="sex" id="sex" list="sex_list" required class="form-control @error('sex') is-invalid @enderror">
                        <datalist id="sex_list">
                            <option value="">Select Sex</option>
                            @foreach($types as $item)


                            <option value="{{ $item }}">{{ $item }}</option>

                            @endforeach
                        </datalist>
                    </select>
                    @error('sex') {{ $message }} @enderror
                </div>

                <div class="form-group col-6">
                    <label class="control-label" for="age"><b>Age: <span class="required">*</span></b></label><br>
                    @php $types = ['0-12','13-19','20-30','30-40','40-65','65+','Don’t know.','Don’t want to share']; @endphp
                    <select name="age" id="age" list="age_list" required class="form-control @error('age') is-invalid @enderror">
                        <datalist id="age_list">
                            <option value="">Select Age</option>
                            @foreach($types as $item)

                            <option value="{{ $item }}">{{ $item }}</option>

                            @endforeach
                        </datalist>
                    </select>
                    @error('age') {{ $message }} @enderror
                </div>

                <div class="form-group col-6">
                    <label class="control-label" for="district"><b>Location: <span class="required">*</span></b></label>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" @error('district') is-invalid @enderror">
                                <select type="text" class="form-control" required name="location" list="location_list" value="">
                                <datalist id="location_list">
                                    <option selected disabled value="">Select Location</option>
                                    @foreach ($districts as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </datalist>
                            </select>
                            </div>
                            @error('district') {{ $message }} @enderror
                        </div>
                    </div>
                </div>


                

                <div class="form-group col-6">
                    <label class="control-label" for="socio_economic_status"><b>Socio-economic
                            Status:</b></label>
                    @php $types = ['Upper', 'Upper Middle Class', 'Middle Class', 'Lower Middle Class', 'Upper Lower
                    Class', 'Lower Class']; @endphp
                    <select name="socio_economic_status" required list="socio_economic_status_list" id="socio_economic_status"
                        class="form-control">

                        <datalist id="socio_economic_status_list">
                            <option value="">Select SES</option>
                            @foreach($types as $item)
                            @if( old('socio_economic_status') == $item))
                            <option value="{{ $item }}">{{ $item }}</option>
                            @else
                            <option value="{{ $item }}">{{ $item }}</option>
                            @endif
                            @endforeach
                        </datalist>
                    </select>
                </div>
            </div>

            <div class="form-footer pt-4 mt-4">
                <button type="submit" class="btn btn-primary btn-default">Add Client</button>
                <button type="submit" class="btn btn-secondary btn-default">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection