@extends('main.component.main')

@section('content')
    <div class="container">
        <div class="row d-flex">
            <div class="col-lg-5 col-md-12">
                <p class="hastag" data-aos="fade-right" data-aos-duration="1000">#PejuangIlmu</p>
                <h2 class="fw-bolder mb-3 lh-base" data-aos="fade-right" data-aos-duration="1200" style="color: #001C30;">
                    Bentuklah Masa Depanmu Melalui Kepahaman Ilmu</h2>
            </div>
        </div>
        <div class="row p-5 h-100" data-aos="fade-up" data-aos-duration="1500">
            @foreach ($pakets as $paket)
                <div class="col mb-3">
                    <div class="card" style="width: 22rem;">
                        <div class="card-body">
                            {{-- <img src="{{ asset('storage/' . $paket->image) }}" class="card-img-top" alt="..."
                                style="height: 12rem; object-fit: cover"> --}}
                            <div class="row">
                                <div class="col">
                                    <a class="card-title fw-bold text-black fs-4 stretched-link"
                                        href="#"
                                        style="text-decoration: none">{{ $paket->name }}</a>
                                </div>
                                {{-- <div class="col text-end">
                                    <p class="badge bg-primary mt-2"><span>{{ $paket->users->name }}</span></p>
                                </div> --}}
                            </div>
                            <p class="card-text">{{ $paket->deskripsi }}</p>
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
