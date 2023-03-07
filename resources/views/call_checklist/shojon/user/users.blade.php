@extends('call_checklist.app')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Product Table -->
        <div class="card card-table-border-none" id="recent-orders">
          <div class="card-header justify-content-between">
            <div>
              <h2>User List</h2>
              <a href="{{ route('register') }}" class="btn btn-info btn-default" style="float: right;">New User</a>
            </div>
          </div>
          <div class="card-body pt-4 pb-5">
            @include('call_checklist.partials.messages')
            <table class="table card-table" id="sampleTable">
              <thead>
                <tr>
                  <th>User Name</th>
                  <th>Name</th>
                  <th class="d-none d-md-table-cell">User Type</th>
                  <th class="d-none d-md-table-cell">Options</th>
                  <th>Created Time</th>
                  {{-- <th>Options</th> --}}
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                    <tr>
                        {{-- <td>
                          <a class="text-dark" href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a>
                        </td> --}}
                        @if(isset($user->user)) 
                        <td class="d-none d-md-table-cell text-dark">{{ $user->user }}</td>
                        @endif
                      
                        @if(isset($user->full_name)) 
                        <td class="d-none d-md-table-cell text-dark">{{ $user->full_name }}</td>
                        @endif
                        @if(isset($user->user_group)) 
                        <td class="d-none d-md-table-cell text-dark">{{ $user->user_group }}</td>
                        @endif
                        <td>
                          <a href="{{ route('user.show', $user->user_id) }}" class="btn btn-info btn-default">Details</a>
                          <a href="{{ route('user.edit', $user->user_id) }}" class="btn btn-info btn-default">Edit</a>
                        </td>
                        @if(isset($user->created_at)) 
                        <td class="d-none d-md-table-cell text-dark">{{ $user->created_at }}</td>
                        @endif
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

