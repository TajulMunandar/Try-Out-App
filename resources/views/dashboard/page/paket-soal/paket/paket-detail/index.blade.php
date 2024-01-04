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
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                    </svg></i>
                Tambah
            </button>

            <div class="card mt-3 col-sm-6 col-md-12">
                <div class="card-body">

                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Paket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Enroll Paket</a>
                        </li>
                    </ul>

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
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $loop->iteration }}">
                                            <i class="fa-solid fa-pen-to-square text-white"></i>
                                        </button>
                                        <button id="delete-button" class="btn btn-danger" id="delete-button"
                                            data-bs-toggle="modal" data-bs-target="#hapusModal{{ $loop->iteration }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{--  MODAL EDIT  --}}
                                <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Paket Detail</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('paket-detail.update', $paket_detail->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <input type="hidden" name="paket_id" value="{{ $paket_id }}">
                                                    <div class="row">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Nama Paket Detail</label>
                                                            <input type="text"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                name="name" value="{{ old('name', $paket_detail->name) }}"
                                                                id="name" placeholder="Anton" autofocus required>
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
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit"
                                                        class="btn btn-warning text-white">Perbarui</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--  MODAL EDIT  --}}

                                {{--  MODAL DELETE  --}}
                                <div class="modal fade" id="hapusModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Data Paket Detail</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('paket-detail.destroy', $paket_detail->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="id" value="{{ $paket_detail->id }}">
                                                    <p class="fs-5">Apakah anda yakin akan menghapus paket detail
                                                        <b>{{ $paket_detail->name }} ?</b></p>

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

    {{--  MODAL ADD  --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Paket Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('paket-detail.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="paket_id" value="{{ $paket_id }}">
                        <div class="row">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Paket</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" placeholder="Anton" autofocus required>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--  MODAL ADD  --}}

@endsection
