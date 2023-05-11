
    <!-- Product Table -->
    <div class="card card-table-border-none" id="recent-orders">  
        <div class="card-body">
            @include('call_checklist.partials.messages')
            <table class="table table-striped" id="sampleTable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th >Client ID</th>
                    <th class="d-none d-md-table-cell">Preferred time</th>
                    <th class="d-none d-md-table-cell">Referred To</th>
                    <th class="d-none d-md-table-cell">History</th>
                    <th class="d-none d-md-table-cell">Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($referrals as $referral)
                    <tr>
                    
                        <td class="text-dark">{{ $referral->name }}</td>
                        <td class="d-none d-md-table-cell text-dark">{{ $referral->unique_id }}</td>
                        <td class="d-none d-md-table-cell text-dark">{{ $referral->preferred_time }}</td>
                        <td class="d-none d-md-table-cell text-dark">{{ $referral->referred_therapist_or_psychiatrist }}</td>
                        <td>
                            <a href="{{ route('patient.showInfo', [$referral->unique_id]) }}" class="btn btn-info btn-default">History</a>
                        </td>
                        <td>
                            <a href="{{ route('session.create', [$referral->unique_id, $referral->id]) }}" class="btn btn-info btn-default">Appointment</a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            
            </table>
        </div>
    </div>
