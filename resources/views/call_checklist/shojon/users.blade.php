@extends('call_checklist.app')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Product Table -->
        <div class="card card-table-border-none" id="recent-orders">
          <div class="card-header justify-content-between">
            <h2>All users</h2>
            {{-- <div class="date-range-report ">
              <span>Jan 25, 2021 - Feb 23, 2021</span>
            </div> --}}
          </div>
          
          <div class="card-body pt-4 pb-5">
            @include('call_checklist.partials.messages')
            <table class="table card-table table-responsive table-responsive-large" style="width:100%" id="sampleTable">
              <thead>
                <tr>
                  <th>Last Login</th>
                  <th>User Name</th>
                  <th>Name</th>
                  <th class="d-none d-md-table-cell">User Type</th>
                  {{-- <th>Options</th> --}}
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                    <tr>
                        {{-- <td>
                          <a class="text-dark" href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a>
                        </td> --}}
                        <td class="d-none d-md-table-cell text-dark">{{ $user->last_login_date }}</td>
                        <td class="d-none d-md-table-cell text-dark">{{ $user->user }}</td>
                        <td class="d-none d-md-table-cell text-dark">{{ $user->full_name }}</td>
                        <td class="d-none d-md-table-cell text-dark">{{ $user->user_group }}</td>
                        {{-- <td class="d-none d-md-table-cell text-dark">{{ $user->department }}</td> --}}
                        {{-- <td class="d-none d-md-table-cell text-dark">{{ $user->con_name }}</td> --}}
                        
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

