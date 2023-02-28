<div class="modal fade" id="Referral_tier_twoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Referral Form </h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
        </div>
          <form id="_referral_tier_two_form">
            @csrf
            <div class="modal-body">
              <div class="row g-2">
              <div class="col-md-6">
              <label for="validationCustom01" class="form-label">Referral Form:</label>
              <input type="text" class="form-control" readonly name="referral_from"  value="Shojon Tier 1">
              </div>
              <div class="col-md-6">
              <label for="validationCustom01" class="form-label">Referral To:</label>
              <input type="text" class="form-control" readonly name="referral_to" value="Shojon Tier 2">
             </div>
             </div><hr>
             <div class="row g-3">
              <div class="col-md-4">
              <label for="validationCustom01" class="form-label">Client ID:</label>
              <input type="text" class="form-control" required name="client_id" readonly value="{{ $uniqueid }}">
              </div>
              <div class="col-md-4">
              <label for="validationCustom01" class="form-label">Client Name:</label>
             @if(empty($newPatient->name))
              <input type="text" class="form-control" required name="client_name">
              @else
              <input type="text" class="form-control" required readonly name="client_name" value="{{$newPatient->name}}">
              @endif
             </div>
             <div class="col-md-4">
              <label for="validationCustom01" class="form-label">Sex:</label>
              @if(empty($newPatient->sex))
              <input type="text" class="form-control" required name="gender" >
              @else
              <input type="text" class="form-control" readonly name="gender" value="{{ $newPatient->sex }}">
              @endif
             </div>
             <div class="col-md-4">
              <label for="validationCustom01" class="form-label">Age:</label>
              @if(empty($newPatient->age))
              <input type="text" class="form-control" required name="age" >
              @else
              <input type="text" class="form-control" required name="age" readonly value="{{ $newPatient->age }}">
              @endif
             </div>
             </div><br>
             <div class="row g-2">
              <div class="col-md-6">
              <label for="validationCustom01" class="form-label">Phone Number:</label>
              @if(empty($newPatient->phone_number))
              <input type="number" class="form-control" required name="phone_number">
              @else
              <input type="number" class="form-control" required readonly name="phone_number" value="{{$newPatient->phone_number}}">
              @endif
              </div>
              <div class="col-md-6">
              <label for="validationCustom01" class="form-label">Emergency number in case of unavailability:</label>
              <input type="number" class="form-control" required name="Emergency_number" placeholder="Emergency number" >
             </div>
             </div><br>
             <div class="row g-2">
              <div class="col-md-6">
              <label for="validationCustom01" class="form-label">Reason for therapy:</label>
              <input type="text" class="form-control" required name="reason_for_therapy"  placeholder="Reason for therapy">
              </div>
              <div class="col-md-6">
              <label for="validationCustom01" class="form-label">Preferred time for session:</label>
              <input type="datetime-local" class="form-control" required name="preferred_time" placeholder="Preferred time for session">
             </div>
             </div><br>
             <div class="row g-3">
              <div class="col-md-4">
                @php $types = ['Free of cost','50','100','150','200']; @endphp 
              <label for="validationCustom01" class="form-label">Financial affordability:</label>
              <select class="form-control" required name="Financial">
                <option selected disabled>Select Referral Types</option>
                @foreach($types as $item)
                <option value="{{$item}}">{{$item}}</option>
                @endforeach
              </select>  
              </div>
              <div class="col-md-4">
              <label for="validationCustom01" class="form-label">Therapist preference:</label>
              <input type="text" class="form-control" required name="Therapist" placeholder="Therapist preference" > 
             </div> 
             <div class="col-md-4">
              @php $types = ['Regular','Emergency']; @endphp
              <label for="validationCustom01" class="form-label">Referral Types :</label>
              <select class="form-control" required name="Referral_types">
                <option selected disabled>Select Referral Types</option>
                @foreach($types as $item)
                <option value="{{$item}}">{{$item}}</option>
                @endforeach
              </select> 
             </div>
             </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
       </div>
    </div>
</div> 
<script>
  config ={
      enableTime: true,
      dateFormat: "Y-m-d (h:i K)",
  }
  flatpickr("input[type=datetime-local]", config);
</script>
<script type="text/javascript">
  $(document).ready(function(){
     $('#_referral_tier_two_form').on('submit',function(e){
       e.preventDefault();
          $.ajax({
              type:"get",
              url: '{{ route('call_checklist.shojon.Referral_form') }}',
              data:$('#_referral_tier_two_form').serialize(),
              success:function(response){
                console.log(response)
                $('#Referral_tier_twoModal').modal('hide')
                alert("Referral save successfully");
              },
              error:function(error)
              {
                console.log(error)
                alert("Referral not save");
              }

            });
     });
  });
</script>