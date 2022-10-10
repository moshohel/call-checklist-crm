<label class="control-label" style="text-align: center" for="financial_affordability" ><b>Referral Form </b></label>
<div class="form-control">
    <label class="control-label" for="ref_client_name"><b>Client Name:</b></label>
    <input class="form-control" type="text" name="ref_client_name" id="ref_client_name" value="{{ old('ref_client_name') }}" placeholder="Enter client name"/>

    <label class="control-label" for="ref_age"><b>Age:</b></label>
    <input class="form-control" type="text" name="ref_age" id="ref_age" value="{{ old('ref_age') }}" placeholder="Enter age"/>

    <label class="control-label" for="ref_therapy_reason"><b>Reason for therapy:</b></label>
    <input class="form-control" type="text" name="ref_therapy_reason" id="ref_therapy_reason" value="{{ old('ref_therapy_reason') }}" placeholder="Enter reason"/>

    <label class="control-label" for="ref_phone_number"><b>Session Phone Number:</b></label>
    <input class="form-control" type="text" name="ref_phone_number" id="ref_phone_number" value="{{ old('ref_phone_number') }}" placeholder="Enter phone number"/>

    <label class="control-label" for="ref_preferred_time"><b>Preferred time for session:</b></label>
    <input class="form-control" type="text" name="ref_preferred_time" id="ref_preferred_time" value="{{ old('ref_preferred_time') }}" placeholder="Enter preferred time"/>

    <label class="control-label" for="ref_emergency_number"><b>Emergency number in case of unavailability:</b></label>
    <input class="form-control" type="text" name="ref_emergency_number" id="ref_emergency_number" value="{{ old('ref_emergency_number') }}" placeholder="Enter emergency number"/>

    <label class="control-label"  for="ref_financial_affort"><b>Financial affordability:</b></label>
    <select class="form-control" list="ref_financial_affort_list"  type="text" name="ref_financial_affort" id="ref_financial_affort" value="{{ old('ref_financial_affort') }}" placeholder="Enter financial affordability"/>
    <datalist id="ref_financial_affort_list">
        @php $options = ['Free of cost','200'] @endphp
        <option disabled selected>Select Option</option>
        @foreach($options as $option)
            <option value="{{ $option }}">{{ $option }}</option>
        @endforeach
    </datalist>
    </select>

    <label class="control-label" for="ref_therapist_preference"><b>Therapist preference:</b></label>
    <input class="form-control" type="text" name="ref_therapist_preference" id="ref_therapist_preference" value="{{ old('ref_therapist_preference') }}" placeholder="Enter therapist_preference"/>
</div>
@error('financial_affordability') {{ $message }} @enderror
