@extends('call_checklist.appCreate')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>

    @if ($is_phone_no)
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <h2 style="text-align: center; color: red">Frequent Caller</h4>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Create Checklist for KPR</h3>
                <form action="{{ route('call_checklist.kpr.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="referrence_id" value="{{ $refId }}">
                    <input type="hidden" name="phone_number" value="{{ $phone }}">

                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="caller_name"><b>Caller Name: <span class="required">*</span></b></label>
                            <div class="form-control @error('caller_name') is-invalid @enderror">
                                <label for="chkAnnonymous">
                                    <input type="radio" id="chkAnnonymous" name="caller_name" value="Annonymous" onclick="ShowNameBox()" />
                                    Annonymous
                                </label>
                                <label for="chkName" style="margin-left: 10px">
                                    <input type="radio" id="chkName" name="caller_name" onclick="ShowNameBox()" />
                                    Name
                                </label>
                                <div id="NameBox" style="display: none;">
                                    <b>Name:</b>
                                    <input class="form-control" type="text" name="name" id="callerName" value="{{ old('caller_name') }}" placeholder="Enter caller name"/>
                                </div>
                            </div>
                            @error('caller_name') {{ $message }} @enderror

                        </div>

                        <div class="form-group">
                            <label class="control-label" for="sex"><b>Sex: <span class="required">*</span></b></label>
                            @php $types = ['Male', 'Female', 'Intersex', 'Others']; @endphp
                            <select name="sex" id="sex" class="form-control @error('sex') is-invalid @enderror">
                                <option disabled selected>Select Sex</option>
                                @foreach($types as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('sex') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="age"><b>Age: <span class="required">*</span></b></label><br>
                            @php $types = ['0-12', '13-19', '20-39', '40-65', '65+', 'Don\'t know']; @endphp
                            <select name="age" id="age" class="form-control @error('age') is-invalid @enderror">
                                <option disabled selected>Select Age</option>
                                @foreach($types as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('age') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="occupation"><b>Occupation: <span class="required">*</span></b></label>
                            @php $types = ['Student', 'Has a job', 'Housewife', 'Unemployed', 'Don\'t know']; @endphp
                            <div class="form-control @error('occupation') is-invalid @enderror">
                                <label>
                                    @foreach($types as $item)
                                        <input type="radio" name="occupation" value="{{ $item }}" onclick="ShowOccupationBox()" />
                                        {{ $item }}
                                        <br>
                                    @endforeach
                                    <input type="radio" id="chkOccupation" name="occupation" onclick="ShowOccupationBox()" />
                                    Other (please explain)
                                </label>
                                <span id="OccupationBox" style="display: none;">
                                    <input class="form-control" type="text" name="other_occupation" value="{{ old('occupation') }}" placeholder="Explain"/>
                                </span>
                            </div>
                            @error('occupation') {{ $message }} @enderror
                        </div>

                        <div>
                            <label class="control-label" for="district"><b>Location:</b></label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" name="district" list="district" placeholder="Select Location">
                                        <datalist id="district">
                                            @foreach ($districts as $district)
                                                <option value={{ $district }}>
                                            @endforeach
                                        </datalist>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="call_type"><b>Call Type: <span class="required">*</span></b></label>
                            @php $types = ['Befriended Call', 'Inappropriate', 'Information', 'Wrong Number', 'Hang up', 'Got disconnected']; @endphp
                            <select name="call_type" id="call_type" class="form-control @error('call_type') is-invalid @enderror">
                                <option disabled selected>Select Call Type</option>
                                @foreach($types as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('call_type') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="caller"><b>Caller: <span class="required">*</span></b></label>
                            @php $types = ['First time', 'Regular Caller', 'Continuation of previous call', 'Don\'t know']; @endphp
                            <select name="caller" id="caller" class="form-control @error('caller') is-invalid @enderror">
                                <option disabled selected>Select Caller</option>
                                @foreach($types as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('caller') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="risk_level"><b>Risk Level: <span class="required">*</span></b></label>
                            @php $types = ['No Risk', 'Slight Risk', 'Moderate Risk', 'Acute Risk', 'Medical Emergency', 'Didn\'t Ask', 'Didn\'t Respond']; @endphp
                            <select name="risk_level" id="risk_level" class="form-control @error('risk_level') is-invalid @enderror">
                                <option disabled selected>Select Risk Level</option>
                                @foreach($types as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('risk_level') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="main_reason_for_calling"><b>Main Reason for Calling: <span class="required">*</span></b></label>

                            <div class="form-control @error('main_reason_for_calling') is-invalid @enderror">
                                <label>
                                    @foreach($main_reason as $item)
                                        <input type="radio" name="main_reason_for_calling" value="{{ $item }}" onclick="ShowMainReasonBox()" />
                                        {{ $item }}
                                        <br>
                                    @endforeach
                                    <input type="radio" id="chkMainReason" name="main_reason_for_calling" onclick="ShowMainReasonBox()" />
                                    Other (please explain)
                                </label>
                                <span id="MainReasonBox" style="display: none;">
                                    <input class="form-control" type="text" name="main_reason" value="{{ old('main_reason_for_calling') }}" placeholder="Explain"/>
                                </span>
                            </div>
                            @error('main_reason_for_calling') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label name="control-label" for="secondary_reason_for_calling"><b>Secondary Reason for Calling:</b></label>

                            <div class="form-control @error('main_reason_for_calling') is-invalid @enderror">
                                <label>
                                    @foreach($secondary_reason as $item)
                                        <input type="checkbox" name="secondary_reason_for_calling[]" value="{{ $item }}" />
                                        {{ $item }}
                                        <br>
                                    @endforeach
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label name="control-label" for="caller_experience"><b>Caller Experience: <span class="required">*</span></b></label>
                            <select name="caller_experience" id="caller_experience" class="form-control @error('caller_experience') is-invalid @enderror">
                                <option disabled selected>Select Experience</option>
                                @foreach ($caller_experience as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('caller_experience') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="client_referral"><b>Was the client referred elsewhere? <span class="required">*</span></b></label>
                            @php $client_referral = ['No', 'Health Hotline', 'Shojon']; @endphp

                            <div class="form-control @error('client_referral') is-invalid @enderror">
                                <label>
                                    @foreach($client_referral as $value)
                                        <input type="radio" name="client_referral" value="{{ $value }}" onclick="ShowClientReferralBox()" />
                                        {{ $value }}
                                        <br>
                                    @endforeach
                                    <input type="radio" id="chkClientReferral" name="client_referral" onclick="ShowClientReferralBox()" />
                                    Other (please explain)
                                </label>
                                <span id="ClientReferralBox" style="display: none;">
                                    <input class="form-control" type="text" name="referral" value="{{ old('client_referral') }}" placeholder="Explain"/>
                                </span>
                            </div>
                            @error('client_referral') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="caller_description"><b>Call Description: <span class="required">*</span></b></label>
                            <textarea rows = "5" cols = "50"
                                class="form-control
                                @error('caller_description') is-invalid @enderror"
                                name="caller_description"
                                id="caller_description"
                                value="{{ old('caller_description') }}"
                                placeholder="Enter description here..."
                                ></textarea>
                            @error('caller_description') {{ $message }} @enderror
                        </div>

                        @if ($is_admin)
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="phone_number"><b>Phone Number:</b></label>
                                    <input class="form-control" type="tel" id="phone_number" name="phone_number" placeholder="01698221144" pattern="01[3-9]{1}[0-9]{8}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label" for="call_started"><b>Call started Time:</b></label>
                                    <input class="form-control" type="time" id="call_started" name="call_started"required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="call_received"><b>Call Received Date:</b></label>
                                    <input class="form-control" type="date" id="call_received" name="call_received"required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label" for="call_ended"><b>Call Ended Time:</b></label>
                                    <input class="form-control" type="time" id="call_ended" name="call_ended"required>
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save KPR</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" onclick="cancel()"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


<script>

    function cancel(){
        if (confirm('Are you sure you want to cancel?')) {
            open('/', '_self').close();
        } else {

        }
    }

    function ShowNameBox() {
        var chkName = document.getElementById("chkName");
        var NameBox = document.getElementById("NameBox");
        NameBox.style.display = chkName.checked ? "block" : "none";
    }

    function ShowOccupationBox() {
        var chkOccupation = document.getElementById("chkOccupation");
        var OccupationBox = document.getElementById("OccupationBox");
        OccupationBox.style.display = chkOccupation.checked ? "block" : "none";
    }

    function ShowMainReasonBox() {
        var chkMainReason = document.getElementById("chkMainReason");
        var MainReasonBox = document.getElementById("MainReasonBox");
        MainReasonBox.style.display = chkMainReason.checked ? "block" : "none";
    }

    function ShowClientReferralBox() {
        var chkClientReferral = document.getElementById("chkClientReferral");
        var ClientReferralBox = document.getElementById("ClientReferralBox");
        ClientReferralBox.style.display = chkClientReferral.checked ? "block" : "none";
    }
</script>
