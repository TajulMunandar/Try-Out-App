@extends('main.component.main')

@section('content')
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <h1>Bentuklah Masa Depanmu melalui Kepahaman Ilmu</h1>
                    <h2>Bersiaplah untuk mengukir prestasi dan
                        meraih keberhasilan melalui ujian, pintu gerbang menuju masa depan yang gemilang.</h2>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="/paket-main" class="btn-get-started scrollto">Mulai</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us section-bg">
            <div class="container-fluid" data-aos="fade-up">

                <div class="row">

                    <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                        <div class="content">
                            <h3><strong>Sekilas Tentang Sejarah IAIN Lhokseumawe</strong></h3>
                            <p class="text-black" style="text-align: justify">
                                Institut Agama Islam Negeri Lhokseumawe merupakan transformasi dari Akademi Ilmu Agama (AIA)
                                yang diprakarsai oleh Drs. Tgk. H. A. Wahab Dahlawi, saat menjabat sebagai bupati Aceh
                                Utara. Bersama para tokoh masyarakat lainnya, sang bupati, menginisiasi lahirnya lembaga
                                perguruan tinggi Islam pertama di Kota Lhokseumawe, ibukota Kabupaten Aceh Utara ketika itu.
                                Tanggal 12 Juni 1969 merupakan angka keramat bagi keberadaan Akademi Ilmu Al-Qur’an. Selang
                                3 (tiga) tahun kemudian, yakni pada tanggal 24 Mei 1972, bupati bersama beberapa tokoh
                                masyarakat setempat mengadakan rapat penting Yayasan. Hasil rapat menyebutkan bahwa untuk
                                kepentingan pengembangan lembaga perguruan tinggi, disepakati perubahan nama dari AIA
                                menjadi Perguruan Tinggi Malikussaleh yang selanjutnya disingkat dengan PERTIM. Keberadaan
                                AIA kemudian dilebur menjadi fakultas Syariah PERTIM. Pada tahun 1975 fakultas Syariah
                                PERTIM menjadi filial dari Fakultas Syariah IAIN Ar-Raniry Banda Aceh. Sejak pertma berdiri
                                AIA hingga tahun 1975 tampuk kepemimpinan berada di bawah Drs. Tgk. H. A. Wahab Dahlawi.
                            </p>
                            <a class="btn btn-outline-info rounded-pill" target="_blank" href="https://www.iainlhokseumawe.ac.id/sejarah-iain-lhokseumawe/">Baca Lebih Lanjut <i class="fa fa-chevron-right"></i></a>
                        </div>


                    </div>

                    <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img"
                        style='background-image: url("assets/img/why-us.png");' data-aos="zoom-in" data-aos-delay="150">
                        &nbsp;</div>
                </div>

            </div>
        </section><!-- End Why Us Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contact</h2>
                </div>

                <div class="row">

                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location:</h4>
                                <p>Jl. Medan-Banda Aceh Km. 275 No. 1 Alue Awe, Muara Dua, Kota Lhokseumawe. Kode Pos: 24352
                                </p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p>info@iainlhokseumawe.ac.id </p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Call:</h4>
                                <p>(0645) 47267</p>
                            </div>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1670.8000268564938!2d97.15344377954473!3d5.127121275613512!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304783bf6d587d35%3A0xf4d9fa87a020b02c!2sInstitut%20Agama%20Islam%20Negeri%20(IAIN)%20Lhokseumawe!5e0!3m2!1sid!2sid!4v1708420121168!5m2!1sid!2sid"
                                frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
@endsection

@section('script')
    AOS.init();
@endsection
