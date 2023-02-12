@extends('call_checklist.app')
@section('title') {{ $pagedetails }} @endsection
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
<div class="app-title">
  <div>
    <h1><i class="fa fa-tags"></i> {{ $pagedetails }}</h1>
  </div>
</div>
<div class="row">
  <!-- left column -->
  <div class="col-md-12 mx-auto">
    <div class="tile">
      <div class="tile-body">
       <div class="row g-4">
        <div class="col-md-3">
          <label for="validationCustom01" class="form-label">Observer's Name:</label>
          <input type="text" class="form-control" value="{{$data->name}}">
        </div>
        <div class="col-md-3">
          <label for="validationCustom01" class="form-label">Counselor's Name:</label>
          <input type="text" class="form-control" value="{{$data->counselor_name}}">

        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="validationCustom01" class="form-label">Total Duration of the Call(Minute)</label>
            <input type="text" class="form-control" value="{{$data->duration_call}}">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="validationCustom01" class="form-label">Date and Time:</label>
            <input class="form-control" value="{{$data->date}}">

          </div>
        </div>
      </div><hr>
      <div class="row">
       <div class="col-md-12">
        <div class="form-group">
         <label for="validationCustom01" class="form-label"><b>Counselor's Skill Assessment Checklist</b></label>
         @php $types = ['Counselor greeted the client nicely','Informed the client about confidentially','Listens to the client attentively','Showed proper empathy towards the client','Build a good rapport with the client','Spoke softly and Patiently with the client.','Gave reassurance to the client','Ask open ended question','Discusses in detail the difficulties / problems with the client','Discussed with the client about how to stay well','Being able to apply the psychometric scale properly and share the score of the scale.','Did the financial assessment properly if necessary','Informs the client about the next step of the service','Answered to the enquiries of client correctly']; @endphp
         @php
         $check_item = json_decode($data->assessment);
         @endphp 
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
           @if($check_item !=0)
           @foreach($types as $key=>$item)
           @foreach($check_item as $key1=>$item1)
           @if($key == $key1)
           <tr>
             <td><label for="validationCustom01" class="form-label">{{$item}}</label></td> 
             @if($check_item[$key1] == "Not good at all")
             <td><input type="checkbox" readonly checked /></td>
             @else
             <td><input type="checkbox"readonly/></td>
             @endif
             @if($check_item[$key1] == "Okay")
             <td><input type="checkbox"readonly checked /></td>
             @else
             <td><input type="checkbox"readonly/></td>
             @endif
             @if($check_item[$key1] == "Good")
             <td><input type="checkbox"readonly checked /></td>
             @else
             <td><input type="checkbox"readonly/></td>
             @endif
             @if($check_item[$key1] == "Excellen")
             <td><input type="checkbox"readonly checked /></td>
             @else
             <td><input type="checkbox"readonly/></td>
             @endif 

           </tr>
           @endif
           @endforeach
           @endforeach
           @endif
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
     @php
     $check_item = json_decode($data->observation);
     $result = array_filter($check_item);
     $array = array_values($result);
     @endphp 
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
       @foreach($types as $key=>$item)
       @foreach($array as $key1=>$item1)
       @if($key == $key1)
       
       <tr>
         <td><label for="validationCustom01" class="form-label">{{$item}}</label></td> 
         @if($array[$key1] == "Not agree")
         <td><input type="checkbox" readonly checked /></td>
         @else
         <td><input type="checkbox"readonly/></td>
         @endif
         @if($array[$key1] == "Slightly agree")
         <td><input type="checkbox"readonly checked /></td>
         @else
         <td><input type="checkbox"readonly/></td>
         @endif
         @if($array[$key1] == "Agree")
         <td><input type="checkbox"readonly checked /></td>
         @else
         <td><input type="checkbox"readonly/></td>
         @endif
         @if(($array[$key1] != "Not agree") && ($array[$key1] != "Slightly agree") && ($array[$key1] != "Agree"))
         <td><input type="text" readonly value="{{$array[$key1]}}"  /></td>
         @else
         <td><input type="text"readonly/></td>
         @endif 

       </tr>
       @endif
       @endforeach
       @endforeach
     </tbody> 
   </table>  
 </div>
</div>
</div>
</div>

<div class="col-md-3">
  <label for="validationCustom01" class="form-label">Rating Score:</label>
  <input type="number" class="form-control" name="rating_score" value="{{$data->rating_score}}" min="0" max="10" required>
</div> 
<div class="col-md-6">
  <label for="validationCustom01" class="form-label">Recommendation:</label>
  <h6>--- {{$data->recommendation}}</h6>

</textarea>
</div> 
<div class="modal-footer">
  <label class="control-label" style="text-align: center; color: red;">This file only for Evaluation View</label>
</div>

</div>
</div>
</div>
@endsection