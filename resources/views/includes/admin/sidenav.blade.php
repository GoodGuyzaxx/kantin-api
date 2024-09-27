<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" style="background-color: #2C2A4A" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <hr class="bs-sidenav-bar">
            <div class="nav">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                {{-- Master Data --}}
                <div class="sb-sidenav-menu-heading">Menu</div>

                <a class="nav-link {{ Request::is('user*') ? 'active' : '' }}"
                   href="{{ route('admin.user.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-pen"></i></div>
                    Admin Kantin
                </a>

                <a class="nav-link {{ Request::is('konsumen*') ? 'active' : '' }}"
                   href="{{ route('admin.konsumen.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-pen"></i></div>
                    Konsumen
                </a>

                <a class="nav-link {{ Request::is('kantin*') ? 'active' : '' }}"
                   href="{{ route('admin.kantin.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-pen"></i></div>
                    Kantin
                </a>

                <a class="nav-link {{ Request::is('menu*') ? 'active' : '' }}"
                   href="{{ route('admin.menu.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                    Menu
                </a>

                <a class="nav-link {{ Request::is('recommendations*') ? 'active' : '' }}"
                   href="{{ route('admin.recommendations') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table-columns"></i></div>
                    Rekomendasi Menu
                </a>
                {{-- kriteria --}}
{{--                @can('admin')--}}
{{--                    <a class="nav-link {{ Request::is('dashboard/kriteria*') ? 'active' : '' }}"--}}
{{--                        href="{{ route('kriteria.index') }}">--}}
{{--                        <div class="sb-nav-link-icon"><i class="fas fa-table-columns"></i></div>--}}
{{--                        Data Kriteria--}}
{{--                    </a>--}}
{{--                    --}}{{-- data Siswa --}}
{{--                    <a class="nav-link {{ Request::is('dashboard/student*') ? 'active' : '' }}"--}}
{{--                        href="{{ route('student.index') }}">--}}
{{--                        <div class="sb-nav-link-icon">--}}
{{--                            <i class="fas fa-school"></i>--}}
{{--                        </div>--}}
{{--                        Data Siswa--}}
{{--                    </a>--}}
{{--                @endcan--}}
{{--                --}}{{-- Master User --}}
{{--                <a class="nav-link {{ Request::is('dashboard/alternatif*') ? 'active' : '' }}"--}}
{{--                    href="{{ route('alternatif.index') }}">--}}
{{--                    <div class="sb-nav-link-icon"><i class="fas fa-users-rectangle"></i></div>--}}
{{--                    Data Alternatif--}}
{{--                </a>--}}
{{--                <a class="nav-link {{ Request::is('dashboard/perbandingan*') ? 'active' : '' }}"--}}
{{--                    href="{{ route('perbandingan.index') }}">--}}
{{--                    <div class="sb-nav-link-icon">--}}
{{--                        <i class="fas fa-code-compare"></i>--}}
{{--                    </div>--}}
{{--                    Perbandingan--}}
{{--                </a>--}}
{{--                <a class="nav-link {{ Request::is('dashboard/ranking*') ? 'active' : '' }}"--}}
{{--                    href="{{ route('rank.index') }}">--}}
{{--                    <div class="sb-nav-link-icon"><i class="fas fa-ranking-star"></i></div>--}}
{{--                    Rangking--}}
{{--                </a>--}}
{{--                @can('admin')--}}
{{--                    <div class="sb-sidenav-menu-heading">Master Pengguna</div>--}}
{{--                    <a class="nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}"--}}
{{--                        href="{{ route('users.index') }}">--}}
{{--                        <div class="sb-nav-link-icon"><i class="fas fa-user-gear"></i></div>--}}
{{--                        Data Pengguna--}}
{{--                    </a>--}}
{{--                @endcan--}}
{{--                <a class="nav-link {{ Request::is('dashboard/profile*') ? 'active' : '' }}"--}}
{{--                    href="{{ route('profile.index') }}">--}}
{{--                    <div class="sb-nav-link-icon"><i class="fas fa-user-pen"></i></div>--}}
{{--                    Ubah Profil--}}
{{--                </a>--}}
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as : <span>{{ auth()->user()->name }}</span></div>
        </div>
    </nav>
</div>
