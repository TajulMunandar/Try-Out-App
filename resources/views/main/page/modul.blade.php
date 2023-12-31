@extends('main.component.main')

@section('content')
    <div class="container">
        <div class="row d-flex">
            <div class="col-lg-5 col-md-12">
                <p class="hastag" data-aos="fade-right" data-aos-duration="1000">#PejuangIlmu</p>
                <h2 class="fw-bolder mb-3 lh-base" data-aos="fade-right" data-aos-duration="1200" style="color: #001C30;">Bangun
                    Masa Depanmu Dengan Ilmu</h2>
            </div>
        </div>
        <div class="row" data-aos="fade-up" data-aos-duration="1000">
            <div class="col">
                <nav class="navbar navbar-expand-lg">
                    <div class="navbar-collapse fs-5 fw-bold">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 slider w-100 justify-content-between">
                            <li class="nav-item"><a class="nav-link" href="/modul">Semua<a></li>
                            @foreach ($prodis as $prodi)
                                <li class="nav-item me-5">
                                    <a class="nav-link" aria-current="page"
                                        href="{{ route('modul-main.index', ['prodi' => $prodi->id]) }}">{{ $prodi->name }}</a>
                                </li>
                            @endforeach
                            <select class="form-select select2" id="id_barang" name="id_barang">
                                <option selected disabled>Pilih Prodi</option>
                                @foreach ($prodis2 as $prodi2)
                                    <option data-href="{{ route('modul-main.index', ['prodi' => $prodi2->id]) }}">
                                        {{ $prodi2->name }}
                                    </option>
                                @endforeach
                            </select>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row p-5 h-100" data-aos="fade-up" data-aos-duration="1500">
            @foreach ($moduls as $modul)
                <div class="col mb-3">
                    <div class="card" style="width: 22rem;">
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $modul->image) }}" class="card-img-top" alt="..."
                                style="height: 12rem; object-fit: cover">
                            <div class="row">
                                <div class="col">
                                    <a class="card-title fw-bold text-black fs-4 stretched-link"
                                        href="{{ route('pramateri.show', ['modul' => $modul->slug]) }}"
                                        style="text-decoration: none">{{ $modul->name }}</a>
                                </div>
                                <div class="col text-end">
                                    <p class="badge bg-primary mt-2"><span>{{ $modul->users->name }}</span></p>
                                </div>
                            </div>
                            <p class="card-text">{{ $modul->deskripsi }}</p>
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
    $(document).ready(function() {
    $('.select2').select2({
    theme: 'bootstrap-5',
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
    });
    });

    $(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
    });

    $(document).ready(function() {
        $('#id_barang').change(function() {
            var selectedOption = $(this).find(':selected');
            var href = selectedOption.data('href');

            if (href) {
                window.location.href = href;
            }
        });
    });
@endsection
