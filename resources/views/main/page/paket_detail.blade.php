@extends('main.component.main')

@section('content')
<main id="main">
    <section id="why-us" class="why-us">
    <div class="container">
        <div class="row d-flex mt-5">
            <div class="col-lg-5 col-md-12">
                <p class="hastag" data-aos="fade-right" data-aos-duration="1000">#PejuangIlmu</p>
                <h2 class="fw-bolder mb-3 lh-base" data-aos="fade-right" data-aos-duration="1200" style="color: #001C30;">
                    {{ $paket_main->name }}</h2>
            </div>
            <div class="col-lg-7 col-md-12 text-end">
                <p class="hastag" data-aos="fade-left" data-aos-duration="1000">
                    Start :
                    <span class="text-dark">
                        {{ $paket_main->start }}
                    </span>
                </p>
                <p class="hastag" data-aos="fade-left" data-aos-duration="1000">
                    End :
                    <span class="text-dark">
                        {{ $paket_main->end }}
                    </span>
                </p>
            </div>
        </div>
        <a class="btn btn-outline-secondary" data-aos="fade-right" data-aos-duration="1000" href="/paket-main">
            <i class="fa-solid fa-chevron-left"></i> Kembali
        </a>
        <div class="row  p-5 h-100" data-aos="fade-up" data-aos-duration="1000">
            @foreach ($pakets as $paket)
                <div class="col mb-3">
                    <div class="card icon-box shadow" style="width: 22rem;">
                        <div class="card-body">
                            <img src="{{ asset('images/quis.jpg') }}" class="card-img-top" alt="..."
                                style="height: 12rem; object-fit: cover">
                            <div class="row mt-2">
                                <div class="col">
                                    <h4>
                                        <p class="card-title fw-bold stretched-link" href="#"
                                        style="text-decoration: none">{{ strtoupper($paket->name) }}</p>
                                    </h4>
                                </div>
                                <div class="col text-end mb-2">
                                    <p class="m-0 fw-bold">Total Soal</p>
                                    <p>{{ $paket->countSoals() }}</p>
                                </div>
                                @php
                                    $jawabanMahasiswa = new \App\Models\JawabanMahasiswa();
                                    $now = now();
                                    $time = $now->toDateTimeString();
                                    $isWithinTime = $time >= $paket_main->end || $time <= $paket_main->start;
                                @endphp
                            </div>
                            <a class="btn btn-primary stretched-link float-end" href="{{ route('quiz.show', $paket->id) }}"
                                @if ($jawabanMahasiswa->checkIfAnswerExists($paket->id, auth()->user()->mahasiswas->id) || $isWithinTime) style="pointer-events: none; cursor:not-allowed; background: red; border: none"  disabled @endif>
                                Mulai
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </section>
</main>
<div id="preloader"></div>
@endsection

@section('script')
    AOS.init();
@endsection
