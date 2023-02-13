@extends('call_checklist.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"/>
<div class="app-title">
  <div>
    <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
  </div>
</div>
<div class="row">
  <!-- left column -->
  <div class="col-md-12 mx-auto">
    <div class="tile">
      <form id="myForm" action="{{ route('call_checklist.evaluation.store') }}" method="POST" role="form"
      enctype="multipart/form-data" autocomplete="off">
      @csrf
      <div class="tile-body">
       <div class="row g-4">
        <div class="col-md-3">
          <label for="validationCustom01" class="form-label">Observer's Name:</label>
          <input type="text" class="form-control" name="name" placeholder="Observer's Name" required>
        </div> 
        <div class="col-md-3">
          <label for="validationCustom01" class="form-label">Counselor's Name:</label>
          <input type="text" class="form-control" name="counselor_name" placeholder="Counselor's Name" required>

        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="validationCustom01" class="form-label">Total Duration of the Call(Minute)</label>
            <input type="number" class="form-control" name="duration_call" placeholder="Total duration" min="0.1" max="500" step=".01" required>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="validationCustom01" class="form-label">Date and Time:</label>
            <input type="datetime-local" class="form-control" name="date" required>
          </div>
        </div>
      </div><hr>
      <div class="row">
       <div class="col-md-12">
        <div class="form-group">
         <label for="validationCustom01" class="form-label"><b>Counselor's Skill Assessment Checklist</b></label>
         <table class="table table-bordered border-primary" id="dynamic_field_formulation">
          <thead>
            <tr>
              <th scope="col">Basic skills</th>
              <th scope="col">Not good at all</th>
              <th scope="col">Okay</th>
              <th scope="col">Good</th>
              <th scope="col">Excellen</th>
            </tr>
          </thead>
          <tbody>
           <tr>
             <td><label for="validationCustom01" class="form-label">Counselor greeted the client nicely</label></td> 
             <td><input type="checkbox" name="Assessment[]" id="oneSelect" value="Not good at all"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="twoSelect" value="Okay" /></td> 
             <td><input type="checkbox" name="Assessment[]" id="threeSelect" value="Good"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="fourSelect" value="Excellen"/></td>
           </tr>
           <tr>
             <td><label for="validationCustom01" class="form-label">Informed the client about confidentially</label></td> 
             <td><input type="checkbox" name="Assessment[]" id="oneSelect1" value="Not good at all"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="twoSelect1" value="Okay" /></td> 
             <td><input type="checkbox" name="Assessment[]" id="threeSelect1" value="Good"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="fourSelect1" value="Excellen"/></td>
           </tr>
           <tr>
             <td><label for="validationCustom01" class="form-label">Listens to the client attentively</label></td> 
             <td><input type="checkbox" name="Assessment[]" id="oneSelect2" value="Not good at all"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="twoSelect2" value="Okay" /></td> 
             <td><input type="checkbox" name="Assessment[]" id="threeSelect2" value="Good"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="fourSelect2" value="Excellen"/></td>
           </tr>
           <tr>
             <td><label for="validationCustom01" class="form-label">Showed proper empathy towards the client</label></td> 
             <td><input type="checkbox" name="Assessment[]" id="oneSelect3" value="Not good at all"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="twoSelect3" value="Okay" /></td> 
             <td><input type="checkbox" name="Assessment[]" id="threeSelect3" value="Good"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="fourSelect3" value="Excellen"/></td>
           </tr>
           <tr>
             <td><label for="validationCustom01" class="form-label">Build a good rapport with the client</label></td> 
             <td><input type="checkbox" name="Assessment[]" id="oneSelect4" value="Not good at all"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="twoSelect4" value="Okay" /></td> 
             <td><input type="checkbox" name="Assessment[]" id="threeSelect4" value="Good"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="fourSelect4" value="Excellen"/></td>
           </tr>
           <tr>
             <td><label for="validationCustom01" class="form-label">Spoke softly and Patiently with the client.</label></td> 
             <td><input type="checkbox" name="Assessment[]" id="oneSelect5" value="Not good at all"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="twoSelect5" value="Okay" /></td> 
             <td><input type="checkbox" name="Assessment[]" id="threeSelect5" value="Good"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="fourSelect5" value="Excellen"/></td>
           </tr>
           <tr>
             <td><label for="validationCustom01" class="form-label">Gave reassurance to the client</label></td> 
             <td><input type="checkbox" name="Assessment[]" id="oneSelect6" value="Not good at all"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="twoSelect6" value="Okay" /></td> 
             <td><input type="checkbox" name="Assessment[]" id="threeSelect6" value="Good"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="fourSelect6" value="Excellen"/></td>
           </tr>
           <tr>
             <td><label for="validationCustom01" class="form-label">Ask open ended question</label></td> 
             <td><input type="checkbox" name="Assessment[]" id="oneSelect7" value="Not good at all"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="twoSelect7" value="Okay" /></td> 
             <td><input type="checkbox" name="Assessment[]" id="threeSelect7" value="Good"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="fourSelect7" value="Excellen"/></td>
           </tr>
           <tr>
             <td><label for="validationCustom01" class="form-label">Discusses in detail the difficulties / problems with the client</label></td> 
             <td><input type="checkbox" name="Assessment[]" id="oneSelect8" value="Not good at all"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="twoSelect8" value="Okay" /></td> 
             <td><input type="checkbox" name="Assessment[]" id="threeSelect8" value="Good"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="fourSelect8" value="Excellen"/></td>
           </tr>
           <tr>
             <td><label for="validationCustom01" class="form-label">Discussed with the client about how to stay well</label></td> 
             <td><input type="checkbox" name="Assessment[]" id="oneSelect9" value="Not good at all"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="twoSelect9" value="Okay" /></td> 
             <td><input type="checkbox" name="Assessment[]" id="threeSelect9" value="Good"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="fourSelect9" value="Excellen"/></td>
           </tr>
           <tr>
             <td><label for="validationCustom01" class="form-label">Being able to apply the psychometric scale properly and share the score of the scale.</label></td> 
             <td><input type="checkbox" name="Assessment[]" id="oneSelect10" value="Not good at all"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="twoSelect10" value="Okay" /></td> 
             <td><input type="checkbox" name="Assessment[]" id="threeSelect10" value="Good"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="fourSelect10" value="Excellen"/></td>
           </tr>
           <tr>
             <td><label for="validationCustom01" class="form-label">Did the financial assessment properly if necessary</label></td> 
             <td><input type="checkbox" name="Assessment[]" id="oneSelect11" value="Not good at all"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="twoSelect11" value="Okay" /></td> 
             <td><input type="checkbox" name="Assessment[]" id="threeSelect11" value="Good"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="fourSelect11" value="Excellen"/></td>
           </tr>
           <tr>
             <td><label for="validationCustom01" class="form-label">Informs the client about the next step of the service</label></td> 
             <td><input type="checkbox" name="Assessment[]" id="oneSelect12" value="Not good at all"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="twoSelect12" value="Okay" /></td> 
             <td><input type="checkbox" name="Assessment[]" id="threeSelect12" value="Good"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="fourSelect12" value="Excellen"/></td>
           </tr>
           <tr>
             <td><label for="validationCustom01" class="form-label">Answered to the enquiries of client correctly</label></td> 
             <td><input type="checkbox" name="Assessment[]" id="oneSelect13" value="Not good at all"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="twoSelect13" value="Okay" /></td> 
             <td><input type="checkbox" name="Assessment[]" id="threeSelect13" value="Good"/></td> 
             <td><input type="checkbox" name="Assessment[]" id="fourSelect13" value="Excellen"/></td>
           </tr>
         </tbody> 
       </table>  
     </div>
   </div>
 </div><hr>
 <div class="row">
   <div class="col-md-12">
    <div class="form-group">
     <label for="validationCustom01" class="form-label"><b>Observation of the Client’s response:</b></label>
     @php $types = ['','','','','']; @endphp

     <table class="table table-bordered border-primary" id="dynamic_field_formulation">
      <thead>
        <tr>
          <th scope="col">Caller’s Response</th>
          <th scope="col">Not agree</th>
          <th scope="col">Slightly agree</th>
          <th scope="col">Agree</th>
          <th scope="col">Comment</th>
        </tr>
      </thead>
      <tbody>   
       <tr>
         <td><label for="validationCustom01" class="form-label">Feeling comfortable talking to the counselor</label></td>  
         <td><input type="checkbox" name="Observation[]" id="oneSelect14" value="Not agree"/></td> 
         <td><input type="checkbox" name="Observation[]" id="twoSelect14" value="Slightly agree" /></td> 
         <td><input type="checkbox" name="Observation[]" id="threeSelect14" value="Agree"/></td> 
         <td><input type="text" name="Observation[]" value="" /></td>
       </tr>
       <tr>
         <td><label for="validationCustom01" class="form-label">The distress/stress of the client reduced somewhat</label></td>  
         <td><input type="checkbox" name="Observation[]" id="oneSelect15" value="Not agree"/></td> 
         <td><input type="checkbox" name="Observation[]" id="twoSelect15" value="Slightly agree" /></td> 
         <td><input type="checkbox" name="Observation[]"id="threeSelect15"value="Agree"/></td> 
         <td><input type="text" name="Observation[]" value=""/></td>
       </tr>
       <tr>
         <td><label for="validationCustom01" class="form-label">There is a positive change in client’s response after talking with counselor</label></td>  
         <td><input type="checkbox" name="Observation[]" id="oneSelect16" value="Not agree"/></td> 
         <td><input type="checkbox" name="Observation[]" id="twoSelect16" value="Slightly agree" /></td> 
         <td><input type="checkbox" name="Observation[]"id="threeSelect16"value="Agree"/></td> 
         <td><input type="text" name="Observation[]" value=""/></td>
       </tr>
       <tr>
         <td><label for="validationCustom01" class="form-label">Express their feelings as “felt good” after completing the session</label></td>  
         <td><input type="checkbox" name="Observation[]" id="oneSelect17" value="Not agree"/></td> 
         <td><input type="checkbox" name="Observation[]" id="twoSelect17" value="Slightly agree" /></td> 
         <td><input type="checkbox" name="Observation[]"id="threeSelect17"value="Agree"/></td> 
         <td><input type="text" name="Observation[]" value=""/></td>
       </tr>
       <tr>
         <td><label for="validationCustom01" class="form-label">The purpose for which the client made the call has been fulfilled</label></td>  
         <td><input type="checkbox" name="Observation[]" id="oneSelect18" value="Not agree"/></td> 
         <td><input type="checkbox" name="Observation[]" id="twoSelect18" value="Slightly agree" /></td> 
         <td><input type="checkbox" name="Observation[]"id="threeSelect18"value="Agree"/></td> 
         <td><input type="text" name="Observation[]" value=""/></td>
       </tr>
     </tbody> 
   </table>  
 </div>
</div>
</div>
</div>

<h4>Call rating</h4>
<p>According to observers, how effective was this call? <br>
Rate between 0 and 10 where 0 means not very effective and 10 means maximum effective.</p>
<div class="col-md-3">
  <label for="validationCustom01" class="form-label">Rating Score:</label>
  <input type="number" class="form-control" name="rating_score" placeholder="Rating Score" min="0" max="10" required>
</div> 
<div class="col-md-6">
  <label for="validationCustom01" class="form-label">Recommendation</label>
  {{-- <input type="textarea" class="form-control" name="recommendation"> --}}
  <textarea id="recommendation" name="recommendation" rows="4" cols="50" required>
  </textarea>
</div> 
<div class="modal-footer">
  {{-- <button type="button" class="btn btn-danger" >Close</button> --}}
  <button type="submit" class="btn btn-primary save_ter_btn">Submit</button>
</div>
</form>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  config ={
    enableTime: true,
    dateFormat: "Y-m-d h:i K",
  }
  flatpickr("input[type=datetime-local]", config);
</script>
<script>
  $('#oneSelect,#twoSelect,#threeSelect,#fourSelect').change(function() {

    if ($('#oneSelect').prop('checked') === true) {
      licSelect = true;
      $('#twoSelect,#threeSelect,#fourSelect').attr("disabled", true);
    } else {
      licSelect = false;
      if (licSelect === false) {
        $('#twoSelect,#threeSelect,#fourSelect').removeAttr("disabled");
      }

    }

    if ($('#twoSelect').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect,#threeSelect,#fourSelect').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect,#threeSelect,#fourSelect').removeAttr("disabled");
      }
    }

    if ($('#threeSelect').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect,#twoSelect,#fourSelect').attr("disabled", true);
    } else {
      if (licSelect === false) {
        $('#oneSelect,#twoSelect,#fourSelect').removeAttr("disabled");
      }

    }

    if ($('#fourSelect').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect,#twoSelect,#threeSelect').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect,#twoSelect,#threeSelect').removeAttr("disabled");
      }
    }
  });

  $('#oneSelect1,#twoSelect1,#threeSelect1,#fourSelect1').change(function() {

    if ($('#oneSelect1').prop('checked') === true) {
      licSelect = true;
      $('#twoSelect1,#threeSelect1,#fourSelect1').attr("disabled", true);
    } else {
      licSelect = false;
      if (licSelect === false) {
        $('#twoSelect1,#threeSelect1,#fourSelect1').removeAttr("disabled");
      }

    }

    if ($('#twoSelect1').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect1,#threeSelect1,#fourSelect1').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect1,#threeSelect1,#fourSelect1').removeAttr("disabled");
      }
    }

    if ($('#threeSelect1').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect1,#twoSelect1,#fourSelect1').attr("disabled", true);
    } else {
      if (licSelect === false) {
        $('#oneSelect1,#twoSelect1,#fourSelect1').removeAttr("disabled");
      }

    }

    if ($('#fourSelect1').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect1,#twoSelect1,#threeSelect1').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect1,#twoSelect1,#threeSelect1').removeAttr("disabled");
      }
    }
  });

  $('#oneSelect2,#twoSelect2,#threeSelect2,#fourSelect2').change(function() {

    if ($('#oneSelect2').prop('checked') === true) {
      licSelect = true;
      $('#twoSelect2,#threeSelect2,#fourSelect2').attr("disabled", true);
    } else {
      licSelect = false;
      if (licSelect === false) {
        $('#twoSelect2,#threeSelect2,#fourSelect2').removeAttr("disabled");
      }

    }

    if ($('#twoSelect2').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect2,#threeSelect2,#fourSelect2').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect2,#threeSelect2,#fourSelect2').removeAttr("disabled");
      }
    }

    if ($('#threeSelect2').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect2,#twoSelect2,#fourSelect2').attr("disabled", true);
    } else {
      if (licSelect === false) {
        $('#oneSelect2,#twoSelect2,#fourSelect2').removeAttr("disabled");
      }

    }

    if ($('#fourSelect2').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect2,#twoSelect2,#threeSelect2').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect2,#twoSelect2,#threeSelect2').removeAttr("disabled");
      }
    }
  });


  $('#oneSelect3,#twoSelect3,#threeSelect3,#fourSelect3').change(function() {

    if ($('#oneSelect3').prop('checked') === true) {
      licSelect = true;
      $('#twoSelect3,#threeSelect3,#fourSelect3').attr("disabled", true);
    } else {
      licSelect = false;
      if (licSelect === false) {
        $('#twoSelect3,#threeSelect3,#fourSelect3').removeAttr("disabled");
      }

    }

    if ($('#twoSelect3').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect3,#threeSelect3,#fourSelect3').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect3,#threeSelect3,#fourSelect3').removeAttr("disabled");
      }
    }

    if ($('#threeSelect3').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect3,#twoSelect3,#fourSelect3').attr("disabled", true);
    } else {
      if (licSelect === false) {
        $('#oneSelect3,#twoSelect3,#fourSelect3').removeAttr("disabled");
      }

    }

    if ($('#fourSelect3').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect3,#twoSelect3,#threeSelect3').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect3,#twoSelect3,#threeSelect3').removeAttr("disabled");
      }
    }
  });


  $('#oneSelect4,#twoSelect4,#threeSelect4,#fourSelect4').change(function() {

    if ($('#oneSelect4').prop('checked') === true) {
      licSelect = true;
      $('#twoSelect4,#threeSelect4,#fourSelect4').attr("disabled", true);
    } else {
      licSelect = false;
      if (licSelect === false) {
        $('#twoSelect4,#threeSelect4,#fourSelect4').removeAttr("disabled");
      }

    }

    if ($('#twoSelect4').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect4,#threeSelect4,#fourSelect4').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect4,#threeSelect4,#fourSelect4').removeAttr("disabled");
      }
    }

    if ($('#threeSelect4').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect4,#twoSelect4,#fourSelect4').attr("disabled", true);
    } else {
      if (licSelect === false) {
        $('#oneSelect4,#twoSelect4,#fourSelect4').removeAttr("disabled");
      }

    }

    if ($('#fourSelect4').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect4,#twoSelect4,#threeSelect4').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect4,#twoSelect4,#threeSelect4').removeAttr("disabled");
      }
    }
  });


  $('#oneSelect5,#twoSelect5,#threeSelect5,#fourSelect5').change(function() {

    if ($('#oneSelect5').prop('checked') === true) {
      licSelect = true;
      $('#twoSelect5,#threeSelect5,#fourSelect5').attr("disabled", true);
    } else {
      licSelect = false;
      if (licSelect === false) {
        $('#twoSelect5,#threeSelect5,#fourSelect5').removeAttr("disabled");
      }

    }

    if ($('#twoSelect5').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect5,#threeSelect5,#fourSelect5').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect5,#threeSelect5,#fourSelect5').removeAttr("disabled");
      }
    }

    if ($('#threeSelect5').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect5,#twoSelect5,#fourSelect5').attr("disabled", true);
    } else {
      if (licSelect === false) {
        $('#oneSelect5,#twoSelect5,#fourSelect5').removeAttr("disabled");
      }

    }

    if ($('#fourSelect5').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect5,#twoSelect5,#threeSelect5').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect5,#twoSelect5,#threeSelect5').removeAttr("disabled");
      }
    }
  });


  $('#oneSelect6,#twoSelect6,#threeSelect6,#fourSelect6').change(function() {

    if ($('#oneSelect6').prop('checked') === true) {
      licSelect = true;
      $('#twoSelect6,#threeSelect6,#fourSelect6').attr("disabled", true);
    } else {
      licSelect = false;
      if (licSelect === false) {
        $('#twoSelect6,#threeSelect6,#fourSelect6').removeAttr("disabled");
      }

    }

    if ($('#twoSelect6').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect6,#threeSelect6,#fourSelect6').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect6,#threeSelect6,#fourSelect6').removeAttr("disabled");
      }
    }

    if ($('#threeSelect6').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect6,#twoSelect6,#fourSelect6').attr("disabled", true);
    } else {
      if (licSelect === false) {
        $('#oneSelect6,#twoSelect6,#fourSelect6').removeAttr("disabled");
      }

    }

    if ($('#fourSelect6').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect6,#twoSelect6,#threeSelect6').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect6,#twoSelect6,#threeSelect6').removeAttr("disabled");
      }
    }
  });

  $('#oneSelect7,#twoSelect7,#threeSelect7,#fourSelect7').change(function() {

    if ($('#oneSelect7').prop('checked') === true) {
      licSelect = true;
      $('#twoSelect7,#threeSelect7,#fourSelect7').attr("disabled", true);
    } else {
      licSelect = false;
      if (licSelect === false) {
        $('#twoSelect7,#threeSelect7,#fourSelect7').removeAttr("disabled");
      }

    }

    if ($('#twoSelect7').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect7,#threeSelect7,#fourSelect7').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect7,#threeSelect7,#fourSelect7').removeAttr("disabled");
      }
    }

    if ($('#threeSelect7').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect7,#twoSelect7,#fourSelect7').attr("disabled", true);
    } else {
      if (licSelect === false) {
        $('#oneSelect7,#twoSelect7,#fourSelect7').removeAttr("disabled");
      }

    }

    if ($('#fourSelect7').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect7,#twoSelect7,#threeSelect7').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect7,#twoSelect7,#threeSelect7').removeAttr("disabled");
      }
    }
  });


  $('#oneSelect8,#twoSelect8,#threeSelect8,#fourSelect8').change(function() {

    if ($('#oneSelect8').prop('checked') === true) {
      licSelect = true;
      $('#twoSelect8,#threeSelect8,#fourSelect8').attr("disabled", true);
    } else {
      licSelect = false;
      if (licSelect === false) {
        $('#twoSelect8,#threeSelect8,#fourSelect8').removeAttr("disabled");
      }

    }

    if ($('#twoSelect8').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect8,#threeSelect8,#fourSelect8').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect8,#threeSelect8,#fourSelect8').removeAttr("disabled");
      }
    }

    if ($('#threeSelect8').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect8,#twoSelect8,#fourSelect8').attr("disabled", true);
    } else {
      if (licSelect === false) {
        $('#oneSelect8,#twoSelect8,#fourSelect8').removeAttr("disabled");
      }

    }

    if ($('#fourSelect8').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect8,#twoSelect8,#threeSelect8').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect8,#twoSelect8,#threeSelect8').removeAttr("disabled");
      }
    }
  });


  $('#oneSelect9,#twoSelect9,#threeSelect9,#fourSelect9').change(function() {

    if ($('#oneSelect9').prop('checked') === true) {
      licSelect = true;
      $('#twoSelect9,#threeSelect9,#fourSelect9').attr("disabled", true);
    } else {
      licSelect = false;
      if (licSelect === false) {
        $('#twoSelect9,#threeSelect9,#fourSelect9').removeAttr("disabled");
      }

    }

    if ($('#twoSelect9').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect9,#threeSelect9,#fourSelect9').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect9,#threeSelect9,#fourSelect9').removeAttr("disabled");
      }
    }

    if ($('#threeSelect9').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect9,#twoSelect9,#fourSelect9').attr("disabled", true);
    } else {
      if (licSelect === false) {
        $('#oneSelect9,#twoSelect9,#fourSelect9').removeAttr("disabled");
      }

    }

    if ($('#fourSelect9').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect9,#twoSelect9,#threeSelect9').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect9,#twoSelect9,#threeSelect9').removeAttr("disabled");
      }
    }


  });$('#oneSelect10,#twoSelect10,#threeSelect10,#fourSelect10').change(function() {

    if ($('#oneSelect10').prop('checked') === true) {
      licSelect = true;
      $('#twoSelect10,#threeSelect10,#fourSelect10').attr("disabled", true);
    } else {
      licSelect = false;
      if (licSelect === false) {
        $('#twoSelect10,#threeSelect10,#fourSelect10').removeAttr("disabled");
      }

    }

    if ($('#twoSelect10').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect10,#threeSelect10,#fourSelect10').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect10,#threeSelect10,#fourSelect10').removeAttr("disabled");
      }
    }

    if ($('#threeSelect10').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect10,#twoSelect10,#fourSelect10').attr("disabled", true);
    } else {
      if (licSelect === false) {
        $('#oneSelect10,#twoSelect10,#fourSelect10').removeAttr("disabled");
      }

    }

    if ($('#fourSelect10').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect10,#twoSelect10,#threeSelect10').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect10,#twoSelect10,#threeSelect10').removeAttr("disabled");
      }
    }
  });

  $('#oneSelect11,#twoSelect11,#threeSelect11,#fourSelect11').change(function() {

    if ($('#oneSelect11').prop('checked') === true) {
      licSelect = true;
      $('#twoSelect11,#threeSelect11,#fourSelect11').attr("disabled", true);
    } else {
      licSelect = false;
      if (licSelect === false) {
        $('#twoSelect11,#threeSelect11,#fourSelect11').removeAttr("disabled");
      }

    }

    if ($('#twoSelect11').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect11,#threeSelect11,#fourSelect11').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect11,#threeSelect11,#fourSelect11').removeAttr("disabled");
      }
    }

    if ($('#threeSelect11').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect11,#twoSelect11,#fourSelect11').attr("disabled", true);
    } else {
      if (licSelect === false) {
        $('#oneSelect11,#twoSelect11,#fourSelect11').removeAttr("disabled");
      }

    }

    if ($('#fourSelect11').prop('checked') === true) {
      licSelect = true;
      $('#oneSelect11,#twoSelect11,#threeSelect11').attr("disabled", true);

    } else {
      if (licSelect === false) {
        $('#oneSelect11,#twoSelect11,#threeSelect11').removeAttr("disabled");
      }
    }
  });
  $('#oneSelect12,#twoSelect12,#threeSelect12,#fourSelect12').change(function() {

  if ($('#oneSelect12').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect12,#threeSelect12,#fourSelect12').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect12,#threeSelect12,#fourSelect12').removeAttr("disabled");
    }

  }

  if ($('#twoSelect12').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect12,#threeSelect12,#fourSelect12').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect12,#threeSelect12,#fourSelect12').removeAttr("disabled");
    }
  }

  if ($('#threeSelect12').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect12,#twoSelect12,#fourSelect12').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect12,#twoSelect12,#fourSelect12').removeAttr("disabled");
    }

  }

  if ($('#fourSelect12').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect12,#twoSelect12,#threeSelect12').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect12,#twoSelect12,#threeSelect12').removeAttr("disabled");
    }
  }
});

$('#oneSelect13,#twoSelect13,#threeSelect13,#fourSelect13').change(function() {

  if ($('#oneSelect13').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect13,#threeSelect13,#fourSelect13').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect13,#threeSelect13,#fourSelect13').removeAttr("disabled");
    }

  }

  if ($('#twoSelect13').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect13,#threeSelect13,#fourSelect13').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect13,#threeSelect13,#fourSelect13').removeAttr("disabled");
    }
  }

  if ($('#threeSelect13').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect13,#twoSelect13,#fourSelect13').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect13,#twoSelect13,#fourSelect13').removeAttr("disabled");
    }

  }

  if ($('#fourSelect13').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect13,#twoSelect13,#threeSelect13').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect13,#twoSelect13,#threeSelect13').removeAttr("disabled");
    }
  }
});

</script>
<script>
  $('#oneSelect14,#twoSelect14,#threeSelect14').change(function() {

  if ($('#oneSelect14').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect14,#threeSelect14').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect14,#threeSelect14').removeAttr("disabled");
    }

  }

  if ($('#twoSelect14').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect14,#threeSelect14').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect14,#threeSelect14').removeAttr("disabled");
    }
  }

  if ($('#threeSelect14').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect14,#twoSelect14').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect14,#twoSelect14').removeAttr("disabled");
    }

  }
});
  $('#oneSelect15,#twoSelect15,#threeSelect15').change(function() {

  if ($('#oneSelect15').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect15,#threeSelect15').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect15,#threeSelect15').removeAttr("disabled");
    }

  }

  if ($('#twoSelect15').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect15,#threeSelect15').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect15,#threeSelect15').removeAttr("disabled");
    }
  }

  if ($('#threeSelect15').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect15,#twoSelect15').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect15,#twoSelect15').removeAttr("disabled");
    }

  }
});

$('#oneSelect16,#twoSelect16,#threeSelect16').change(function() {

  if ($('#oneSelect16').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect16,#threeSelect16').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect16,#threeSelect16').removeAttr("disabled");
    }

  }

  if ($('#twoSelect16').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect16,#threeSelect16').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect16,#threeSelect16').removeAttr("disabled");
    }
  }

  if ($('#threeSelect16').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect16,#twoSelect16').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect16,#twoSelect16').removeAttr("disabled");
    }

  }
});

$('#oneSelect17,#twoSelect17,#threeSelect17').change(function() {

  if ($('#oneSelect17').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect17,#threeSelect17').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect17,#threeSelect17').removeAttr("disabled");
    }

  }

  if ($('#twoSelect17').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect17,#threeSelect17').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect17,#threeSelect17').removeAttr("disabled");
    }
  }

  if ($('#threeSelect17').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect17,#twoSelect17').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect17,#twoSelect17').removeAttr("disabled");
    }

  }
});

$('#oneSelect18,#twoSelect18,#threeSelect18').change(function() {

  if ($('#oneSelect18').prop('checked') === true) {
    licSelect = true;
    $('#twoSelect18,#threeSelect18').attr("disabled", true);
  } else {
    licSelect = false;
    if (licSelect === false) {
      $('#twoSelect18,#threeSelect18').removeAttr("disabled");
    }

  }

  if ($('#twoSelect18').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect18,#threeSelect18').attr("disabled", true);

  } else {
    if (licSelect === false) {
      $('#oneSelect18,#threeSelect18').removeAttr("disabled");
    }
  }

  if ($('#threeSelect18').prop('checked') === true) {
    licSelect = true;
    $('#oneSelect18,#twoSelect18').attr("disabled", true);
  } else {
    if (licSelect === false) {
      $('#oneSelect18,#twoSelect18').removeAttr("disabled");
    }

  }
});
</script>

@endsection
