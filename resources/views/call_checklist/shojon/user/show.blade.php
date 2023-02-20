@extends('call_checklist.app')

@section('content')

<div class="content-wrapper">

    <div class="content">
        <div class="bg-white border rounded">
            @include('call_checklist.partials.messages')
            <div class="row no-gutters">
                <div class="col-lg-4 col-xl-3">
                    <div class="profile-content-left pt-5 pb-3 px-3 px-xl-5">
                        <div class="card text-center widget-profile px-0 border-0">
                            <div class="card-img mx-auto rounded-circle">
                                <img src="{{asset('Image/Profile/'.$user[0]->image )}}" alt="user image">
                            </div>
                            <div class="card-body">
                                <h4 class="py-2 text-dark">{{ $user[0]->full_name }}</h4>
                                <p>User name: {{ $user[0]->user }}</p>
                                <a class="btn btn-primary btn-pill btn-lg my-4" href="{{ route('user.edit', $user[0]->user_id) }}">Edit</a>
                            </div>
                        </div>
                        {{-- <div class="d-flex justify-content-between ">
                            <div class="text-center pb-4">
                                <h6 class="text-dark pb-2">1503</h6>
                                <p>Friends</p>
                            </div>
                            <div class="text-center pb-4">
                                <h6 class="text-dark pb-2">2905</h6>
                                <p>Followers</p>
                            </div>
                            <div class="text-center pb-4">
                                <h6 class="text-dark pb-2">1200</h6>
                                <p>Following</p>
                            </div>
                        </div> --}}
                        <hr class="w-100">
                        {{-- <div class="contact-info pt-4">
                            <h5 class="text-dark mb-1">Information</h5>
                            <p class="text-dark font-weight-medium pt-4 mb-2">Email address</p>
                            <p>Albrecht.straub@gmail.com</p>
                            <p class="text-dark font-weight-medium pt-4 mb-2">Phone Number</p>
                            <p>+99 9539 2641 31</p>
                            <p class="text-dark font-weight-medium pt-4 mb-2">Birthday</p>
                            <p>Nov 15, 1990</p>
                            <p class="text-dark font-weight-medium pt-4 mb-2">Social Profile</p>
                            <p class="pb-3 social-button">
                                <a href="#" class="mb-1 btn btn-outline btn-twitter rounded-circle">
                                    <i class="mdi mdi-twitter"></i>
                                </a>
                                <a href="#" class="mb-1 btn btn-outline btn-linkedin rounded-circle">
                                    <i class="mdi mdi-linkedin"></i>
                                </a>
                                <a href="#" class="mb-1 btn btn-outline btn-facebook rounded-circle">
                                    <i class="mdi mdi-facebook"></i>
                                </a>
                                <a href="#" class="mb-1 btn btn-outline btn-skype rounded-circle">
                                    <i class="mdi mdi-skype"></i>
                                </a>
                            </p>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9">
                    <div class="profile-content-right py-5">
                        <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link " id="timeline-tab" data-toggle="tab" href="#timeline"
                                    role="tab" aria-controls="timeline" aria-selected="false">Refferls</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                    aria-controls="profile" aria-selected="true">Sessions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab"
                                    aria-controls="settings" aria-selected="false">Clients</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab"
                                    aria-controls="request" aria-selected="false">Requests</a>
                            </li>
                        </ul>

                        <div class="tab-content px-3 px-xl-5" id="myTabContent">
                            <div class="tab-pane fade " id="timeline" role="tabpanel"
                                aria-labelledby="timeline-tab">
                                <div class="media mt-5 profile-timeline-media">
                                    <div class="align-self-start iconbox-45 overflow-hidden mr-3">
                                        {{-- <img src="assets/img/user/u3.jpg" alt="Generic placeholder image"> --}}
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 text-dark"> Refferls </h6>
                                        
                                        <div class="d-inline-block rounded overflow-hidden mt-4 mr-0 mr-lg-4">
                                            @include('call_checklist.referral.referral_list')
                                        </div>
                                        <div class="d-inline-block rounded overflow-hidden mt-4 mr-0 mr-lg-4">
                                            
                                        </div>
                                        <div class="d-inline-block rounded overflow-hidden mt-4 mr-0 mr-lg-4">
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="media mt-5 profile-timeline-media">
                                    <div class="align-self-start iconbox-45 overflow-hidden mr-3">
                                        {{-- <img src="assets/img/user/u3.jpg" alt="Generic placeholder image"> --}}
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 text-dark"> Sessions </h6>

                                        @include('call_checklist.shojon.session.session_list')
                                        <div class="d-inline-block rounded overflow-hidden mt-4 mr-0 mr-lg-4">
                                        </div>
                                        <div class="d-inline-block rounded overflow-hidden mt-4 mr-0 mr-lg-4">
                                            
                                        </div>
                                        <div class="d-inline-block rounded overflow-hidden mt-4 mr-0 mr-lg-4">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                <div class="media mt-5 profile-timeline-media">
                                    <div class="align-self-start iconbox-45 overflow-hidden mr-3">
                                        {{-- <img src="assets/img/user/u3.jpg" alt="Generic placeholder image"> --}}
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 text-dark"> Clients </h6>
                                        @include('call_checklist.shojon.session.myclient_list')
                                        <div class="d-inline-block rounded overflow-hidden mt-4 mr-0 mr-lg-4">
                                            
                                        </div>
                                        <div class="d-inline-block rounded overflow-hidden mt-4 mr-0 mr-lg-4">
                                            
                                        </div>
                                        <div class="d-inline-block rounded overflow-hidden mt-4 mr-0 mr-lg-4">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">
                                <div class="media mt-5 profile-timeline-media">
                                    <div class="align-self-start iconbox-45 overflow-hidden mr-3">
                                        {{-- <img src="assets/img/user/u3.jpg" alt="Generic placeholder image"> --}}
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 text-dark"> Reschedule/Session Cancelation Request </h6>
                                        @include('call_checklist.shojon.session.reschedule_cancelation_list')
                                        <div class="d-inline-block rounded overflow-hidden mt-4 mr-0 mr-lg-4">
                                            
                                        </div>
                                        <div class="d-inline-block rounded overflow-hidden mt-4 mr-0 mr-lg-4">
                                            
                                        </div>
                                        <div class="d-inline-block rounded overflow-hidden mt-4 mr-0 mr-lg-4">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>



@endsection