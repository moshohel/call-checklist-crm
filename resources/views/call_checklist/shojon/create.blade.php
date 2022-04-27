@extends('call_checklist.appCreate')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>

    @if ($is_phone_no)
        @include('call_checklist.shojon._repeated_call')
    @endif

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Create Checklist for Shojon</h3>
                <form id="myForm" action="{{ route('call_checklist.shojon.store') }}" method="POST" role="form"
                      enctype="multipart/form-data" autocomplete="off">
                    @csrf

                    <div class="tile-body">

                        <div class="form-group">
                            <label class="control-label" for="phone_number"><b>Phone Number:</b></label><br>
                            <input class="form-control" type="text" name="phone_number" id="phone_number"
                                   value="{{ $phone }}">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="caller_name"><b>Caller Name:</b></label>
                            <input class="form-control" type="text" name="caller_name" id="caller_name"
                                   value="{{ old('caller_name',$last? $last->caller_name : null) }}"
                                   placeholder="Enter caller name"/>
                        </div>

                        <input type="hidden" name="referrence_id" value="{{ $refId }}">


                        <div class="form-group">
                            <label class="control-label" for="sex"><b>Sex: <span class="required">*</span></b></label>
                            @php $types = ['Male', 'Female', 'Intersex', 'Others']; @endphp
                            <select name="sex" id="sex" list="sex_list"
                                    class="form-control @error('sex') is-invalid @enderror">
                                <datalist id="sex_list">
                                    <option value="">Select Sex</option>
                                    @foreach($types as $item)
                                        @if($last && ($last->sex == $item))
                                            <option value="{{ $item }}" selected>{{ $item }}</option>
                                        @else
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endif
                                    @endforeach
                                </datalist>
                            </select>
                            @error('sex') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="age"><b>Age: <span
                                        class="required">*</span></b></label><br>
                            @php $types = ['0-12','13-19', '20-30', '31-40', '41-65', '65+', 'Do not know', 'Do not want to share']; @endphp
                            <select name="age" id="age" list="age_list"
                                    class="form-control @error('age') is-invalid @enderror">
                                <datalist id="age_list">
                                    <option value="">Select Age</option>
                                    @foreach($types as $item)
                                        @if( $last && ($last->age == $item))
                                            <option selected value="{{ $item }}">{{ $item }}</option>
                                        @else
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endif
                                    @endforeach
                                </datalist>
                            </select>
                            @error('age') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="occupation"><b>Occupation: <span class="required">*</span></b></label>
                            @php $types = ['Student', 'Job holder', 'Businessperson', 'Housewife', 'Unemployed', 'Retired', 'Could not tell']; @endphp
                            <div class="form-control @error('occupation') is-invalid @enderror">
                                <label>
                                    @foreach($types as $item)
                                        @if((old('occupation') == $item))
                                            <input type="radio" name="occupation" value="{{ $item }}" checked="checked"
                                                   onclick="ShowOccupationBox()"/>
                                        @else
                                            <input type="radio" name="occupation" value="{{ $item }}"
                                                   onclick="ShowOccupationBox()"/>
                                        @endif
                                        {{ $item }}
                                        <br>
                                    @endforeach
                                    <input type="radio" id="chkOccupation" name="occupation"
                                           onclick="ShowOccupationBox()"/>
                                    Other (please explain)
                                </label>
                                <span id="OccupationBox" style="display: none;">
                                    <input class="form-control" type="text" name="other_occupation"
                                           value="{{ old('other_occupation',$last ? $last->other_occupation : null) }}"
                                           placeholder="Explain"/>
                                </span>
                            </div>
                            @error('occupation') {{ $message }} @enderror
                        </div>


                        <div class="form-group">
                            <label class="control-label" for="socio_economic_status"><b>Socio-economic
                                    Status:</b></label>
                            @php $types = ['Upper', 'Upper Middle Class', 'Middle Class', 'Lower Middle Class', 'Upper Lower Class', 'Lower Class']; @endphp
                            <select name="socio_economic_status" list="socio_economic_status_list"
                                    id="socio_economic_status" class="form-control">

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

                        <div>
                            <label class="control-label" for="district"><b>Location: <span class="required">*</span></b></label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" @error('district') is-invalid @enderror">
                                    <input type="text" class="form-control" name="location" list="location_list"
                                           value="{{ old('location',$last ? $last->location : null) }}">
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

                    <div class="form-group">
                        <label class="control-label" for="hearing_source"><b>Where/how did the Client hear about SHOJON:
                                <span class="required">*</span></b></label><br>
                        @php $types = ['Search Engine', 'KPR', 'Social Media', 'Word of mouth', 'SUEPP', 'SF Microfinance', 'Radio', 'TV', 'Print Media', 'Don\'t know']; @endphp
                        <div class="form-control @error('hearing_source') is-invalid @enderror">
                            <label>
                                @foreach($types as $item)
                                    @if( old('hearing_source') == $item)
                                        <input type="radio" name="hearing_source" value="{{ $item }}"
                                               onclick="ShowHearingSourceBox()" checked="checked"/>
                                    @else
                                        <input type="radio" name="hearing_source" value="{{ $item }}"
                                               onclick="ShowHearingSourceBox()"/>
                                    @endif
                                    {{ $item }}
                                    <br>
                                @endforeach
                                <input type="radio" id="chkHearingSource" name="hearing_source"
                                       onclick="ShowHearingSourceBox()"/>
                                Other (please explain)
                            </label>
                            <span id="HearingSourceBox" style="display: none;">
                                    <input class="form-control" type="text" name="other_hearing_source"
                                           value="{{ old('other_hearing_source',$last ? $last->other_hearing_source : null) }}"
                                           placeholder="Explain"/>
                                </span>
                        </div>
                        @error('hearing_source') {{ $message }} @enderror
                    </div>

                    <div class="form-group" style="display: none">
                        <label class="control-label" for="yes_no_radio"><b>Consent for Recording: <span
                                    class="required">*</span></b></label>
                        <div class="form-control @error('is_recordable') is-invalid @enderror">
                            <div>
                                <input type="radio" id="yes" name="is_recordable" value=1>
                                <label for="yes">Yes</label>
                            </div>

                            <div>
                                <input type="radio" id="no" name="is_recordable" value=0>
                                <label for="no">No</label>
                            </div>
                        </div>
                        @error('is_recordable') {{ $message }} @enderror
                    </div>


                    <div class="form-group">
                        <label class="control-label" for="call_type"><b>Call Type: <span
                                    class="required">*</span></b></label>
                        @php $types = ['Received Service', 'Referral', 'Information related call', 'Inappropriate', 'Information', 'Wrong Number', 'Hang up', 'Got Disconnected']; @endphp
                        <select name="call_type" id="call_type" list="call_type_list"
                                class="form-control @error('call_type') is-invalid @enderror">
                            <datalist id="call_type_list">
                                <option value="">Select Call Type</option>
                                @foreach($types as $item)
                                    @if(old('call_type') == $item)
                                        <option value="{{ $item }}" selected>{{ $item }}</option>
                                    @else
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endif
                                @endforeach
                            </datalist>
                        </select>
                        @error('call_type') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="caller"><b>Caller type: <span
                                    class="required">*</span></b></label>
                        @php $types = ['First Time', 'Regular Caller', 'Follow up', 'Continuation of previous call', 'Don\'t know']; @endphp
                        <select name="caller" id="caller" list="caller_type_list"
                                class="form-control @error('caller') is-invalid @enderror">
                            <datalist id="caller_type_list">
                                <option value="">Select Caller Type</option>
                                @foreach($types as $item)
                                    @if(old('caller') == $item)
                                        <option value="{{ $item }}" selected>{{ $item }}</option>
                                    @else
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endif
                                @endforeach
                            </datalist>
                        </select>
                        @error('caller') {{ $message }} @enderror
                    </div>

                    <div class="form-group" style="display: none">
                        <label class="control-label" for="service"><b>Need Of the service: <span
                                    class="required">*</span></b></label>
                        @php $types = ['Ventilation & Emotional Support', 'Psychotherapy/counseling', 'Medication/psychiatric consultation', 'Referral', 'Hospitalization', 'Rehabilitation', 'Don\'t know']; @endphp
                        <div class="form-control @error('service') is-invalid @enderror">
                            <label>
                                @foreach($types as $item)
                                    <input type="radio" name="service" value="{{ $item }}" onclick="ShowServiceBox()"/>
                                    {{ $item }}
                                    <br>
                                @endforeach
                                <input type="radio" id="chkService" name="service" onclick="ShowServiceBox()"/>
                                Others (mention if any)
                            </label>
                            <span id="ServiceBox" style="display: none;">
                                    <input class="form-control" type="text" name="other_service"
                                           value="{{ old('service') }}" placeholder="Explain"/>
                                </span>
                        </div>
                        @error('service') {{ $message }} @enderror
                    </div>


                    <div class="form-group">
                        <label class="control-label" for="pre_mood_rating"><b>Mood Rating (pre-stage):</b> <br>[0 means
                            lowest wellbeing, 10 means Highest wellbeing] </label>
                        {{-- <div class="col-md-auto"> --}}
                        {{-- <input class="form-control @error('pre_mood_rating') is-invalid @enderror" type="text"
                               name="pre_mood_rating" id="sliderPre" class="slider"/> --}}
                        {{-- <input class="form-control @error('pre_mood_rating') is-invalid @enderror" type="number" name="pre_mood_rating" min="1" max="10" value="0"> --}}

                        <select name="pre_mood_rating"
                                class="form-control @error('pre_mood_rating') is-invalid @enderror">
                            <option value="">Select a Value</option>
                            @for ($i = 0; $i < 11; $i++)
                                @if( old('pre_mood_rating') && (old('pre_mood_rating') == $i))
                                    <option value={{ $i }} selected> {{ $i }} </option>
                                @else
                                    <option value={{ $i }}>{{ $i }}</option>
                                @endif
                            @endfor
                        </select>
                        {{-- </div> --}}
                        @error('pre_mood_rating') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="main_reason_for_calling"><b>Primary Reason for Calling: <span
                                    class="required">*</span></b></label>
                        <div class="form-control @error('main_reason_for_calling') is-invalid @enderror">
                            <label>
                                @foreach($main_reason as $item)
                                    @if( old('main_reason_for_calling') == $item)
                                        <input type="radio" name="main_reason_for_calling" value="{{ $item }}"
                                               checked="checked"
                                               onclick="ShowMainReasonBox()"/>
                                    @else
                                        <input type="radio" name="main_reason_for_calling" value="{{ $item }}"
                                               onclick="ShowMainReasonBox()"/>
                                    @endif

                                    {{ $item }}
                                    <br>
                                @endforeach
                                <input type="radio" id="chkMainReason" name="main_reason_for_calling"
                                       onclick="ShowMainReasonBox()"/>
                                Other (please explain)
                            </label>
                            <span id="MainReasonBox" style="display: none;">
                                    <input class="form-control" type="text" name="other_main_reason_for_calling"
                                           value="{{ old('other_main_reason_for_calling',$last ? $last->other_main_reason_for_calling : null) }}"
                                           placeholder="Explain"/>
                                </span>
                        </div>
                        @error('main_reason_for_calling') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="secondary_reason_for_calling"><b>Secondary Reason for Calling:
                                (Select Multiple)
                                <span class="required">*</span></b></label>
                        <div class="form-control @error('secondary_reason_for_calling') is-invalid @enderror">
                            <label>
                                @foreach($secondary_reason as $item)
                                    @if(old('secondary_reason_for_calling') && is_array(old('secondary_reason_for_calling')) && in_array($item,old('secondary_reason_for_calling')))
                                        <input type="checkbox" name="secondary_reason_for_calling[]" value="{{ $item }}"
                                               onclick="ShowSecondaryReasonBox()" checked="checked"/>

                                    @else
                                        <input type="checkbox" name="secondary_reason_for_calling[]" value="{{ $item }}"
                                               onclick="ShowSecondaryReasonBox()"/>
                                    @endif
                                    {{ $item }}
                                    <br>
                                @endforeach
                                <input type="checkbox" id="chkSecondaryReason" name="secondary_reason_for_calling"
                                       onclick="ShowSecondaryReasonBox()"/>
                                Other (please explain)
                            </label>
                            <span id="SecondaryReasonBox" style="display: none;">
                                    <input class="form-control" type="text" name="other_secondary_reason_for_calling[]"
                                           placeholder="Explain"/>
                                <!-- MUST BE A PROBLEM FOR ARRAY TO SHOW OLD VALUE-->
                            </span>
                        </div>
                        @error('secondary_reason_for_calling') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="mental_illness_diagnosis"><b>Does the client have any mental
                                illness diagnosis? (Select Multiple) <span class="required">*</span></b></label>
                        <div class="form-control @error('mental_illness_diagnosis') is-invalid @enderror">
                            <label>

                                <label>
                                    @foreach($mental_illness as $item)
                                        @if(old('mental_illness_diagnosis') && is_array('mental_illness_diagnosis')) && in_array($item,old('mental_illness_diagnosis')))
                                            <input type="checkbox" name="mental_illness_diagnosis[]" value="{{ $item }}"
                                                   onclick="ShowSecondaryReasonBox()" checked="checked"/>

                                        @else
                                            <input type="checkbox" name="mental_illness_diagnosis[]" value="{{ $item }}"
                                                   onclick="ShowSecondaryReasonBox()"/>
                                        @endif
                                        {{ $item }}
                                        <br>
                                    @endforeach
                                    <input type="checkbox" id="chkMentalIllness" name="mental_illness_diagnosis"
                                           onclick="ShowMentalIllnessBox()"/>
                                    Other (please explain)
                                </label>
                                <span id="MentalIllnessBox" style="display: none;">
                                    <input class="form-control" type="text" name="other_mental_illness_diagnosis[]"
                                           placeholder="Explain"/>
                                    <!-- MUST BE A PROBLEM FOR ARRAY TO SHOW OLD VALUE-->
                            </span>
                        </div>
                        @error('mental_illness_diagnosis') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="ghq"><b>GHQ (appendix - questionnaire and
                                scoring):</b></label>
                        <span class="btn btn-success" data-toggle="modal" data-target="#ghq-questionnaire-modal"
                              style="margin: 5px">Qiestionniare</span>
                        @include('call_checklist.shojon._question_form')
                        <input type="text" id="ghq" name="ghq" value="{{old('ghq','Incomplete')}}"
                               style="text-align:center;" readonly>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="suicidal_risk"><b>Does the client have Suicidal
                                risk:</b></label>
                        @php $types = ['No', 'Don\'t know', 'Mild', 'Moderate', 'Severe', 'Medical emergency']; @endphp
                        <select name="suicidal_risk" id="suicidal_risk" list="suicidal_risk_list"
                                class="form-control @error('suicidal_risk') is-invalid @enderror">
                            <datalist id="suicidal_risk_list">
                                <option value="">Select Option</option>
                                @foreach($types as $item)
                                    @if( old('suicidal_risk') == $item)
                                        <option value="{{ $item }}" selected>{{ $item }}</option>
                                    @else
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endif
                                @endforeach
                            </datalist>
                        </select>
                        @error('suicidal_risk') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="post_mood_rating"><b>Mood Rating (post-stage):</b> <br> [0
                            means lowest wellbeing, 10 means Highest wellbeing]</label>

                        {{-- <div class="col-md-auto"> --}}
                        {{-- <input class="form-control @error('post_mood_rating') is-invalid @enderror" type="text"
                               name="post_mood_rating" id="sliderPost" class="slider"/> --}}
                        <select name="post_mood_rating"
                                class="form-control @error('post_mood_rating') is-invalid @enderror">
                            <option value="">Select a Value</option>
                            @for ($i = 0; $i < 11; $i++)
                                @if( old('post_mood_rating') && (old('post_mood_rating') == $i))
                                    <option value={{ $i }} selected> {{ $i }} </option>
                                @else
                                    <option value={{ $i }}>{{ $i }}</option>
                                @endif
                            @endfor
                        </select>
                        {{-- </div> --}}
                        @error('post_mood_rating') {{ $message }} @enderror
                    </div>


                    <div class="form-group">
                        <label class="control-label" for="call_effectivenes"><b>How effective do you think the call was
                                for the client at the end of the call? <span class="required">*</span></b></label>
                        @php $types = ['Not at all effective', 'Slightly effective', 'Effective', 'Considerably effective', 'Very effective','Not applicable']; @endphp
                        <select name="call_effectivenes" id="call_effectivenes" list="call_effectivenes_list"
                                class="form-control @error('call_effectivenes') is-invalid @enderror">
                            <datalist id="call_effectivenes_list">
                                <option value="">Select Effective Option</option>
                                @foreach($types as $item)
                                    @if( old('call_effectivenes') == $item)
                                        <option value="{{ $item }}" selected>{{ $item }}</option>
                                    @else
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endif
                                @endforeach
                            </datalist>
                        </select>
                        @error('call_effectivenes') {{ $message }} @enderror
                    </div>

                    <div class="form-group" id="referred">
                        <label class="control-label" for="client_referral"><b>Was the client referred elsewhere? <span
                                    class="required">*</span></b></label>
                        @php $types = ['No', 'Health Hotline 09678771511', 'Kaan Pete Roi 9612119911', 'Inner Circle 01777772215']; @endphp
                        <div class="form-control @error('client_referral') is-invalid @enderror">
                            <label>
                                @foreach($types as $item)
                                    @if(old('client_referral') == $item)
                                        <input type="radio" id="group1" name="client_referral" value="{{ $item }}"
                                               checked="checked"/>
                                    @else
                                        <input type="radio" id="group1" name="client_referral" value="{{ $item }}"/>
                                    @endif
                                    {{ $item }}
                                    <br>
                                @endforeach

                                @if(old('client_referral') == "SHOJON Tier 2 for Psychotherapy")
                                    <input type="radio" id="group2" name="client_referral"
                                           value="SHOJON Tier 2 for Psychotherapy" checked="checked"/>
                                @else
                                    <input type="radio" id="group2" name="client_referral"
                                           value="SHOJON Tier 2 for Psychotherapy"/>
                                @endif
                                SHOJON Tier 2 for Psychotherapy

                                <br>

                                @if(old('client_referral') == "SHOJON Tier 3 for Psychiatric Consultation" )
                                    <input type="radio" id="group2" name="client_referral"
                                           value="SHOJON Tier 3 for Psychiatric Consultation" checked="checked"/>
                                @else
                                    <input type="radio" id="group2" name="client_referral"
                                           value="SHOJON Tier 3 for Psychiatric Consultation"/>
                                @endif
                                SHOJON Tier 3 for Psychiatric Consultation
                                <br>

                                @if(old('client_referral') == "other")
                                    <input type="radio" id="group3" name="client_referral" value="other"
                                           checked="checked"/>
                                @else
                                    <input type="radio" id="group3" name="client_referral" value="other"/>
                                @endif
                                Other (please explain)
                            </label>
                            <span id="ClientReferralBox" style="display: none;">
                                    <input class="form-control" type="text" name="other_client_referral"
                                           value="{{ old('client_referral') }}" placeholder="Explain"/>
                                </span>
                        </div>
                        @error('client_referral') {{ $message }} @enderror
                    </div>

                    <div class="form-group" id="financialAffordibilityBox" >
                        @include('call_checklist.shojon.financial_affordability_form')
                    </div>

                    {{-- <label class="control-label" for="financial_affordability"><b>If referred to 2/3 Tier of SHOJON – Financial affordability: <span class="required">*</span></b></label>
                        @php $types = ['Free', '50 - 100', '100 - 200', '200 - 300', '300-500', '500 – 800', '800 – 1000', 'Not referred to SHOJON tier 2/3']; @endphp
                        <select name="financial_affordability" id="financial_affordability" class="form-control @error('financial_affordability') is-invalid @enderror">
                            <option disabled selected>Select Financial affordability</option>
                            @foreach($types as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('financial_affordability') {{ $message }} @enderror --}}

                    <div class="form-group">
                        <label class="control-label" for="caller_description"><b>Call Description: <span
                                    class="required">*</span></b></label>
                        <textarea rows="5" cols="50"
                                  class="form-control
                                @error('caller_description') is-invalid @enderror"
                                  name="caller_description"
                                  id="caller_description"
                                  value="{{ old('caller_description') }}">{{ old('caller_description')}}
                        </textarea>

                        @error('caller_description') {{ $message }} @enderror
                    </div>

                    <span class="btn btn-success" id="messageButton" style="margin: 5px" onclick="showMessageBox()">Message</span>
                    <div class="form-group" id="messageBox" style="display: none">
                        <select name="sms_switch" type="text" class="form-control" id="sms_type" list="sms_types"
                                onchange="change_sms()">
                            <datalist id="sms_types">
                                <option value="" selected>Please Select Type</option>
                                <option value="tier2" <?php if (old('sms_switch') == 'tier2') echo "selected" ?> >Tier
                                    2
                                </option>
                                <option value="tier3" <?php if (old('sms_switch') == 'tier3') echo "selected" ?> >Tier
                                    3
                                </option>
                                <option
                                    value="health_hotline" <?php if (old('sms_switch') == 'health_hotline') echo "selected" ?> >
                                    Health Hotline
                                </option>
                                <option value="kpr" <?php if (old('sms_switch') == 'kpr') echo "selected" ?> >KPR
                                </option>
                                <option
                                    value="inner_circle" <?php if (old('sms_switch') == 'inner_circle') echo "selected" ?> >
                                    Inner Circle
                                </option>
                            </datalist>

                            <label class="control-label" for="message"><b>Message: </b></label>
                            <textarea rows="3" cols="50"
                                      class="form-control
                                @error('message') is-invalid @enderror"
                                      name="message"
                                      id="message"
                                      value="{{ old('message') }}"
                                      placeholder="Write your message"
                            ></textarea>
                        @error('message') {{ $message }} @enderror
                    </div>

                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                            Shojon
                        </button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" onclick="cancel()"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    function change_sms() {
        var tier2 = "স্বজন-এ কল করার জন্য আপনাকে ধন্যবাদ। আপনার মানসিক স্বাস্থ্যসেবা নিশ্চিত করতে সব সময় পাশে আছে স্বজন। কাউন্সেলিং সেবা নেয়ার জন্য খুব দ্রুত আপনার সাথে যোগাযোগ করা হবে।";
        var tier3 = "স্বজন-এ কল করার জন্য আপনাকে ধন্যবাদ। মনঃ চিকিৎসা থেকে সেবা ও পরামর্শ দেওয়ার জন্য খুব দ্রুত আপনার সাথে যোগাযোগ করা হবে। আপনার মানসিক স্বাস্থ্যসেবা নিশ্চিতে সবসময় পাশে আছে স্বজন।";
        var health_hotline = "স্বজন-এ কল করার জন্য আপনাকে ধন্যবাদ। আপনার যে কোন শারীরিক স্বাস্থ্য সংক্রান্ত সাহায্যের জন্য কল করতে পারেন সাজেদা হাসপাতাল এর হটলাইন নাম্বারে ০৯৬৭৮৭৭১৫১১।";
        var KPR = "স্বজন-এ কল করার জন্য আপনাকে ধন্যবাদ। আত্মহত্যা প্রবণতা মূলক বিষয়ে কথা বলতে এবং যেকোন সাহায্যের জন্য \"কান পেতে রই\" রয়েছে দুপুর ৩টা থেকে রাত ৩টা পর্যন্ত ০৯৬১২১১৯৯১১ নম্বরে।";
        var Inner_Circle = "স্বজন-এ কল করার জন্য আপনাকে ধন্যবাদ। অটিজম এবং শিশুর বিকাশ সম্পর্কিত বিজ্ঞান সম্পর্কিত তথ্য এবং সেবা নিয়ে বিস্তারিত জানতে কল করুন ০১৭৭৭৭৭২২১৫ নাম্বারে।";

        var sms_type = $("#sms_type").val();
        if (sms_type == "tier2")
            $("#message").html(tier2);
        else if (sms_type == "tier3")
            $("#message").html(tier3);
        else if (sms_type == "health_hotline")
            $("#message").html(health_hotline);
        else if (sms_type == "kpr")
            $("#message").html(KPR);
        else if (sms_type == "inner_circle")
            $("#message").html(Inner_Circle);


    }

    function cancel() {
        if (confirm('Are you sure you want to cancel?')) {
            open('/', '_self').close();
        } else {

        }
    }

    $(document).ready(function () {
        show_hide_referral();
        $('#myForm input').on('change', function () {
            show_hide_referral();
        });

        change_sms();

    });

    function show_hide_referral() {
        let checked_item = $('input[name=client_referral]:checked', '#myForm');
        let id = checked_item.attr('id');

        var financialAffordibilityBox = document.getElementById("financialAffordibilityBox");
        var clientReferralBox = document.getElementById("ClientReferralBox");

        if (id == 'group1') {
            financialAffordibilityBox.style.display = "none";
            clientReferralBox.style.display = "none";
        } else if (id == 'group2') {
            financialAffordibilityBox.style.display = "block";
            clientReferralBox.style.display = "none";
        } else if (id == 'group3') {
            financialAffordibilityBox.style.display = "none";
            clientReferralBox.style.display = "block";

        }
    }
