@extends('dashboard.component.main')
@section('title', 'Data Question Quizz Choice')
@section('page-heading', 'Data Question Quizz Choice')

@section('content')

    {{--  ALERT  --}}
    <div class="row mt-3">
        <div class="col">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    {{--  ALERT  --}}

    {{--  CONTENT  --}}
    <div class="row mt-3 mb-5">
        <div class="col">
            <a href="{{ route('choicee.index', ['isChoice' => 'true']) }}" class="btn btn-dark "><i
                    class="fa-solid fa-arrow-left"></i> Kembali</a>
            <a class="btn btn-dark" href="{{ route('question.create', ['isChoice' => $isChoice, 'quizzId' => $quizzId]) }}">
                <i class=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                    </svg></i>
                Tambah
            </a>

            <div class="card mt-3 col-sm-6 col-md-12">
                <div class="card-body">

                    {{-- tables --}}
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Jawaban</th>
                                <th>Jawaban benar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $question->title }}</td>
                                    <td>
                                    @foreach ($question->jawabans as $key => $jawaban)
                                            @php
                                                $abjad = chr(97 + $key);
                                            @endphp

                                            {{ $abjad }}. {{ $jawaban->name }} <br>
                                            @if ($key === 3)
                                                @break
                                            @endif
                                    @endforeach
                                </td>
                                <td>
                                    @php
                                        $correct = $question->jawabans->where('status', true)->first();
                                    @endphp
                                    @if ($correct)
                                        {{ $correct->name }}
                                    @else
                                        Tidak ada jawaban yang benar
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-warning text-white"
                                        href="{{ route('question.edit', ['question' => $question->id, 'isChoice' => $isChoice, 'quizzId' => $quizzId]) }}"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <button id="delete-button" class="btn btn-danger" id="delete-button"
                                        data-bs-toggle="modal" data-bs-target="#hapusModal">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            {{--  MODAL DELETE  --}}
                            <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Data Question Choice
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('question.destroy', $question->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="isChoice" id="" value="true">
                                                <input type="hidden" name="quizId" id=""
                                                    value="{{ $quizzId }}">
                                                <p class="fs-5">Apakah anda yakin akan menghapus data </p>
                                                <b>{{ $question->title }} ?</b>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{--  MODAL DELETE  --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{--  CONTENT  --}}

@endsection
