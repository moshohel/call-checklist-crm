<!--<form action="{{$url ?? ''}}" method="GET" role="search">-->
{{ Form::model(request(),['method'=>'get']) }}
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('sex', 'Sex', ['class' => 'control-label']) !!}
                <select name="sex" id="sex" class="form-control @error('sex') is-invalid @enderror">
                    <option value="" selected >Select Sex</option>
                    @foreach($data['sex'] as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
                {{-- {!! Form::label('sex', 'Sex', ['class' => 'control-label']) !!}
                {!! Form::select('sex',  $data['sex'] ?? [], request()->get('sex'), ['class' => 'form-control']) !!} --}}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('age', 'Age', ['class' => 'control-label']) !!}
                <select name="age" id="age" class="form-control">
                    <option value="" selected >Select Age</option>
                    @foreach($data['age'] as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('occupation', 'Occupation', ['class' => 'control-label']) !!}
                <select name="occupation" id="occupation" class="form-control">
                    <option value="" selected >Select Occupation</option>
                    @foreach($data['occupation'] as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('location', 'Location', ['class' => 'control-label']) !!}
                <div class="form-group">
                    <input class="form-control" name="location" list="location" placeholder="Select Location">
                    <datalist id="location">
                        @foreach ($data['location'] as $district)
                            <option value={{ $district }}>
                        @endforeach
                    </datalist>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('call_type', 'Call Type', ['class' => 'control-label']) !!}
                <select name="call_type" id="call_type" class="form-control">
                    <option value="" selected >Select Call Type</option>
                    @foreach($data['call_type'] as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('caller', 'Caller', ['class' => 'control-label']) !!}
                <select name="caller" id="caller" class="form-control">
                    <option value="" selected >Select Caller</option>
                    @foreach($data['caller'] as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('risk_level', 'Risk Level', ['class' => 'control-label']) !!}
                <select name="risk_level" id="risk_level" class="form-control">
                    <option value="" selected >Select Risk Level</option>
                    @foreach($data['risk_level'] as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('main_reason', 'Main Reason', ['class' => 'control-label']) !!}
                <select name="main_reason" id="main_reason" class="form-control">
                    <option value="" selected >Select Reason</option>
                    @foreach($data['main_reason'] as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('secondary_reason', 'Secondary Reason', ['class' => 'control-label']) !!}
                <select name="secondary_reason" id="secondary_reason" class="form-control">
                    <option value="" selected >Select Reason</option>
                    @foreach($data['secondary_reason'] as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('caller_experience', 'Client Experience', ['class' => 'control-label']) !!}
                <select name="caller_experience" id="caller_experience" class="form-control">
                    <option value="" selected >Select Client Experience</option>
                    @foreach($data['caller_experience'] as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('client_referral', 'Client Referral', ['class' => 'control-label']) !!}
                <select name="client_referral" id="client_referral" class="form-control">
                    <option value="" selected >Select Client Referral</option>
                    @foreach($data['client_referral'] as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('volunteer_id', 'Volunteer ID', ['class' => 'control-label']) !!}
                <select name="volunteer_id" id="volunteer_id" class="form-control">
                    <option selected value="">Select Volunteer ID</option>
                    @foreach($data['volunteer_id'] as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="start"><b>Start Date:</b></label>
-               <input class="form-control" type="date" id="start" name="start">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="end"><b>End Date:</b></label>
-               <input class="form-control" type="date" id="end" name="end">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="start"><b>Start Time:</b></label>
                <input class="form-control" type="time" id="start_time" name="start_time">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="end"><b>End Time:</b></label>
                <input class="form-control" type="time" id="end_time" name="end_time">
            </div>
        </div>
    </div>

    <div class="row hidden-print">
        <div class="col-md-12 text-right">
            {!! Form::submit('Search', ['class'=> 'btn btn-primary btn-sm']) !!}
            @if((auth()->user()->user_group == "ADMIN") || ( (auth()->user()->user_level == 8) && (auth()->user()->user_group == "KPR")))
                <span class="pull-right hidden-print" style="margin-left: 5px">
                     <input type="submit" class="btn btn-success btn-sm" value="Excel" formaction="{{route('kpr_excel')}}">
                </span>
            @endif
        </div>
    </div>
</form>
