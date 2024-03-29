<nav class="navbar-vertical navbar">
    <div class="nav-scroller flex-column d-flex justify-content-between">
        <!-- Brand logo -->
        <a class="navbar-brand text-center fw-bold" href="/dashboard" style="color: #DDE6ED"><img
                src="{{ asset('images/logo.png') }}" alt="" style="background-color: #DDE6ED">
        </a>

        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">

            @canany(['admin', 'dosen'])
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fa-solid fa-chart-pie me-3 nav-icon"></i>
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link has-arrow {{ Request::is('dashboard/paket-soal*') ? 'active' : '' }}" href="#!"
                        data-bs-toggle="collapse" data-bs-target="#paket-soal" aria-expanded="false"
                        aria-controls="paket-soal">
                        <i class="fa-solid fa-box me-3 nav-icon"></i>
                        Paket-Soal
                    </a>
                    <div id="paket-soal" class="collapse {{ Request::is('dashboard/paket-soal*') ? 'show' : '' }}"
                        data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/paket-soal/soal*') ? 'active' : '' }}"
                                    href="{{ route('soal.index') }}">
                                    Soal
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/paket-soal/paket*') ? 'active' : '' }}"
                                    href="{{ route('paket.index') }}">
                                    Paket
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/paket-soal/enrol*') ? 'active' : '' }}"
                                    href="{{ route('enrol.index') }}">
                                    Enroll Paket
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link has-arrow {{ Request::is('dashboard/penilaian*') ? 'active' : '' }}" href="#!"
                        data-bs-toggle="collapse" data-bs-target="#penilaian" aria-expanded="false"
                        aria-controls="penilaian">
                        <i class="fa-solid fa-hundred-points me-3 nav-icon"></i>
                        Penilaian
                    </a>
                    <div id="penilaian" class="collapse {{ Request::is('dashboard/penilaian*') ? 'show' : '' }}"
                        data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/penilaian/paket*') ? 'active' : '' }}"
                                    href="{{ route('penilaian.index') }}">
                                    Paket
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/penilaian/all*') ? 'active' : '' }}"
                                    href="{{ route('penilaian.show') }}">
                                    All
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcanany

            @can('admin')
            <hr class="mx-3">
                <li class="nav-item ">
                    <p class="nav-link mb-0 fw-bold">DATA MASTER</p>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/dosen') ? 'active' : '' }}"
                        href="{{ route('dosen.index') }}">
                        <i class="fa-solid fa-user-group me-3 nav-icon"></i>
                        Dosen
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/mahasiswa') ? 'active' : '' }}"
                        href="{{ route('mahasiswa.index') }}">
                        <i class="fa-solid fa-user-group me-3 nav-icon"></i>
                        Mahasiswa
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/prodi') ? 'active' : '' }}"
                        href="{{ route('prodi.index') }}">
                        <i class="fa-solid fa-screen-users me-3 nav-icon"></i>
                        Mata Kuliah
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/user') ? 'active' : '' }}"
                        href="{{ route('user.index') }}">
                        <i class="fa-solid fa-user me-4 nav-icon"></i>
                        User
                    </a>
                </li>
            @endcan
        </ul>

        <div class="nav-item mt-auto mb-5">
            <form action="/logout" method="post" class="d-grid">
                @csrf
                <button class="btn btn-outline-secondary d-block mx-4" style="color: #64CCC5">
                    <i class="fa-solid fa-arrow-right-from-bracket me-2 nav-icon"></i>
                    Keluar
                </button>
            </form>
        </div>

    </div>
</nav>
