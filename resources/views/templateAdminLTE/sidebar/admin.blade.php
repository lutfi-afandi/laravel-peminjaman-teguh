<li class="px-nav-item px-nav-dropdown {{ request()->is('master*') ? 'px-open' : '' }}">
    <a href="javascript:;"><i class="px-nav-icon fa fa-hdd-o"></i>
        <span class="px-nav-label">Master Data</span>
    </a>
    <ul class="px-nav-dropdown-menu">
        <li class="px-nav-item {{ request()->is('master/kegiatan*') ? 'active' : '' }}">
            <a href="{{ route('admin.kegiatan.index') }}">
                <span class="px-nav-label">
                    <i class="dropdown-icon px-nav-icon ion-ios-pulse-strong"></i>
                    Kegiatan</span>
            </a>
        </li>
    </ul>
</li>
