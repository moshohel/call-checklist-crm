@extends('call_checklist.app')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@section('content')
<div class="row">
  <div class="col-12">
    <!-- Product Table -->
    <div class="card card-table-border-none" id="recent-orders">
      <div class="card-header justify-content-between">
        <h2 class="pb-4">All Clients</h2>
        <div class="btn-group">
          <a id="print_excel" href="#" class="btn btn-sm btn-secondary" style="display: none">
            <i class="mdi mdi-content-save"></i> Download Excel</a>
          <a id="print_pdf" class="btn btn-sm btn-secondary" style="display: none">
            <i class="mdi mdi-printer" id="print_icon"></i> Download PDF</a>
        </div>
      </div>
      @include('call_checklist.partials.messages')
      {{-- Filter --}}
      <form class="pt-4 card-body" action="{{ route('patient.search') }}" method="get" enctype="multipart/form-data"
        id="search">
        @csrf
        <div class="row ">
          <div class="form-group col-3" id="from_date">
            <label for="exampleFormControlInput6">Start Date</label>
            <input type="date" class="form-control" name="from_date" id="exampleFormControlInput6"
              placeholder="Chamber Time">
          </div>
          <div class="form-group col-3" id="to_date">
            <label for="exampleFormControlInput5"> End Date</label>
            <input type="date" class="form-control" name="to_date" id="exampleFormControlInput5"
              placeholder="Chamber Time">
          </div>
          <div class="form-group col-3" id="unique_id">
            <label for="exampleFormControlInput5">Client ID</label>
            <input type="text" class="form-control" name="unique_id" id="exampleFormControlInput5"
              placeholder="Client Id">
          </div>

        </div>
        <div class="row">
          <div class="form-group col-3" id="phone_number">
            <label for="exampleFormControlInput5">Phone Number</label>
            <input type="number" class="form-control" name="phone_number" id="exampleFormControlInput5"
              placeholder="Phone Number" min="">
          </div>
          <div class="form-footer pt-2 mt-4 ml-4">
            <button type="submit" class="btn btn-info btn-default" id="search-btn">Search</button>
          </div>
        </div>
      </form>

      <div class="card-body pt-0 pb-5">
        {{-- @include('partials.messages') --}}
        <table class="table card-table" style="width:100%" id="sampleTable">
          <thead>
            <tr>
              <th>Name</th>
              <th class="d-none d-md-table-cell">Phone</th>
              <th>Gender</th>
              <th>Age</th>
              <th class="d-none d-md-table-cell">Address</th>
              <th>Client Id</th>
              <th>Added By</th>
              <th>Create Date & Time</th>
              <th>Options</th>
            </tr>
          </thead>
          <tbody>

          </tbody>

        </table>
      </div>
      @include('call_checklist.shojon.tier2._referral')
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>

@endpush

@section('script')

<script>
  $(document).ready(function(){
  // console.log('{{ env('BASE_URL') }}'+"/patient/paging");
  $("#search-btn").click(function(){
    // $("#print_pdf").show();
    // $("#print_excel").show();
  });
});

  function load_datatable(additional_query=''){
  let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  // alert('load Table');
  $('#sampleTable').dataTable({
    destroy: true, //use this to reinitiate the table, other wise problem will occur
    processing: true,
    serverSide: true,
    "scrollX": true,
    ajax: {
      url: '{{ env('BASE_URL') }}'+"/patient/paging"

        // url: "http://127.0.0.1:8000/patient/paging"
        // url: '{{ route("patient.paging") }}'
        ,type: 'GET'
        ,data:{_token: CSRF_TOKEN,additional_query: additional_query} //,'records_total': records_total
    }
  });
}

$(document).ready(function() {
    load_datatable();
} );

$( "#search" ).submit(function( e ) {
        e.preventDefault();
        e.stopImmediatePropagation();
		$("#result").show();
    // alert('form submitted');
		$.ajax({
            data: $(this).serialize(), // get the form data
            type: $(this).attr('method'), // GET or POST
            url: $(this).attr('action'), // the file to call
            dataType : 'json',
            })
            .done(function( response ) {
              var additional_query=response.additional_query;
              load_datatable(additional_query);

                var url = '{{ route("pdf.patient", ":id") }}';
                url = url.replace(':id', additional_query);
                document.getElementById("print_pdf").setAttribute("href",url);
                console.log(response);
            });

        //alert('form submitted');

        return false;
    });

</script>

@endsection