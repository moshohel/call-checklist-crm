@extends('call_checklist.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Call From - {{ $number }}</h2>
    </div>
    @include('call_checklist.partials.messages')
    <div class="card-body">
        <div class="row">

            <div class="col-md-6 col-xl-4 card-body text-center" style="height: 15ch;">
                <a href="{{ route('patient.create',$number) }}" class="btn btn-primary text-center" style="width: 100%; height: 100%;">New
                Caller</a>
            </div>
            <div class="col-md-6 col-xl-4 card-body text-center " style="height: 15ch;">
                <a href="{{ route('patients') }}"
                class="btn btn-primary text-center" style="width: 100%; height: 100%;">Exiting
            Caller</a>
        </div>
        <div class="col-md-6 col-xl-4 card-body text-center" style="height: 15ch;">

            <a href="{{ route('session.rescheduleOrCancelationForm', $number) }}" style="width: 100%; height: 100%;" class="btn btn-primary text-center">Reschedule / Cancelation</a>

        </div>
    </div>
    <div class="row">

        <div class="col-md-6 col-xl-4 card-body text-center" style="height: 15ch;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Cilent_call_Modal" style="width: 100%; height: 100%;">Client call</button>
        </div>
        <div class="col-md-6 col-xl-4 card-body text-center" style="height: 15ch;" style="width: 100%; height: 100%;" >
            <a href="#"
            class="btn btn-primary text-center" style="width: 100%; height: 100%;">Doctor Re-Assigning</a>
        </div>
        <div class="col-md-6 col-xl-4 card-body" style="height: 15ch;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#TerminationModal" style="width: 100%; height: 100%;">Termination</button>
        </div>
    </div>
</div>
</div>
@include('call_checklist.shojon.tier2.Termination_form')
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
            <table class="table table-hover table-bordered" id="sampleTable">
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
                      <h2>All Cilent Call</h2>
                  </div>
                  <hr>
              </div>
              <table class="table table-hover table-bordered" id="sampleTable_cl">
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
<div class="modal fade" id="Cilent_call_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
@include('call_checklist.shojon.tier2.Termination_form')
<script type="text/javascript" src="{{ asset('backend/js/jquery-3.2.1.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
                success: function (data) {
                    console.log(data);
                    $('#content').html(data);
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
        var cilentNumber = $("#Number").val();
        $.ajax({
            type: "get",
            url: "/patient/cilent_call_Number",
            data: {cilentNumber: cilentNumber},
            success: function (data) {
                console.log(data);
                $('#content_cilent_call').html(data);
            }
        });
    });
</script>    
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script type="text/javascript">$('#sampleTable_cl').DataTable();</script>
@endpush

