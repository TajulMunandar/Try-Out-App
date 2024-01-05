@extends('dashboard.component.main')
@section('title', 'Data Soal Detail')
@section('page-heading', 'Data Soal Detail')

@section('content')

    <div class="row mt-6">
        <div class="col-sm-6 col-md-12 col-lg-8">
            <a class="btn btn-outline-secondary" href="{{ route('soal.show', $soal_id) }}">
                <i class="fa-solid fa-chevron-left"></i>
                Kembali
            </a>
            <div class="card mt-3">
                <h5 class="card-header">Buat Soal Detail Baru</h5>
                <form action="{{ route('soal-detail.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="soal_id" value="{{ $soal_id }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" placeholder="Question" autofocus required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label for="answer" class="form-label">Jawaban</label>
                            <div class="mb-3 form-check px-6">
                                <input class="form-check-input @error('jawaban') is-invalid @enderror mt-2" type="radio"
                                    id="flexRadioDefault1" name="jawaban" value="0">
                                <input type="text" class="form-control @error('answer') is-invalid @enderror"
                                    name="answer[]" id="answer" autofocus required>
                                @error('jawaban')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('answer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label for="answer" class="form-label">Jawaban</label>
                            <div class="mb-3 form-check px-6">
                                <input class="form-check-input @error('jawaban') is-invalid @enderror mt-2" type="radio"
                                    id="flexRadioDefault1" name="jawaban" value="1">
                                <input type="text" class="form-control @error('answer') is-invalid @enderror"
                                    name="answer[]" id="answer" autofocus required>
                                @error('jawaban')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('answer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label for="answer" class="form-label">Jawaban</label>
                            <div class="mb-3 form-check px-6">
                                <input class="form-check-input @error('jawaban') is-invalid @enderror mt-2" type="radio"
                                    id="flexRadioDefault1" name="jawaban" value="2">
                                <input type="text" class="form-control @error('answer') is-invalid @enderror"
                                    name="answer[]" id="answer" autofocus required>
                                @error('jawaban')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('answer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label for="answer" class="form-label">Jawaban</label>
                            <div class="mb-3 form-check px-6">
                                <input class="form-check-input @error('jawaban') is-invalid @enderror mt-2" type="radio"
                                    id="flexRadioDefault1" name="jawaban" value="3">
                                <input type="text" class="form-control @error('answer') is-invalid @enderror"
                                    name="answer[]" id="answer" autofocus required>
                                @error('jawaban')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('answer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
