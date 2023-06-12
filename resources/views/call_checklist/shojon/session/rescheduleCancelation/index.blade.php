@extends('call_checklist.app')

@section('content')
<!-- Product Table -->
<div class="card card-table-border-none" id="recent-orders">
  <div class="card-body">
    @include('call_checklist.partials.messages')
    <table class="table table-striped" id="sampleTable">
      <thead>
        <tr>
          <th>Name</th>
          <th class="d-none d-md-table-cell">Client ID</th>
          <th class="d-none d-md-table-cell">Phone</th>
          <th class="d-none d-md-table-cell">Reson</th>
          <th class="d-none d-md-table-cell">Status</th>
          <th>Options</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($rescheduleOrCancelations as $rescheduleOrCancelation)
        <tr>

          <td>{{ $rescheduleOrCancelation->name }}</td>
          <td class="d-none d-md-table-cell text-dark">{{ $rescheduleOrCancelation->unique_id }}</td>
          <td class="d-none d-md-table-cell text-dark">{{ $rescheduleOrCancelation->phone_number }}</td>
          <td class="d-none d-md-table-cell text-dark">{{ $rescheduleOrCancelation->reason }}</td>
          <td class="d-none d-md-table-cell text-dark  already_referred">{{ $rescheduleOrCancelation->status }}</td>

          <td>
            {{-- <a href="{{ route('patient.show', ['unique_id' => $rescheduleOrCancelation->unique_id]) }}"
              class="btn btn-info btn-default">Info</a> --}}
            <a href="{{ route('session.sessionRescheduleCancelationShow', [ $rescheduleOrCancelation->id]) }}"
              class="btn btn-info btn-default">Info</a>
          </td>

        </tr>
        @endforeach
      </tbody>

    </table>
  </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>

@endpush

@section('script')
<script type="text/javascript">
  $('#sampleTable').DataTable();

  // $('td:contains(1)').css('background','green');

  const collection = document.getElementsByClassName("already_referred");
  for (let i = 0; i < collection.length; i++) {
    if(collection[i].innerHTML == "NOT DONE")
    {
      collection[i].style.backgroundColor = "#fcb4b4";
    //   collection[i].innerHTML = "NO"
    }
    else
    {
      collection[i].style.backgroundColor = "#dfffdf";
    //   collection[i].innerHTML = "YES"
    }
  }
</script>
@endsection