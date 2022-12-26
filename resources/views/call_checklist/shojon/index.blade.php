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
                        @include('call_checklist._date_range_label')
                    </div>
                    @include('call_checklist.partials.messages')
                    <div class="collapse" id="filter">
                        <div class="alert alert-warning" role="alert">
                            @include('call_checklist.shojon._filter')
                        </div>
                    </div>
                    <hr>
                </div>

                <table class="table table-hover table-bordered table-responsive" id="sampleTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Volunteer ID</th>
                            <th>Date</th>
                            <th>Talk Time</th>
                            <th>Time Call Started</th>
                            <th>Time Call Ended</th>
                            <th> Phone No </th>
                            <th> Caller Name </th>
                            <th> Sex </th>
                            <th> Age </th>
                            <th class="text-center"> Occupation </th>
                            <th class="text-center"> SES </th>
                            <th class="text-center"> Location </th>
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
                        @php
                        $counter = 0;
                        @endphp

                        @forelse($shojonData as $data)
                        <tr>
                            <td>{{ ++$counter }}</td>
                            <td>{{ isset($data->agent) ? $data->agent : null }}</td>
                            <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                            <td>{{ $data->customer_sec }}</td>
                            <td>{{ isset($data->call_started)?explode(' ',$data->call_started,2)[1]:" " }}</td>
                            <td>{{ isset($data->call_ended)?explode(' ',$data->call_ended,2)[1]:" " }}</td>
                            <td>{{ $data->phone_number }}</td>
                            <td>{{ $data->caller_name }}</td>
                            <td>{{ $data->sex }}</td>
                            <td>{{ $data->age }}</td>
                            <td>{{ $data->occupation }}</td>
                            <td>{{ $data->socio_economic_status }}</td>
                            <td>{{ $data->location }}</td>
                            <td>{{ $data->hearing_source }}</td>
                            <td>{{ $data->call_type }}</td>
                            <td>{{ $data->caller }}</td>
                            <td>{{ $data->pre_mood_rating }}</td>
                            <td>{{ $data->main_reason_for_calling }}</td>
                            <td>{{ $data->secondary_reason_for_calling }}</td>
                            <td>{{ $data->mental_illness_diagnosis }}</td>
                            <td>{{ $data->ghq }}</td>
                            <td>{{ $data->suicidal_risk }}</td>
                            <td>{{ $data->post_mood_rating }}</td>
                            <td>{{ $data->call_effectivenes }}</td>
                            <td>{{ $data->client_referral }}</td>
                            <td style="width: 500px">{{ $data->caller_description }}</td>
                            <td>{{ $data->ref_client_name }}</td>
                            <td>{{ $data->ref_age }}</td>
                            <td>{{ $data->ref_therapy_reason }}</td>
                            <td>{{ $data->ref_phone_number }}</td>
                            <td>{{ $data->ref_preferred_time }}</td>
                            <td>{{ $data->ref_emergency_number }}</td>
                            <td>{{ $data->ref_financial_affort }}</td>
                            <td>{{ $data->ref_therapist_preference }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="24">No Data Found.</td>
                        </tr>
                        @endforelse
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
<script type="text/javascript">
    $('#sampleTable').DataTable();
</script>
@endpush