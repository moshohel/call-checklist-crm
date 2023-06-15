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
                    <th class="d-none d-md-table-cell">Cancel</th>
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
                    <td class="d-none d-md-table-cell text-dark">
                        <a href="#deleteModal{{ $session->id }}" data-toggle="modal" class="btn btn-danger">Cancel
                            Session</a>
                    </td>
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

                <div class="modal fade" id="deleteModal{{ $session->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are you sure to Cancel?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{!! route('session.sessionCancelation', $session->id) !!}" method="get">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger">Sure!!! You want to Cancel the
                                        Session</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>

        </table>
    </div>
</div>