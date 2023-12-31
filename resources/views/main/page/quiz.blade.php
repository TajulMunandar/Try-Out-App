@extends('main.component.main')

@section('content')
    <div class="container ">
        <div class="row">
            <div class="col d-flex justify-content-between align-items-center">
                <p class="fs-3 fw-bold mb-0">
                    {{ $quiz->title }}
                </p>
                <p class="m-0">
                    {{ $tanggal }}
                </p>
            </div>
        </div>
        <hr>
        @if ($quiz->isChoice == 1)
            <form action="{{ route('quiz-main.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $quiz->modulId }}">
                <input type="hidden" name="quizId" value="{{ $quizId }}">
                <div class="row">
                    @foreach ($questions as $question)
                        <div class="col-lg-12 p-3 mt-3">
                            <p class="fs-5 mb-0">{{ $loop->iteration }} . {{ $question->title }}</p>
                        </div>
                        @php
                            $lastAnswerKey = $question->jawabans->count() - 1;
                        @endphp
                        @foreach ($question->jawabans as $key => $jawaban)
                            <div class="col-lg-12 d-flex align-items-center">
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio"
                                        name="jawabanId[{{ $loop->parent->iteration }}]"
                                        id="jawabanId_{{ $loop->parent->iteration }}_{{ $loop->iteration }}"
                                        value="{{ $jawaban->id }}"
                                        @if ($key === $lastAnswerKey) checked hidden @endif>
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
                    @endforeach
                </div>
                <hr>
                <footer class="footer px-5 py-3 text-end">
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#selesai">Selesai</a>
                </footer>
                <!-- Modal -->
                <div class="modal fade" id="selesai" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Quiz</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda Yakin Sudah Mengisi Soal dengan Benar?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @else
            {{-- essay --}}
            <form action="{{ route('quiz-essay.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $quiz->modulId }}">
                <input type="hidden" name="quizId" value="{{ $quizId }}">
                <div class="row d-flex">
                    @foreach ($questions as $question)
                        <div class="col-lg-12 p-3 mt-3">
                            <p class="fs-5">{{ $loop->iteration }} . {{ $question->title }}</p>
                            <div class="row w-100 d-flex align-items-center">
                                <div class="col-lg-8">
                                    <div class="form-floating">
                                        <input type="hidden" name="questionId[]" value="{{ $question->id }}">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="jawaban[]"></textarea>
                                        <label for="floatingTextarea">Jawaban</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="mb-3">
                                        <input class="form-control" type="file" id="formFile" name="file[]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
                <footer class="footer px-5 py-3 text-end">
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#selesai">Selesai</a>
                </footer>
                <!-- Modal -->
                <div class="modal fade" id="selesai" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Quiz</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda Yakin Sudah Mengisi Soal dengan Benar?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>

@endsection

@section('script')
    AOS.init();
@endsection
