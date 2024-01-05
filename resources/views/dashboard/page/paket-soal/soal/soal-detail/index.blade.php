@extends('dashboard.component.main')
@section('title', 'Data Soal Detail')
@section('page-heading', 'Data Soal Detail')

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
            <a class="btn btn-outline-secondary" href="{{ route('soal.index') }}">
                <i class="fa-solid fa-chevron-left"></i>
                Kembali
            </a>
            <a class="btn btn-primary" href="{{ route('soal-detail.create', ['soal_id' => $soal_id]) }}">
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
                            @foreach ($soal_details as $soal_detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $soal_detail->name }}</td>
                                    <td>
                                        @foreach ($soal_detail->jawabans as $key => $jawaban)
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
                                        $correct = $soal_detail->jawabans->where('status', true)->first();
                                    @endphp
                                    @if ($correct)
                                        {{ $correct->name }}
                                    @else
                                        Tidak ada jawaban yang benar
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-warning text-white"
                                        href="{{ route('soal-detail.edit', ['soal_detail' => $soal_detail->id, 'soal_id' => $soal_id]) }}"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <button id="delete-button" class="btn btn-sm btn-danger" id="delete-button"
                                        data-bs-toggle="modal" data-bs-target="#hapusSoalDetail{{ $loop->iteration }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            {{--  MODAL DELETE  --}}
                            <x-form_modal>
                                @slot('id', "hapusSoalDetail$loop->iteration")
                                @slot('title', 'Hapus Data Soal Detail')
                                @slot('route', route('soal-detail.destroy', $soal_detail->id))
                                @slot('method') @method('delete') @endslot
                                @slot('btnPrimaryClass', 'btn-outline-danger')
                                @slot('btnSecondaryClass', 'btn-secondary')
                                @slot('btnPrimaryTitle', 'Hapus')
                                @csrf

                                <input type="hidden" name="soal_id" id="" value="{{ $soal_id }}">
                                <p class="fs-5">Apakah anda yakin akan menghapus data </p>
                                <b>{{ $soal_detail->name }} ?</b>
                            </x-form_modal>
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
