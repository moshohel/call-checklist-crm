@extends('call_checklist.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
{{--
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> --}}
<div class="app-title">
    <div>
        <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
    </div>
</div>



<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="tile">
            <h3 class="tile-title">Create Checklist for Shojon</h3>
            @include('call_checklist.partials.messages')
            <form id="myForm" action="{{ route('call_checklist.shojontierThree.store') }}" method="POST" role="form" enctype="multipart/form-data" autocomplete="off">
                @csrf

                <div class="tile-body">
                    <!-- Auto generated field -->
                    <input type="hidden" name="project_name" value="SHOJON">
                    <input type="hidden" name="service_providers_name" value="{{ auth()->user()->full_name }}">
                    <input type="hidden" name="service_providers_id" value="{{ auth()->user()->user_id }}">
                    <input type="hidden" name="call_started" value="#">
                    <input type="hidden" name="call_end" value="#">
                    <input type="hidden" name="duration" value="#">

                    <input type="hidden" name="session_id" value="{{ $session_id }}">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label"><b>Phone Number</b></label>
                            <input type="number" class="form-control" readonly name="phone_number" value="{{$newPatient->phone_number}}">
                        </div>
                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label"><b>Client Name</b></label>
                            <input type="text" class="form-control" name="client_name" readonly value="{{$newPatient->name}}">
                            <input type="hidden" class="form-control" name="client_id" placeholder="Enter client name" value="{{ $uniqueid }}">
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                @php $types = ['Male','Female','LGBTQ','Others']; @endphp
                                <label for="validationCustom01" class="form-label"><b>Sex</b></label>
                                <select class="form-control" readonly name="sex" required>
                                    <option disabled selected>Select Sex</option>
                                    @foreach($types as $item)
                                    @if($newPatient->sex == $item)
                                    <option selected value="{{$item}}">{{$item}}</option>
                                    @else
                                    <option value="{{$item}}">{{$item}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                @php $types = ['0-12','13-19','20-30','30-40','40-65','65+','Don’t know.','Don’t want to
                                share']; @endphp
                                <label for="validationCustom01" class="form-label"><b>Age</b></label>
                                <select class="form-control" readonly name="age" required>
                                    <option disabled selected>Select age</option>
                                    @foreach($types as $item)
                                    @if($newPatient->age == $item)
                                    <option selected value="{{$item}}">{{$item}}</option>
                                    @else
                                    <option value="{{$item}}">{{$item}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <input type="hidden" name="referrence_id" value="1">

                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                @php $types = ['Upper', 'Upper Middle Class', 'Middle Class', 'Lower Middle Class',
                                'Upper Lower Class', 'Lower Class']; @endphp
                                <label for="validationCustom01" class="form-label"><b>Socio-economic Status
                                        (SES)</b></label>
                                <select class="form-control" readonly name="socio_economic">
                                    <option disabled selected>Select Socio-economic</option>
                                    @foreach($types as $item)
                                    @if($newPatient->socio_economic_status ==$item )
                                    <option selected value="{{$item}}">{{$item}}</option>
                                    @else
                                    <option value="{{$item}}">{{$item}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="validationCustom01" class="form-label"><b>Location</b></label>
                                <select class="form-control" readonly name="location" required>
                                    <option disabled selected>Select Location</option>
                                    @foreach($districts as $item)
                                    @if($newPatient->location == $item->name)
                                    <option selected value="{{$item->name}}">{{$item->name}}</option>
                                    @else
                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group">
                        <label class="control-label" for="socio_economic_status"><b>Socio-economic
                                Status:</b></label>
                        @php $types = ['Upper', 'Upper Middle Class', 'Middle Class', 'Lower Middle Class', 'Upper Lower
                        Class', 'Lower Class']; @endphp
                        <select name="socio_economic_status" list="socio_economic_status_list" id="socio_economic_status" class="form-control">

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

                    <div class="form-group">
                        <label class="control-label" for="occupation"><b>1. Occupation:</label>
                        @php $types = ['Student', 'Job holder', 'Businessperson', 'Housewife', 'Unemployed', 'Retired',
                        'Could not tell']; @endphp
                        <div class="form-control @error('occupation') is-invalid @enderror">
                            <label>
                                @foreach($types as $item)
                                @if((old('occupation') == $item))
                                <input type="radio" name="occupation" value="{{ $item }}" checked="checked" onclick="ShowOccupationBox()" />
                                @else
                                <input type="radio" name="occupation" value="{{ $item }}" onclick="ShowOccupationBox()" />
                                @endif
                                {{ $item }}
                                <br>
                                @endforeach
                                <input type="radio" id="chkOccupation" name="occupation" onclick="ShowOccupationBox()" />
                                Other (please explain)
                            </label>
                            <span id="OccupationBox" style="display: none;">
                                <input class="form-control" type="text" name="other_occupation" value="{{ old('other_occupation',$last ? $last->other_occupation : null) }}" placeholder="Explain" />
                            </span>
                        </div>
                        @error('occupation') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="educational_qualification"><b>2. Educational
                                Qualification</b></label>
                        @php $types = ['Pre-primary(Jr/Sr KG or equivalent)', 'Primary (1st-5th)', 'Secondary
                        (5th-SSC)', 'Higher Secondary ( 11th- HSC)', 'Graduate (degree and Hons)', 'Post-Graduate and
                        above','Never been to school','Don’t know','Other']; @endphp
                        <select name="educational_qualification" list="educational_qualification" id="educational_qualification" class="form-control">

                            <datalist id="educational_qualification">
                                <option value="" selected disabled>Select Educational Qualification</option>
                                @foreach($types as $item)
                                @if( old('educational_qualification') == $item))
                                <option value="{{ $item }}">{{ $item }}</option>
                                @else
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endif
                                @endforeach
                            </datalist>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="marital_status"><b>3. Marital Status</b></label>
                        @php $types = ['Single', 'Married', 'Divorced', 'Separated', 'Don’t know', 'Don’t want to
                        share']; @endphp
                        <select name="marital_status" list="marital_status" id="marital_status" class="form-control">

                            <datalist id="marital_status">
                                <option value="" selected disabled>Select Marital Status</option>
                                @foreach($types as $item)
                                @if( old('marital_status') == $item))
                                <option value="{{ $item }}">{{ $item }}</option>
                                @else
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endif
                                @endforeach
                            </datalist>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="session_number"><b>4. Session Number </b></label>
                        @php $types = ['1st session', '2nd session', '3rd session', '4th session', '6th session', '7th
                        session','8th session','8th session','9th session','10th session','Last session']; @endphp
                        <div class="form-control @error('session_number') is-invalid @enderror">
                            <label>
                                @foreach($types as $item)
                                @if((old('session_number') == $item))
                                <input type="radio" name="session_number" value="{{ $item }}" checked="checked" onclick="ShowSessionBox()" />
                                @else
                                <input type="radio" name="session_number" value="{{ $item }}" onclick="ShowSessionBox()" />
                                @endif
                                {{ $item }}
                                <br>
                                @endforeach
                                <input type="radio" id="chkSession" name="session_number" onclick="ShowSessionBox()" />
                                Other (please explain)
                            </label>
                            <span id="SessionBox" style="display: none;">
                                <input class="form-control" type="text" name="other_session_number" value="{{ old('other_occupation',$last ? $last->other_occupation : null) }}" placeholder="Explain" />
                            </span>
                        </div>
                        @error('session_number') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label">5. Mental State Examination </label><br>
                        <div class="form-control">
                            <label class="form-control">
                                <label class="control-label">
                                    <input type="radio" id="chkAppearance" class="Appearance" name="appearance" onclick="ShowAppearanceBox()" />
                                    Appearance (please explain)
                                </label>

                                <span id="AppearanceBox" class="AppearanceInput" style="display: none;">
                                    <input class="form-control" type="text" name="examination_appearance" value="{{ old('examination_appearance',$last ? $last->examination_appearance : null) }}" placeholder="Appearance Explain" />
                                </span>
                            </label>
                            <label class="form-control">
                                <label class="control-label">
                                    <input type="radio" id="chkBehavior" class="Behavior" name="Behavior" onclick="ShowBehaviorBox()" />
                                    Behavior (please explain)
                                </label>

                                <span id="BehaviorBox" class="BehaviorInput" style="display: none;">
                                    <input class="form-control" type="text" name="examination_behavior" value="{{ old('examination_behavior',$last ? $last->examination_behavior : null) }}" placeholder="Behavior Explain" />
                                </span>
                            </label>
                            <label class="form-control">
                                <label class="control-label">
                                    <input type="radio" id="chkSpeech" class="Speech" name="Speech" onclick="ShowSpeechBox()" />
                                    Speech (please explain)
                                </label>

                                <span id="SpeechBox" class="SpeechInput" style="display: none;">
                                    <input class="form-control" type="text" name="examination_speech" value="{{ old('examination_speech',$last ? $last->examination_speech : null) }}" placeholder="Speech Explain" />
                                </span>
                            </label>
                            <label class="form-control">
                                <label class="control-label">
                                    <input type="radio" id="chkaffect" class="affect" name="affect" onclick="ShowaffectBox()" />
                                    Mood and affect (please explain)
                                </label>

                                <span id="affectBox" class="affectInput" style="display: none;">
                                    <input class="form-control" type="text" name="examination_affect" value="{{ old('examination_affect',$last ? $last->examination_affect : null) }}" placeholder="affect Explain" />
                                </span>
                            </label>
                            <label class="form-control">
                                <label class="control-label">
                                    <input type="radio" id="chkThought" class="Thought" name="Thought" onclick="ShowThoughtBox()" />
                                    Thought (please explain)
                                </label>

                                <span id="ThoughtBox" class="ThoughtInput" style="display: none;">
                                    <input class="form-control" type="text" name="examination_thought" value="{{ old('examination_thought',$last ? $last->examination_thought : null) }}" placeholder="Thought Explain" />
                                </span>
                            </label>
                            <label class="form-control">
                                <label class="control-label">
                                    <input type="radio" id="chkPerception" class="Perception" name="Perception" onclick="ShowPerceptionBox()" />
                                    Perception (please explain)
                                </label>

                                <span id="PerceptionBox" class="PerceptionInput" style="display: none;">
                                    <input class="form-control" type="text" name="examination_perception" value="{{ old('examination_perception',$last ? $last->examination_perception : null) }}" placeholder="Perception Explain" />
                                </span>
                            </label>
                            <label class="form-control">
                                <label class="control-label">
                                    <input type="radio" id="chkCognition" class="Cognition" name="Cognition" onclick="ShowCognitionBox()" />
                                    Cognition (please explain)
                                </label>

                                <span id="CognitionBox" class="CognitionInput" style="display: none;">
                                    <input class="form-control" type="text" name="examination_cognition" value="{{ old('examination_cognition',$last ? $last->examination_cognition : null) }}" placeholder="Cognition Explain" />
                                </span>
                            </label>
                            <label class="form-control">
                                <label class="control-label">
                                    <input type="radio" id="chkJudgement" class="Judgement" name="Judgement" onclick="ShowJudgementBox()" />
                                    Insight & Judgement (please explain)
                                </label>

                                <span id="JudgementBox" class="JudgementInput" style="display: none;">
                                    <input class="form-control" type="text" name="examination_judgement" value="{{ old('examination_judgement',$last ? $last->examination_judgement : null) }}" placeholder="Judgement Explain" />
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">6. Presenting Problems list and problem rating: </label><br>
                        <table class="table table-bordered border-primary" id="dynamic_field">
                            <thead>
                                <tr>
                                    <th scope="col">Symptoms</th>
                                    <th scope="col">Severity ( Rate in 0-100)</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="Symptoms[]" placeholder="Symptoms" class="form-control name_list" /></td>
                                    <td><input type="text" name="Severity[]" placeholder="Severity ( Rate in 0-100)" class="form-control name_list" /></td>
                                    <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="form-group">
                        <label class="control-label" for="problem_duration"><b>7. Problem duration</b></label>
                        @php $types = ['<1 month', '1 to 3 months' , '4 to 6 months ' , '6 to 12 month ' , '12 to 24 months ' , '<24 month' ,'More than 5 years','More than 10 years ',' Don’t know','Other']; @endphp <select name="problem_duration" list="problem_duration" id="problem_duration" class="form-control">

                            <datalist id="problem_duration">
                                <option value="" selected disabled>Select Problem duration</option>
                                @foreach($types as $item)
                                @if( old('problem_duration') == $item))
                                <option value="{{ $item }}">{{ $item }}</option>
                                @else
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endif
                                @endforeach
                            </datalist>
                            </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="illness_history"><b>8. Illness/ problem history </b></label>
                        <textarea class="form-control" name="illness_history">

                        </textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="family_history"><b>9. Family illness History </b></label>
                        <textarea class="form-control" name="family_history">

                        </textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="birth_history"><b>10. Birth and development
                                history:</b></label>
                        <textarea class="form-control" name="birth_history">

                        </textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="substance_history"><b>11. Substance use history if
                                any</b></label>
                        <textarea class="form-control" name="substance_history">

                        </textarea>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="suicidal_risk"><b>12. Does the client have suicidal
                                Ideation</b></label>
                        @php $types = ['Yes', 'No', 'Don’t know']; @endphp
                        <select name="suicidal_risk" id="suicidal_risk" list="suicidal_risk_list" class="form-control @error('suicidal_risk') is-invalid @enderror">
                            <datalist id="suicidal_risk_list">
                                <option value="" selected disabled>Select Option</option>
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
                        <label class="control-label" for="self_harm_history"><b>13. Does the client have any self-harm
                                history</b></label>
                        @php $types = ['Yes', 'No', 'Don’t Know/Don’t want shere']; @endphp
                        <select name="self_harm_history" id="self_harm_history" list="suicidal_risk_list" class="form-control @error('self_harm_history') is-invalid @enderror">
                            <datalist id="suicidal_risk_list">
                                <option value="" selected disabled>Select Option</option>
                                @foreach($types as $item)
                                @if( old('self_harm_history') == $item)
                                <option value="{{ $item }}" selected>{{ $item }}</option>
                                @else
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endif
                                @endforeach
                            </datalist>
                        </select>
                        @error('self_harm_history') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="mental_illness_diagnosis"><b>14. Previous psychiatric
                                diagnosis</b></label>
                        @php $types = ['Major Depressive Disorder', 'Anxiety Disorder', 'Panic Disorder','Obsessive
                        Compulsive Disorder','Social Anxiety Disorder','Insomnia','Schizophrenia','Bipolar Disorder
                        ','Personality Disorder','Autism spectrum disorder','Attention deficit hyperactivity
                        disorder','Learning disorder (LD)','Dementia','Alzheimer','Phobia','Post-traumatic stress
                        disorder (PTSD)','Substance Abuse Disorder','Psychosexual disorder','Gender Identity
                        disorder','Conversion disorder','Conduct disorder','No applicable']; @endphp
                        <div class="form-control @error('mental_illness_diagnosis') is-invalid @enderror">
                            <label>

                                <label>
                                    @foreach($types as $item)
                                    @if(old('mental_illness_diagnosis') && is_array('mental_illness_diagnosis')) &&
                                    in_array($item,old('mental_illness_diagnosis')))
                                    <input type="checkbox" name="mental_illness_diagnosis[]" value="{{ $item}}" onclick="ShowSecondaryReasonBox()" checked="checked" />

                                    @else
                                    <input type="checkbox" name="mental_illness_diagnosis[]" value="{{ $item}}" onclick="ShowSecondaryReasonBox()" />
                                    @endif
                                    {{ $item }}
                                    <br>
                                    @endforeach
                                    <input type="checkbox" id="chkMentalIllness" name="mental_illness_diagnosis" onclick="ShowMentalIllnessBox()" />
                                    Other (please explain)<br>
                                    <input type="hidden" name="mental_illness_diagnosis[]" value="" checked="checked">
                                </label>
                                <span id="MentalIllnessBox" style="display: none;">
                                    <input class="form-control" type="text" name="other_mental_illness_diagnosis[]" placeholder="Explain" />
                                    <!-- MUST BE A PROBLEM FOR ARRAY TO SHOW OLD VALUE-->
                                </span>
                        </div>
                        @error('mental_illness_diagnosis') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label">15. Previous Medication History :</label>
                        <textarea class="form-control" name="previous_medication"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="physical_Concern_history"><b>16. Physical Concern history
                        </label>
                        @php $types = ['Diabetes','Hypertension','Thyroid problem','Chronic pain','Asthma','Hormonal
                        issues','Life threatening disease','Obesity','Not Applicable']; @endphp
                        <div class="form-control @error('physical_Concern_history') is-invalid @enderror">
                            <label>
                                @foreach($types as $item)
                                @if(old('physical_Concern_history') && is_array(old('physical_Concern_history')) &&
                                in_array($item,old('physical_Concern_history')))
                                <input type="checkbox" name="physical_Concern_history[]" value="{{ $item }}" onclick="ShowSecondaryReasonBox()" checked="checked" />
                                @else
                                <input type="checkbox" name="physical_Concern_history[]" value="{{ $item }}" onclick="ShowSecondaryReasonBox()" />

                                @endif
                                {{ $item }}
                                <br>
                                @endforeach
                                <input type="checkbox" id="chkSecondaryReason" name="physical_Concern_history" onclick="ShowSecondaryReasonBox()" />
                                Others (please explain)<br>
                                <input type="hidden" name="physical_Concern_history[]" value="" checked="checked">
                            </label>
                            <span id="SecondaryReasonBox" style="display: none;">
                                <input class="form-control" type="text" name="other_physical_Concern_history[]" placeholder="Explain" />
                                <!-- MUST BE A PROBLEM FOR ARRAY TO SHOW OLD VALUE-->
                            </span>
                        </div>
                        @error('physical_Concern_history') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="current_differential_diagnosis"><b>17. Current Differential
                                Diagnosis:</b></label>
                        @php $types = ['Major Depressive Disorder', 'Anxiety Disorder', 'Panic Disorder','Obsessive
                        Compulsive Disorder','Social Anxiety Disorder','Eating Disorder','Insomnia/sleep related
                        disorder','Schizophrenia','Bipolar Disorder ','Personality Disorder','Autism spectrum
                        disorder','Attention deficit hyperactivity disorder','Learning disorder
                        (LD)','Dementia','Alzheimer','Phobia','Post-traumatic stress disorder (PTSD)','Substance Abuse
                        Disorder','Sexual disorder','Gender Identity disorder','Conversion disorder','Conduct
                        disorder','No']; @endphp
                        <div class="form-control @error('current_differential_diagnosis') is-invalid @enderror">
                            <label>

                                <label>
                                    @foreach($types as $item)
                                    @if(old('current_differential_diagnosis') &&
                                    is_array('current_differential_diagnosis')) &&
                                    in_array($item,old('current_differential_diagnosis')))
                                    <input type="checkbox" name="current_differential_diagnosis[]" value="{{ $item}}" onclick="ShowCurrentDiagnosis()" checked="checked" />

                                    @else
                                    <input type="checkbox" name="current_differential_diagnosis[]" value="{{ $item}}" onclick="ShowCurrentDiagnosis()" />
                                    @endif
                                    {{ $item }}
                                    <br>
                                    @endforeach
                                    <input type="checkbox" id="chkCurrentDiagnosis" name="current_differential_diagnosis" onclick="ShowCurrentDiagnosis()" />
                                    Other (please explain)<br>
                                    <input type="hidden" name="current_differential_diagnosis[]" value="" checked="checked">
                                </label>
                                <span id="CurrentDiagnosisBox" style="display: none;">
                                    <input class="form-control" type="text" name="other_current_differential_diagnosis[]" placeholder="Explain" />
                                    <!-- MUST BE A PROBLEM FOR ARRAY TO SHOW OLD VALUE-->
                                </span>
                        </div>
                        @error('current_differential_diagnosis') {{ $message }} @enderror
                    </div>
                    <!-- Prescribed Medications -->
                    <div class="form-group">
                        <label class="control-label" for="prescribed_medications"><b>Prescribed Medications:</b></label>
                        <textarea class="form-control" name="prescribed_medications">

                        </textarea>
                    </div>
                    <!-- Is Psychotherapy session suggested for the client?  -->
                    <div class="form-group">
                        <label class="control-label" for="psychotherapy_session_suggested"><b>18. Is Psychotherapy
                                session suggested for the client?</b></label>
                        @php $types = ['Yes', 'No']; @endphp
                        <select name="psychotherapy_session_suggested" id="psychotherapy_session_suggested" list="suicidal_risk_list" class="form-control @error('psychotherapy_session_suggested') is-invalid @enderror">
                            <datalist id="suicidal_risk_list">
                                <option value="" selected disabled>Select Option</option>
                                @foreach($types as $item)
                                @if( old('psychotherapy_session_suggested') == $item)
                                <option value="{{ $item }}" selected>{{ $item }}</option>
                                @else
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endif
                                @endforeach
                            </datalist>
                        </select>
                        @error('psychotherapy_session_suggested') {{ $message }} @enderror
                    </div>
                    <!-- 22. Does client have the ability to buy medicine?   -->
                    <div class="form-group">
                        <label class="control-label" for="client_ability_buy_medicine"><b>19. Does client have the
                                ability to buy medicine</b></label>
                        @php $types = ['Yes', 'No','Don’t Know']; @endphp
                        <select name="client_ability_buy_medicine" id="client_ability_buy_medicine" list="suicidal_risk_list" class="form-control @error('client_ability_buy_medicine') is-invalid @enderror">
                            <datalist id="suicidal_risk_list">
                                <option value="" selected disabled>Select Option</option>
                                @foreach($types as $item)
                                @if( old('client_ability_buy_medicine') == $item)
                                <option value="{{ $item }}" selected>{{ $item }}</option>
                                @else
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endif
                                @endforeach
                            </datalist>
                        </select>
                        @error('client_ability_buy_medicine') {{ $message }} @enderror
                    </div>
                    <!-- 23. Is the client suitable for ? ( single select) -->
                    <div class="form-group">
                        <label class="control-label" for="suitable_session_type"><b>20. Is the client suitable for
                            </b></label>
                        @php $types = ['Online session', 'In person Session']; @endphp
                        <select name="suitable_session_type" id="suitable_session_type" list="suicidal_risk_list" class="form-control @error('suitable_session_type') is-invalid @enderror">
                            <datalist id="suicidal_risk_list">
                                <option value="" selected disabled>Select Option</option>
                                @foreach($types as $item)
                                @if( old('suitable_session_type') == $item)
                                <option value="{{ $item }}" selected>{{ $item }}</option>
                                @else
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endif
                                @endforeach
                            </datalist>
                        </select>
                        @error('suitable_session_type') {{ $message }} @enderror
                    </div>
                    <!--   24.    How effective the client thinks the psychiatric consultation was? (mandatory single select)  -->
                    <div class="form-group">
                        <label class="control-label" for="useful_effective"><b>21. How effective the client thinks the
                                psychiatric consultation was</label><br>
                        @php $types = ['Very useful and effective','Useful, but not so effective', 'Quite useful and
                        effective', 'Neither useful, nor effective', 'No comment/Cannot decide']; @endphp
                        <div class="form-control @error('useful_effective') is-invalid @enderror">
                            <label>
                                @foreach($types as $item)
                                @if( old('useful_effective') == $item)
                                <input type="radio" name="useful_effective" value="{{ $item }}" />
                                @else
                                <input type="radio" name="useful_effective" value="{{ $item }}" />
                                @endif
                                {{ $item }}
                                <br>
                                @endforeach
                            </label>
                        </div>
                        @error('useful_effective') {{ $message }} @enderror
                    </div>

                    <div class="form-group" style="display: none">
                        <label class="control-label" for="yes_no_radio"><b>22. Consent for Recording: </label>
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
                    <div class="form-group" id="referred">
                        {{-- <label class="control-label" for="client_referral">23. Referral</label>
                        <div class="form-control">
                            <label class="control-label">Internal Referral:</label><br>
                            <label id="SHOJONTierThreeBox" class="TierThree">
                                <label class="control-label">
                                    <a href="#" class="btn btn-primary btn-sm Referral_form " data-id="#"
                                        data-toggle="modal" data-target="#ReferralModal">Referral Tier 2</a>
                                </label>
                            </label>
                            @include('call_checklist.shojon.tier2._referral_tier_three')
                            </label>
                        </div> --}}
                        <label class="control-label" for="client_referral">23. Referral</label>
                        <div class="form-control">
                            <label class="control-label">
                                <input type="radio" id="chkSHOJONTierThree" class="TierThreeChe" name="Internal_referral" value="Yes" onclick="ShowSHOJONTierTowInternalReferralBox()" />
                                Internal Referral
                            </label><br>
                            {{-- <label id="SHOJONTierThreeBox" class="TierThree">
                                <label class="control-label">
                                    <a href="#" class="btn btn-primary btn-sm Referral_form " data-id="#"
                                        data-toggle="modal" data-target="#Referral_tier_threeModal">Referral Tier 3</a>
                                </label>
                            </label>
                            @include('call_checklist.shojon.tier_one._referral_tier_two') --}}
                            <span id="SHOJONTierTwoBox" class="TierTwo">
                                <a href="#" class="btn btn-info btn-sm edit" data-id="#" data-toggle="modal" data-target="#Referral_tier_twoModal">SHOJON Tier 2</a>
                                @include('call_checklist.shojon.tier_one._referral_tier_two')
                            </span>
                        </div>
                        <div class="form-control">
                            <label class="control-label" for="client_referral"><b>External referral: </label>
                            <div class="form-control @error('TreatmentGoal') is-invalid @enderror">
                                <label class="control-label">Reason for referral:</label><br>
                                <label class="control-label" style="width: 90%;">
                                    <input type="text" name="ReasonForReferral" class="form-control">

                                </label><br>
                                <label class="control-label">Name of the Agency:</label><br>
                                <label class="control-label" style="width: 90%;">
                                    <input type="text" name="NameOfAgency" class="form-control">

                                </label>
                            </div>
                            @php $types = ['Health Hotline 09678771511','KPR 01777772215']; @endphp
                            <div class="form-control @error('client_referral') is-invalid @enderror">
                                <label>
                                    @foreach($types as $item)
                                    <input type="radio" name="client_referral" value="{{ $item }}" />
                                    {{ $item }}
                                    <br>
                                    @endforeach
                                    <input type="radio" id="CliKReferral" name="client_referral" value="other" onclick="ShowReferralBox()" />
                                    Other (please explain)
                                </label>
                                <span id="ReferralBox" style="display: none;">
                                    <input class="form-control" type="text" name="other_client_referral" value="{{ old('client_referral') }}" placeholder="Explain" />
                                </span>
                            </div>
                            @error('client_referral') {{ $message }} @enderror
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label" for="next_session_plan"><b>Followup Session</label>
                        <textarea rows="2" cols="50" class="form-control
                                @error('next_session_plan') is-invalid @enderror" name="next_session_plan" id="next_session_plan" value="{{ old('next_session_plan') }}">{{ old('next_session_plan')}}
                        </textarea>

                        @error('next_session_plan') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="session_summary"><b>24. Session summary : </label>
                        <textarea rows="2" cols="50" class="form-control
                                @error('session_summary') is-invalid @enderror" name="session_summary" id="session_summary" value="{{ old('session_summary') }}">{{ old('session_summary')}}
                        </textarea>

                        @error('session_summary') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="TreatmentGoal"><b>25. Session Outcomes
                        </label><br>
                        <div class="form-control @error('TreatmentGoal') is-invalid @enderror">
                            <label class="control-label">Schedule Follow-up Session</label><br>
                            <div class="row">
                                <div class="col">
                                    <input type="date" class="form-control" required name="next_session_date">
                                </div>
                                <div class="col">
                                    <input type="time" class="form-control" required name="next_session_time">
                                </div>
                            </div><br>
                            <label class="control-label">
                                <a href="#" class="btn btn-primary btn-sm Termination_form " data-id="#" data-toggle="modal" data-target="#TerminationModaltier_three">Termination</a>
                            </label>
                            @include('call_checklist.shojon.tierThree.TerminationTier_three')
                            </label>
                        </div>
                        @error('TreatmentGoal') {{ $message }} @enderror
                    </div>

                    <span class="btn btn-success" id="messageButton" style="margin: 5px" onclick="showMessageBox()">Message</span>
                    <div class="form-group" id="messageBox" style="display: none">
                        <select name="sms_switch" type="text" class="form-control" id="sms_type" list="sms_types" onchange="change_sms()">
                            <datalist id="sms_types">
                                <option value="" selected>Please Select Type</option>
                                <option value="tier2" <?php if (old('sms_switch') == 'tier2') echo "selected" ?>>Tier
                                    2
                                </option>
                                <option value="tier3" <?php if (old('sms_switch') == 'tier3') echo "selected" ?>>Tier
                                    3
                                </option>
                                <option value="health_hotline" <?php if (old('sms_switch') == 'health_hotline')
                                                                    echo "selected" ?>>
                                    Health Hotline
                                </option>
                                <option value="kpr" <?php if (old('sms_switch') == 'kpr') echo "selected" ?>>KPR
                                </option>
                                <option value="inner_circle" <?php if (old('sms_switch') == 'inner_circle')
                                                                    echo "selected" ?>>
                                    Inner Circle
                                </option>
                            </datalist>

                            <label class="control-label" for="message"><b>Message: </b></label>
                            <textarea rows="3" cols="50" class="form-control
                                @error('message') is-invalid @enderror" name="message" id="message" value="{{ old('message') }}" placeholder="Write your message">
                                                </textarea>
                            @error('message') {{ $message }} @enderror
                    </div>

                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>SUBMIT
                        </button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" onclick="cancel()"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
            </form>
        </div>
    </div>
</div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}
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

    $(document).ready(function() {
        $('#myForm input').on('change', function() {});

        change_sms();

    });


    // function show_hide_referral() {
    //     let checked_item = $('input[name=client_referral]:checked', '#myForm');
    //     let id = checked_item.attr('id');

    //     var financialAffordibilityBox = document.getElementById("financialAffordibilityBox");
    //     var clientReferralBox = document.getElementById("ClientReferralBox");

    //     if (id == 'group1') {
    //         financialAffordibilityBox.style.display = "none";
    //         clientReferralBox.style.display = "none";
    //     } else if (id == 'group2') {
    //         financialAffordibilityBox.style.display = "block";
    //         clientReferralBox.style.display = "none";
    //     } else if (id == 'group3') {
    //         financialAffordibilityBox.style.display = "none";
    //         clientReferralBox.style.display = "block";

    //     }
    // }
</script>

<script>
    $(document).ready(function() {
        var postURL = "<?php echo url('addmore'); ?>";
        var i = 1;
        $('#add').click(function() {
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added"><td><input type="text"  name="Symptoms[]" placeholder="Symptoms" class="form-control name_list" /></td><td><input type="text"  name="Severity[]" placeholder="Severity ( Rate in 0-100)" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
    });
</script>

<script>
    $(document).ready(function() {
        ShowOccupationBox();
        ShowSessionBox();
        ShowAppearanceBox();
        ShowBehaviorBox();
        ShowCurrentDiagnosis();
        ShowSpeechBox();
        ShowaffectBox();
        ShowThoughtBox();
        ShowPerceptionBox();
        ShowCognitionBox();
        ShowJudgementBox();
        ShowReferralBox()
        // ShowServiceBox();
        //ShowMainReasonBox();
        ShowSecondaryReasonBox();
        //showPresentCotinuation();
        ShowMentalIllnessBox();
        // ShowClientReferralBox();
        //showFinancialAffordability();
        showMessageBox();
    });

    function ShowReferralBox() {
        var radio = document.getElementById("CliKReferral");
        var Box = document.getElementById("ReferralBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function ShowJudgementBox() {
        var radio = document.getElementById("chkJudgement");
        var Box = document.getElementById("JudgementBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function ShowCognitionBox() {
        var radio = document.getElementById("chkCognition");
        var Box = document.getElementById("CognitionBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function ShowPerceptionBox() {
        var radio = document.getElementById("chkPerception");
        var Box = document.getElementById("PerceptionBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function ShowThoughtBox() {
        var radio = document.getElementById("chkThought");
        var Box = document.getElementById("ThoughtBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function ShowaffectBox() {
        var radio = document.getElementById("chkaffect");
        var Box = document.getElementById("affectBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function ShowSpeechBox() {
        var radio = document.getElementById("chkSpeech");
        var Box = document.getElementById("SpeechBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function ShowBehaviorBox() {
        var radio = document.getElementById("chkBehavior");
        var Box = document.getElementById("BehaviorBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function ShowAppearanceBox() {
        var radio = document.getElementById("chkAppearance");
        var Box = document.getElementById("AppearanceBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function ShowOccupationBox() {
        var radio = document.getElementById("chkOccupation");
        var Box = document.getElementById("OccupationBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function ShowSessionBox() {
        var radio = document.getElementById("chkSession");
        var Box = document.getElementById("SessionBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    function ShowCurrentDiagnosis() {
        var radio = document.getElementById("chkCurrentDiagnosis");
        var Box = document.getElementById("CurrentDiagnosisBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

    // function ShowHearingSourceBox() {
    //     var radio = document.getElementById("chkHearingSource");
    //     var Box = document.getElementById("HearingSourceBox");
    //     Box.style.display = radio.checked ? "block" : "none";
    //     var other = Box.getElementsByTagName('input')[0];
    //     radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    // }

    // function ShowServiceBox() {
    //     var radio = document.getElementById("chkService");
    //     var Box = document.getElementById("ServiceBox");
    //     Box.style.display = radio.checked ? "block" : "none";
    //     var other = Box.getElementsByTagName('input')[0];
    //     radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    // }

    // function ShowMainReasonBox() {
    //     var radio = document.getElementById("chkMainReason");
    //     var Box = document.getElementById("MainReasonBox");
    //     Box.style.display = radio.checked ? "block" : "none";
    //     var other = Box.getElementsByTagName('input')[0];
    //     radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    // }

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
    // function showPresentCotinuation(){
    //     var radio = document.getElementById("Present_Continuation");
    //     var Box = document.getElementById("Present_Continuation1");
    //     Box.style.display = radio.checked ? "block" : "none";
    //     var other = Box.getElementsByTagName('input')[0];
    //     radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    // }

    // function ShowClientReferralBox() {
    //     var chkClientReferral = document.getElementById("chkClientReferral");
    //     var ClientReferralBox = document.getElementById("ClientReferralBox");
    //     ClientReferralBox.style.display = chkClientReferral.checked ? "block" : "none";
    // }

    // function showFinancialAffordability() {
    //     var chkTier = document.getElementById("chkTier");
    //     var financialAffordibilityBox = document.getElementById("financialAffordibilityBox");
    //     financialAffordibilityBox.style.display = chkTier.checked ? "block" : "none";
    // }

    function showMessageBox() {
        var messageButton = document.getElementById("messageButton");
        var messageBox = document.getElementById("messageBox");
        messageBox.style.display = messageButton.click ? "block" : "none";
    }

    (function() {
        // 'use strict';

        var init = function() {

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

    $(document).on('dblclick', '.Appearance', function() {
        if (this.checked) {
            $(this).prop('checked', false);
            $('.AppearanceInput').hide();
        }
    });
    $(document).on('dblclick', '.Behavior', function() {
        if (this.checked) {
            $(this).prop('checked', false);
            $('.BehaviorInput').hide();
        }
    });
    $(document).on('dblclick', '.Speech', function() {
        if (this.checked) {
            $(this).prop('checked', false);
            $('.SpeechInput').hide();
        }
    });
    $(document).on('dblclick', '.affect', function() {
        if (this.checked) {
            $(this).prop('checked', false);
            $('.affectInput').hide();
        }
    });
    $(document).on('dblclick', '.Thought', function() {
        if (this.checked) {
            $(this).prop('checked', false);
            $('.ThoughtInput').hide();
        }
    });
    $(document).on('dblclick', '.Perception', function() {
        if (this.checked) {
            $(this).prop('checked', false);
            $('.PerceptionInput').hide();
        }
    });
    $(document).on('dblclick', '.Cognition', function() {
        if (this.checked) {
            $(this).prop('checked', false);
            $('.CognitionInput').hide();
        }
    });
    $(document).on('dblclick', '.Judgement', function() {
        if (this.checked) {
            $(this).prop('checked', false);
            $('.JudgementInput').hide();
        }
    });
</script>