@extends('call_checklist.app')
@section('title') {{ $data->caller_name }} @endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <div class="app-title">
        <div>
            <h1><i class="fa-solid fa-user"></i><a href="{{ route('call_checklist.shojon.view',$data->id) }}">{{ $data->caller_name }}</span></a>
            </h1>
        </div>
    </div>
 @endsection