<div id="accordion" class="accordion">
    @php($i = 1)
    @foreach ($previous_data as $query)
    <div class="card">
        <div class="card-header collapsible-title" id="headingThree"
            style="background-color: #f2f2f2;">
            <button class="btn btn-link collapsed" data-toggle="collapse"
                data-target="#collapseThree{{ $query->id }}" aria-expanded="false"
                aria-controls="collapseThree{{ $query->id }}">
                Tier Three Service Number - {{ $i++ }}
            </button>
        </div>
        <div id="collapseThree{{ $query->id}}" class="collapse"
            aria-labelledby="headingThree{{ $query->id }}"
            data-parent="#accordion{{ $query->id }}">
            <div class="card-body">
                <div class="media mt-1 profile-reportDetails-media">
                    <div class="media-body">
                        <h5 class="mt-0 text-dark" style="text-align: center;">
                            Query of {{ $query->name }}
                        </h5>
                        <table class="table table-striped table-responsive table-details">
                            <tbody>
                                {{-- <tr>
                                    <td>$query->ID</td>
                                    <td>{{ $query->id }}</td>
                                </tr> --}}
                                <tr>
                                    <td>Call Received</td>
                                    <td>{{ $query->call_received }}</td>
                                </tr>
                                <tr>
                                    <td>Occupation</td>
                                    <td>{{ $query->occupation }}</td>
                                </tr>
                                <tr>
                                    <td>Call Type</td>
                                    <td>{{ $query->call_type }}</td>
                                </tr>
                                <tr>
                                    <td>Main Reason for Calling</td>
                                    <td>{{ $query->main_reason_for_calling }}</td>
                                </tr>
                                <tr>
                                    <td>Mental illness diagnosis</td>
                                    <td>{{ $query->mental_illness_diagnosis }}</td>
                                </tr>
                                <tr>
                                    <td>GHQ</td>
                                    <td>{{ $query->ghq }}</td>
                                </tr>

                                <tr>
                                    <td>Suicidal  risk</td>
                                    <td>{{ $query->suicidal_risk }}</td>
                                </tr>
                                <tr>
                                    <td>Client Referral</td>
                                    <td>{{ $query->client_referral }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>