<nav class="navbar-vertical navbar">
    <div class="nav-scroller flex-column d-flex justify-content-between">
        <!-- Brand logo -->
        <a class="navbar-brand text-center fw-bold" href="/dashboard" style="color: #DDE6ED">
            <img src="{{ asset('images/logo.png') }}" alt="" style="background-color: #F8FAE5" height="110%">
        </a>

        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">

            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-chart-pie me-3 nav-icon"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/materi') }}"
                    href="">
                    <i class="fa-solid fa-box me-4 nav-icon"></i>
                    Paket
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/quizz*') ? 'active' : '' }}" href="#!"
                    data-bs-toggle="collapse" data-bs-target="#navQuizz" aria-expanded="false" aria-controls="navQuizz">
                    <i class="fa-solid fa-briefcase me-3 nav-icon"></i>
                    Quizz
                </a>
                <div id="navQuizz" class="collapse {{ Request::is('dashboard/quizz*') ? 'show' : '' }}"
                    data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/quizz/choice*') || Request::query('isChoice') == 'true' ? 'active' : '' }}"
                                href="">
                                Choice
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/quizz/essay*') || Request::query('isChoice') == 'false' ? 'active' : '' }}"
                                href="">
                                Essay
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <hr class="mx-3">


            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/mahasiswa') ? 'active' : '' }}"
                    href="{{ route('mahasiswa.index') }}">
                    <i class="fa-solid fa-screen-users me-3 nav-icon"></i>
                    Mahasiswa
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/prodi') ? 'active' : '' }}"
                    href="{{ route('prodi.index') }}">
                    <i class="fa-solid fa-buildings me-3 nav-icon"></i>
                    Prodi
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/user') ? 'active' : '' }}"
                    href="{{ route('user.index') }}">
                    <i class="fa-solid fa-user me-4 nav-icon"></i>
                    User
                </a>
            </li>
        </ul>


        <div class="nav-item mt-auto mb-5">
            <form action="/logout" method="post" class="d-grid">
                @csrf
                <button class="btn btn-danger d-block mx-4">
                    <i class="fa-solid fa-arrow-right-from-bracket me-2 nav-icon"></i>
                    Keluar
                </button>
            </form>
        </div>

    </div>
</nav>
