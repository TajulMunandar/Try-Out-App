@extends('dashboard.component.main')
@section('title', 'Data Mahasiswa')
@section('page-heading', 'Data Mahasiswa')

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
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMahasiswa">
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
                                <th>Name</th>
                                <th>NIM</th>
                                <th>Kelas</th>
                                <th>Mata Kuliah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $mahasiswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mahasiswa->name }}</td>
                                    <td>{{ $mahasiswa->nim }}</td>
                                    <td>{{ $mahasiswa->kelas }}</td>
                                    <td>{{ $mahasiswa->prodis->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editMahasiswa{{ $loop->iteration }}">
                                            <i class="fa-solid fa-pen-to-square text-white"></i>
                                        </button>
                                        <button id="delete-button" class="btn btn-sm btn-danger" id="delete-button"
                                            data-bs-toggle="modal" data-bs-target="#hapusMahasiswa{{ $loop->iteration }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{--  MODAL EDIT  --}}
                                <x-form_modal>
                                    @slot('id', "editMahasiswa$loop->iteration")
                                    @slot('title', 'Edit Data Mahasiswa')
                                    @slot('route', route('mahasiswa.update', $mahasiswa->id))
                                    @slot('method') @method('put') @endslot
                                    @slot('btnPrimaryTitle', 'Perbarui')
                                    @csrf

                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Mahasiswa</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name', $mahasiswa->name) }}" id="name"
                                                placeholder="Anton" autofocus required>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="nim" class="form-label">NIM</label>
                                            <input type="text" class="form-control @error('nim') is-invalid @enderror"
                                                name="nim" value="{{ old('nim', $mahasiswa->nim) }}" id="nim"
                                                placeholder="123...." autofocus required>
                                            @error('nim')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="kelas" class="form-label">Kelas</label>
                                            <input type="text" class="form-control @error('kelas') is-invalid @enderror"
                                                name="kelas" value="{{ old('kelas', $mahasiswa->kelas) }}" id="kelas"
                                                placeholder="4B" autofocus required>
                                            @error('kelas')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="prodi_id" class="form-label">Mata Kuliah</label>
                                            <select class="form-select" name="prodi_id" id="prodi_id">
                                                @foreach ($prodis as $prodi)
                                                    @if (old('prodi_id', $mahasiswa->prodi_id) == $prodi->id)
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
                                    @slot('id', "hapusMahasiswa$loop->iteration")
                                    @slot('title', 'Hapus Data Mahasiswa')
                                    @slot('route', route('mahasiswa.destroy', $mahasiswa->id))
                                    @slot('method') @method('delete') @endslot
                                    @slot('btnPrimaryClass', 'btn-outline-danger')
                                    @slot('btnSecondaryClass', 'btn-secondary')
                                    @slot('btnPrimaryTitle', 'Hapus')
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $mahasiswa->id }}">
                                    <p class="fs-5">Apakah anda yakin akan menghapus mahasiswa
                                        <b>{{ $mahasiswa->name }} ?</b>
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
        @slot('id', 'tambahMahasiswa')
        @slot('title', 'Tambah Data Mahasiswa')
        @slot('route', route('mahasiswa.store'))

        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                placeholder="Anton" autofocus required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim"
                placeholder="123...." autofocus required>
            @error('nim')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="kelas" class="form-label">Kelas</label>
            <input type="text" class="form-control @error('kelas') is-invalid @enderror" name="kelas" id="kelas"
                placeholder="4B" autofocus required>
            @error('kelas')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="prodi_id" class="form-label">Mata Kuliah</label>
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
    </x-form_modal>
    {{--  MODAL ADD  --}}

@endsection
