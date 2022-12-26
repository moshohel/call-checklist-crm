@extends('call_checklist.app')

@section('content')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Detail of {{ $patient->name }}</h2>
    </div>
    <div class="card-body">
        <div class="" id="recent-orders">
            <table class="table table-responsive table-responsive-large" style="width:100%" id="sampleTable">
                <tr>
                    <th class="d-none d-md-table-cell">Name</th>
                    <td>{{ $patient->name }}</td>
                </tr>
                <tr>
                    <th class="d-none d-md-table-cell">Phone</th>
                    <td>{{ $patient->phone_number }}</td>
                </tr>
                <tr>
                    <th class="d-none d-md-table-cell">Gender</th>
                    <td>{{ $patient->sex }}</td>
                </tr>
                <tr>
                    <th class="d-none d-md-table-cell">Age</th>
                    <td>{{ $patient->age }}</td>
                </tr>
                <tr>
                    <th class="d-none d-md-table-cell">Address</th>
                    <td>{{ $patient->occupotion }}</td>
                </tr>
                <tr>
                    <th class="d-none d-md-table-cell">Department</th>
                    <td>{{ $patient->department }}</td>
                </tr>
                {{-- <tr>
                    <th class="d-none d-md-table-cell">Consultant</th>
                    <td>{{ $consultant->name }}</td>
                </tr>
                --}}
                <tr>
                    <th class="d-none d-md-table-cell">Created At</th>
                    <td>{{ $patient->created_at }}</td>
                </tr>
            </table>
        </div>
        {{-- <div class="modal-body">
            <form action="{!! route('patient.delete', $patient->id) !!}" method="get">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">Permanent Delete</button>
            </form>
        </div> --}}
        <div class="row">
            <div class="col">

                <a href="{{ route('patient.edit', $patient->id) }}" class='btn btn-info'>Edit</a>
            </div>
            <div class="col">

                <a href="#deleteModal{{ $patient->id }}" data-toggle="modal" class="btn btn-danger">Delete</a>
            </div>
        </div>
        <div class="modal fade" id="deleteModal{{ $patient->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are sure to delete?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{!! route('patient.delete', $patient->id) !!}" method="get">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">Permanent Delete</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection