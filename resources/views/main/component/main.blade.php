<!DOCTYPE html>
<html lang="en">

<head>
    @include('main.component.head')
    <title>SI-ETO</title>
</head>

<body style="background-color: #DDE6ED">
    @include('main.component.navbar')
    <div class="body-content">
        @yield('content')
    </div>
    @if (request()->is('quiz/*'))
        <!-- Tidak menampilkan apa pun jika pengguna berada di halaman /quiz -->
    @else
        @include('main.component.footer')
    @endif

    @include('main.component.script')

    <script src="{{ asset('js/vue.global.js') }}"></script>
    <script>
        @yield('script')
    </script>
</body>

</html>
