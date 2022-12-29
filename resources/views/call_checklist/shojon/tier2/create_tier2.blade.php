@extends('call_checklist.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')

<<<<<<< HEAD
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"/>
=======

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

>>>>>>> 8816165d36b1195532b8fb1c1b1cc3ed2235617d
<div class="app-title">
    <div>
        <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
    </div>
</div>



<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="tile">
            <h3 class="tile-title">Create Checklist for Shojon</h3>
            <form id="myForm" action="{{ route('call_checklist.shojontier2.store') }}" method="POST" role="form"
<<<<<<< HEAD
=======

>>>>>>> 8816165d36b1195532b8fb1c1b1cc3ed2235617d
            enctype="multipart/form-data" autocomplete="off">
            @csrf

            <div class="tile-body">

                <!-- Auto generated field -->
                <input type="hidden" name="project_name" value="#">
                <input type="hidden" name="service_providers_name" value="#">
                <input type="hidden" name="service_providers_id" value="#">
                <input type="hidden" name="call_started" value="#">
                <input type="hidden" name="call_end" value="#">
                <input type="hidden" name="duration" value="#">

                <div class="form-group">
                    <label class="control-label" for="phone_number"><b>Phone Number:</b></label><br>
                    <input class="form-control" type="text" name="phone_number" id="phone_number"
                    value="1">
                </div>

                <div class="form-group">
                    <label class="control-label" for="caller_id"><b>Caller ID:</b></label>
                    <input class="form-control" type="text" name="caller_id" id="caller_id"
                    value="{{ old('caller_id',$last? $last->caller_id : null) }}"
                    placeholder="Enter caller name"/>
                </div>

                <div class="form-group">
                    <label class="control-label" for="caller_name"><b>Caller Name:</b></label>
                    <input class="form-control" type="text" name="caller_name" id="caller_name"
                    value="{{ old('caller_name',$last? $last->caller_name : null) }}"
                    placeholder="Enter caller name"/>
                </div>

                <input type="hidden" name="referrence_id" value="1">


                <div class="form-group">
                    <label class="control-label" for="sex"><b>Sex:</label>
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
                    <label class="control-label" for="age"><b>Age: </label><br>
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
                    <label class="control-label" for="occupation"><b>Occupation:</label>
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


                    <div>
                        <label class="control-label" for="district"><b>Location:</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select type="text" class="form-control" name="location" list="location_list">
                                            <option disabled selected="">Select districts</option>
                                            @foreach ($districts as $item)
                                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('district') {{ $message }} @enderror
                                </div>
                            </div>
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



                    <div class="form-group">
                        <label class="control-label" for="Educational_Qualification"><b> Educational Qualification: (mandatory single select):</b></label>
                        @php $types = ['Pre-primary(Jr/Sr KG or equivalent)', 'Primary (1st-5th)', 'Secondary (5th-SSC)', 'Higher Secondary ( 11th- HSC)', 'Graduate (degree and Hons)', 'Post-Graduate and above','Never been to school','Don’t know','Other']; @endphp
                        <select name="Educational_Qualification" list="Educational_Qualification"
                        id="Educational_Qualification" class="form-control">

                        <datalist id="Educational_Qualification">
                            <option value="" selected disabled>Select Educational Qualification</option>
                            @foreach($types as $item)
                            @if( old('Educational_Qualification') == $item))
                            <option value="{{ $item }}">{{ $item }}</option>
                            @else
                            <option value="{{ $item }}">{{ $item }}</option>
                            @endif
                            @endforeach
                        </datalist>
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label" for="Marital_Status"><b> Marital Status: (single select)</b></label>
                    @php $types = ['Single', 'Married', 'Divorced', 'Separated', 'Don’t know', 'Don’t want to share']; @endphp
                    <select name="Marital_Status" list="Marital_Status"
                    id="Marital_Status" class="form-control">

                    <datalist id="Marital_Status">
                        <option value="" selected disabled>Select Marital Status</option>
                        @foreach($types as $item)
                        @if( old('Marital_Status') == $item))
                        <option value="{{ $item }}">{{ $item }}</option>
                        @else
                        <option value="{{ $item }}">{{ $item }}</option>
                        @endif
                        @endforeach
                    </datalist>
                </select>
            </div>

            <div class="form-group">
                <label class="control-label" for="Session_Number"><b>Session Number (mandatory single select )</b></label>
                @php $types = ['1st session', '2nd session', '3rd session', '4th session', '6th session', '7th session','8th session','8th session','9th session','10th session','Last session']; @endphp
                <div class="form-control @error('Session_Number') is-invalid @enderror">
                    <label>
                        @foreach($types as $item)
                        @if((old('Session_Number') == $item))
                        <input type="radio" name="Session_Number" value="{{ $item }}" checked="checked"
                        onclick="ShowSessionBox()"/>
                        @else
                        <input type="radio" name="Session_Number" value="{{ $item }}"
                        onclick="ShowSessionBox()"/>
                        @endif
                        {{ $item }}
                        <br>
                        @endforeach
                        <input type="radio" id="chkSession" name="Session_Number"
                        onclick="ShowSessionBox()"/>
                        Other (please explain)
                    </label>
                    <span id="SessionBox" style="display: none;">
                        <input class="form-control" type="text" name="other_Session_Number"
                        value="{{ old('other_occupation',$last ? $last->other_occupation : null) }}"
                        placeholder="Explain"/>
                    </span>
                </div>
                @error('Session_Number') {{ $message }} @enderror
            </div>

            <div class="form-group">
                <label class="control-label" for="distress_rating"><b>Distress Rating (pre-stage):</b> <br>[0 means
                lowest wellbeing, 10 means Highest wellbeing] </label>
                {{-- <div class="col-md-auto"> --}}
                    {{-- <input class="form-control @error('distress_rating') is-invalid @enderror" type="text"
                    name="distress_rating" id="sliderPre" class="slider"/> --}}
                    {{-- <input class="form-control @error('distress_rating') is-invalid @enderror" type="number" name="distress_rating" min="1" max="10" value="0"> --}}

                    <select name="distress_rating"
                    class="form-control @error('distress_rating') is-invalid @enderror">
                    <option value="">Select a Value</option>
                    @for ($i = 0; $i < 11; $i++)
                    @if( old('distress_rating') && (old('distress_rating') == $i))
                    <option value={{ $i }} selected> {{ $i }} </option>
                    @else
                    <option value={{ $i }}>{{ $i }}</option>
                    @endif
                    @endfor
                </select>
            {{-- </div> --}}
            @error('distress_rating') {{ $message }} @enderror
        </div>

        <div class="form-group">
            <div class="" id="notiDiv">

            </div>
            <label class="control-label" for="ghq"><b>GHQ (appendix - questionnaire and
            scoring):</b></label>
            <a href="#" class="btn btn-info btn-sm edit" data-id="#" data-toggle="modal" data-target="#editModal" >Qiestionniare</a>
            @include('call_checklist.shojon.tier2.questrion_from')
            <input type="text" id="ghq" name="ghq" value="{{old('ghq','Incomplete')}}"
            style="text-align:center;" readonly>
        </div>

        <div class="form-group">
            <label class="control-label">Presenting Problems list and problem rating: </label><br>
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
    <label class="control-label" for="Problem_duration"><b>Problem duration: (mandatory single select)</b></label>
    @php $types = ['<1 month', '1 to 3 months', '4 to 6 months ', '6 to 12 month ', '12 to 24 months ', '<24 month','More than 5 years','More than 10 years ','Don’t know','Other']; @endphp
    <select name="Problem_duration" list="Problem_duration"
    id="Problem_duration" class="form-control">

    <datalist id="Problem_duration">
        <option value="" selected disabled>Select Problem duration</option>
        @foreach($types as $item)
        @if( old('Problem_duration') == $item))
        <option value="{{ $item }}">{{ $item }}</option>
        @else
        <option value="{{ $item }}">{{ $item }}</option>
        @endif
        @endforeach
    </datalist>
