@extends('main.component.main')

@section('content')
    <div class="container">
        <div class="quiz-page">
            {{-- Halaman Pertama --}}
            <div class="row">
                <div class="col d-flex justify-content-between align-items-center">
                    <p class="fs-3 fw-bold mb-0">{{ $quiz->name }}</p>
                </div>
            </div>
            <form>
                {{-- Konten Pertama --}}
                <button class="btn btn-primary next-page">Next</button>
            </form>
        </div>

        @foreach ($shuffledSoalDetails as $soal)
            <div class="quiz-page" style="display: none;">
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
                    <button class="btn btn-primary next-page">Next</button>
                </form>
            </div>
        @endforeach

        <form id="quiz-form" action="{{ route('quiz.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- Input jawaban --}}
            {{-- ... Input Jawaban ... --}}
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection

@section('script')
document.addEventListener('DOMContentLoaded', function () {
    let currentPage = 0;
    const quizPages = document.querySelectorAll('.quiz-page');
    const nextPageButtons = document.querySelectorAll('.next-page');

    nextPageButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Simpan jawaban pada halaman saat ini ke dalam formulir
            saveCurrentPageAnswers();

            // Tampilkan halaman berikutnya atau submit formulir jika ini halaman terakhir
            if (currentPage < quizPages.length - 1) {
                currentPage++;
                showPage(currentPage);
            } else {
                document.getElementById('quiz-form').submit();
            }
        });
    });

    function saveCurrentPageAnswers() {
        const currentAnswers = document.querySelectorAll(
            `.quiz-page:nth-child(${currentPage + 1}) input[type="radio"]:checked`
        );

        currentAnswers.forEach(answer => {
            const name = answer.name.replace('jawaban_id', `jawaban[${currentPage}]`);
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = name;
            hiddenInput.value = answer.value;
            document.getElementById('quiz-form').appendChild(hiddenInput);
        });
    }

    function showPage(pageIndex) {
        quizPages.forEach((page, index) => {
            if (index === pageIndex) {
                page.style.display = 'block';
            } else {
                page.style.display = 'none';
            }
        });
    }
});

@endsection
