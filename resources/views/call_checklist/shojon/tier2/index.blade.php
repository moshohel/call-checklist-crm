@extends('call_checklist.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> <a href="{{ route('call_checklist.shojon.index') }}">{{ $pageTitle }}</span></a>
            </h1>
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
                            <th>Service Providers Name</th>
                            <th>Program Name</th>
                            <th>Service Providers ID</th>
                            <th>Time Call Started</th>
                            <th>Date</th>
                            <th>Time Call Ended</th>
                            <th>Duration of Call</th>
                            <th>Phone No</th>
                            <th>Caller</th>
                            <th>Caller ID</th>
                            <th>Caller Name</th>
                            <th> Sex </th>
                            <th> Age </th>
                            <th class="text-center"> Occupation </th>
                            <th class="text-center"> Location </th>
                            <th class="text-center"> SES </th>
                            <th class="text-center"> Educational Qualification </th>
                            <th class="text-center"> Marital Status </th>
                            <th class="text-center"> Session Number </th>
                            <th class="text-center"> Distress Rating </th>
                            <th class="text-center"> Problem duration </th>
                            <th class="text-center"> Hearing Source </th>
                            <th class="text-center"> Call Type </th>
                            <th class="text-center"> Caller </th>
                            <th class="text-center"> Mood Rating (Pre) </th>
                            <th class="text-center"> Main Reason </th>
                            <th class="text-center"> Secondary Reason </th>
                            <th class="text-center"> MID </th>
                            <th class="text-center"> GHQ </th>
                            <th class="text-center"> Suicidal Risk </th>
                            <th class="text-center"> Mood Rating (Post) </th>
                            <th class="text-center"> Caller Effectiveness </th>
                            <th class="text-center"> Client Referral </th>
                            <th class="text-center" style="width: 500px"> Caller Descriprion </th>
                            <th class="text-center"> Client name </th>
                            <th class="text-center"> Age </th>
                            <th class="text-center"> Therapy Reason </th>
                            <th class="text-center"> Phone Number </th>
                            <th class="text-center"> Preferred Time </th>
                            <th class="text-center"> Emergency Number </th>
                            <th class="text-center"> Financial Effort </th>
                            <th class="text-center"> Therapist Prefrrence </th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                            	<td></td>
                            </tr>
                           
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