</select>
</div>

<div class="form-group">
  <label class="control-label" for="Problem_duration"><b>    Illness/ problem history (short): (text filled)</b></label>  
  <textarea class="form-control" name="problem_history">

  </textarea>
</div>
<div class="form-group">
  <label class="control-label" for="Problem_duration"><b>Family History (short): (text filled)</b></label>  
  <textarea class="form-control" name="Family_History">

  </textarea>
</div>

<div class="form-group">
    <label class="control-label" for="suicidal_risk"><b>Does the client have suicidal Ideation? (Single select) </b></label>
    @php $types = ['Yes', 'No', 'Don’t know']; @endphp
    <select name="suicidal_risk" id="suicidal_risk" list="suicidal_risk_list"
    class="form-control @error('suicidal_risk') is-invalid @enderror">
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
    <label class="control-label" for="self_harm_history"><b>Does the client have any self-harm history? (Single select)</b></label>
    @php $types = ['Yes', 'No', 'Don’t Know/Don’t want shere']; @endphp
    <select name="self_harm_history" id="self_harm_history" list="suicidal_risk_list"
    class="form-control @error('self_harm_history') is-invalid @enderror">
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
    <label class="control-label" for="mental_illness_diagnosis"><b>Previous psychiatric diagnosis? (Multiple select)  
        @php $types = ['Major Depressive Disorder', 'Anxiety Disorder', 'Panic Disorder','Obsessive Compulsive Disorder','Social Anxiety Disorder','Eating Disorder','Insomnia','Schizophrenia','Bipolar Disorder ','Personality Disorder','Autism spectrum disorder','Attention deficit hyperactivity disorder','Learning disorder (LD)','Phobia','Post-traumatic stress disorder (PTSD)','Substance Abuse Disorder','Sexual disorder','Gender Identity disorder','Conversion disorder','Conduct','No']; @endphp        
        <div class="form-control @error('mental_illness_diagnosis') is-invalid @enderror">
            <label>

                <label>
                    @foreach($types as $item)
                    <input type="checkbox" name="mental_illness_diagnosis[]" value="{{$item}}"> {{$item}}<br>
                    @endforeach
                    <input type="checkbox" id="chkMentalIllness" name="mental_illness_diagnosis"
                    onclick="ShowMentalIllnessBox()"/>
                    Other (please explain)<br>
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
            <label class="control-label" for="PresentCotinuation"><b>Present Continuation of Psychiatric Medication: (mandatory single select) 
            </label><br>
            @php $types = ['Yes','No']; @endphp
            <div class="form-control @error('hearing_source') is-invalid @enderror">
                <label>
                    @foreach($types as $item)
                    @if( old('hearing_source') == $item)
                    <input type="radio" name="PresentCotinuation" value="{{ $item }}"
                    onclick="showPresentCotinuation()" checked="checked"/>
                    @else
                    <input type="radio" name="PresentCotinuation" value="{{ $item }}"
                    onclick="showPresentCotinuation()"/>
                    @endif
                    {{ $item }}
                    <br>
                    @endforeach
                    <input type="radio" id="Present_Continuation" name="PresentCotinuation"
                    onclick="showPresentCotinuation()"/>
                    Others (please explain)
                </label>
                <span id="Present_Continuation1" style="display: none;">
                    <input class="form-control" type="text" name="other_PresentCotinuation"
                    value="{{ old('other_hearing_source',$last ? $last->other_hearing_source : null) }}"
                    placeholder="Explain"/>
                </span>
            </div>
            @error('Present_Continuation') {{ $message }} @enderror
        </div>
        <div class="form-group">
            <label class="control-label">Mantion the name of medicine if any :</label>
            <textarea class="form-control" name="name_of_medicine"></textarea>
        </div>

        <div class="form-group">
            <label class="control-label" for="Physical_Concern_history"><b>Physical Concern history: (multiple select)</label>
                @php
                 $types = ['Diabetes','Hypertension','Chronic pain','Asthma','Hormonal issues','Life threatening disease','Obesity'];
                @endphp
                <div class="form-control @error('Physical_Concern_history') is-invalid @enderror">
                    <label>
                        @foreach($types as $item)
                        <input type="checkbox" name="Physical_Concern_history[]" value="{{$item}}"> {{$item}}<br>
                        @endforeach
                        <input type="checkbox" id="chkSecondaryReason" name="Physical_Concern_history"
                        onclick="ShowSecondaryReasonBox()"/>
                        Others (please explain)<br> 
                    </label>
                    <span id="SecondaryReasonBox" style="display: none;">
                        <input class="form-control" type="text" name="other_Physical_Concern_history[]"
                        placeholder="Explain"/>
                        <!-- MUST BE A PROBLEM FOR ARRAY TO SHOW OLD VALUE-->
                    </span>
                </div>
                @error('Physical_Concern_history') {{ $message }} @enderror
            </div>

            <div class="form-group">
                <label class="control-label" for="current_differential_diagnosis"><b>Current Differential Diagnosis: (Mandatory multiple select) 
                      @php $types = ['Major Depressive Disorder', 'Anxiety Disorder', 'Panic Disorder','Obsessive Compulsive Disorder','Social Anxiety Disorder','Eating Disorder','Insomnia/sleep related disorder','Schizophrenia','Bipolar Disorder','Personality Disorder','Autism spectrum disorder','Attention deficit hyperactivity disorder','Learning disorder (LD)','Dementia','Alzheimer','Phobia','Post-traumatic stress disorder (PTSD)','Substance Abuse Disorder','Sexual disorder','Gender Identity disorder','Conversion disorder','Conduct','No']; @endphp     
                    <div class="form-control @error('current_differential_diagnosis') is-invalid @enderror">
                        <label>

                            <label>
                                @foreach($types as $item)
                                <input type="checkbox" name="current_differential_diagnosis[]" value="{{ $item }}"> {{ $item }}<br>
                                @endforeach
                                <input type="checkbox" id="chkCurrentDiagnosis" name="current_differential_diagnosis"
                                onclick="ShowCurrentDiagnosis()"/>
                                Other (please explain)<br>
                            </label>
                            <span id="CurrentDiagnosisBox" style="display: none;">
                                <input class="form-control" type="text" name="other_current_differential_diagnosis[]"
                                placeholder="Explain"/>
                                <!-- MUST BE A PROBLEM FOR ARRAY TO SHOW OLD VALUE-->
                            </span>
                        </div>
                        @error('current_differential_diagnosis') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="PsychometricToolscore"><b>Psychometric Tool score & Interpretation:
                        </label><br>
                        @php $types = ['Depression scale','Anxiety','Social Interaction Anxiety scale ','Obsessive- compulsive disorder ','Beck hopelessness scale','Cognitive distortion scale','Depression, Anxiety, stress scale','Somatic complaint scale','Event'];@endphp       
                        <div class="form-control @error('PsychometricToolscore') is-invalid @enderror">
                            <label class="control-label">Tool Name:</label><br>
                            <label class="control-label"style="width: 90%;">
                                <div class="form-control @error('PsychometricTool') is-invalid @enderror">
                                    <label>
                                        @foreach($types as $item)
                                        @if( old('hearing_source') == $item)
                                        <input type="radio" name="PsychometricTool" value="{{ $item }}"
                                        onclick="showPresentCotinuation()" checked="checked"/>
                                        @else
                                        <input type="radio" name="PsychometricTool" value="{{ $item }}"
                                        onclick="showPresentCotinuation()"/>
                                        @endif
                                        {{ $item }}
                                        <br>
                                        @endforeach

                                    </label>

                                </div>
                            </label><br>
                            <label class="control-label">Score:</label><br>
                            <label class="control-label" style="width: 90%;">
                                <input type="text" name="Psychometricscore" class="form-control">
                                
                            </label>
                        </div>
                        @error('PsychometricToolscore') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="Problem_duration"><b> Client’s Expectation from therapy:</b></label>  
                      <textarea class="form-control" name="therapy">

                      </textarea>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Formulation:</label><br>
                    <table class="table table-bordered border-primary" id="dynamic_field_formulation">
                        <thead>
                            <tr>
                              <th scope="col">Predisposing Factor</th>
                              <th scope="col">Precipitatory factor </th>
                              <th scope="col">Perpetuating (maintaining) factor</th>
                              <th scope="col">ProtectiveFactor</th>
                              <th scope="col">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr>
                           <td><input type="text" name="Predisposing[]" placeholder="Predisposing Factor" class="form-control name_list" /></td>  
                           <td><input type="text" name="Precipitatory[]" placeholder="Precipitatory factor" class="form-control name_list" /></td> 
                           <td><input type="text" name="Perpetuating[]" placeholder="Perpetuating factor" class="form-control name_list" /></td> 
                           <td><input type="text" name="Protective[]" placeholder="ProtectiveFactor" class="form-control name_list" /></td> 
                           <td><button type="button" name="addmore" id="addmore_formulation" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></td>
                       </tr>
                   </tbody> 
               </table>  
           </div>

           <div class="form-group">
            <label class="control-label" for="TreatmentGoal"><b>Treatment Goal 
            </label><br>
            <div class="form-control @error('TreatmentGoal') is-invalid @enderror">
                <label class="control-label">Short term Goal:</label><br>
                <label class="control-label"style="width: 90%;">
                    <input type="text" name="ShorttermGoal" class="form-control">

                </label><br>
                <label class="control-label">Long term goal:</label><br>
                <label class="control-label" style="width: 90%;">
                    <input type="text" name="Longtermgoal" class="form-control">

                </label>
            </div>
            @error('TreatmentGoal') {{ $message }} @enderror
        </div>

        <div class="form-group">
          <label class="control-label" for="Problem_duration"><b> Intervention:</b></label>  
          <textarea class="form-control" name="Intervention">

          </textarea>
      </div>

      <div class="form-group">
          <label class="control-label" for="Problem_duration"><b>Homework:</b></label>  
          <textarea class="form-control" name="Homework">

          </textarea>
      </div>

      <div class="form-group">
        <label class="control-label" for="useful_effective"><b>How useful and effective do you think the call has been for you? 
        </label><br>
        @php $types = ['Very useful and effective','Useful, but not so effective', 'Quite useful and effective', 'Neither useful, nor effective', 'No comment/Cannot decide']; @endphp
        <div class="form-control @error('useful_effective') is-invalid @enderror">
            <label>
                @foreach($types as $item)
                @if( old('useful_effective') == $item)
                <input type="radio" name="useful_effective" value="{{ $item }}"
                />
                @else
                <input type="radio" name="useful_effective" value="{{ $item }}"
                />
                @endif
                {{ $item }}
                <br>
                @endforeach 
            </label>
        </div>
        @error('useful_effective') {{ $message }} @enderror
    </div>

    <div class="form-group" style="display: none">
        <label class="control-label" for="yes_no_radio"><b>Consent for Recording: </label>
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
            <label class="control-label" for="client_referral">Referral</label>
            <div class="form-control">
                <label class="control-label">Internal Referral:( single select )</label><br>
                <label class="control-label">
                 <a href="#" class="btn btn-primary btn-sm Referral_form " data-id="#" data-toggle="modal" data-target="#ReferralModal" >Referral Tier 3</a>

             </label>
             @include('call_checklist.shojon.tier2._referral')
         </label>
     </div>
     <div class="form-control">
        <label class="control-label" for="client_referral"><b>External referral:  </label>
            <div class="form-control @error('TreatmentGoal') is-invalid @enderror">
                <label class="control-label">Reason for referral:</label><br>
                <label class="control-label"style="width: 90%;">
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
                    <input type="radio" name="client_referral" value="{{ $item }}"/>
                    {{ $item }}
                    <br>
                    @endforeach
                    <input type="radio" id="CliKReferral" name="client_referral" value="other" onclick="ShowReferralBox()" />
                    Other (please explain)
                </label>
                <span id="ReferralBox" style="display: none;">
                    <input class="form-control" type="text" name="other_client_referral"
                    value="{{ old('client_referral') }}" placeholder="Explain"/>
                </span>
            </div>
            @error('client_referral') {{ $message }} @enderror   
        </div>
    </div>
