@extends('call_checklist.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
<div class="app-title">
    <div>
        <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
    </div>
</div>
<div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div>
                        <div class="text-center">
                            
                        </div>

                        <div class="collapse" id="filter">
                            <div class="alert alert-warning" role="alert">
                                
                            </div>
                        </div>
                        <hr>
                    </div>

                    <table class="table table-hover table-bordered table-responsive" id="sampleTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Phone No</th>
                            <th>Caller ID</th>
                            <th>Caller Name</th>
                            <th> Sex </th>
                            <th> Age </th>
                            <th class="text-center"> Location </th>
                            <th class="text-center"> call Type </th>
                            <th class="text-center">Action</th>
                             
                        </tr>
                        </thead>
                        <tbody>
                             @foreach($data as $key=>$row)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{$row->date}}</td>
                                <td>{{$row->phone_number}}</td>
                                <td>{{$row->caller_id}}</td>
                                <td>{{$row->caller_name}}</td>
                                <td>{{$row->sex}}</td>
                                <td>{{$row->age}}</td>
                                <td>{{$row->location}}</td>
                                <td>{{$row->call_Type}}</td>
                                <td><a href="{{ route('call_checklist.shojon.TierOneview',$row->id) }}"><i class="fa-solid fa-eye"></i></a>
                                 <a href="{{ route('call_checklist.shojon.TierOneedit',$row->caller_id) }}"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  
    

@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush