<div id="accordion" class="accordion">
    @php($i = 1)
    @foreach ($previous_data as $query)
    <?php
     $pre=json_decode($query->mental_illness_diagnosis,true);
     $sec=json_decode($query->secondary_reason,true);
    ?>
    <div class="card">
        <div class="card-header collapsible-title" id="headingOne"
            style="background-color: #f2f2f2;">
            <button class="btn btn-link collapsed" data-toggle="collapse"
                data-target="#collapseOne{{ $query->id }}" aria-expanded="false"
                aria-controls="collapseOne{{ $query->id }}">
                Tier One Service Number - {{ $i++ }}
            </button>
        </div>
        <div id="collapseOne{{ $query->id}}" class="collapse"
            aria-labelledby="headingOne{{ $query->id }}"
            data-parent="#accordion{{ $query->id }}">
            <div class="card-body">
                <div class="media mt-1 profile-reportDetails-media">
                    <div class="media-body">
                        <h5 class="mt-0 text-dark" style="text-align: center;">
                            Query of {{ $query->caller_name }}
                        </h5>
                        <table class="table table-striped table-responsive table-details">
                            <tbody>
                                <tr>
                                    <td>Client Id</td>
                                    <td>{{ $query->caller_id }}</td>
                                </tr>
                                <tr>
                                    <td>Date</td>
                                    <td>{{ $query->date }}</td>
                                </tr>
                                <tr>
                                    <td>Time</td>
                                    <td>{{ $query->time }}</td>
                                </tr>
                                <tr>
                                    <td>Phone number</td>
                                    <td>{{ $query->phone_number }}</td>
                                </tr>
                                <tr>
                                    <td>Sex</td>
                                    <td>{{ $query->sex }}</td>
                                </tr>
                                <tr>
                                    <td>Age</td>
                                    <td>{{ $query->age }}</td>
                                </tr>
                                <tr>
                                    <td>Occupation</td>
                                    <td>{{ $query->occupation }}</td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td>{{ $query->location }}</td>
                                </tr>

                                <tr>
                                    <td>Socio economic</td>
                                    <td>{{ $query->socio_economic }}</td>
                                </tr>
                                
                                <tr>
                                    <td>How you know about Shojon</td>
                                    <td>{{ $query->hear_about_shojon }}</td>
                                </tr>
                                <tr>
                                    <td>Caller</td>
                                    <td>{{ $query->caller }}</td>
                                </tr>
                                <tr>
                                    <td>Distress</td>
                                    <td>{{ $query->distress }}</td>
                                </tr>
                                <tr>
                                    <td>Primary reason</td>
                                    <td>{{ $query->primary_reason }}</td>
                                </tr>
                                <tr>
                                    <td>Secondary reason</td>
                                    <td>
                                        <ul>
                                            @foreach ($sec  as $keys=>$value)
                                            <li>
                                                {{ $value }}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td
                                </tr>
                                <tr>
                                    <td>WHO</td>
                                    <td>{{ $query->who }}</td>
                                </tr>
                                <tr>
                                    <td>Mental illness diagnosis</td>
                                    <td>
                                        <ul>
                                            @foreach ($pre  as $keys=>$value)
                                            <li>
                                                {{ $value }}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Suicidal risk</td>
                                    <td>{{ $query->suicidal_risk }}</td>
                                </tr>

                                <tr>
                                    <td>Effective</td>
                                    <td>{{ $query->effective }}</td>
                                </tr>
                                <tr>
                                    <td>Internal referr</td>
                                    <td>{{ $query->internal_referr }}</td>
                                </tr>
                                
                                <tr>
                                    <td>Reason for referral</td>
                                    <td>{{ $query->reason_for_referral }}</td>
                                </tr>
                                <tr>
                                    <td>Name of agency</td>
                                    <td>{{ $query->name_of_agency }}</td>
                                </tr>
                                
                                <tr>
                                    <td>Call description</td>
                                    <td>{{ $query->call_description }}</td>
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