<<<<<<< HEAD
=======

                                <th scope="col">Predisposing Factor</th>
                                <th scope="col">Precipitatory factor </th>
                                <th scope="col">Perpetuating (maintaining) factor</th>
                                <th scope="col">ProtectiveFactor</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name="Predisposing[]" placeholder="Predisposing Factor"
                                        class="form-control name_list" /></td>
                                <td><input type="text" name="Precipitatory[]" placeholder="Precipitatory factor"
                                        class="form-control name_list" /></td>
                                <td><input type="text" name="Perpetuating[]" placeholder="Perpetuating factor"
                                        class="form-control name_list" /></td>
                                <td><input type="text" name="Protective[]" placeholder="ProtectiveFactor"
                                        class="form-control name_list" /></td>
                                <td><button type="button" name="addmore" id="addmore_formulation"
                                        class="btn btn-success"><i class="fa-solid fa-plus"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <label class="control-label" for="TreatmentGoal"><b>Treatment Goal
                    </label><br>
                    <div class="form-control @error('TreatmentGoal') is-invalid @enderror">
                        <label class="control-label">Short term Goal:</label><br>
                        <label class="control-label" style="width: 90%;">
                            <input type="text" name="ShorttermGoal" class="form-control">

                        </label><br>
                        <label class="control-label">Long term goal:</label><br>
                        <label class="control-label" style="width: 90%;">
                            <input type="text" name="Longtermgoal" class="form-control">

                        </label>
                    </div>
                    @error('TreatmentGoal') {{ $message }} @enderror
                </div>

                <div class="form-group">
                    <label class="control-label" for="Problem_duration"><b> Intervention:</b></label>
                    <textarea class="form-control" name="Intervention">

                            </textarea>
                </div>

                <div class="form-group">
                    <label class="control-label" for="Problem_duration"><b>Homework:</b></label>
                    <textarea class="form-control" name="Homework">

                            </textarea>
                </div>

                <div class="form-group">
                    <label class="control-label" for="useful_effective"><b>How useful and effective do you think the
                            call has been for you?
                    </label><br>
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
                    <label class="control-label" for="yes_no_radio"><b>Consent for Recording: </label>
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
                    <label class="control-label" for="client_referral">Referral</label>
                    <div class="form-control">
                        <label class="control-label">Internal Referral:( single select )</label><br>
                        <label class="control-label">
                            <a href="#" class="btn btn-primary btn-sm Referral_form " data-id="#" data-toggle="modal"
                                data-target="#ReferralModal">Referral Tier 3</a>

                        </label>
                        @include('call_checklist.shojon.tier2._referral')
                        </label>
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
                                <input type="radio" id="CliKReferral" name="client_referral" value="other"
                                    onclick="ShowReferralBox()" />
                                Other (please explain)
                            </label>
                            <span id="ReferralBox" style="display: none;">
                                <input class="form-control" type="text" name="other_client_referral"
                                    value="{{ old('client_referral') }}" placeholder="Explain" />
                            </span>
                        </div>
                        @error('client_referral') {{ $message }} @enderror
                    </div>
                </div>

