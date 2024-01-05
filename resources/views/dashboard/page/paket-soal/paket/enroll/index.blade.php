@extends('dashboard.component.main')
@section('title', 'Data Enroll Paket')
@section('page-heading', 'Data Enroll Paket')

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
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahEnroll">
                <i class=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                    </svg></i>
                Tambah
            </button>

            <div class="card mt-3 col-sm-6 col-md-12">
                <div class="card-body">
                    {{-- tables --}}
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Paket</th>
                                <th>Soal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($enrols as $enrol)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $enrol->paket_details->name }}</td>
                                    <td>{{ $enrol->soals->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editEnroll{{ $loop->iteration }}">
                                            <i class="fa-solid fa-pen-to-square text-white"></i>
                                        </button>
                                        <button id="delete-button" class="btn btn-sm btn-danger" id="delete-button"
                                            data-bs-toggle="modal" data-bs-target="#hapusEnroll{{ $loop->iteration }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{--  MODAL EDIT  --}}
                                <x-form_modal>
                                    @slot('id', "editEnroll$loop->iteration")
                                    @slot('title', 'Edit Data Enroll Paket')
                                    @slot('route', route('enrol.update', $enrol->id))
                                    @slot('method') @method('put') @endslot
                                    @slot('btnPrimaryTitle', 'Perbarui')
                                    @csrf

                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="paket_detail_id" class="form-label">Paket</label>
                                            <select class="form-select" name="paket_detail_id" id="paket_detail_id">
                                                @foreach ($pakets as $paket)
                                                    @if (old('paket_detail_id', $enrol->paket_detail_id) == $paket->id)
                                                        <option value="{{ $paket->id }}" selected>
                                                            {{ $paket->name }}</option>
                                                    @else
                                                        <option value="{{ $paket->id }}">
                                                            {{ $paket->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="soal_id" class="form-label">soal</label>
                                            <select class="form-select" name="soal_id" id="soal_id">
                                                @foreach ($soals as $soal)
                                                    @if (old('soal_id', $enrol->soal_id) == $soal->id)
                                                        <option value="{{ $soal->id }}" selected>
                                                            {{ $soal->name }}</option>
                                                    @else
                                                        <option value="{{ $soal->id }}">
                                                            {{ $soal->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </x-form_modal>
                                {{--  MODAL EDIT  --}}

                                {{--  MODAL DELETE  --}}
                                <x-form_modal>
                                    @slot('id', "hapusEnroll$loop->iteration")
                                    @slot('title', 'Hapus Data Enroll Paket')
                                    @slot('route', route('enrol.destroy', $enrol->id))
                                    @slot('method') @method('delete') @endslot
                                    @slot('btnPrimaryClass', 'btn-outline-danger')
                                    @slot('btnSecondaryClass', 'btn-secondary')
                                    @slot('btnPrimaryTitle', 'Hapus')
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $enrol->id }}">
                                    <p class="fs-5">Apakah anda yakin akan menghapus enrol paket
                                        <b>{{ $enrol->soals->name }} ?</b>
                                    </p>

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

    {{--  MODAL ADD  --}}
    <x-form_modal>
        @slot('id', 'tambahEnroll')
        @slot('title', 'Tambah Data Enroll Paket')
        @slot('route', route('enrol.store'))
        @csrf

        <div class="row">
            <div class="mb-3">
                <label for="paket_detail_id" class="form-label">Paket</label>
                <select class="form-select" name="paket_detail_id" id="paket_detail_id">
                    @foreach ($pakets as $paket)
                        <option value="{{ $paket->id }}">
                            {{ $paket->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="soal_id" class="form-label">Soal</label>
                <select class="form-select" name="soal_id" id="soal_id">
                    @foreach ($soals as $soal)
                        <option value="{{ $soal->id }}">
                            {{ $soal->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </x-form_modal>
    {{--  MODAL ADD  --}}

@endsection
