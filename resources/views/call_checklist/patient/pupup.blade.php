@extends('call_checklist.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"/>
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Call From - {{ $number }}</h2>
    </div>
    <div class="card-body">
        <div>
            @include('call_checklist.partials.messages')
        </div>
        <div class="row">

            <div class="col-md-6 col-xl-4 card-body text-center" style="height: 15ch;">
                <a href="{{ route('patient.create',$number) }}" class="btn btn-primary text-center" style="width: 100%; height: 100%;">New Client</a>
            </div>
            <div class="col-md-6 col-xl-4 card-body text-center " style="height: 15ch;">
                <a href="{{ route('patients') }}"
                class="btn btn-primary text-center" style="width: 100%; height: 100%;">Existing Client</a>
            </div>
            <div class="col-md-6 col-xl-4 card-body text-center" style="height: 15ch;">

                <a href="{{ route('session.rescheduleOrCancelationForm', $number) }}" style="width: 100%; height: 100%;" class="btn btn-primary text-center">Reschedule/Cancelation</a>

            </div>
        </div>
        <div class="row">

            <div class="col-md-6 col-xl-4 card-body text-center" style="height: 15ch;">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Cilent_call_Modal" style="width: 100%; height: 100%;">Silent Call</button>
            </div>
            <div class="col-md-6 col-xl-4 card-body text-center" style="height: 15ch;" style="width: 100%; height: 100%;" >
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Reassign_reaquest_Modal" style="width: 100%; height: 100%;">Reassign Request</button>
            </div>
            <div class="col-md-6 col-xl-4 card-body" style="height: 15ch;">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#TerminationModal_pop" style="width: 100%; height: 100%;">Service Termination</button>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div>
                    <div class="card-header card-header-border-bottom text-center showtableId">
                      <h2>Caller History</h2>
                  </div>
                  <hr>
                  <div class="col-12">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="search" name="Search" placeholder="Search exiting">  
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <table class="table table-hover table-bordered" id="liveSearch_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Unique ID</th>
                        <th>Client Name</th>
                        <th>Phone Number</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Location</th>
                        <th>SES</th>
                        <th class="text-center">Action</th>
                        <th class="text-center">History</th>

                    </tr>
                </thead>
                <div id="notfound" class="text-center">
                    <h2 style="color: red;"><b>Data not found</b></h2>
                </div>
                <tbody id="content" class="serchValue">

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div>
                    <div class="card-header card-header-border-bottom text-center showtableId">
                      <h2>Silent Call History</h2>
                  </div>
                  <hr>
              </div>
              <table class="table table-hover table-bordered" id="cilentCallTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-center">Number</th>
                        <th class="text-center">Date And Time</th>
                    </tr>
                </thead>
                <tbody id="content_cilent_call">

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<div id="result" style="display:none;">
    <ul id="id">

    </ul>
</div>

<!-- silent call modal -->

<div class="modal fade" id="Cilent_call_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Silent Call</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <form id="_cilent_call_form">
        @csrf
        <div class="col-md-12">
            <label for="validationCustom01" class="form-label">Number</label>
            <input type="text" id="Number" class="form-control" readonly name="Number"  value="{{$number}}">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Number</button>
        </div>
    </form>
</div>
</div>
</div>
</div>

<!-- Reassign request modal  -->

<div class="modal fade" id="Reassign_reaquest_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reassign Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <form id="_reassign_request_form">
        @csrf
        <div class="form-row">
            <div class="col">
                <label for="unique_id" class="form-label"><b>Client ID</b> <span style="color: red;">*</span></label>  
                <input type="text" class="form-control" maxlength="9" minlength="9" required name="unique_id" placeholder="SHOXXXXXX">
            </div>
            <div class="col">
                <label for="phone_number" class="form-label"><b>Phone Number</b> <span style="color: red;">*</span></label>  
                <input type="number" class="form-control" id="phone_number" name="phone_number" required placeholder="01XXXXXXXXX">
            </div>
        </div>
        <div class="form-group">
            <label for="reason_for_reassing" class="form-label"><b>Reason for Reassing</b> <span style="color: red;">*</span></label>
            <textarea class="form-control" name="reason_for_reassing" required id="reason_for_reassing" rows="3"></textarea>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send Request</button>
        </div>
    </form>
</div>
</div>
</div>
</div>

<!-- termination modal -->

<div class="modal fade" id="TerminationModal_pop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Termination Form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form id="_termination_from">
        @csrf
        <div class="modal-body">
            <div class="row g-4">
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">Project name:</label>
                    <input type="text" class="form-control" readonly name="project_name" value="SHOJON"  placeholder="Project name">
                </div>
                <input type="hidden" name="flag" value="tier2">
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">Counselor name:</label>
                    <input type="text" class="form-control" readonly name="Counselor_name" value="{{ auth()->user()->full_name }}" placeholder="Counselor name" >
                </div>
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">Client name:</label>
                    @if(empty($newPatient->name))
                    <input type="text" class="form-control"name="Client_name"  placeholder="Client name">
                    @else
                    <input type="text" class="form-control" readonly value="{{$newPatient->name}}" name="Client_name"  placeholder="Client name">
                    @endif
                </div>
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">Client ID:</label>
                    @if(empty($uniqueid))
                    <input type="text" class="form-control"name="Client_id" placeholder="Client Id">
                    @else
                    <input type="text" class="form-control"name="Client_id" readonly value="{{ $uniqueid }}" placeholder="Client id">
                    @endif
                </div>
            </div><br>

            <div class="row g-2">
                <div class="col-md-8">
                    @php $types = ['The planned treatment was completed','The client refused to receive or participate in services','The client was unable to afford continued or didn’t pay fees on time ','Client migrate','There was little or no progress in treatment','The counselor migrate','The counselor could not be able to continue the therapy for any reason','The client needs services that are not available here, so was referred']; @endphp
                    <label for="validationCustom01" class="form-label">Main reason for termination (mandatory single select) </label>
                    <div class="form-control ">
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
                    <table class="table table-bordered border-primary" id="dynamic_field_Treatment">
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
                                <td><button type="button" name="addmore" id="addmore_Treatment" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></td>
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
    $(document).ready(function () {
        $('#search').on('keyup', function(){
            var value = $(this).val();
            if (value == '') {
                $('#notfound').show();
                $('#content').hide();
            }else{
                $('.serchValue').show();
                $('#notfound').hide();
            }
            $.ajax({
                type: "get",
                url: "/patient/livesearch",
                data: {Search:value},
                success: function (response) {
                    console.log(response);
                    $('#content').html(response);
                }, error:function(error)
                {
                    console.log(error);
                }
            });
        });
    });
    $(document).ready(function(){
        $('#_cilent_call_form').on('submit',function(e){
            e.preventDefault();
            $.ajax({
              type:"get",
              url: '{{ route('patient.cilent_call') }}',
              data:$('#_cilent_call_form').serialize(),
              success:function(response){
                console.log(response)
                $('#Cilent_call_Modal').modal('hide')
                alert("Number save successfully");
            },
            error:function(error)
            {
                console.log(error)
                alert("Number not save");
            }
        });
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('#_reassign_request_form').on('submit',function(e){
            e.preventDefault();
            $.ajax({
              type:"get",
              url: '{{ route('patient.reassign') }}',
              data:$('#_reassign_request_form').serialize(),
              success:function(response){
                console.log(response)
                $('#Reassign_reaquest_Modal').modal('hide')
                alert("Request save successfully");
            },
            error:function(error)
            {
                console.log(error)
                alert("Request not save  ! Invalid Client");
            }
        });
        });
    });
</script> 
<script>
    $(document).ready(function(){
        var cilentNumber = $("#Number").val();
        $.ajax({
            type: "get",
            url: "/patient/cilent_call_Number",
            data: {cilentNumber: cilentNumber},
            success: function (data) {
                console.log(data);
                $('#content_cilent_call').html(data);
            }, error:function(error)
            {
                console.log(error);
            }
        });
    });
</script>  
<script>
    $(document).ready(function(){
        $('#_termination_from').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                type:"POST",
                url: '{{ route('call_checklist.shojon.termination_form') }}',
                data:$('#_termination_from').serialize(),
                success:function(response){
                    console.log(response)
                    $('#TerminationModal').modal('hide')
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
        var i=1;  
        $('#addmore_Treatment').click(function(){  
            i++;  
            $('#dynamic_field_Treatment').append('<tr id="row_formulation'+i+'" class="dynamic-added"><td><input type="text" name="Scheduled[]" placeholder="Scheduled Factor" class="form-control name_list" /></td>  <td><input type="text" name="Attended[]" placeholder="Attended" class="form-control name_list" /></td> <td><input type="text" name="Cancelled[]" placeholder="Cancelled" class="form-control name_list" /></td><td><input type="text" name="notAttend[]" placeholder="Not attend" class="form-control name_list" /></td> <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_Treatment">X</button></td></tr>');  
        });  
        $(document).on('click', '.btn_remove_Treatment', function(){  
            var button_id_formulation = $(this).attr("id");   
            $('#row_formulation'+button_id_formulation+'').remove();  
        });  
    }); 
</script>
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
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#liveSearch_table').DataTable();</script>
<script type="text/javascript">$('#cilentCallTable').DataTable();</script>
@endpush


