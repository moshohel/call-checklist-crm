@extends('call_checklist.app')

@section('content')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Reffer</h2>
    </div>
    <div class="card-body">
        <form action="{{ route("referral.update", $referral[0]->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- INCULDE Messages Partial --}}
            {{-- @include('partials.messages') --}}
            <div class="row">
                <div class="form-group col-6">
                    <label for="exampleFormControlInput1">Recommender</label>
                    <input type="text" name="Recommender" value="{{ $referral[0]->referred_by }}" class="form-control"
                    id="exampleFormControlInput1" readonly>
                </div>
                <div class="form-group col-6">
                    <label for="exampleFormControlInput1">Refer Date</label>
                    <input type="text" name="name" value="{{ $referral[0]->name }}" class="form-control"
                    id="exampleFormControlInput1" readonly>
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput2">Phone</label>
                    <input type="number" name="phone" value="{{ $referral[0]->phone_number }}" class="form-control"
                    id="exampleFormControlInput2">
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlSelect3">Consultent</label>
                    <select class="form-control" name="consultant_id" value=""
                    id="exampleFormControlSelect3">
                    <option value="" disabled selected hidden>Consultent</option>
                    @foreach ($consultants as $consultant)
                    <option value="{{ $consultant->full_name }}">{{ $consultant->full_name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="form-group col-6">
                <label for="exampleFormControlInput1">Diagnosis</label>
                <input type="text" name="referr_from" value="{{ $referral[0]->diagnosis }}" class="form-control"
                id="exampleFormControlInput1">
            </div> --}}

            <div class="form-group col-6">
                <label for="exampleFormControlInput7">Preferred Contultent</label>
                <input type="text" class="form-control" name="preferred_therapist_or_psychiatrist"  value="{{ $referral[0]->preferred_therapist_or_psychiatrist }}" id="exampleFormControlInput7"
                placeholder="Preferred Contultent" readonly >
            </div>

            <div class="form-group col-6">
                <label for="exampleFormControlInput1">Refer From</label>
                <input type="text" name="referr_from" value="{{ $referral[0]->referr_from }}" class="form-control"
                id="exampleFormControlInput1" readonly>
            </div>
            

   <!--          <div class="col-md-3">
                <div class="form-group col-6">
                  @php $types = ['Regular','Emergency']; @endphp
                  <label for="validationCustom01" class="form-label">Sex</label>
                  <select class="form-control" name="sex">
                    <option disabled selected>Select Sex</option>
                    @foreach($types as $item)
                    @if($referral[0]->Referral_types == $item)
                    <option selected value="{{$item}}">{{$item}}</option>
                    @else
                    <option value="{{$item}}">{{$item}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div> -->


        <div class="form-group col-6">
            <label for="exampleFormControlInput1">Referral type</label>
            <select class="form-control" name="referral_types">
                <option disabled selected>Select Sex</option>
                @foreach($types as $item)
                @if($referral[0]->Referral_types == $item)
                <option selected value="{{$item}}">{{$item}}</option>
                @else
                <option value="{{$item}}">{{$item}}</option>
                @endif
                @endforeach
            </select>
                <!-- <input type="text" name="referr_from" value="{{ $referral[0]->Referral_types }}" class="form-control"
                    id="exampleFormControlInput1" readonly> -->
                </div>


                <div class="form-group col-6">
                    <label for="exampleFormControlInput1">Client Id</label>
                    <input type="text" name="unique_id" value="{{ $referral[0]->unique_id }}" class="form-control"
                    id="exampleFormControlInput1" readonly>
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput1">Gender</label>
                    <input type="text" name="referr_from" value="{{ $referral[0]->gender }}" class="form-control"
                    id="exampleFormControlInput1" readonly>
                </div>

                <div class="form-group col-6">
                    <label for="exampleFormControlInput6">Age</label>
                    <input type="text" class="form-control" name="age" value="{{ $referral[0]->age }}" id="exampleFormControlInput6" readonly >
                </div>
                <div class="form-group col-6">
                    @php $types = ['Free of cost','50','100','150','200']; @endphp
                    <label for="exampleFormControlInput6">Financial Affordability</label>
                    <select class="form-control" name="referral_types">
                        <option disabled selected>Select Sex</option>
                        @foreach($types as $item)
                        @if($referral[0]->financial == $item)
                        <option selected value="{{$item}}">{{$item}}</option>
                        @else
                        <option value="{{$item}}">{{$item}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>


            </div>

            <div class="form-footer pt-4 mt-4">
                <button type="submit" class="btn btn-primary btn-default"> Save Change</button>
                <button type="submit" class="btn btn-secondary btn-default">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection