<div class="modal fade" id="TerminationModaltier_three" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Termination Form </h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
       </div>
       <form id="_termination_tier_three_from">
        @csrf
	       <div class="modal-body">
	       	<div class="row g-4">
	       	<div class="col-md-3">
			    <label for="validationCustom01" class="form-label">Project name:</label>
			    <input type="text" class="form-control" name="project_name"  placeholder="Project name">
			</div>
	       	<div class="col-md-3">
			    <label for="validationCustom01" class="form-label">Counselor name:</label>
			    <input type="text" class="form-control" name="Counselor_name" placeholder="Counselor name" >
			 </div>
			 <div class="col-md-3">
			    <label for="validationCustom01" class="form-label">Client name:</label>
			    <input type="text" class="form-control"name="Client_name" placeholder="Client name">
			 </div>
			 <div class="col-md-3">
			    <label for="validationCustom01" class="form-label">Client ID:</label>
			    <input type="text" class="form-control"name="Client_id" placeholder="Client id">
			 </div>
			 </div><br>

			 <div class="row g-2">
	       	<div class="col-md-8">
	       		@php $types = ['The planned treatment was completed','The client refused to receive or participate in services','The client was unable to afford continued or didn’t pay fees on time ','Client migrate','There was little or no progress in treatment','The counselor migrate','The counselor could not be able to continue the therapy for any reason','The client needs services that are not available here, so was referred']; @endphp
	       		<label for="validationCustom01" class="form-label">Main reason for termination (mandatory single select) </label>
			    <div class="form-control ">
                <label>
                    @foreach($types as $item)
                        @if((old('termination') == $item))
                            <input type="radio" name="termination" value="{{ $item }}" checked="checked"
                                   onclick="ShowTerminationBox()"/>
                        @else
                            <input type="radio" name="termination" value="{{ $item }}"
                                   onclick="ShowTerminationBox()"/>
                        @endif
                        {{ $item }}
                        <br>
                    @endforeach
                    <input type="radio" id="chkTermination" name="termination"
                           onclick="ShowTerminationBox()"/>
                    Other (please explain)
                </label>
                <span id="terminationBox" style="display: none;">
                    <input class="form-control" type="text" name="other_termination"placeholder="Explain"/>
                </span>
            </div>			
	        </div>
	       	<div class="col-md-4">
	       		@php $types = ['Client','Therapist','A mutual decision','Other'];@endphp
			    <label for="validationCustom01" class="form-label">Source of termination Decision</label>
			    <select id="Problem_duration" name="whoTerminated" class="form-control">
	                <option value="" selected disabled>Select termination Decision</option>
	                @foreach($types as $item)
	                    <option name="whoTerminated" value="{{ $item }}">{{ $item }}</option>
	                @endforeach
	            </select>
			 </div>
			 </div><br>
	       	<div class="form-group">
	       		<label for="validationCustom01" class="form-label">Treatment session summary:</label>
	       		<label class="form-control">
                <div class="row g-4">
	       	<div class="col-md-3">
			    <label for="validationCustom01" class="form-label">Referred date: </label>
			    <input type="date" class="form-control" name="ReferredDate" placeholder="Referred date">
			</div>
	       	<div class="col-md-3">
			    <label for="validationCustom01" class="form-label">Date of first contact:</label>
			    <input type="date" class="form-control" name="firstContact" placeholder="first contact">
			 </div>
			 <div class="col-md-3">
			    <label for="validationCustom01" class="form-label">Date of last session: </label>
			    <input type="date" class="form-control"name="lastSession" placeholder="last session">
			 </div>
			 <div class="col-md-3">
			    <label for="validationCustom01" class="form-label">No of sessions: </label>
			    <input type="text" class="form-control"name="NoOfSessions" placeholder="No of sessions">
			 </div>
			 </div><br>
			 <table class="table table-bordered border-primary" id="dynamic_field_terminationtt">
                        <thead>
                            <tr>
                              <th scope="col">Scheduled</th>
                              <th scope="col">Attended</th>
                              <th scope="col">Cancelled</th>
                              <th scope="col">Did not attend</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                             <td><input type="text" name="Scheduled[]" placeholder="Scheduled Factor" class="form-control name_list" /></td>  
                              <td><input type="text" name="Attended[]" placeholder="Attended" class="form-control name_list" /></td> 
                              <td><input type="text" name="Cancelled[]" placeholder="Cancelled" class="form-control name_list" /></td> 
                              <td><input type="text" name="notAttend[]" placeholder="Not attend" class="form-control name_list" /></td> 
                              <td><button type="button" name="addmore" id="addmore_terminationtt" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></td>
                            </tr>
                          </tbody> 
                    </table>  
			 </label>
            </div>
	       	<div class="form-group">
	       		<label for="validationCustom01" class="form-label">Treatment outcome: </label>
	       		<label class="form-control">
	       	  		<div class="row g-3">
			       	<div class="col-md-4">
					    <label for="validationCustom01" class="form-label">Distress Rating:</label>
					</div>
			       	<div class="col-md-4">
					    <input type="text" class="form-control" name="Distress_pre" placeholder="Distress Pre">
					 </div>
					 <div class="col-md-4">
					    <input type="text" class="form-control"name="Distress_post" placeholder="Distress Post">
					 </div>
					 </div><br>
					 <div class="row g-3">
			       	<div class="col-md-4">
					    <label for="validationCustom01" class="form-label">Wellbeing scale rating:</label>
					</div>
			       	<div class="col-md-4">
					    <input type="text" class="form-control" name="Wellbeing_pre" placeholder="Wellbeing scale Pre">
					 </div>
					 <div class="col-md-4">
					    <input type="text" class="form-control"name="Wellbeing_post" placeholder="Wellbeing scale Post">
					 </div>
					 </div><br>
					 <div class="row g-3">
			       	<div class="col-md-4">
					    <label for="validationCustom01" class="form-label">Psychological tools rating:</label>
					</div>
			       	<div class="col-md-4">
					    <input type="text" class="form-control" name="Psychological_pre" placeholder="Psychological tools Pre">
					 </div>
					 <div class="col-md-4">
					    <input type="text" class="form-control"name="Psychological_post" placeholder="Psychological tools Post">
					 </div>
					 </div>	 
	       	  	</label>
	       	  </div>
	       	  <div class="form-group">
	       	  	   <label class="control-label">Counselor overall feedback:</label>
	       	  	   <textarea class="form-control feedback" name="feedback">
	       	  	   	
	       	  	   </textarea>
	       	  </div>
	       	  <div class="form-group">
	       	  	   <label class="control-label">Clients core learning from the session:</label>
	       	  	   <textarea class="form-control learning-session" name="learning_session">
	       	  	   	
	       	  	   </textarea>
	       	  </div>
	       </div>
	       <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
	    </form>   
     </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
         ShowTerminationBox();
	});
	function ShowTerminationBox(){
		 var radio = document.getElementById("chkTermination");
        var Box = document.getElementById("terminationBox");
        Box.style.display = radio.checked ? "block" : "none";
        var other = Box.getElementsByTagName('input')[0];
        radio.checked ? other.setAttribute('required', "required") : other.removeAttribute('required');
	}
</script>
<script type="text/javascript">
	$(document).ready(function(){
        $('#_termination_tier_three_from').on('submit',function(e){
            e.preventDefault();
            $.ajax({
            	type:"POST",
            	url: '{{ route('call_checklist.shojon.termination_form') }}',
            	data:$('#_termination_tier_three_from').serialize(),
            	success:function(response){
            		console.log(response)
            		$('#TerminationModaltier_three').modal('hide')
            		alert("Termination save successfully");
            	},
            	error:function(error)
            	{
            		console.log(error)
            		alert("Termination not save");
            	}

            });
        });
	});
</script>

<script>
    $(document).ready(function(){      
       var postURL = "<?php echo url('multipulField_Terminationtt'); ?>";
       var i=1;  
       $('#addmore_terminationtt').click(function(){  
            i++;  
            $('#dynamic_field_terminationtt').append('<tr id="row_terminationtt'+i+'" class="dynamic-added"><td><input type="text" name="Scheduled[]" placeholder="Scheduled Factor" class="form-control name_list" /></td>  <td><input type="text" name="Attended[]" placeholder="Attended" class="form-control name_list" /></td> <td><input type="text" name="Cancelled[]" placeholder="Cancelled" class="form-control name_list" /></td><td><input type="text" name="notAttend[]" placeholder="Not attend" class="form-control name_list" /></td> <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_terminationtt">X</button></td></tr>');  
       });  
       $(document).on('click', '.btn_remove_terminationtt', function(){  
            var button_id_terminationtt = $(this).attr("id");   
            $('#row_terminationtt'+button_id_terminationtt+'').remove();  
       });  
     }); 
</script>