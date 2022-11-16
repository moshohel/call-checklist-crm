@extends('call_checklist.app')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Product Table -->
        <div class="card card-table-border-none" id="recent-orders">
          <div class="card-header justify-content-between">
            <h2>All Referrals Request</h2>          
          </div>
          @include('call_checklist.partials.messages')
          <div class="card-body pt-4 pb-5">
            {{-- @include('call_checklist.partials.messages') --}}
            <table class="table card-table table-responsive table-responsive-large" style="width:100%" id="sampleTable">
              <thead>
                <tr>
                  <th>Reffer To</th>
                  <th>Reffer Form</th>
                  <th>Name</th>
                  <th class="d-none d-md-table-cell">Client ID</th>
                  <th class="d-none d-md-table-cell">Already Referred</th>
                  <th class="d-none d-md-table-cell">Referred To</th>
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
                        <td class="d-none d-md-table-cell text-dark already_referred">{{ $referral->already_referred }}</td>
                        <td class="d-none d-md-table-cell text-dark">{{ $referral->referred_therapist_or_psychiatrist }}</td>
                        <td>
                          
                          <a href="{{ route('referral.edit', [$referral->unique_id, $referral->id]) }}" class="btn btn-info btn-default">Edit</a>
                          <a href="{{ route('referral.showInfo', [$referral->unique_id, $referral->id]) }}" class="btn btn-info btn-default">Refer</a>
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
{{-- <script type="text/javascript" src="{{ asset('backend/js/jquery-3.2.1.min.js') }}"></script> --}}
<script type="text/javascript">
  $('#sampleTable').DataTable();

  // $('td:contains(1)').css('background','green');

  const collection = document.getElementsByClassName("already_referred");
  for (let i = 0; i < collection.length; i++) {
    if(collection[i].innerHTML == 0)
    {
      collection[i].style.backgroundColor = "#fcb4b4";
      collection[i].innerHTML = "NO"
    }
    else
    {
      collection[i].style.backgroundColor = "#dfffdf";
      collection[i].innerHTML = "YES"
    }
  }
</script>
@endpush