@extends('call_checklist.app')

@section('content')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Reffer</h2>
    </div>
    <div class="card-body">
        <div class="" id="recent-orders">
            <table class="table table-responsive table-responsive-large" style="width:100%" id="sampleTable">
                <tr>
                    <th class="d-none d-md-table-cell">Name</th>
                    <td>{{ $referral[0]->name }}</td>
                </tr>
                <tr>
                    <th class="d-none d-md-table-cell">Phone</th>
                    <td>{{ $referral[0]->phone_number }}</td>
                </tr>
                <tr>
                    <th class="d-none d-md-table-cell">referr_to</th>
                    <td>{{ $referral[0]->referr_to }}</td>
                </tr>
                <tr>
                    <th class="d-none d-md-table-cell">Age</th>
                    <td>{{ $referral[0]->age }}</td>
                </tr>
                <tr>
                    <th class="d-none d-md-table-cell">Referr From</th>
                    <td>{{ $referral[0]->referr_from }}</td>
                </tr>
                <tr>
                    <th class="d-none d-md-table-cell">Preferred Therapist/Psychiatrist</th>
                    <td>{{ $referral[0]->preferred_therapist_or_psychiatrist }}</td>
                </tr>
                <tr>
                    <th class="d-none d-md-table-cell">Preferre Time</th>
                    <td>{{ $referral[0]->preferred_time }}</td>
                </tr>
            </table>
        </div>
        
        <div class="row">
            
            <div class="col">

                <a href="#deleteModal{{ $referral[0]->id }}" data-toggle="modal" class="btn btn-danger">Reffer</a>
            </div>
        </div>
        <div class="modal fade" id="deleteModal{{ $referral[0]->id }}" tabindex="-1" role="dialog"
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
                        <form action="{!! route("referral.referConsultant", $referral[0]->id) !!}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group col-6">
                                <label for="exampleFormControlInput7">Preferred Contultent</label>
                                <input type="text" class="form-control" name="preferred_therapist_or_psychiatrist" readonly  value="{{ $referral[0]->preferred_therapist_or_psychiatrist }}" id="exampleFormControlInput7"
                                    placeholder="No Preferrence" >
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleFormControlInput7">Preferred Time</label>
                                <input type="text" class="form-control" name="preferred_time" readonly  value="{{ $referral[0]->preferred_time }}" id="exampleFormControlInput7"
                                    placeholder="No Preferrence" >
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleFormControlSelect3">Consultent</label>
                                <select class="form-control" name="referred_therapist_or_psychiatrist_user_id" value=""
                                    id="exampleFormControlSelect3">
                                    <option value="" disabled selected hidden>Consultent</option>
                                    @foreach ($consultants as $consultant)
                                    <option value="{{ $consultant->user_id }}">{{ $consultant->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger">Reffer</button>
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