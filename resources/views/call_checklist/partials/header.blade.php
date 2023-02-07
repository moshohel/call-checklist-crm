<header class="app-header">
    @if(\Illuminate\Support\Facades\Auth::check())
        
    {{-- <a href="#">SHOJON CRM</a> --}}
        <img src="{{ asset('Image/logo/SHOJON LOgo.png') }}" alt="logo" style="float:left;width:3%;height:3%;">
        {{-- <a class="app-header__logo" href="#">{{ config('app.name') }}</a> --}}
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    @endif
    <ul class="app-nav">
        {{-- <li class="app-search">
            <input class="app-search__input" type="search" placeholder="Search"/>
            <button class="app-search__button">
                <i class="fa fa-search"></i>
            </button>
        </li> --}}
        <!-- User Menu-->
        <li class="dropdown">
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">{{ auth()->user()->full_name }}<i
                    class="fa fa-user fa-lg ml-4"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                {{-- <li>
                    <a class="dropdown-item" href="#"><i class="fa fa-cog fa-lg"></i> Settings</a>
                </li> --}}
                <li>
                    <a class="dropdown-item" href="{{ route('user.edit', auth()->user()->user_id) }}"><i class="fa fa-user fa-lg"></i> Profile</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();"> <i class="fa fa-sign-out fa-lg"></i> Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</header>
