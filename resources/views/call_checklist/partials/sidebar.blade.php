<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
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
                        href="{{ route('call_checklist.shojon.create') }}">
                        <i class="app-menu__icon fa fa-wpforms"></i>
                        <span class="app-menu__label">Shojon Manual Entry</span>
                    </a>
                </li>
            </ul>
        </li>

        @endif

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

        @if( (auth()->user()->user_group == "ADMIN") || (auth()->user()->user_group == "SHOJON"))
        <li>
            <a class="app-menu__item" href="{{ route('call_checklist.kpr.dashboard') }}">
                <i class="app-menu__icon fa fa-wpforms"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        @endif
    </ul>
</aside>