@extends('dashboard.component.main')
@section('title', 'Data Soal Detai')
@section('page-heading', 'Data Soal Detai')

@section('content')
    <div class="row mt-6">
        <div class="col-sm-6 col-md-12 col-lg-8">
            <a class="btn btn-outline-secondary" href="{{ route('soal.show', $soal_id) }}">
                <i class="fa-solid fa-chevron-left"></i>
                Kembali
            </a>
            <div class="card mt-3">
                <h5 class="card-header">Edit Soal Detail</h5>
                <form action="{{ route('soal-detail.update', $soal_detail->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="soal_id" value="{{ $soal_id }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" value="{{ old('name', $soal_detail->name) }}"
                                    placeholder="Anton" autofocus required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @foreach ($jawabans as $index => $value)

                                <div class="mb-3 form-check px-6">
                                    <input type="hidden" name="idQuestion[]" value="{{ $value->id }}">
                                    @if ($index < 4)
                                    <p class="m-0">
                                        <label for="answer" class="form-label">Jawaban</label>
                                    </p>
                                        {{-- Tampilkan opsi radio dan input teks untuk 4 jawaban pertama --}}
                                        <input class="form-check-input @error('jawaban') is-invalid @enderror mt-2"
                                            type="radio" id="flexRadioDefault1" name="jawaban"
                                            value="{{ old('jawaban', $index) }}" {{ $value->status ? 'checked' : '' }}>
                                        <input type="text"
                                            class="form-control @error('answer.' . $index) is-invalid @enderror"
                                            name="answer[]" id="answer{{ $index }}"
                                            value="{{ old('answer.' . $index, $value->name) }}" required>
                                    @endif

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
                            @endforeach
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Perbarui</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
