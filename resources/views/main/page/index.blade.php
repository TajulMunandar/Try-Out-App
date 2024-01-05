@extends('main.component.main')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-5 col-md-12 col-sm-12">
                <h2 class="fw-bolder mb-3 lh-base" data-aos="fade-right" data-aos-duration="1200" style="color: #001C30;">
                    Bentuklah Masa Depanmu melalui Kepahaman Ilmu</h2>
                <p class="caption lh-md" data-aos-duration="1400" data-aos="fade-right"> Bersiaplah untuk mengukir prestasi dan
                    meraih keberhasilan melalui ujian, pintu gerbang menuju masa depan yang gemilang.</p>
                <a class="btn btn-primary" href="/paket" data-aos-duration="1600" data-aos="fade-right">MULAI</a>
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12 d-flex justify-content-center">
                <dotlottie-player data-aos-duration="1400" data-aos="fade-left" src="https://lottie.host/531514e8-a168-4301-8338-7a2e9a6efee9/uw7YA2WFXe.json"
                    background="transparent" speed="1" style="width: 75%;" loop
                    autoplay>
                </dotlottie-player>
            </div>
        </div>
    </div>
    @include('main.component.footer')
@endsection

@section('script')
    AOS.init();
@endsection
