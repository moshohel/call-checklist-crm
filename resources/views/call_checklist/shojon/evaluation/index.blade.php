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
                            <th>Date and Time</th>
                            <th>Observer's Name</th>
                            <th>Counselor's Name</th>
                            <th>Total duration</th>
                            <th>Call Rating</th>
                            <th class="text-center">Action</th>
                             
                        </tr>
                        </thead>
                        <tbody>
                             @foreach($data as $key=>$row)
                            <tr>
                                <td>{{$key}}</td>
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