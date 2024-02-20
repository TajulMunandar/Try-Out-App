@extends('main.component.main')

@section('content')
    <div class="container mt-5 pt-5">
        <div class="row d-flex">
            <div class="col-lg-5 col-md-12">
                <p class="hastag" data-aos="fade-right" data-aos-duration="1000">#PejuangIlmu</p>
                <h2 class="fw-bolder mb-3 lh-base" data-aos="fade-right" data-aos-duration="1200" style="color: #001C30;">
                    Bentuklah Masa Depanmu Melalui Kepahaman Ilmu</h2>
            </div>
        </div>
        <div class="row p-5 h-100" data-aos="fade-up" data-aos-duration="1000">
            {{--  ALERT  --}}
            <div class="row mt-3">
                <div class="col">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('failed'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('failed') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
            {{--  ALERT  --}}
            @foreach ($pakets as $paket)
                @if ($paket->paket_details->isNotEmpty())
                    <div class="col mb-3">
                        <div class="card shadow icon-box" style="width: 22rem;">
                            <div class="card-body">
                                <img src="{{ asset('images/quis.jpg') }}" class="card-img-top" alt="..."
                                    style="height: 12rem; object-fit: cover">
                                <div class="row mt-2">
                                    <div class="col text-center">
                                        <h4>
                                            <a class="card-title fw-bold stretched-link"
                                            href="{{ route('paket-main.show', $paket->id) }}"
                                            style="text-decoration: none">{{ strtoupper($paket->name) }}</a>
                                        </h4>

                                    </div>
                                </div>
                                <div class="row">
                                    <p class="m-0 fw-bold ">Mata Kuliah</p>
                                    <div class="col">
                                        @foreach ($paket->paket_details as $paketd)
                                            <p class="badge bg-primary mt-2 mb-2">
                                                <span>
                                                    {{ $paketd->name }}
                                                </span>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row ">
                                    @php
                                        $start = \Carbon\Carbon::parse($paket->start)->format(' d M Y');
                                        $end = \Carbon\Carbon::parse($paket->end)->format(' d M Y');
                                        $starth = \Carbon\Carbon::parse($paket->start)->format('H : i');
                                        $endh = \Carbon\Carbon::parse($paket->end)->format('H : i');
                                    @endphp
                                    <div class="col">
                                        <p class="m-0 fw-bold">Start Date</p>
                                        <p class="m-0" > {{ $start }}</p>
                                        <p >Time : {{ $starth }}</p>
                                    </div>
                                    <div class="col">
                                        <p class="m-0 fw-bold">End Date</p>
                                        <p class="m-0" >{{ $end }}</p>
                                        <p > Time : {{ $endh }}</p>
                                    </div>
                                </div>
                                <p class="card-text">{{ $paket->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div id="preloader"></div>
@endsection

@section('script')
    AOS.init();
@endsection
