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
            
            <div class="col-md-6 col-xl-4 card-body" style="height: 15ch;">
                <a href="{{ route('patient.create',$number) }}" class="btn btn-outline-primary" style="width: 100%; height: 100%;">New
                            Caller</a>
                {{-- <a href="{{ route('call_checklist.shojon.manual_form') }}" class="btn btn-outline-primary" style="width: 100%; height: 100%;">New
                    Caller</a> --}}
            </div>
            <div class="col-md-6 col-xl-4 card-body" style="height: 15ch;">
                <a href="{{ route('patients') }}"
                    class="btn btn-outline-primary" style="width: 100%; height: 100%;">Existing Caller</a>
            </div>
            <div class="col-md-6 col-xl-4 card-body" style="height: 15ch;">
                
                <a href="{{ route('session.rescheduleOrCancelationForm', $number) }}" style="width: 100%; height: 100%;" class="btn btn-outline-primary">Reschedule / Cancelation</a>
                    
            </div>
            {{-- <div class="col-md-6 col-xl-4">
                <div class="card mb-4 py-3">
                    <div class="card-body text-center">
                        <a href="#" class="btn btn-outline-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-4 py-3">
                    <div class="card-body text-center">
                        <a href="#" class="btn btn-outline-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-4 py-3">
                    <div class="card-body text-center">
                        <a href="#" class="btn btn-outline-primary">Go somewhere</a>
                    </div>
                </div>
            </div> --}}

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
    <div id="result" style="display:none;">
        <ul id="id">
            
        </ul>
    </div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>   
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
</script>     
@endsection

