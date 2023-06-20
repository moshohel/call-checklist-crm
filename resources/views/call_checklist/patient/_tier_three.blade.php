<div id="accordion" class="accordion">
    @php($i = 1)
    @if(isset($tierThree))
    @foreach ($tierThree as $query)
    <?php
        $dia=json_decode($query->diagnosis,true);
        $con=json_decode($query->concern_history,true);
        $diff=json_decode($query->differential_diagnosis,true);
        ?>
    <div class="card">
        <div class="card-header collapsible-title" id="headingThree" style="background-color: #f2f2f2;">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree{{ $query->id }}"
                aria-expanded="false" aria-controls="collapseThree{{ $query->id }}">
                Tier Three Service Number - {{ $i++ }}
            </button>
        </div>
        <div id="collapseThree{{ $query->id}}" class="collapse" aria-labelledby="headingThree{{ $query->id }}"
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
                                    <td>Appearance</td>
                                    <td>{{ $query->appearance }}</td>
                                </tr>
                                <tr>
                                    <td>Behavior</td>
                                    <td>{{ $query->behavior }}</td>
                                </tr>
                                <tr>
                                    <td>Speech</td>
                                    <td>{{ $query->speech }}</td>
                                </tr>
                                <tr>
                                    <td>Affect</td>
                                    <td>{{ $query->affect }}</td>
                                </tr>
                                <tr>
                                    <td>Thought</td>
                                    <td>{{ $query->thought }}</td>
                                </tr>
                                <tr>
                                    <td>Perception</td>
                                    <td>{{ $query->perception }}</td>
                                </tr>

                                <tr>
                                    <td>Cognition</td>
                                    <td>{{ $query->cognition }}</td>
                                </tr>
                                <tr>
                                    <td>Judgement</td>
                                    <td>{{ $query->judgement }}</td>
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
                                    <td>Birth history</td>
                                    <td>{{ $query->birth_history }}</td>
                                </tr>
                                <tr>
                                    <td>Problem history</td>
                                    <td>{{ $query->problem_history }}</td>
                                </tr>

                                <tr>
                                    <td>Substance history</td>
                                    <td>{{ $query->substance_history }}</td>
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
                                    @if(isset($con))
                                    <td>
                                        <ul>
                                            @foreach ($dia as $keys=>$value)
                                            <li>
                                                {{ $value }}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Previous medication</td>
                                    <td>{{ $query->previous_medication }}</td>
                                </tr>

                                <tr>
                                    <td>Name of medicine</td>
                                    <td>{{ $query->name_of_medicine }}</td>
                                </tr>

                                <tr>
                                    <td>Concern history</td>
                                    @if(isset($con))
                                    <td>
                                        <ul>
                                            @foreach ($con as $keys=>$value)
                                            <li>
                                                {{ $value }}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    @endif
                                </tr>

                                <tr>
                                    <td>Differential diagnosis</td>
                                    @if(isset($con))
                                    <td>
                                        <ul>
                                            @foreach ($diff as $keys=>$value)
                                            <li>
                                                {{ $value }}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    @endif
                                </tr>

                                <tr>
                                    <td>Prescribed medications</td>
                                    <td>{{ $query->prescribed_medications }}</td>
                                </tr>
                                <tr>
                                    <td>Psychotherapy session suggested</td>
                                    <td>{{ $query->psychotherapy_session_suggested }}</td>
                                </tr>
                                <tr>
                                    <td>Client ability buy medicine</td>
                                    <td>{{ $query->client_ability_buy_medicine }}</td>
                                </tr>
                                <tr>
                                    <td>Suitable session type</td>
                                    <td>{{ $query->suitable_session_type }}</td>
                                </tr>
                                {{-- <tr>
                                    <td>Precipitatory</td>
                                    <td>{{ $query->precipitatory }}</td>
                                </tr> --}}

                                {{-- <tr>
                                    <td>Perpetuating</td>
                                    <td>{{ $query->perpetuating }}</td>
                                </tr> --}}
                                {{-- <tr>
                                    <td>Protective</td>
                                    <td>{{ $query->protective }}</td>
                                </tr> --}}

                                {{-- <tr>
                                    <td>Short term</td>
                                    <td>{{ $query->short_term }}</td>
                                </tr> --}}
                                {{-- <tr>
                                    <td>Long term</td>
                                    <td>{{ $query->long_term }}</td>
                                </tr> --}}

                                {{-- <tr>
                                    <td>Intervention</td>
                                    <td>{{ $query->intervention }}</td>
                                </tr> --}}
                                {{-- <tr>
                                    <td>Homework</td>
                                    <td>{{ $query->homework }}</td>
                                </tr> --}}
                                <tr>
                                    <td>Effective</td>
                                    <td>{{ $query->effective }}</td>
                                </tr>
                                {{-- <tr>
                                    <td>Internal referral</td>
                                    <td>{{ $query->internal_referral }}</td>
                                </tr> --}}

                                {{-- <tr>
                                    <td>External referral</td>
                                    <td>{{ $query->external_referral }}</td>
                                </tr> --}}
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
    @endif
</div>