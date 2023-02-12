@extends('call_checklist.app')

@section('content')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Edit Clients</h2>
    </div>
    <div class="card-body">
        <form action="{{ route("patient.update", $patient->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- INCULDE Messages Partial --}}
            {{-- @include('partials.messages') --}}
            <div class="row">
                <div class="form-group col-6">
                    <label for="exampleFormControlInput1">Name</label>
                    <input type="text" name="name" value="{{ $patient->name }}" class="form-control"
                        id="exampleFormControlInput1">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput2">Phone</label>
                    <input type="number" name="phone" value="{{ $patient->phone_number }}" class="form-control"
                        id="exampleFormControlInput2">
                </div>

                {{-- <div class="form-group col-12">
                    <label for="exampleFormControlSelect3">Consultent</label>
                    <select class="form-control" name="consultant_id" value="{{ $patient->consultant_id }}"
                        id="exampleFormControlSelect3">
                        <option value="" disabled selected hidden>Consultent</option>
                        @foreach ($consultants as $consultant)

                        <option value="{{ $consultant->id }}">{{ $consultant->name }}</option>
                        @endforeach

                    </select>
                </div> --}}

                <div class="form-group col-3">
                    <label class="control-label" for="sex"><b>Sex: <span class="required">*</span></b></label>
                    @php $types = ['Male', 'Female', 'Intersex', 'Others']; @endphp
                    <select name="sex" id="sex" list="sex_list" class="form-control @error('sex') is-invalid @enderror">
                        <datalist id="sex_list">
                            <option value="">Select Sex</option>
                            @foreach($types as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </datalist>
                    </select>
                    @error('sex') {{ $message }} @enderror
                </div>

                <div class="form-group col-3">
                    <label class="control-label" for="district"><b>Location: <span class="required">*</span></b></label>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" @error('district') is-invalid @enderror">
                                <input type="text" class="form-control" name="location" list="location_list" value="">
                                <datalist id="location_list">
                                    @foreach ($districts as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                            @error('district') {{ $message }} @enderror
                        </div>
                    </div>
                </div>


                <div class="form-group col-3">
                    <label class="control-label" for="age"><b>Age: <span class="required">*</span></b></label><br>
                    @php $types = ['0-12','13-19', '20-30', '31-40', '41-65', '65+', 'Do not know', 'Do not want to
                    share']; @endphp
                    <select name="age" id="age" list="age_list" class="form-control @error('age') is-invalid @enderror">
                        <datalist id="age_list">
                            <option value="">Select Age</option>
                            @foreach($types as $item)

                            <option value="{{ $item }}">{{ $item }}</option>

                            @endforeach
                        </datalist>
                    </select>
                    @error('age') {{ $message }} @enderror
                </div>

                <div class="form-group col-3">
                    <label class="control-label" for="socio_economic_status"><b>Socio-economic
                            Status:</b></label>
                    @php $types = ['Upper', 'Upper Middle Class', 'Middle Class', 'Lower Middle Class', 'Upper Lower
                    Class', 'Lower Class']; @endphp
                    <select name="socio_economic_status" list="socio_economic_status_list" id="socio_economic_status"
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

                <div class="form-group col-3">
                    <label class="control-label" for="occupation"><b>Occupation: <span
                                class="required">*</span></b></label>
                    @php $types = ['Student', 'Job holder', 'Businessperson', 'Housewife', 'Unemployed', 'Retired',
                    'Could not tell']; @endphp
                    <div class="form-control @error('occupation') is-invalid @enderror">
                        <label>
                            @foreach($types as $item)
                            @if((old('occupation') == $item))
                            <input type="radio" name="occupation" value="{{ $item }}" checked="checked"
                                onclick="ShowOccupationBox()" />
                            @else
                            <input type="radio" name="occupation" value="{{ $item }}" onclick="ShowOccupationBox()" />
                            @endif
                            {{ $item }}
                            <br>
                            @endforeach
                            <input type="radio" id="chkOccupation" name="occupation" onclick="ShowOccupationBox()" />
                            Other (please explain)
                        </label>
                        {{-- <span id="OccupationBox" style="display: none;">
                            <input class="form-control" type="text" name="other_occupation"
                                value="{{ old('other_occupation',$last ? $last->other_occupation : null) }}"
                                placeholder="Explain" />
                        </span> --}}
                    </div>
                    @error('occupation') {{ $message }} @enderror
                </div>

                <div class="form-group col-3">
                    <label class="control-label" for="hearing_source"><b>Where/how did the Client hear about SHOJON:
                            <span class="required">*</span></b></label><br>
                    @php $types = ['Search Engine', 'KPR', 'Social Media', 'Word of mouth', 'SUEPP', 'SF Microfinance',
                    'Radio', 'TV', 'Print Media', 'Don\'t know']; @endphp
                    <div class="form-control @error('hearing_source') is-invalid @enderror">
                        <label>
                            @foreach($types as $item)
                            @if( old('hearing_source') == $item)
                            <input type="radio" name="hearing_source" value="{{ $item }}"
                                onclick="ShowHearingSourceBox()" checked="checked" />
                            @else
                            <input type="radio" name="hearing_source" value="{{ $item }}"
                                onclick="ShowHearingSourceBox()" />
                            @endif
                            {{ $item }}
                            <br>
                            @endforeach
                            <input type="radio" id="chkHearingSource" name="hearing_source"
                                onclick="ShowHearingSourceBox()" />
                            Other (please explain)
                        </label>
                        {{-- <span id="HearingSourceBox" style="display: none;">
                            <input class="form-control" type="text" name="other_hearing_source"
                                value="{{ old('other_hearing_source',$last ? $last->other_hearing_source : null) }}"
                                placeholder="Explain" />
                        </span> --}}
                    </div>
                    @error('hearing_source') {{ $message }} @enderror
                </div>

                {{-- <div class="form-group col-6">
                    <label for="exampleFormControlInput6">Regular price</label>
                    <input type="number" class="form-control" name="regular_price" id="exampleFormControlInput6"
                        placeholder="Regular price" min="1" max="50000">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput7">patient price</label>
                    <input type="number" class="form-control" name="patient_price" id="exampleFormControlInput7"
                        placeholder="patient price" min="1" max="50000">
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