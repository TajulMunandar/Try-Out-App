<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">
        <h1 class="logo me-auto"><a href="/main"><img src="assets/img/logoiain.png" alt=""></a></h1>
        <nav id="navbar" class="navbar">
            <ul>
                <li>
                    @if (request()->is('quiz/*'))
                        <!-- Tidak menampilkan apa pun jika pengguna berada di halaman /quiz -->
                    @else
                        @if (auth()->user())
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle " type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ strtoupper(auth()->user()->username) }}
                                </button>
                                <ul class="dropdown-menu">
                                    @if (auth()->user()->is_admin == 1 || auth()->user()->is_admin == 2)
                                        <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                                    @endif
                                    <form action="/logout" method="post">
                                        @csrf
                                        <li><button type="submit" class="dropdown-item">Logout</button></li>
                                    </form>
                                </ul>
                            @else
                                <div class="d-flex">
                                    <a class="getstarted" href="/login">Login</a>
                                </div>
                            </div>
                        @endif
                    @endif
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
