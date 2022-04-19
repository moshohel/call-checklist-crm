@if ($is_phone_no)
<div class="row">
    <div class="col-md-12">
       <button style="height: 40px" id = "show" type="button" onclick="show()">Show existing records</button>
       <button style="height: 40px; display: none" id = "hide"  type="button" onclick="hide()">Hide existing records</button>
    </div>
</div>
<br>
@endif

<div id ="to_be_hidden" class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">

                <table class="table table-hover table-bordered table-responsive" id="sampleTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th> Call Received Date </th>
                        <th class="text-center"> Occupation </th>
                        <th class="text-center"> Call Type </th>
                        <th class="text-center" nowrap> Main Reason </th>
                        <th class="text-center">
                            <abbr title="Mental Illness Diagnosis">MID</abbr>
                        </th>
                        <th class="text-center"> GHQ </th>
                        <th class="text-center"> Suicidal Risk </th>
                        <th class="text-center"> Client Referral </th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 0;
                        @endphp

                        @foreach($previous_data as $data)
                            <tr>
                                <td>{{ ++$counter }}</td>
                                <td>{{ $data->call_received }}</td>
                                <td>{{ $data->occupation }}</td>
                                <td>{{ $data->call_type }}</td>
                                <td nowrap>{{ $data->main_reason_for_calling }}</td>
                                <td nowrap>{{ $data->mental_illness_diagnosis }}</td>
                                <td>{{ $data->ghq }}</td>
                                <td>{{ $data->suicidal_risk }}</td>
                                <td>{{ $data->client_referral }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>

    $(document).ready(function() {
        //$("#hide").show();
        $("#to_be_hidden").hide();
    });

    function show(){
        $("#to_be_hidden").show();
        $("#show").hide();
        $("#hide").show();
    }

    function hide(){
        $("#to_be_hidden").hide();
        $("#hide").hide();
        $("#show").show();

    }

</script>
