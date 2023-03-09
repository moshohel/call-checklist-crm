@extends('call_checklist.app')
@section('title') {{ $data->caller_name }} @endsection
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"/>
<div class="app-title">
  <div>
    <h1><i class="fa fa-tags"></i> {{ $pageTitleUpdate }}</h1>
  </div>
</div>
<div class="row">
  <!-- left column -->
  <div class="col-md-12 mx-auto">
    <div class="tile">
      <form id="myForm" action="{{ route('call_checklist.shojon.tierOne_update') }}" method="POST" role="form"
      enctype="multipart/form-data" autocomplete="off">
      @csrf
      <div class="tile-body">
        <!-- general form elements -->
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="row g-4">
          <div class="col-md-3">
            <label for="validationCustom01" class="form-label">Phone Number</label>
            <input type="number" class="form-control" readonly max="15" min="7" name="phone_number" placeholder="Enter Phone Number" value="{{ $data->phone_number }}" >
          </div>
          <div class="col-md-3">
            <label for="validationCustom01" class="form-label">Client Name</label>
            @isset($data->caller_name)
            <input type="text" class="form-control" name="client_name" value="{{ $data->caller_name }}" >
            @endisset
          </div>
          <div class="col-md-3">
            <div class="form-group">
              @php $types = ['Male','Female','LGBTQ','Others']; @endphp 
              <label for="validationCustom01" class="form-label">Sex</label>
              <select class="form-control" name="sex">
                <option disabled selected>Select Sex</option>
                @foreach($types as $item)
                @if($data->sex == $item)
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
              @php $types = ['0-12','13-19','20-30','30-40','40-65','65+','Don’t know.','Don’t want to share']; @endphp 
              <label for="validationCustom01" class="form-label">Age</label>
              <select class="form-control" name="age">
                <option disabled selected>Select age</option>
                @foreach($types as $item)
                @if($data->age == $item)
                <option selected value="{{$item}}">{{$item}}</option>
                @else
                <option value="{{$item}}">{{$item}}</option>
                @endif
                @endforeach
              </select>
            </div>
          </div>
        </div><hr>

        <!-- second line -->

        <div class="row g-4">
          <div class="col-md-3">
            <div class="form-group">
              @php $types = ['Upper', 'Upper Middle Class', 'Middle Class', 'Lower Middle Class', 'Upper Lower Class', 'Lower Class']; @endphp 
              <label for="validationCustom01" class="form-label">Socio-economic Status (SES)</label>
              <select class="form-control" name="socio_economic">
                <option disabled selected>Select Socio-economic</option>
                @foreach($types as $item)
                @if($data->socio_economic == $item)
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
              <label for="validationCustom01" class="form-label">Location</label>
              <select class="form-control" name="location">
                <option disabled selected>Select Location</option>
                @foreach($districts as $item)
                @if($data->location == $item->name)
                <option selected value="{{$item->name}}">{{$item->name}}</option>
                @else
                <option value="{{$item->name}}">{{$item->name}}</option>
                @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              @php $types = ['Received Service','Information related call','Inappropriate','Silent call','Hang up']; @endphp 
              <label for="validationCustom01" class="form-label">Call Type</label>
              <select class="form-control" name="call_type">
                <option disabled selected>Select Call Type</option>
                @foreach($types as $item)
                @if($data->call_Type == $item)
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
              @php $types = ['First time','Regular Caller','Follow Up','Continuation of previous call','Don’t know']; @endphp 
              <label for="validationCustom01" class="form-label">Caller</label>
              <select class="form-control" name="caller">
                <option disabled selected>Select Caller</option>
                @foreach($types as $item)
                @if($data->caller == $item)
                <option selected value="{{$item}}">{{$item}}</option>
                @else
                <option value="{{$item}}">{{$item}}</option>
                @endif
                @endforeach
              </select>
            </div>
          </div>
        </div><hr>

        <!-- threed line -->

        <div class="row g-3">
          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom01" class="form-label">1.Occupation</label> 
              @php $types = ['Student', 'Job holder', 'Businessperson', 'Housewife', 'Unemployed','self employed', 'Retired', 'Could not tell']; @endphp
              <div class="form-control">
                  @foreach($types as $item)
                  @if($data->occupation == $item)
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
                <span id="OccupationBox" style="display: none;">
                  <input class="form-control" type="text" name="other_occupation" placeholder="Explain"/>
                </span>
              </div> 
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom01" class="form-label"><b>2.Where/how did the Client hear about SHOJON</b></label> 
              @php $types = ['Search engine','KPR', 'Social Media', 'Word of mouth', 'Referred by professional', 'SUDIN', 'SF Microfinance','Radio','TV','Print Media','Don’t know.']; @endphp
              <div class="form-control">
                  @foreach($types as $item)
                  @if($data->hear_about_shojon == $item)
                  <input type="radio" name="about_shojon" value="{{ $item }}" checked="checked"
                  onclick="Showabout_shojonBox()"/>
                  @else
                  <input type="radio" name="about_shojon" value="{{ $item }}"
                  onclick="Showabout_shojonBox()"/>
                  @endif
                  {{ $item }}
                  <br>
                  @endforeach
                  <input type="radio" id="chkabout_shojon" name="about_shojon"
                  onclick="Showabout_shojonBox()"/>
                  Other, comment (please explain)
                <span id="about_shojonBox" style="display: none;">
                  <input class="form-control" type="text" name="other_about_shojon" placeholder="Explain"/>
                </span>
              </div> 
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label" for="distress_rating"><b>3.Distress Rating (pre-stage)</b></label> 
              @php $types = ['0','1', '2', '3', '4', '5', '6', '7','8','9','10']; @endphp
              <div class="form-control">
                  <label><b style="color: black;">[0 means
                  lowest wellbeing, 10 means Highest wellbeing]</b></label><br>
                  @foreach($types as $item)
                  @if($data->distress == $item)
                  <input type="radio" name="Distress" value="{{ $item }}" checked="checked"/>
                  @else
                  <input type="radio" name="Distress" value="{{ $item }}"
                  />
                  @endif
                  {{ $item }}
                  <br>
                  @endforeach
              </div> 
            </div>
          </div>
        </div><hr>
        <!-- forth line -->

        <div class="row g-3">
          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom01" class="form-label"><b>4.Primary Reason for Calling (CHOOSE ONLY ONE)</b></label> 
              @php $types = ['COVID19 related Issues', 'Mental Illness', 'Substance Abuse', 'Family/Relationship Issues', 'Health/Physical Concerns', 'Financial Concerns', 'Immediate Emotional Crisis','Suicidal Feelings','Domestic Abuse','Child Abuse','Discrimination due to gender','Mental Health Related Symptoms','Discrimination due to minority status','Education','Bereavement','Work related stress','Disability','Anger','Parenting issue','Don’t know']; @endphp
              <div class="form-control">
                  @foreach($types as $item)
                  @if($data->primary_reason == $item)
                  <input type="radio" name="primary_reason" value="{{ $item }}" checked="checked"
                  onclick="Showprimary_reasonBox()"/>
                  @else
                  <input type="radio" name="primary_reason" value="{{ $item }}"
                  onclick="Showprimary_reasonBox()"/>
                  @endif
                  {{ $item }}
                  <br>
                  @endforeach
                  <input type="radio" id="chkprimary_reason" name="primary_reason"
                  onclick="Showprimary_reasonBox()"/>
                  Other, comment (please explain)
                <span id="primary_reasonBox" style="display: none;">
                  <input class="form-control" type="text" name="other_primary_reason" placeholder="Explain"/>
                </span>
              </div> 
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="validationCustom01" class="form-label"><b>5.Secondary reason (Multiple select)</b></label> 
              @php $types = ['COVID19 related Issues', 'Mental Illness', 'Substance Abuse', 'Family/Relationship Issues', 'Health/Physical Concerns', 'Financial Concerns', 'Immediate Emotional Crisis','Suicidal Feelings','Mental Health Related Symptoms','Domestic Abuse','Child Abuse','Discrimination due to gender','Discrimination due to minority status','Education','Bereavement','Work related stress','Disability','Anger','Parenting issue','Don’t know','Not applicable']; @endphp
              @php
              $check_item = json_decode($data->secondary_reason);
              @endphp
              <div class="form-control">
                  @if($check_item !="")
                  @foreach($types as $item)
                  <input type="checkbox" name="secondary_reason[]" value="{{ $item }}"
                  {{ in_array($item,$check_item)? 'checked':''}}/>
                  {{ $item }}
                  <br>
                  @endforeach
                  @else
                  @foreach($types as $item)
                  <input type="checkbox" name="secondary_reason[]" value="{{ $item }}"/>
                  {{ $item }}
                  <br>
                  @endforeach
                  @endif
                  <input type="checkbox" id="chksecondary_reason" name="secondary_reason[]"
                  onclick="Showsecondary_reasonBox()"/>
                  Other, comment (please explain)
                <span id="secondary_reasonBox" style="display: none;">
                  <input class="form-control" type="text" name="other_secondary_reason" placeholder="Explain"/>
                </span>
              </div> 
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label" for="distress_rating"><b>6.Does the client have any mental illness diagnosis</b></label> 
              @php $types = ['Major Depressive Disorder', 'Anxiety Disorder', 'Panic Disorder','Obsessive Compulsive Disorder','Social Anxiety Disorder','Insomnia','Schizophrenia','Bipolar Disorder ','Personality Disorder','Autism spectrum disorder','Attention deficit hyperactivity disorder','Learning disorder (LD)','Phobia','Post-traumatic stress disorder (PTSD)','Substance Abuse Disorder','Sexual disorder','Gender Identity disorder','Conversion disorder','Conduct disorder','No']; @endphp
              @php
              $check_item = json_decode($data->mental_illness_diagnosis);
              @endphp 
              <div class="form-control">
                  @if($check_item !="")
                  @foreach($types as $item)
                  <input type="checkbox" name="mental_illness_diagnosis[]" value="{{ $item }}"
                  {{ in_array($item,$check_item)? 'checked':''}}/>
                  {{ $item }}
                  <br>
                  @endforeach
                  @else
                  @foreach($types as $item)
                  <input type="checkbox" name="mental_illness_diagnosis[]" value="{{ $item }}"/>
                  {{ $item }}
                  <br>
                  @endforeach
                  @endif
                  <input type="checkbox" id="chkmental_illness" name="mental_illness_diagnosis[]"
                  onclick="Showmental_illnessBox()"/>
                  Other, comment (please explain)
                <span id="mental_illnessBox" style="display: none;">
                  <input class="form-control" type="text" name="other_mental_illness_diagnosis" placeholder="Explain"/>
                </span>
              </div>
            </div>
          </div>
        </div><hr>

        <!-- fifth line -->

        <div class="row g-3">
          <div class="col-md-4">
            <div class="form-group">
              <div class="" id="notiDiv">

              </div>
              <label class="control-label" for="ghq"><b>7.GHQ (appendix - questionnaire and
              scoring)</b></label>
              <a href="#" class="btn btn-info btn-sm edit" data-id="#" data-toggle="modal" data-target="#editModal" >Questionniare</a>
              @include('call_checklist.shojon.tier_one.questrion_from')
              @if($data->who !="")
              <input type="text" id="ghq"  name="ghq" value="{{ $data->who }}"
              style="text-align:center;" readonly>
              @else
              <input type="text" id="ghq"  name="ghq" value="{{old('ghq','Incomplete')}}"
              style="text-align:center;" readonly>
              @endif
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              @php $types = ['No','Don’t know','Mild','Moderate','Severe','Medical emergency']; @endphp 
              <label for="validationCustom01" class="form-label"><b>8.Does the client have suicidal risk</b></label>
              <select class="form-control" name="suicidal_risk">
                <option disabled selected>Select suicidal risk</option>
                @foreach($types as $item)
                @if($data->suicidal_risk == $item)
                <option selected value="{{$item}}">{{$item}}</option>
                @else
                <option value="{{$item}}">{{$item}}</option>
                @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              @php $types = ['Explicitly angry/upset and said something negative about call experience','Was not explicitly angry/upset, but you can tell they were dissatisfied with the call','Neutral about call experience: not positive or negative','Did not explicitly say anything about feeling better, but you can tell','They are calmer, less anxious, no longer crying, etc','Explicitly said “thank you” or that they were feeling better and was','Obviously much better at end of call','Was VERY HAPPY with call experience, multiple expressions of gratitude/thanks','Not applicable']; @endphp 
              <label for="validationCustom01" class="form-label"><b>9.How effective the session went for the client</b></label>
              <select class="form-control" name="effective">
                <option disabled selected>Select effectiveness</option>
                @foreach($types as $item)
                @if($data->effective == $item)
                <option selected value="{{$item}}">{{$item}}</option>
                @else
                <option value="{{$item}}">{{$item}}</option>
                @endif
                @endforeach
              </select>
            </div>
          </div>
        </div><hr>

        <!-- six line -->

        <div class="row g-2">
          <div class="col-md-6">
           <div class="form-group">
            <label class="control-label" for="Internal_Referral"><b>10.Internal Referral:</b></label> 
            @php $types = ['No', 'KPR']; @endphp
            <div class="form-control">
                @foreach($types as $item)
                @if($data->internal_referr == $item)
                <input type="radio" name="Internal_Referral" value="{{ $item }}" checked="checked"/>
                @else
                <input type="radio" name="Internal_Referral" value="{{ $item }}"
                />
                @endif
                {{ $item }}
                <br>
                @endforeach
                <label class="form-control">
                 <label class="control-label">
                   <input type="radio" id="chkSHOJONTierTwo" class="TierTwoChe" name="Speech"onclick="ShowSHOJONTierTwoBox()"/>
                   SHOJON Tier 2 for Psychotherapy
                 </label>
                 <span id="SHOJONTierTwoBox" class="TierTwo"  style="display: none;">
                  <a href="#" class="btn btn-info btn-sm edit" data-id="#" data-toggle="modal" data-target="#Referral_tier_twoModal" >SHOJON Tier 2</a>
                  @include('call_checklist.shojon.tier_one._referral_tier_two')
                </span>
              </label>
              <label class="form-control">
               <label class="control-label">
                 <input type="radio" id="chkSHOJONTierThree" class="TierThreeChe" name="Speech"onclick="ShowSHOJONTierThreeBox()"/>
                 SHOJON Tier 3 for Psychiatric Consultation
               </label>

               <span id="SHOJONTierThreeBox" class="TierThree"  style="display: none;">
                <a href="#" class="btn btn-info btn-sm edit" data-id="#" data-toggle="modal" data-target="#Referral_tier_threeModal" >SHOJON Tier 3</a>
                @include('call_checklist.shojon.tier_one._referral_tier_three')
              </span>
            </label>
        </div> 
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label" for="distress_rating"><b>11.External Referral </b></label> 
        @php $types = ['NIMH (contact No)', 'BSMMU- IPNA (contact No)','No']; @endphp
        <div class="form-control">
          <label class="control-label"for="distress_rating"><b>Reason for referral</b></label><br>
          <label class="control-label"  style="width: 100%;" >
            @if($data->reason_for_referral!="")
            <textarea type="text"  class="form-control" name="reason_for_referral">{{$data->reason_for_referral}}  </textarea>
            @else

            <textarea type="text"  class="form-control" name="reason_for_referral">  </textarea>
            @endif
          </label>
        </div>
        <div class="form-control">
            @foreach($types as $item)
            @if($data->name_of_agency == $item)
            <input type="radio" name="name_of_agency" value="{{ $item }}" checked="checked"
            onclick=" ShoExternal_ReferralBox()()"/>
            @else
            <input type="radio" name="name_of_agency" value="{{ $item }}"
            onclick=" ShoExternal_ReferralBox()()"/>
            @endif
            {{ $item }}
            <br>
            @endforeach
            <input type="radio" id="chkExternal_Referral" name="name_of_agency"
            onclick=" ShoExternal_ReferralBox()()"/>
            Other, comment (please explain)
          <span id="External_ReferralBox" style="display: none;">
            <input class="form-control" type="text" name="other_name_of_agency" placeholder="Explain"/>
          </span>
        </div> 
      </div>
    </div>
  </div><hr>
  <div class="row g-1">
  <div class="col-md-12">
     <div class="form-group">
        <label class="control-label"for="distress_rating"><b>12.Call Description</b></label>
        <textarea rows="4" cols="50" class="form-control" name="call_description">
          {{$data->call_description}}</textarea>
     </div>
  </div>
</div><hr> 
<span class="btn btn-success" id="messageButton" style="margin: 5px" onClick="showMessageBox()">Message</span>
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
    <button class="btn btn-primary" type="Submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Tier One Update
    </button>
    &nbsp;&nbsp;&nbsp;
    <a class="btn btn-secondary" style="background-color:red;" onclick="cancel()"><i
      class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
    </div>
  </form>
</div>
</div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript">
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
</script>
<script>
  $(document).ready(function(){
    ShowOccupationBox();
    Showabout_shojonBox();
    Showprimary_reasonBox();
    Showsecondary_reasonBox();
    Showmental_illnessBox();
    ShowSHOJONTierTwoBox();
    ShowSHOJONTierThreeBox();
    ShoExternal_ReferralBox();
    showMessageBox();

  });
      function showMessageBox() {
      var x = document.getElementById("messageBox");
      if (x.style.display == "block") {
        x.style.display = "none";
      } else {
        x.style.display = "block";
      }
    }

  function ShowOccupationBox()
  {
    var radio = document.getElementById("chkOccupation");
    var Box = document.getElementById("OccupationBox");
    Box.style.display = radio.checked ? "block" : "none";
    var other = Box.getElementsByTagName('input')[0];
    radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
  }
  function Showabout_shojonBox()
  {
    var radio = document.getElementById("chkabout_shojon");
    var Box = document.getElementById("about_shojonBox");
    Box.style.display = radio.checked ? "block" : "none";
    var other = Box.getElementsByTagName('input')[0];
    radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
  }
  function Showprimary_reasonBox()
  {
    var radio = document.getElementById("chkprimary_reason");
    var Box = document.getElementById("primary_reasonBox");
    Box.style.display = radio.checked ? "block" : "none";
    var other = Box.getElementsByTagName('input')[0];
    radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
  }
  function Showsecondary_reasonBox()
  {
    var radio = document.getElementById("chksecondary_reason");
    var Box = document.getElementById("secondary_reasonBox");
    Box.style.display = radio.checked ? "block" : "none";
    var other = Box.getElementsByTagName('input')[0];
    radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
  }
  function Showmental_illnessBox()
  {
    var radio = document.getElementById("chkmental_illness");
    var Box = document.getElementById("mental_illnessBox");
    Box.style.display = radio.checked ? "block" : "none";
    var other = Box.getElementsByTagName('input')[0];
    radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
  }
  function ShowSHOJONTierTwoBox()
  {
    var radio = document.getElementById("chkSHOJONTierTwo");
    var Box = document.getElementById("SHOJONTierTwoBox");
    Box.style.display = radio.checked ? "block" : "none";
    var other = Box.getElementsByTagName('input')[0];
    radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
  }
  function ShowSHOJONTierThreeBox()
  {
    var radio = document.getElementById("chkSHOJONTierThree");
    var Box = document.getElementById("SHOJONTierThreeBox");
    Box.style.display = radio.checked ? "block" : "none";
    var other = Box.getElementsByTagName('input')[0];
    radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
  }
  function ShoExternal_ReferralBox()
  {
    var radio = document.getElementById("chkExternal_Referral");
    var Box = document.getElementById("External_ReferralBox");
    Box.style.display = radio.checked ? "block" : "none";
    var other = Box.getElementsByTagName('input')[0];
    radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
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

  $(document).on('dblclick','.TierTwoChe',function(){
    if(this.checked){
      $(this).prop('checked', false);
      $('.TierTwo').hide();
    }
  });
  $(document).on('dblclick','.TierThreeChe',function(){
    if(this.checked){
      $(this).prop('checked', false);
      $('.TierThree').hide();
    }
  });
</script>