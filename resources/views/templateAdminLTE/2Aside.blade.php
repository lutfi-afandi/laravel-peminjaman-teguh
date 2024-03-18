@if (Auth::user()->level == 'admin' || Auth::user()->level == 'baak')
    <nav class="px-nav px-nav-left">
        <button type="button" class="px-nav-toggle" data-toggle="px-nav">
            <span class="px-nav-toggle-arrow"></span>
            <span class="navbar-toggle-icon"></span>
            <span class="px-nav-toggle-label font-size-11">HIDE MENU</span>
        </button>

        <ul class="px-nav-content">
            <li class="px-nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('home.index') }}"><i class="px-nav-icon fa fa-home"></i><span
                        class="px-nav-label">Dashboard</span></a>
            </li>
            @if (Auth::user()->level == 'admin' || Auth::user()->level == 'baak')
                @include('templateAdminLTE.sidebar.admin')
            @endif
        </ul>
    </nav>
@endif