</script>

<script>

    $(document).ready(function () {
        ShowOccupationBox();
        ShowHearingSourceBox();
        ShowServiceBox();
        ShowMainReasonBox();
        ShowSecondaryReasonBox();
        ShowMentalIllnessBox();
        ShowClientReferralBox();
        showFinancialAffordability();
        showMessageBox();
    });

    function ShowOccupationBox() {
        var radio = document.getElementById("chkOccupation");
        var Box = document.getElementById("OccupationBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function ShowHearingSourceBox() {
        var radio = document.getElementById("chkHearingSource");
        var Box = document.getElementById("HearingSourceBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function ShowServiceBox() {
        var radio = document.getElementById("chkService");
        var Box = document.getElementById("ServiceBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function ShowMainReasonBox() {
        var radio = document.getElementById("chkMainReason");
        var Box = document.getElementById("MainReasonBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function ShowSecondaryReasonBox() {
        var radio = document.getElementById("chkSecondaryReason");
        var Box = document.getElementById("SecondaryReasonBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function ShowMentalIllnessBox() {
        var radio = document.getElementById("chkMentalIllness");
        var Box = document.getElementById("MentalIllnessBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function ShowClientReferralBox() {
        var chkClientReferral = document.getElementById("chkClientReferral");
        var ClientReferralBox = document.getElementById("ClientReferralBox");
        ClientReferralBox.style.display = chkClientReferral.checked ? "block" : "none";
    }

    function showFinancialAffordability() {
        var chkTier = document.getElementById("chkTier");
        var financialAffordibilityBox = document.getElementById("financialAffordibilityBox");
        financialAffordibilityBox.style.display = chkTier.checked ? "block" : "none";
    }

    function showMessageBox() {
        var messageButton = document.getElementById("messageButton");
        var messageBox = document.getElementById("messageBox");
        messageBox.style.display = messageButton.click ? "block" : "none";
    }

    (function () {
        // 'use strict';

        var init = function () {

            var sliderPre = new rSlider({
                target: '#sliderPre',
                values: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                range: false,
                set: [0],
                tooltip: false,
                // onChange: function (vals) {
                //     console.log(vals);
                // }
            });

            var sliderPost = new rSlider({
                target: '#sliderPost',
                values: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                range: false,
                set: [0],
                tooltip: false,
                // onChange: function (vals) {
                //     console.log(vals);
                // }
            });
        };
        window.onload = init;
    })();
</script>
