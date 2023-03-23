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
                    @include('call_checklist.partials.messages')
                    <div>
                        <div class="text-center">
                            
                        </div>

                        <div class="collapse" id="filter">
                            <div class="alert alert-warning" role="alert">
                                
                            </div>
                        </div>
                        <hr>
                    </div>

                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Time</th>
                            <th>Client ID</th>
                            <th>Phone No</th>
                            <th>Reasion</th>
                            <th>Status</th>
                            <th class="text-center">Action</th> 
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $key=>$row)
                            <tr>
                                <td style="text-align:center;">{{ $key+1 }}</td>
                                <td style="text-align:center;">{{ $row->date }}</td>
                                <td style="text-align:center;">{{ $row->unique_id }}</td>
                                <td style="text-align:center;">{{ $row->phone_number }}</td>
                                <td style="text-align:center;">{{ $row->reason_for_reassing }}</td>
                                <td style="text-align:center;">{{ $row->status }}</td>
                                <td style="text-align:center;"><a href="#"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i></a></td>
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
