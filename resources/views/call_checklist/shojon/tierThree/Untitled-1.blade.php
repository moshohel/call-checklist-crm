<div class="form-group" id="referred">
    <label class="control-label" for="client_referral">23. Referral</label>
    <div class="form-control">
        <label class="control-label">Internal Referral:</label><br>

        <span id="SHOJONTierThreeBox" class="TierThree">
            <a href="#" class="btn btn-info btn-sm edit" data-id="#" data-toggle="modal"
                data-target="#Referral_tier_threeModal">SHOJON Tier 3</a>
            @include('call_checklist.shojon.tierThree._referral_tier_two')
        </span>

        </label>
    </div>
    <div class="form-control">
        <label class="control-label" for="client_referral"><b>External referral: </label>
        <div class="form-control @error('TreatmentGoal') is-invalid @enderror">
            <label class="control-label">Reason for referral:</label><br>
            <label class="control-label" style="width: 90%;">
                <input type="text" name="ReasonForReferral" class="form-control">

            </label><br>
            <label class="control-label">Name of the Agency:</label><br>
            <label class="control-label" style="width: 90%;">
                <input type="text" name="NameOfAgency" class="form-control">

            </label>
        </div>
        @php $types = ['Health Hotline 09678771511','KPR 01777772215']; @endphp
        <div class="form-control @error('client_referral') is-invalid @enderror">
            <label>
                @foreach($types as $item)
                <input type="radio" name="client_referral" value="{{ $item }}" />
                {{ $item }}
                <br>
                @endforeach
                <input type="radio" id="CliKReferral" name="client_referral" value="other"
                    onclick="ShowReferralBox()" />
                Other (please explain)
            </label>
            <span id="ReferralBox" style="display: none;">
                <input class="form-control" type="text" name="other_client_referral"
                    value="{{ old('client_referral') }}" placeholder="Explain" />
            </span>
        </div>
        @error('client_referral') {{ $message }} @enderror
    </div>
</div>