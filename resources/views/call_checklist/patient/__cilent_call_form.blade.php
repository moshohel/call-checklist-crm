@extends('call_checklist.app')
@section('content')


<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Silent Call</h5>
        </div>
        <div class="modal-body">
            <form id="_cilent_call_form">
                @csrf
                <div class="col-md-12">
                    <label for="validationCustom01" class="form-label">Number</label>
                    <input type="text" id="Number" class="form-control" name="Number">
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Save Number</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $('#_cilent_call_form').on('submit',function(e){
            e.preventDefault();
            $.ajax({
              type:"get",
              url: '{{ route('patient.cilent_call') }}',
              data:$('#_cilent_call_form').serialize(),
              success:function(response){
                console.log(response)
                $('#Cilent_call_Modal').modal('hide')
                alert("Number save successfully");
            },
            error:function(error)
            {
                console.log(error)
                alert("Number not save");
            }
        });
        });
    });
</script>
@endpush