>>>>>>> 8816165d36b1195532b8fb1c1b1cc3ed2235617d

                <!-- {{-- <label class="control-label" for="financial_affordability"><b>If referred to 2/3 Tier of SHOJON – Financial affordability:</label>
                        @php $types = ['Free', '50 - 100', '100 - 200', '200 - 300', '300-500', '500 – 800', '800 – 1000', 'Not referred to SHOJON tier 2/3']; @endphp
                        <select name="financial_affordability" id="financial_affordability" class="form-control @error('financial_affordability') is-invalid @enderror">
                            <option disabled selected>Select Financial affordability</option>
                            @foreach($types as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('financial_affordability') {{ $message }} @enderror --}} -->
<<<<<<< HEAD
=======

>>>>>>> 8816165d36b1195532b8fb1c1b1cc3ed2235617d
                        <div class="form-group">
                            <label class="control-label" for="next_session_plan"><b>Next session plan</label>
                                <textarea rows="2" cols="50"
                                class="form-control
                                @error('next_session_plan') is-invalid @enderror"
                                name="next_session_plan"
                                id="next_session_plan"
                                value="{{ old('next_session_plan') }}">{{ old('next_session_plan')}}
                            </textarea>

                            @error('next_session_plan') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="session_summary"><b>Session summary : </label>
                                <textarea rows="2" cols="50"
                                class="form-control
                                @error('session_summary') is-invalid @enderror"
                                name="session_summary"
                                id="session_summary"
                                value="{{ old('session_summary') }}">{{ old('session_summary')}}
                            </textarea>

                            @error('session_summary') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="TreatmentGoal"><b>Session Outcomes
                            </label><br>
                            <div class="form-control @error('TreatmentGoal') is-invalid @enderror">
                                <label class="control-label">Schedule next session</label><br>
                                <label class="control-label"style="width: 90%;">
                                    <input type="date" name="next_session" class="form-control">

                                </label><br>
                                <label class="control-label"> 
                                    <a href="#" class="btn btn-primary btn-sm Termination_form " data-id="#" data-toggle="modal" data-target="#TerminationModal" >Termination</a>
                                </label>
                                @include('call_checklist.shojon.tier2.Termination_form')    
                            </label>
                        </div>
                        @error('TreatmentGoal') {{ $message }} @enderror
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
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Shojon
                </button>
                &nbsp;&nbsp;&nbsp;
                <a class="btn btn-secondary" onclick="cancel()"><i
                    class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
<<<<<<< HEAD
=======

                <div class="form-group">
                    <label class="control-label" for="next_session_plan"><b>Next session plan</label>
                    <textarea rows="2" cols="50" class="form-control
                                @error('next_session_plan') is-invalid @enderror" name="next_session_plan"
                        id="next_session_plan" value="{{ old('next_session_plan') }}">{{ old('next_session_plan')}}
                        </textarea>

                    @error('next_session_plan') {{ $message }} @enderror
                </div>
                <div class="form-group">
                    <label class="control-label" for="session_summary"><b>Session summary : </label>
                    <textarea rows="2" cols="50" class="form-control
                                @error('session_summary') is-invalid @enderror" name="session_summary"
                        id="session_summary" value="{{ old('session_summary') }}">{{ old('session_summary')}}
                        </textarea>

                    @error('session_summary') {{ $message }} @enderror
                </div>

                <div class="form-group">
                    <label class="control-label" for="TreatmentGoal"><b>Session Outcomes
                    </label><br>
                    <div class="form-control @error('TreatmentGoal') is-invalid @enderror">
                        <label class="control-label">Schedule next session</label><br>
                        <label class="control-label" style="width: 90%;">
                            <input type="date" name="next_session" class="form-control">

                        </label><br>
                        <label class="control-label">
                            <a href="#" class="btn btn-primary btn-sm Termination_form " data-id="#" data-toggle="modal"
                                data-target="#TerminationModal">Termination</a>
                        </label>
                        @include('call_checklist.shojon.tier2.Termination_form')
                        </label>
                    </div>
                    @error('TreatmentGoal') {{ $message }} @enderror
                </div>

                <span class="btn btn-success" id="messageButton" style="margin: 5px"
                    onclick="showMessageBox()">Message</span>
                <div class="form-group" id="messageBox" style="display: none">
                    <select name="sms_switch" type="text" class="form-control" id="sms_type" list="sms_types"
                        onchange="change_sms()">
                        <datalist id="sms_types">
                            <option value="" selected>Please Select Type</option>
                            <option value="tier2" <?php if (old('sms_switch')=='tier2' ) echo "selected" ?> >Tier
                                2
                            </option>
                            <option value="tier3" <?php if (old('sms_switch')=='tier3' ) echo "selected" ?> >Tier
                                3
                            </option>
                            <option value="health_hotline" <?php if (old('sms_switch')=='health_hotline' )
                                echo "selected" ?> >
                                Health Hotline
                            </option>
                            <option value="kpr" <?php if (old('sms_switch')=='kpr' ) echo "selected" ?> >KPR
                            </option>
                            <option value="inner_circle" <?php if (old('sms_switch')=='inner_circle' ) echo "selected"
                                ?> >
                                Inner Circle
                            </option>
                        </datalist>

                        <label class="control-label" for="message"><b>Message: </b></label>
                        <textarea rows="3" cols="50" class="form-control
                                @error('message') is-invalid @enderror" name="message" id="message"
                            value="{{ old('message') }}" placeholder="Write your message"></textarea>
                        @error('message') {{ $message }} @enderror
                </div>

                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                        Shojon
                    </button>
                    &nbsp;&nbsp;&nbsp;
                    <a class="btn btn-secondary" onclick="cancel()"><i
                            class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>

>>>>>>> 8816165d36b1195532b8fb1c1b1cc3ed2235617d
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
        $('#myForm input').on('change', function () {
        });
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
    $(document).ready(function(){      
     var postURL = "<?php echo url('addmore'); ?>";
     var i=1;  
     $('#add').click(function(){  
        i++;  
        $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text"  name="Symptoms[]" placeholder="Symptoms" class="form-control name_list" /></td><td><input type="text"  name="Severity[]" placeholder="Severity ( Rate in 0-100)" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
    });  
     $(document).on('click', '.btn_remove', function(){  
        var button_id = $(this).attr("id");   
        $('#row'+button_id+'').remove();  
    });  
 }); 
</script>

<script>
    $(document).ready(function(){      
     var postURL = "<?php echo url('multipulField_formulation'); ?>";
     var i=1;  
     $('#addmore_formulation').click(function(){  
        i++;  
        $('#dynamic_field_formulation').append('<tr id="row_formulation'+i+'" class="dynamic-added"><td><input type="text"  name="Predisposing[]" placeholder="Predisposing Factor" class="form-control name_list" /></td><td><input type="text"  name="Precipitatory[]" placeholder="Precipitatory factor" class="form-control name_list" /></td><td><input type="text"  name="Perpetuating[]" placeholder="Perpetuating  factor" class="form-control name_list" /></td><td><input type="text"  name="Protective[]" placeholder="Protective Factor" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_formulation">X</button></td></tr>');  
    });  
     $(document).on('click', '.btn_remove_formulation', function(){  
        var button_id_formulation = $(this).attr("id");   
        $('#row_formulation'+button_id_formulation+'').remove();  
    });  
 }); 
</script>
<script>
    $(document).ready(function () {
        ShowOccupationBox();
        ShowSessionBox();
        ShowCurrentDiagnosis();
        ShowReferralBox();
       // ShowServiceBox();
        //ShowMainReasonBox();
        ShowSecondaryReasonBox();
        showPresentCotinuation();
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
    function showPresentCotinuation(){
        var radio = document.getElementById("Present_Continuation");
        var Box = document.getElementById("Present_Continuation1");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
    }

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