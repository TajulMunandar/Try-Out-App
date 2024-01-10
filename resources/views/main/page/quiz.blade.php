@extends('main.component.main')

@section('content')
    <div class="container" id="quiz">
        <div class="quiz-page">
            {{-- Halaman Pertama --}}
            <div class="row">
                <div class="col d-flex justify-content-between align-items-center">
                    <p class="fs-3 fw-bold mb-0">{{ $quiz->name }}</p>
                </div>
            </div>
        </div>

        @foreach ($shuffledSoalDetails as $soal)
            <div class="quiz-page">
                {{-- Konten Soal dan Jawaban --}}
                <div class="row">
                    <div class="col-lg-12 p-3 mt-3">
                        <p class="fs-5 mb-0">{{ $loop->iteration }} . {{ $soal->name }}</p>
                    </div>
                    @php
                        $lastAnswerKey = $soal->jawabans->count() - 1;
                    @endphp
                    @foreach ($soal->jawabans as $key => $jawaban)
                        <div class="col-lg-12 d-flex align-items-center">
                            <div class="form-check mt-1">
                                <input class="form-check-input" type="radio"
                                    name="jawaban_id[{{ $loop->parent->iteration }}]"
                                    id="jawabanId_{{ $loop->parent->iteration }}_{{ $loop->iteration }}"
                                    value="{{ $jawaban->id }}" @if ($key === $lastAnswerKey) checked hidden @endif>
                                @php
                                    $abjad = chr(97 + $key);
                                @endphp
                                <label class="form-check-label"
                                    for="jawabanId_{{ $loop->parent->iteration }}_{{ $loop->iteration }}"
                                    @if ($key === $lastAnswerKey) hidden @endif>
                                    {{ $abjad }}. {{ $jawaban->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <form>
                    <button class="btn btn-primary back-page">Back</button>
                    <button class="btn btn-primary next-page">Next</button>
                </form>
            </div>
        @endforeach

        <form id="quiz-form" action="{{ route('quiz.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection


@section('script')
    const {
        createApp
        } = Vue

    createApp({
        mounted() {
            document.addEventListener("DOMContentLoaded", function () {
                const quizPages = document.querySelectorAll('.quiz-page');
                let currentPage = 1;
        
                function showPage(pageIndex) {
                    // Sembunyikan semua halaman
                    quizPages.forEach((page, index) => {
                        if (index === pageIndex) {
                            page.style.display = 'block';
                        } else {
                            page.style.display = 'none';
                        }
                    });
                }
        
                // Tampilkan halaman pertama saat dokumen dimuat
                showPage(currentPage);
        
                function nextPage() {
                    if (currentPage < quizPages.length - 1) {
                        currentPage++;
                        showPage(currentPage);
                    }
                }

                function prevPage() {
                    if (currentPage > 0) {
                        currentPage--;
                        showPage(currentPage);
                    }
                }
        
                // Tambahkan event listener untuk tombol "Next"
                document.querySelectorAll('.next-page').forEach(button => {
                    button.addEventListener('click', function (e) {
                        e.preventDefault();
                        nextPage();
                    });
                });

                // Tambahkan event listener untuk tombol "Back"
                document.querySelectorAll('.back-page').forEach(button => {
                    button.addEventListener('click', function (e) {
                        e.preventDefault();
                        prevPage();
                    });
                });
            });
    },

    }).mount("#quiz");
@endsection
