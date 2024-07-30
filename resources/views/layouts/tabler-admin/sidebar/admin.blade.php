<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle show" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false"
        role="button" aria-expanded="false">
        <span
            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                <path d="M12 12l8 -4.5" />
                <path d="M12 12l0 9" />
                <path d="M12 12l-8 -4.5" />
                <path d="M16 5.25l-8 4.5" />
            </svg>
        </span>
        <span class="nav-link-title">
            Peminjaman
        </span>
    </a>
    <div class="dropdown-menu show">
        <div class="dropdown-menu-columns">
            <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('admin.peminjaman.index') }}">
                    Peminjaman Barang
                </a>
            </div>
        </div>
    </div>
    <div class="dropdown-menu show">
        <div class="dropdown-menu-columns">
            <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('admin.booking.index') }}">
                    Peminjaman Ruangan
                </a>
            </div>
        </div>
    </div>
    <div class="dropdown-menu show">
        <div class="dropdown-menu-columns">
            <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('admin.laporan') }}">
                    Laporan Peminjaman
                </a>
            </div>
        </div>
    </div>
    <div class="dropdown-menu show">
        <div class="dropdown-menu-columns">
            <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('admin.jadwal') }}">
                    Jadwal Ruangan
                </a>
            </div>
        </div>
    </div>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle show" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false"
        role="button" aria-expanded="false">
        <span
            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                <path d="M12 12l8 -4.5" />
                <path d="M12 12l0 9" />
                <path d="M12 12l-8 -4.5" />
                <path d="M16 5.25l-8 4.5" />
            </svg>
        </span>
        <span class="nav-link-title">
            Master Data
        </span>
    </a>
    <div class="dropdown-menu show">
        <div class="dropdown-menu-columns">
            <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('admin.barang.index') }}">
                    Barang
                </a>
            </div>
        </div>
    </div>
    <div class="dropdown-menu show">
        <div class="dropdown-menu-columns">
            <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('admin.gedung.index') }}">
                    Gedung
                </a>
            </div>
        </div>
    </div>
    <div class="dropdown-menu show">
        <div class="dropdown-menu-columns">
            <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('admin.ruangan.index') }}">
                    Ruangan
                </a>
            </div>
        </div>
    </div>
    <div class="dropdown-menu show">
        <div class="dropdown-menu-columns">
            <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('admin.unit.index') }}">
                    Unit Kerja
                </a>
            </div>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.user.index') }}">
        <span
            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
            </svg>
        </span>
        <span class="nav-link-title">
            User
        </span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.scan.qrcode') }}">
        <span
            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
            </svg>
        </span>
        <span class="nav-link-title">
            Scan QR
        </span>
    </a>
</li>
