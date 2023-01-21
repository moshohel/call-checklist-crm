<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">

        @if( (auth()->user()->user_group == "ADMIN") || (auth()->user()->user_group == "SHOJON"))
        <li>
            <a class="app-menu__item" href="{{ route('call_checklist.shojon.tierOne.dashboard') }}">
                <i class="app-menu__icon fa fa-wpforms"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        @endif

        @if( (auth()->user()->user_group == "ADMIN") || (auth()->user()->user_group == "KPR"))
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i>
                <span class="app-menu__label">CheckList</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">

                <li>
                    <a class="app-menu__item" href="{{ url('call-checklist/kpr/create/123321405060987') }}">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">KPR Manual Entry</span>
                    </a>
                </li>

            </ul>
            <ul class="treeview-menu">
                <li>
                    <a class="app-menu__item {{ Route::currentRouteName() == 'call_checklist.shojon.create' ? 'active' : '' }}"
                        href="{{ route('call_checklist.shojon.create', $new=1) }}">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">Shojon Manual Entry</span>
                    </a>
                </li>

            </ul>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i>
                <span class="app-menu__label">Tier 1</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">

                <li>
                    <a class="app-menu__item {{ Route::currentRouteName() == 'call_checklist.shojon.create' ? 'active' : '' }}"
                        href="{{ route('call_checklist.shojon.tierOne.dashboard') }}">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">Dashboard tier -1 </span>
                    </a>
                </li>
                <li>
                    <a class="app-menu__item {{ Route::currentRouteName() == 'call_checklist.shojon.create' ? 'active' : '' }}"
                        href="{{ route('call_checklist.shojon.manual_form') }}">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">Add - Tier 1 </span>
                    </a>
                </li>
                <li>
                    <a class="app-menu__item {{ Route::currentRouteName() == 'call_checklist.shojon.create' ? 'active' : '' }}"
                        href="{{ route('call_checklist.shojon.TierOneList') }}">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">Client List - Tier 1 </span>
                    </a>
                </li>

            </ul>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i>
                <span class="app-menu__label">Tier 2</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">

                <li>
                    <a class="app-menu__item {{ Route::currentRouteName() == 'call_checklist.shojon.create' ? 'active' : '' }}"
                        href="#">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">Dashboard tier - 2 </span>
                    </a>
                </li>
                <li>
                    <a class="app-menu__item {{ Route::currentRouteName() == 'call_checklist.shojon.create' ? 'active' : '' }}"
                        href="{{ route('call_checklist.shojon.tier2') }}">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">Add Patient - Tier 2 </span>
                    </a>
                </li>
                <li>
                    <a class="app-menu__item {{ Route::currentRouteName() == 'call_checklist.shojon.create' ? 'active' : '' }}"
                        href="{{ route('call_checklist.shojon.Patientlist') }}">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">Patient List - Tier 2 </span>
                    </a>
                </li>

            </ul>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i>
                <span class="app-menu__label">Tier 3</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">

                <li>
                    <a class="app-menu__item"
                        href="{{ route('call_checklist.shojon.tierThree') }}">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">Add Patient - Tier 3 </span>
                    </a>
                </li>
                <li>
                    <a class="app-menu__item"
                        href="{{ route('shojon.tierThreeList') }}">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">Patient List - Tier 3</span>
                    </a>
                </li>

            </ul>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i>
                <span class="app-menu__label">Call Evaluation</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">

                <li>
                    <a class="app-menu__item"
                        href=" {{ route('call_checklist.shojon.callEvaluation') }} ">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">Evaluation</span>
                    </a>
                </li>
                <li>
                    <a class="app-menu__item"
                        href=" {{ route('call_checklist.shojon.eva_index') }} ">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">Evaluation List</span>
                    </a>
                </li>

            </ul>
        </li>
        @endif
        
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i>
                <span class="app-menu__label">Shojon Patient</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="app-menu__item" href="{{ route('patients') }}">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">Patients</span>
                    </a>
                </li>
            </ul>
            {{-- <ul class="treeview-menu">
                @if( (auth()->user()->user_group == "ADMIN") || (auth()->user()->user_group == "SHOJON"))
                <li>
                    <a class="app-menu__item {{ (auth()->user()->user_group == " ADMIN") || (auth()->user()->user_group
                        == "SHOJON") ? 'active' : '' }}"
                        href="#">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">New Patient</span>
                    </a>
                </li>
                @endif
            </ul> --}}
        </li>

        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i>
                <span class="app-menu__label">Report</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                @if( (auth()->user()->user_group == "ADMIN") || (auth()->user()->user_group == "KPR"))
                <li>
                    <a class="app-menu__item" href="{{ route('call_checklist.kpr.index') }}">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">KPR Report</span>
                    </a>
                </li>
                @endif
            </ul>
            <ul class="treeview-menu">
                @if( (auth()->user()->user_group == "ADMIN") || (auth()->user()->user_group == "SHOJON"))
                <li>
                    <a class="app-menu__item {{ (auth()->user()->user_group == " ADMIN") || (auth()->user()->user_group
                        == "SHOJON") ? 'active' : '' }}"
                        href="{{ route('call_checklist.shojon.index') }}">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">Shojon Report</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>

        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i>
                <span class="app-menu__label">Reschedule / Cancelation</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="app-menu__item" href="{{ route('session.rescheduleOrCancelations') }}">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">List</span>
                    </a>
                </li>
            </ul>
            {{-- <ul class="treeview-menu">
                @if( (auth()->user()->user_group == "ADMIN") || (auth()->user()->user_group == "SHOJON"))
                <li>
                    <a class="app-menu__item {{ (auth()->user()->user_group == " ADMIN") || (auth()->user()->user_group
                        == "SHOJON") ? 'active' : '' }}"
                        href="#">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">New Patient</span>
                    </a>
                </li>
                @endif
            </ul> --}}
        </li>

        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-retweet"></i>
                <span class="app-menu__label">Referrals</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="app-menu__item" href="{{ route('referrals') }}">
                        <i class="app-menu__icon fa fa-list"></i>
                        <span class="app-menu__label">Referral List</span>
                    </a>
                </li>
            </ul>
            <ul class="treeview-menu">
                @if( (auth()->user()->user_group == "ADMIN") || (auth()->user()->user_group == "SHOJON"))
                <li>
                    <a class="app-menu__item {{ (auth()->user()->user_group == " ADMIN") || (auth()->user()->user_group
                        == "SHOJON") ? 'active' : '' }}"
                        href="{{ route('referral.create') }}">
                        <i class="app-menu__icon fa fa-plus-circle"></i>
                        <span class="app-menu__label">New Referral</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>

        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-circle"></i>
                <span class="app-menu__label">User</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            @if( (auth()->user()->user_group == "ADMIN") || (auth()->user()->user_group == "SHOJON"))
            <ul class="treeview-menu">
                <li>
                    <a class="app-menu__item" href="{{ route('users') }}">
                        <i class="app-menu__icon fa fa-user-circle"></i>
                        <span class="app-menu__label">User List</span>
                    </a>
                </li>
            </ul>
            @endif
            <ul class="treeview-menu">
                @if( (auth()->user()->user_group == "ADMIN") || (auth()->user()->user_group == "SHOJON"))
                <li>
                    <a class="app-menu__item {{ (auth()->user()->user_group == " ADMIN") || (auth()->user()->user_group
                        == "SHOJON") ? 'active' : '' }}"
                        href="{{ route('register') }}">
                        <i class="app-menu__icon fa fa-user-circle"></i>
                        <span class="app-menu__label">New User</span>
                    </a>
                </li>
                @endif
                
                <li>
                    <a class="app-menu__item {{ (auth()->user()->user_group == " ADMIN") || (auth()->user()->user_group
                        == "SHOJON") ? 'active' : '' }}"
                        href="{{ route('user.show', auth()->user()->user_id) }}">
                        <i class="app-menu__icon fa fa-user-circle"></i>
                        <span class="app-menu__label">Client Details</span>
                    </a>
                </li>

                <li>
                    <a class="app-menu__item {{ (auth()->user()->user_group == " ADMIN") || (auth()->user()->user_group
                        == "SHOJON") ? 'active' : '' }}"
                        href="{{ route('calendar.index') }}">
                        <i class="app-menu__icon fa fa-user-circle"></i>
                        <span class="app-menu__label">Calendar</span>
                    </a>
                </li>
            </ul>

        </li>


    </ul>
</aside>