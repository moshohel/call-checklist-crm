<div id="accordion" class="accordion">
    @php($i = 1)
    @foreach ($tierTwo as $query)
    <?php
     $dia=json_decode($query->diagnosis,true);
     $con=json_decode($query->concern_history,true);
     $diff=json_decode($query->differential_diagnosis,true);
    ?>
        <div class="card">
            <div class="card-header collapsible-title" id="headingTwo"
                style="background-color: #f2f2f2;">
                <button class="btn btn-link collapsed" data-toggle="collapse"
                    data-target="#collapseTwo{{ $query->id }}" aria-expanded="false"
                    aria-controls="collapseTwo{{ $query->id }}">
                    Tier Two Service Number - {{ $i++ }}
                </button>
            </div>
            <div id="collapseTwo{{ $query->id}}" class="collapse"
                aria-labelledby="headingTwo{{ $query->id }}"
                data-parent="#accordion{{ $query->id }}">
                <div class="card-body">
                    <div class="media mt-1 profile-reportDetails-media">
                        <div class="media-body">
                            <h5 class="mt-0 text-dark" style="text-align: center;">
                                Client Name - {{ $query->caller_name }}
                            </h5>
                            <table class="table table-striped table-responsive table-details">
                                <tbody>
                                    <tr>
                                        <td>Client Id</td>
                                        <td>{{ $query->caller_id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Service Provider name</td>
                                        <td>{{ $query->service_providers_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Date</td>
                                        <td>{{ $query->date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone number</td>
                                        <td>{{ $query->phone_number }}</td>
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
                                        <td>Education</td>
                                        <td>{{ $query->education }}</td>
                                    </tr>
                                    <tr>
                                        <td>Marital</td>
                                        <td>{{ $query->marital }}</td>
                                    </tr>
                                    <tr>
                                        <td>Session</td>
                                        <td>{{ $query->session }}</td>
                                    </tr>
                                    <tr>
                                        <td>Distress</td>
                                        <td>{{ $query->distress }}</td>
                                    </tr>
                                    <tr>
                                        <td>WHO</td>
                                        <td>{{ $query->WHO }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Symptoms</td>
                                        <td>{{ $query->symptoms }}</td>
                                    </tr>
                                    <tr>
                                        <td>Severity</td>
                                        <td>{{ $query->severity }}</td>
                                    </tr>

                                    <tr>
                                        <td>Problem duration</td>
                                        <td>{{ $query->problem_duration }}</td>
                                    </tr>
                                    <tr>
                                        <td>Family history</td>
                                        <td>{{ $query->family_history }}</td>
                                    </tr>

                                    <tr>
                                        <td>Suicidal ideation</td>
                                        <td>{{ $query->suicidal_ideation }}</td>
                                    </tr>
                                    <tr>
                                        <td>Self harm history</td>
                                        <td>{{ $query->self_harm_history }}</td>
                                    </tr>
                                    <tr>
                                        <td>Diagnosis</td>
                                        <td>
                                            <ul>
                                                @foreach ($dia  as $keys=>$value)
                                                <li>
                                                    {{ $value }}
                                                </li>
                                                @endforeach
                                            </ul>
                                        </td
                                    </tr>
                                    <tr>
                                        <td>Psychiatric medication</td>
                                        <td>{{ $query->psychiatric_medication }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Name of medicine</td>
                                        <td>{{ $query->name_of_medicine }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Concern history</td>
                                        <td>
                                            <ul>
                                                @foreach ($con  as $keys=>$value)
                                                <li>
                                                    {{ $value }}
                                                </li>
                                                @endforeach
                                            </ul>
                                        </td
                                    </tr>
                                    
                                    <tr>
                                        <td>Differential diagnosis</td>
                                        <td>
                                            <ul>
                                                @foreach ($diff  as $keys=>$value)
                                                <li>
                                                    {{ $value }}
                                                </li>
                                                @endforeach
                                            </ul>
                                        </td
                                    </tr>
                                    <tr>
                                        <td>Tool name</td>
                                        <td>{{ $query->tool_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Score</td>
                                        <td>{{ $query->score }}</td>
                                    </tr>
                                    <tr>
                                        <td>Therapy</td>
                                        <td>{{ $query->therapy }}</td>
                                    </tr>
                                    <tr>
                                        <td>Predisposing</td>
                                        <td>{{ $query->predisposing }}</td>
                                    </tr>
                                    <tr>
                                        <td>Precipitatory</td>
                                        <td>{{ $query->precipitatory }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Perpetuating</td>
                                        <td>{{ $query->perpetuating }}</td>
                                    </tr>
                                    <tr>
                                        <td>Protective</td>
                                        <td>{{ $query->protective }}</td>
                                    </tr>

                                    <tr>
                                        <td>Short term</td>
                                        <td>{{ $query->short_term }}</td>
                                    </tr>
                                    <tr>
                                        <td>Long term</td>
                                        <td>{{ $query->long_term }}</td>
                                    </tr>

                                    <tr>
                                        <td>Intervention</td>
                                        <td>{{ $query->intervention }}</td>
                                    </tr>
                                    <tr>
                                        <td>Homework</td>
                                        <td>{{ $query->homework }}</td>
                                    </tr>
                                    <tr>
                                        <td>Effective</td>
                                        <td>{{ $query->effective }}</td>
                                    </tr>
                                    <tr>
                                        <td>Internal referral</td>
                                        <td>{{ $query->internal_referral }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>External referral</td>
                                        <td>{{ $query->external_referral }}</td>
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
                                        <td>Client referral</td>
                                        <td>{{ $query->client_referral }}</td>
                                    </tr>

                                    <tr>
                                        <td>Session plan</td>
                                        <td>{{ $query->session_plan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Session summary</td>
                                        <td>{{ $query->session_summary }}</td>
                                    </tr>
                                    <tr>
                                        <td>Next session date</td>
                                        <td>{{ $query->next_session_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Next session time</td>
                                        <td>{{ $query->next_session_time }}</td>
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