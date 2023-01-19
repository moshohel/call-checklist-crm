@extends('call_checklist.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Call From - {{ $number }}</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
              
                <div class="row g-2">
                <div class="col-md-4">
                   <input type="text" class="form-control" id="search" name="Search" placeholder="Search exiting">  
                </div>
                </div>
            <hr> 
            

            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card mb-4 py-3">
                    <div class="card-body text-center">
                        {{-- <h5 class="card-title text-primary">Card Title</h5> --}}

                        <a href="{{ route('patient.create',$number) }}" class="btn btn-outline-primary">New
                            Caller</a>
                            
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-4 py-3">
                    <div class="card-body text-center">
                        {{-- <h5 class="card-title text-primary">Card Title</h5> --}}
                        {{-- <a
                            href="{!! route('call_checklist.shojon.create', ['referrence_id'=>1, 'phone_number'=> $number ]) !!}"
                            class="btn btn-outline-primary">Exiting
                            Caller</a> --}}
                        {{-- <a
                            href="{{ route('call_checklist.shojon.create',  ['referrence_id'=>1, 'phone_number'=> $number ] ) }}"
                            class="btn btn-outline-primary">Exiting
                            Caller</a> --}}
                        <a href="#"
                            class="btn btn-outline-primary">Exiting
                            Caller</a>
                        {{-- <a href="/call-checklist/shojon/create/9876/{{ $number }}"
                            class="btn btn-outline-primary">Exiting Caller</a> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-4 py-3">
                    <div class="card-body text-center">
                        {{-- <h5 class="card-title text-primary">Card Title</h5> --}}

                        <a href="#" class="btn btn-outline-primary">Appoinment Request</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-4 py-3">
                    <div class="card-body text-center">
                        {{-- <h5 class="card-title text-primary">Card Title</h5> --}}

                        <a href="#" class="btn btn-outline-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-4 py-3">
                    <div class="card-body text-center">
                        {{-- <h5 class="card-title text-primary">Card Title</h5> --}}

                        <a href="#" class="btn btn-outline-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-4 py-3">
                    <div class="card-body text-center">
                        {{-- <h5 class="card-title text-primary">Card Title</h5> --}}

                        <a href="#" class="btn btn-outline-primary">Go somewhere</a>
                    </div>
                </div>
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
                          <h2>Search Datas</h2>
                        </div>
                        <hr>
                    </div>
                    <table class="table table-hover table-bordered table-responsive" id="sampleTable">
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

