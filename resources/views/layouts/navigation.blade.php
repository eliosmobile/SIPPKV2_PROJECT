<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                SIRPPK
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/jadwal') }}"><i class="fas fa-calendar-alt"></i> {{ __('Jadwal') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/tentang') }}"><i class="fas fa-info-circle"></i> {{ __('Tentang Kami') }}</a>
                        </li>
                    @endguest

                    @auth
                        @role('mahasiswa')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/dashboard_mahasiswa') }}"><i class="fas fa-user-graduate"></i> {{ __('Dashboard Mahasiswa') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('room_requests.create') }}"><i class="fas fa-door-open"></i> {{ __('Request Peminjaman Ruangan') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('room_requests.index') }}"><i class="fas fa-file-alt"></i> {{ __('Status Surat') }}</a>
                            </li>
                        @endrole
                        @role('super admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/superadmin/dashboard') }}"><i class="fas fa-tachometer-alt"></i> {{ __('Dashboard Super Admin') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin_ruangan.users.create') }}"><i class="fas fa-user-plus"></i> {{ __('Buat Akun Admin') }}</a>
                            </li>
                        @endrole
                        @role('admin ruangan')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin_ruangan.dashboard') }}"><i class="fas fa-tachometer-alt"></i> {{ __('Dashboard Admin') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin_ruangan.requests') }}"><i class="fas fa-envelope"></i> {{ __('Permintaan Ruangan') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin_ruangan.rooms.create') }}"><i class="fas fa-plus-circle"></i> {{ __('Tambah Ruangan') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin_ruangan.users.create') }}"><i class="fas fa-user-plus"></i> {{ __('Buat Akun Admin') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin_ruangan.index') }}"><i class="fas fa-users-cog"></i> {{ __('Daftar Akun Admin Ruangan') }}</a>
                            </li>
                        @endrole
                        @role('admin fasilitas')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/adminfasilitas/dashboard') }}"><i class="fas fa-tools"></i> {{ __('Dashboard Admin Fasilitas') }}</a>
                            </li>
                        @endrole
                        @role('wadir')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('wadir.index') }}"><i class="fas fa-chart-line"></i> {{ __('Dashboard Wadir') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('wadir.requests') }}"><i class="fas fa-check-circle"></i> {{ __('Approval Requests') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('wadir.approved_requests') }}"><i class="fas fa-history"></i> {{ __('Request History') }}</a>
                        </li>
                        @endrole
                    
                        @role('direktur')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('direktur.dashboard') }}"><i class="fas fa-chart-pie"></i> {{ __('Dashboard Direktur') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('direktur.requests') }}"><i class="fas fa-check-circles"></i> {{ __('Requests') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('wadir.approved_requests') }}"><i class="fas fa-check-circle"></i> {{ __('History') }}</a>
                            </li>
                            
                        @endrole
                    @endauth
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> {{ __('Login') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user-tag"></i> {{ __('Role: ') . Auth::user()->roles->pluck('name')->implode(', ') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- Include FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
