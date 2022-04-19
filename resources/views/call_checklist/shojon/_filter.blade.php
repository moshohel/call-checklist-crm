<!--<form action="{{$url ?? ''}}" method="GET" role="search">-->
{{ Form::model(request(),['method'=>'get']) }}
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('sex', 'Sex', ['class' => 'control-label']) !!}
            <select name="sex" id="sex" class="form-control @error('sex') is-invalid @enderror">
                <option  value="">Select Sex</option>
                @foreach($data['sex'] as $item)
                    @if( old('sex') && (old('sex') == $i))
                        <option value={{ $item }} selected> {{ $item }} </option>
                    @else
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endif
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
                <option  value="">Select Age</option>
                @foreach($data['age'] as $item)
                    @if( old('age') && (old('age') == $i))
                        <option value={{ $item }} selected> {{ $item }} </option>
                    @else
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('occupation', 'Occupation', ['class' => 'control-label']) !!}
            <select name="occupation" id="occupation" class="form-control">
                <option  value="">Select Occupation</option>
                @foreach($data['occupation'] as $item)
                    @if( old('occupation') && (old('occupation') == $i))
                        <option value={{ $item }} selected> {{ $item }} </option>
                    @else
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('socio_economic_status', 'Socio Economic Status', ['class' => 'control-label']) !!}
            <select name="socio_economic_status" id="socio_economic_status" class="form-control">
                <option  value="">Select SES</option>
                @foreach($data['socio_economic_status'] as $item)
                    @if( old('socio_economic_status') && (old('socio_economic_status') == $i))
                        <option value={{ $item }} selected> {{ $item }} </option>
                    @else
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endif
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
                    @foreach ($data['location'] as $item)
                        @if( old('location') && (old('location') == $i))
                            <option value={{ $item }} selected> {{ $item }} </option>
                        @else
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endif
                    @endforeach
                </datalist>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('hearing_source', 'Hiring Source', ['class' => 'control-label']) !!}
            <select name="hearing_source" id="hearing_source" class="form-control">
                <option value="">Select Hiring Source</option>
                @foreach($data['hearing_source'] as $item)
                    @if( old('sexhearing_source') && (old('hearing_source') == $i))
                        <option value={{ $item }} selected> {{ $item }} </option>
                    @else
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('call_type', 'Call Type', ['class' => 'control-label']) !!}
            <select name="call_type" id="call_type" class="form-control">
                <option value="">Select Call Type</option>
                @foreach($data['call_type'] as $item)
                    @if( old('call_type') && (old('call_type') == $i))
                        <option value={{ $item }} selected> {{ $item }} </option>
                    @else
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>


    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('caller', 'Caller', ['class' => 'control-label']) !!}
            <select name="caller" id="caller" class="form-control">
                <option value="">Select Caller</option>
                @foreach($data['caller'] as $item)
                    @if( old('caller') && (old('caller') == $i))
                        <option value={{ $item }} selected> {{ $item }} </option>
                    @else
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('pre_mood_rating', 'Mood Rating (Pre)', ['class' => 'control-label']) !!}
            <select name="pre_mood_rating" id="pre_mood_rating" class="form-control">
                <option value="">Select Mood Rating</option>
                @foreach($data['pre_mood_rating'] as $item)
                    @if( old('pre_mood_rating') && (old('pre_mood_rating') == $i))
                        <option value={{ $item }} selected> {{ $item }} </option>
                    @else
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('main_reason', 'Main Reason', ['class' => 'control-label']) !!}
            <select name="main_reason" id="main_reason" class="form-control">
                <option value="">Select Reason</option>
                @foreach($data['main_reason'] as $item)
                    @if( old('main_reason') && (old('main_reason') == $i))
                        <option value={{ $item }} selected> {{ $item }} </option>
                    @else
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('secondary_reason', 'Secondary Reason', ['class' => 'control-label']) !!}
            <select name="secondary_reason" id="secondary_reason" class="form-control">
                <option value="">Select Reason</option>
                @foreach($data['secondary_reason'] as $item)
                    @if( old('secondary_reason') && (old('secondary_reason') == $i))
                        <option value={{ $item }} selected> {{ $item }} </option>
                    @else
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('mental_illness_diagnosis', 'Mental Illness Diagnosis', ['class' => 'control-label']) !!}
            <select name="mental_illness_diagnosis" id="mental_illness_diagnosis" class="form-control">
                <option value="">Select MID</option>
                @foreach($data['mental_illness_diagnosis'] as $item)
                    @if( old('mental_illness_diagnosis') && (old('mental_illness_diagnosis') == $i))
                        <option value={{ $item }} selected> {{ $item }} </option>
                    @else
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('ghq', 'GHQ', ['class' => 'control-label']) !!}
            <select name="ghq" id="ghq" class="form-control">
                <option value="">Select GHQ</option>
                @foreach($data['ghq'] as $item)
                    @if( old('ghq') && (old('ghq') == $i))
                        <option value={{ $item }} selected> {{ $item }} </option>
                    @else
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('suicidal_risk', 'Suicidal Risk', ['class' => 'control-label']) !!}
            <select name="suicidal_risk" id="suicidal_risk" class="form-control">
                <option value="">Select Suicidal Risk</option>
                @foreach($data['suicidal_risk'] as $item)
                    @if( old('suicidal_risk') && (old('suicidal_risk') == $i))
                        <option value={{ $item }} selected> {{ $item }} </option>
                    @else
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('post_mood_rating', 'Mood Rating (Post)', ['class' => 'control-label']) !!}
            <select name="post_mood_rating" id="post_mood_rating" class="form-control">
                <option value="">Select Mood Rating</option>
                @foreach($data['post_mood_rating'] as $item)
                    @if( old('post_mood_rating') && (old('post_mood_rating') == $i))
                        <option value={{ $item }} selected> {{ $item }} </option>
                    @else
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('call_effectivenes', 'Call Effectivenes', ['class' => 'control-label']) !!}
            <select name="call_effectivenes" id="call_effectivenes" class="form-control">
                <option value="">Select Call Effectivenes</option>
                @foreach($data['call_effectivenes'] as $item)
                    @if( old('call_effectivenes') && (old('call_effectivenes') == $i))
                        <option value={{ $item }} selected> {{ $item }} </option>
                    @else
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('client_referral', 'Client Referral', ['class' => 'control-label']) !!}
            <select name="client_referral" id="client_referral" class="form-control">
                <option value="">Was the client referred elsewhere?*</option>
                @foreach($data['client_referral'] as $item)
                    @if( old('client_referral') && (old('client_referral') == $i))
                        <option value={{ $item }} selected> {{ $item }} </option>
                    @else
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('volunteer_id', 'Volunteer ID', ['class' => 'control-label']) !!}
            <select name="volunteer_id" id="volunteer_id" class="form-control">
                <option value="">Select Volunteer ID</option>
                @foreach($data['volunteer_id'] as $item)
                    @if( old('volunteer_id') && (old('volunteer_id') == $i))
                        <option value={{ $item }} selected> {{ $item }} </option>
                    @else
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" for="start"><b>Start Date:</b></label>
            <input class="form-control" type="date" id="start" name="start" value="{{old('start')}}">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" for="end"><b>End Date:</b></label>
            <input class="form-control" type="date" id="end" name="end" value="{{old('end')}}">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" for="start"><b>Start Time:</b></label>
            <input class="form-control" type="time" id="start_time" name="start_time" value="{{old('start_time')}}">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" for="end"><b>End Time:</b></label>
            <input class="form-control" type="time" id="end_time" name="end_time" value="{{old('end_time')}}">
        </div>
    </div>

</div>


<div class="row hidden-print">
    <div class="col-md-12 text-right">

        {!! Form::submit('Search', ['class'=> 'btn btn-primary btn-sm']) !!}

        @if((auth()->user()->user_group == "ADMIN") || ( (auth()->user()->user_level == 8) && (auth()->user()->user_group == "SHOJON")))
            <span class="pull-right hidden-print" style="margin-left: 5px">
                     <input type="submit" class="btn btn-success btn-sm" value="Excel"
                            formaction="{{route('shojon_excel')}}">
                </span>
        @endif
    </div>
</div>
{{ Form::close() }}
