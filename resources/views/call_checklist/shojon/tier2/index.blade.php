@extends('call_checklist.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <div class="app-title">
        <div class="col-md-auto">
            <h1><i class="fa fa-tags"></i> <a href="{{ route('call_checklist.shojon.index') }}">{{ $pageTitle }}</span></a>
            </h1>
        </div>
        <div class="col-md-auto">
        <form action="{{ route('shojonTierTow.report.picker') }}" method="get">
	  		<div class="row">
                <div class="col-md-12">
                    <div class="row g-3">
                       <div class="col-md-5">
                         <div class="form-group">
                             <input name="FromDate"  placeholder="From Date" class="form-control">
                         </div>
                     </div>
                     <div class="col-md-5">
                         <div class="form-group">
                             <input name="toDate" placeholder="To Date" class="form-control">
                         </div>
                     </div>
                     <div class="col-md-2">
                         <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="button" value="Download">
                        </div>
                    </div>
                </div>
	  		</div>
        </div>
  		</form>
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

                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Phone No</th>
                            
                            <th>Caller Name</th>
                            <th> Sex </th>
                            <th> Age </th>
                            <th class="text-center"> Location </th>
                            <th class="text-center"> Session Number </th>
                            <th class="text-center">Action</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                             @foreach($data as $key=>$row)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{$row->date}}</td>
                                <td>{{$row->phone_number}}</td>
                                
                                <td>{{$row->caller_name}}</td>
                                <td>{{$row->sex}}</td>
                                <td>{{$row->age}}</td>
                                <td>{{$row->location}}</td>
                                <td>{{$row->session}}</td>
                                <td><a href="{{ route('shojon.tireTwo.view',$row->id) }}"><i class="fa-solid fa-eye"></i></a>
                                 <a href="{{ route('shojon.tireTwo.edit',$row->id) }}"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>
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

