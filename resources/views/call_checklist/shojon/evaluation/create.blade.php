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
                       <input type="number" class="form-control" name="duration_call" placeholder="Total duration" min="0.1" max="500" step="0.1" required>
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
          			@php $types = ['Counselor greeted the client nicely','Informed the client about confidentially','Listens to the client attentively','Showed proper empathy towards the client','Build a good rapport with the client','Spoke softly and Patiently with the client.','Gave reassurance to the client','Ask open ended question','Discusses in detail the difficulties / problems with the client','Discussed with the client about how to stay well','Being able to apply the psychometric scale properly and share the score of the scale.','Did the financial assessment properly if necessary','Informs the client about the next step of the service','Answered to the enquiries of client correctly']; @endphp
          			
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
                      	@foreach($types as $item)
                        <tr>
                           <td><label for="validationCustom01" class="form-label">{{$item}}</label></td>  
                           <td><input type="checkbox" name="Assessment[]"value="Not good at all"/></td> 
                           <td><input type="checkbox" name="Assessment[]" value="Okay" /></td> 
                           <td><input type="checkbox" name="Assessment[]"value="Good"/></td> 
                           <td><input type="checkbox" name="Assessment[]"value="Excellen"/></td>
                       </tr>
                       @endforeach
                   </tbody> 
               </table>  
          		</div>
          	</div>
          </div><hr>
          <div class="row">
          	<div class="col-md-12">
          		<div class="form-group">
          			<label for="validationCustom01" class="form-label"><b>Observation of the Client’s response:</b></label>
          			@php $types = ['Feeling comfortable talking to the counselor','The distress/stress of the client reduced somewhat','There is a positive change in client’s response after talking with counselor','Express their feelings as “felt good” after completing the session','The purpose for which the client made the call has been fulfilled']; @endphp
          			
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
                      	@foreach($types as $item)
                        <tr>
                           <td><label for="validationCustom01" class="form-label">{{$item}}</label></td>  
                           <td><input type="checkbox" name="Observation[]"value="Not agree"/></td> 
                           <td><input type="checkbox" name="Observation[]" value="Slightly agree" /></td> 
                           <td><input type="checkbox" name="Observation[]"value="Agree"/></td> 
                           <td><input type="text" name="Observation[]"value=""/></td>
                       </tr>
                       @endforeach
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
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary save_ter_btn">Submit</button>
        </div>
        </form>
    </div>
</div>
</div>
<script>
    config ={
      enableTime: true,
      dateFormat: "Y-m-d h:i K",
    }
    flatpickr("input[type=datetime-local]", config);
</script>
@endsection