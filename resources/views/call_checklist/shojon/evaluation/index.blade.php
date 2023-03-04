@extends('call_checklist.app')
@section('title') {{ $pageTitlelist }} @endsection
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
<div class="app-title">
    <div>
        <h1><i class="fa fa-tags"></i> {{ $pageTitlelist }}</h1>
    </div>
</div>
<div class="row">
        <div class="col-md-12">
            <div class="tile">
                <a href="{{ route('call_checklist.shojon.evaluationExcel') }}" class="btn btn-info btn-default">Excel</a>
                <div class="tile-body">
                    @include('call_checklist.partials.messages')
                    <div>
                        <div class="text-center">
                            <a href="{{ route('call_checklist.shojon.callEvaluation') }}" class="btn btn-info btn-default mt-2 mb-2" style="float: right;">New Evalution</a>
                        </div>

                        <div class="collapse" id="filter">
                            <div class="alert alert-warning" role="alert">
                                {{-- <a href="{{ route('register') }}" class="btn btn-info btn-default" style="float: right;">New User</a> --}}
                            </div>
                        </div>
                        <hr>
                    </div>
                    

                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date and Time</th>
                            <th>Observer's Name</th>
                            <th>Counselor's Name</th>
                            <th>Total duration of the Call (Minutes) </th>
                            <th>Call Rating</th>
                            <th class="text-center">Action</th>
                             
                        </tr>
                        </thead>
                        <tbody>
                             @foreach($data as $key=>$row)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$row->date}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->counselor_name}}</td>
                                <td>{{$row->duration_call}}</td>
                                <td>{{$row->rating_score}}</td>
                                <td><a href="{{ route('call_checklist.shojon.evaluationdetalis',$row->id) }}"><i class="fa-solid fa-eye"></i></a>
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