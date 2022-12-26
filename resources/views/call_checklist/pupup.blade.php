@extends('call_checklist.app')

@section('content')

<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Call From - {{ $number }}</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do
                    eiusmod tempor <a href="#" target="_blank"> more
                        details.</a></p>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card mb-4 py-3">
                    <div class="card-body text-center">
                        {{-- <h5 class="card-title text-primary">Card Title</h5> --}}

                        <a href="{{ route('call_checklist.shojon.create', $new=1) }}" class="btn btn-outline-primary">New
                            Caller</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-4 py-3">
                    <div class="card-body text-center">
                        {{-- <h5 class="card-title text-primary">Card Title</h5> --}}
                        {{-- <a
                            href="{!! route('call_checklist.shojon.create', ['referrence_id'=>1, 'phone_number'=> $number ]) !!}"
                            class="btn btn-outline-primary">Exiting
                            Caller</a> --}}
                        {{-- <a
                            href="{{ route('call_checklist.shojon.create',  ['referrence_id'=>1, 'phone_number'=> $number ] ) }}"
                            class="btn btn-outline-primary">Exiting
                            Caller</a> --}}
                        <a href="{{ url('/call-checklist/shojon/create/' . $referrence_id . '/' . $number) }}"
                            class="btn btn-outline-primary">Exiting
                            Caller</a>
                        {{-- <a href="/call-checklist/shojon/create/9876/{{ $number }}"
                            class="btn btn-outline-primary">Exiting Caller</a> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-4 py-3">
                    <div class="card-body text-center">
                        {{-- <h5 class="card-title text-primary">Card Title</h5> --}}

                        <a href="#" class="btn btn-outline-primary">Appoinment Request</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-4 py-3">
                    <div class="card-body text-center">
                        {{-- <h5 class="card-title text-primary">Card Title</h5> --}}

                        <a href="#" class="btn btn-outline-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-4 py-3">
                    <div class="card-body text-center">
                        {{-- <h5 class="card-title text-primary">Card Title</h5> --}}

                        <a href="#" class="btn btn-outline-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-4 py-3">
                    <div class="card-body text-center">
                        {{-- <h5 class="card-title text-primary">Card Title</h5> --}}

                        <a href="#" class="btn btn-outline-primary">Go somewhere</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection