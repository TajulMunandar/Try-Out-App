@extends('main.component.main')

@section('content')
    <div class="container" id="quiz">
        <div class="col">
            <div class="row mt-5">
                <div class="col">
                    <p class="fs-3 fw-bold mb-0">{{ strtoupper($quiz->name) }}</p>
                </div>
                <div class="col text-end">
                    <p class="fw-bold fs-4">Batas Waktu</p>
                    <p id="countdown" class="fs-5" data-end="{{ $end }}"></p>
                </div>
            </div>
        </div>
        <div class="quiz-page">
        </div>

        <form id="quiz-form" action="{{ route('quiz.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="mahasiswa_id" value="{{ auth()->user()->mahasiswas->id }}">
            <input type="hidden" name="paket_detail_id" value="{{ $quiz->id }}">
            @foreach ($shuffledSoalDetails as $soal)
                <div class="quiz-page" >
                    {{-- Konten Soal dan Jawaban --}}
                    <div class="row mb-5 pb-5">
                        <div>
                            <p class="fw-bold">Paket Soal : {{ $soal->soals->name }}</p>
                        </div>
                        <div class="col-lg-12 p-3 mt-3">
                            <p class="fs-3 mb-0">{{ $loop->iteration }} . {{ $soal->name }}</p>
                        </div>
                        @php
                            $lastAnswerKey = $soal->jawabans->count() - 1;
                        @endphp
                        @foreach ($soal->jawabans as $key => $jawaban)
                            <div class="col-lg-12 d-flex align-items-center">
                                <div class="form-check mt-1 fs-4">
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

                   <hr class="mt-5 pt-5">
                    <button class="btn btn-outline-dark back-page me-2">
                        <i class="fa-solid fa-chevron-left fa-sm"></i>
                        Back
                    </button>
                    <button class="btn btn-outline-dark next-page me-2">
                        Next
                        <i class="fa-solid fa-chevron-right fa-sm"></i>
                    </button>
                    <a class="btn btn-success float-end" @click="saveQuiz">
                        <i class="fa-solid fa-floppy-disk fa-sm"></i>
                        Save
                    </a>
                </div>
            @endforeach
        </form>
    </div>
    </div>
@endsection


@section('script')



const {
    createApp
} = Vue

createApp({
    data() {
        return {
            countdown: '', // Countdown value
            currentPage: 1, // Current page of the quiz
            countdownInterval: null,
            end: '{{ $end }}',
        };
    },
    mounted() {
        this.initCountdownTimer();

        let timer = '{{ $end }}';
        let waktuSelesai = new Date(timer);
        console.log(waktuSelesai);

        setInterval(() => {
            let waktuSaatIni = new Date();
            console.log(waktuSaatIni);

            if (waktuSaatIni >= waktuSelesai) {
                document.getElementById('quiz-form').submit();
            }
        }, 1000);

        const quizPages = document.querySelectorAll('.quiz-page');
        let currentPage = 1;

        const btnModal = document.querySelector('#btnModal');

        function showPage(pageIndex) {
            // Sembunyikan atau tampilkan tombol next dan back sesuai dengan keadaan
            const nextPageBtn = document.querySelector('.next-page');
            const backPageBtn = document.querySelector('.back-page');
            const saveBtn = document.querySelector('.btn-success');

            // Tampilkan tombol "Next" kecuali di halaman terakhir
                nextPageBtn.style.display = pageIndex < quizPages.length - 1 ? 'block' : 'none';

                // Tampilkan tombol "Back" kecuali di halaman pertama
                backPageBtn.style.display = pageIndex > 1 ? 'block' : 'none';

                // Tampilkan tombol "Save" hanya di halaman terakhir
                saveBtn.style.display = pageIndex === quizPages.length - 1 ? 'block' : 'none';


                // Sembunyikan semua halaman kecuali halaman yang aktif
                quizPages.forEach((page, index) => {
                    page.style.display = index === pageIndex ? 'block' : 'none';
                });
            }

            // Tampilkan halaman pertama saat dokumen dimuat
            showPage(currentPage);

            function nextPage() {
                if (currentPage < quizPages.length - 1) {
                    currentPage++;
                    showPage(currentPage);
                }

                // Tampilkan tombol "Back" di semua keadaan kecuali halaman terakhir
                document.querySelector('.back-page').style.display = 'block';

                // Sembunyikan tombol "Next" di halaman terakhir
                document.querySelector('.next-page').style.display = currentPage < quizPages
                    .length - 1 ? 'block' : 'none';

                // Tampilkan tombol "Save" hanya di halaman terakhir
                document.querySelector('.btn-success').style.display = currentPage === quizPages
                    .length - 1 ? 'block' : 'none';
            }

            function prevPage() {
                if (currentPage > 0) {
                    currentPage--;
                    showPage(currentPage);
                }

                // Tampilkan tombol "Next" di semua keadaan kecuali halaman pertama
                document.querySelector('.next-page').style.display = currentPage < quizPages
                    .length - 1 ? 'block' : 'none';

                // Sembunyikan tombol "Back" di halaman pertama
                document.querySelector('.back-page').style.display = currentPage > 1 ? 'block' :
                    'none';

                // Tampilkan tombol "Save" hanya di halaman terakhir
                document.querySelector('.btn-success').style.display = currentPage === quizPages
                    .length - 1 ? 'block' : 'none';

            }

            // Tambahkan event listener untuk tombol "Next"
            document.querySelectorAll('.next-page').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    nextPage();
                });
            });

            // Tambahkan event listener untuk tombol "Back"
            document.querySelectorAll('.back-page').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    prevPage();
                });
            });

    },
    methods: {
        saveQuiz() {
            // Show a confirmation dialog using SweetAlert
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to save the quiz?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Trigger the form submission
                    document.getElementById('quiz-form').submit();
                } else {
                    // If the user clicks "Cancel", show a SweetAlert instead of alert
                    Swal.fire({
                        icon: 'info',
                        title: 'Quiz not saved',
                        text: 'You have chosen not to save the quiz.',
                    });
                }
            });
        },
        initCountdownTimer() {
            const countDownDate = new Date(this.end).getTime();
            const countdownElement = document.getElementById('countdown'); // Get the DOM element

            this.countdownInterval = setInterval(() => {
                const now = new Date().getTime();
                const distance = countDownDate - now;

                if (distance >= 0) {
                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    const countdownString = ` ${hours};${minutes};${seconds} <i class="fa-solid fa-clock"></i>`;

                    // Set the countdown value directly in the DOM element
                    countdownElement.innerHTML = countdownString;
                } else {
                    clearInterval(this.countdownInterval);
                    countdownElement.textContent = "EXPIRED";
                }
            }, 1000);
        },
    },

}).mount("#quiz");
@endsection
