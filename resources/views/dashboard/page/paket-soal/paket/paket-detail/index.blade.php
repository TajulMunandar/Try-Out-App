@extends('dashboard.component.main')
@section('title', 'Data Paket Detail')
@section('page-heading', 'Data Paket Detail')

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
            <a class="btn btn-outline-secondary" href="{{ route('paket.index') }}">
                <i class="fa-solid fa-chevron-left"></i>
                Kembali
            </a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPaketDetail">
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
                                <th>Prodi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paket_details as $paket_detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $paket_detail->name }}</td>
                                    <td>{{ $paket_detail->prodis->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editPaketDetail{{ $loop->iteration }}">
                                            <i class="fa-solid fa-pen-to-square text-white"></i>
                                        </button>
                                        <button id="delete-button" class="btn btn-sm btn-danger" id="delete-button"
                                            data-bs-toggle="modal" data-bs-target="#hapusPaketDetail{{ $loop->iteration }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{--  MODAL EDIT  --}}
                                <x-form_modal>
                                    @slot('id', "editPaketDetail$loop->iteration")
                                    @slot('title', 'Edit Data Paket Detail')
                                    @slot('route', route('paket-detail.update', $paket_detail->id))
                                    @slot('method') @method('put') @endslot
                                    @slot('btnPrimaryTitle', 'Perbarui')
                                    @csrf

                                    <input type="hidden" name="paket_id" value="{{ $paket_id }}">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Paket Detail</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name', $paket_detail->name) }}" id="name"
                                                placeholder="Anton" autofocus required>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="prodi_id" class="form-label">Prodi</label>
                                            <select class="form-select" name="prodi_id" id="prodi_id">
                                                @foreach ($prodis as $prodi)
                                                    @if (old('prodi_id', $paket_detail->prodi_id) == $prodi->id)
                                                        <option value="{{ $prodi->id }}" selected>
                                                            {{ $prodi->name }}</option>
                                                    @else
                                                        <option value="{{ $prodi->id }}">
                                                            {{ $prodi->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </x-form_modal>
                                {{--  MODAL EDIT  --}}

                                {{--  MODAL DELETE  --}}
                                <x-form_modal>
                                    @slot('id', "hapusPaketDetail$loop->iteration")
                                    @slot('title', 'Hapus Data Paket Detail')
                                    @slot('route', route('paket-detail.destroy', $paket_detail->id))
                                    @slot('method') @method('delete') @endslot
                                    @slot('btnPrimaryClass', 'btn-outline-danger')
                                    @slot('btnSecondaryClass', 'btn-secondary')
                                    @slot('btnPrimaryTitle', 'Hapus')
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $paket_detail->id }}">
                                    <p class="fs-5">Apakah anda yakin akan menghapus paket detail
                                        <b>{{ $paket_detail->name }} ?</b>
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
        @slot('id', 'tambahPaketDetail')
        @slot('title', 'Tambah Data Paket Detail')
        @slot('route', route('paket-detail.store'))
        @csrf

        <input type="hidden" name="paket_id" value="{{ $paket_id }}">
        <div class="row">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Paket</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    placeholder="Anton" autofocus required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="prodi_id" class="form-label">Prodi</label>
                <select class="form-select" name="prodi_id" id="prodi_id">
                    @foreach ($prodis as $prodi)
                        @if (old('prodi_id', $prodi->id) == $prodi->id)
                            <option value="{{ $prodi->id }}" selected>{{ $prodi->name }}</option>
                        @else
                            <option value="{{ $prodi->id }}">{{ $prodi->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </x-form_modal>
    {{--  MODAL ADD  --}}

@endsection
