@extends('call_checklist.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> <a href="{{ route('call_checklist.kpr.index') }}">{{ $pageTitle }}</span></a>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div>
                        <div class="text-center">
                        <!--    <span class="pull-right hidden-print" style="margin-left: 5px">
                                <a class="btn btn-success btn-sm" href="{{ URL::to('call-checklist/kpr/report/excel/all') }}" target="_blank"><i class="fa fa-download"></i>Excel</a>
                            </span>-->
                            @include('call_checklist._date_range_label')
                        </div>

                        <div class="collapse" id="filter">
                            <div class="alert alert-warning" role="alert">
                                @include('call_checklist.kpr._filter')
                            </div>
                        </div>
                        <hr>
                    </div>

                    <table class="table table-hover table-bordered table-responsive" id="sampleTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> Volunteer ID</th>
                            <th> Date </th>
                            <th> Talk Time </th>
                            <th> Time Call Started </th>
                            <th> Time Call Ended </th>
                            <th> Phone No </th>
                            <th> Caller Name </th>
                            <th> Sex </th>
                            <th> Age </th>
                            <th class="text-center"> Occupation </th>
                            <th class="text-center"> Location </th>
                            <th class="text-center"> Call Type </th>
                            <th class="text-center"> Caller </th>
                            <th class="text-center"> Risk Level </th>
                            <th class="text-center"> Main Reason </th>
                            <th class="text-center"> Secondary Reason </th>
                            <th class="text-center"> Caller Experience </th>
                            <th class="text-center"> Client Referral </th>
                            <th class="text-center"> Caller Descriprion </th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = 0;
                            @endphp

                            @forelse($kprData as $data)
                                <tr>
                                    <td>{{ ++$counter }}</td>
                                    <td>{{ isset($data->agent) ? $data->agent : null }}</td>
                                    <td nowrap>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                    <td>{{  $data->customer_sec }}</td>
                                    <td nowrap>{{ $data->call_started }}</td>
                                    <td nowrap>{{ $data->call_ended }}</td>
                                    <td>{{ isset($data->phone_number) ? $data->phone_number : null }}</td>
                                    <td>{{ $data->caller_name }}</td>
                                    <td>{{ $data->sex }}</td>
                                    <td>{{ $data->age }}</td>
                                    <td>{{ $data->occupation }}</td>
                                    <td>{{ $data->location }}</td>
                                    <td>{{ $data->call_type }}</td>
                                    <td>{{ $data->caller }}</td>
                                    <td>{{ $data->risk_level }}</td>
                                    <td nowrap>{{ $data->main_reason_for_calling }}</td>
                                    <td nowrap>{{ isset($data->secondary_reason_for_calling) ? $data->secondary_reason_for_calling : null }}</td>
                                    <td nowrap>{{ $data->caller_experience }}</td>
                                    <td nowrap>{{ $data->client_referral }}</td>
                                    <td>{{ $data->caller_description }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="15">No Data Found.</td>
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
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush
