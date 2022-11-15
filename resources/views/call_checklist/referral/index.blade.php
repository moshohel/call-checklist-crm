@extends('call_checklist.app')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Product Table -->
        <div class="card card-table-border-none" id="recent-orders">
          <div class="card-header justify-content-between">
            <h2>All Referrals Request</h2>          
          </div>
          
          <div class="card-body pt-4 pb-5">
            @include('call_checklist.partials.messages')
            <table class="table card-table table-responsive table-responsive-large" style="width:100%" id="sampleTable">
              <thead>
                <tr>
                  <th>Reffer To</th>
                  <th>Reffer Form</th>
                  <th>Name</th>
                  <th class="d-none d-md-table-cell">Client ID</th>
                  <th class="d-none d-md-table-cell">Options</th>
                  {{-- <th>Options</th> --}}
                </tr>
              </thead>
              <tbody>
                @foreach ($referrals as $referral)
                    <tr>
                        {{-- <td>
                          <a class="text-dark" href="{{ route('referral.show', $referral->id) }}">{{ $referral->name }}</a>
                        </td> --}}
                        <td class="d-none d-md-table-cell text-dark">{{ $referral->referr_to }}</td>
                        <td class="d-none d-md-table-cell text-dark">{{ $referral->referr_from }}</td>
                        <td class="d-none d-md-table-cell text-dark">{{ $referral->name }}</td>
                        <td class="d-none d-md-table-cell text-dark">{{ $referral->unique_id }}</td>
                        <td>
                          
                          <a href="{{ route('referral.edit', [$referral->unique_id, $referral->id]) }}" class="btn btn-info btn-default">Refer</a>
                        </td>
                        {{-- <td class="d-none d-md-table-cell text-dark">{{ $referral->department }}</td> --}}
                        {{-- <td class="d-none d-md-table-cell text-dark">{{ $referral->con_name }}</td> --}}
                        
                    </tr>
                @endforeach
              </tbody>
          
            </table>
          </div>
        </div>
    </div>
  </div>
@endsection


@section('scripts')


@push('scripts')
<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
  $('#sampleTable').DataTable();
</script>
@endpush