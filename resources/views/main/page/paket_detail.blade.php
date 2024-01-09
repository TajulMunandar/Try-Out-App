@extends('main.component.main')

@section('content')
    <div class="container">
        <div class="row d-flex">
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
        <div class="row p-5 h-100" data-aos="fade-up" data-aos-duration="1000">
            @foreach ($pakets as $paket)
                <div class="col mb-3">
                    <div class="card shadow" style="width: 22rem;">
                        <div class="card-body">
                            <img src="{{ asset('images/quis.jpg') }}" class="card-img-top" alt="..."
                                style="height: 12rem; object-fit: cover">
                            <div class="row mt-2">
                                <div class="col">
                                    <p class="card-title fw-bold text-black fs-4 stretched-link" href="#"
                                        style="text-decoration: none">{{ strtoupper($paket->name) }}</p>
                                </div>
                                <div class="col text-end">
                                    <p class="m-0 fw-bold">Total Soal</p>
                                    <p >{{ $paket->countSoals() }}</p>
                                </div>

                            </div>
                            <a class="btn btn-primary stretched-link float-end" href="{{ route('quiz.show', $paket->id) }}" >
                                Mulai
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('main.component.footer')
@endsection

@section('script')
    AOS.init();
@endsection
