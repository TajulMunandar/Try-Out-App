@extends('main.component.main')

@section('content')
    <div class="container">
        <div class="row d-flex">
            <div class="col-lg-5 col-md-12">
                <p class="hastag" data-aos="fade-right" data-aos-duration="1000">#PejuangIlmu</p>
                <h2 class="fw-bolder mb-3 lh-base" data-aos="fade-right" data-aos-duration="1200" style="color: #001C30;">
                    {{ $modul->name }}</h2>
            </div>
        </div>
        <div class="row" data-aos="fade-up" data-aos-duration="1000">
            <div class="col">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pramateri/' . $modul->slug . '/pramateri') ? 'active' : '' }}"
                            href="{{ route('pramateri-main.show', ['modul' => $modul->slug]) }}">Materi</a>
                    </li>
                    @if (auth()->user())
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('pramateri/' . $modul->slug . '/quiz') ? 'active' : '' }}"
                                href="{{ route('pramateri-quiz.show', ['modul' => $modul->slug]) }}">Quiz</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="row p-5 h-100" data-aos="fade-up" data-aos-duration="1500">
            @foreach ($quizzes as $quiz)
                <div class="col mb-3">
                    <div class="card" style="width: 22rem;">
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $quiz->moduls->image) }}" class="card-img-top" alt="..."
                                style="height: 15rem; object-fit: cover">
                            <div class="row mb-3 d-flex  align-items-center">

                                <div class="col">
                                    <h5 class="card-title fw-bold">{{ $quiz->title }}</h5>
                                    <p class="card-text">{{ $date }}</p>
                                </div>
                                <div class="col text-end">
                                    @if ($quiz->isChoice == 1)
                                        <span class="badge bg-info"> Choice </span>
                                    @else
                                        <span class="badge bg-success"> Essay </span>
                                    @endif

                                    @php
                                        $score = $quiz->scores->where('userId', auth()->user()->id)->first(); // Ambil skor pertama (jika ada) dari relasi scores
                                    @endphp

                                    @if ($score)
                                        <p class="mb-0 text-end"><span class="badge bg-black">{{ $score->nilai }} /
                                                100</span></p>
                                    @else
                                        <p class="mb-0 text-end"><span class="badge bg-black">No Score</span></p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <?php
                                    $first = $quiz->firstTime;

                                    $last = $quiz->lastTime;

                                    // Convert the datetime to Y-m-d format (Year-Month-Day)
                                    $firstTime = date('D M Y', strtotime($first));
                                    $lastTime = date('D M Y', strtotime($last));

                                    // Extract the time from the datetime and format it as HH:MM
                                    $firstTime2 = date('H:i', strtotime($first));
                                    $lastTime2 = date('H:i', strtotime($last));
                                    ?>
                                    <p class="mb-1">Dari:</p>
                                    <p class="badge bg-info mb-1"><span>{{ $firstTime }}</span></p>
                                    <p class="ms-1">{{ $firstTime2 }} WIB</p>
                                </div>
                                <div class="col">
                                    <p class="mb-1">Sampai:</p>
                                    <p class="badge bg-danger mb-1"><span>{{ $lastTime }}</span></p>
                                    <p class="ms-1">{{ $lastTime2 }} WIB</p>
                                </div>
                            </div>

                            @php
                                $now = now();
                                $isWithinTime = $now >= $quiz->firstTime && $now <= $quiz->lastTime;
                                $isFinish = \App\Models\score::where('userId', auth()->user()->id)
                                    ->where('quizId', $quiz->id)
                                    ->first();

                                $url = '#';
                                if ($isWithinTime && !$isFinish) {
                                    $url = route('quiz-main.showquiz', ['id' => $quiz->id]);
                                }

                                $modulAkses = $quiz->moduls->prodiId == auth()->user()->prodiId;
                                $buttonClasses = 'btn btn-primary stretched-link float-end';
                                if (!$isWithinTime || $isFinish || !$modulAkses) {
                                    $buttonClasses .= ' disabled';
                                }
                            @endphp
                            <a href="{{ $url }}" class="{{ $buttonClasses }}">
                                Mulai
                            </a>
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
