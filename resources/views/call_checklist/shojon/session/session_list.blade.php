<!-- Product Table -->
<div class="card card-table-border-none" id="recent-orders">
    <div class="card-body">
        @include('call_checklist.partials.messages')
        <table class="table" id="sampleTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th class="d-none d-md-table-cell">Client ID</th>
                    <th class="d-none d-md-table-cell">Session for</th>
                    <th class="d-none d-md-table-cell">Time</th>
                    <th class="d-none d-md-table-cell">Date</th>
                    <th class="d-none d-md-table-cell">Session Taken</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sessions as $session)
                <tr>

                    <td>{{ $session->name }}</td>
                    <td class="d-none d-md-table-cell text-dark">{{ $session->unique_id }}</td>
                    <td class="d-none d-md-table-cell text-dark">{{ $session->referr_to }}</td>
                    <td class="d-none d-md-table-cell text-dark">{{ $session->session_time }}</td>
                    <td class="d-none d-md-table-cell text-dark">{{ $session->session_date }}</td>
                    <td class="d-none d-md-table-cell text-dark">{{ $session->session_taken }}</td>
                    @if ($session->referr_to == "Shojon Tier 2")
                    <td>
                        <a href="{{ route('call_checklist.shojon.tier2.create',  [$session->unique_id, $session->id]) }}"
                            class="btn btn-info btn-default">session</a>
                    </td>
                    @endif
                    @if ($session->referr_to == "Shojon Tier 3")
                    <td>
                        <a href="{{ route('call_checklist.shojon.tierThree.create', [$session->unique_id, $session->id]) }}"
                            class="btn btn-info btn-default">session</a>
                    </td>
                    @endif

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>