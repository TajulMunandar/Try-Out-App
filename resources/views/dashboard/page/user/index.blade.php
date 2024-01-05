@extends('dashboard.component.main')
@section('title', 'Data User')
@section('page-heading', 'Data User')

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
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahUser">
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
                                <th>NIM</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->nim }}</td>
                                    <td>
                                        @if ($user->is_admin == 0)
                                            Mahasiswa
                                        @elseif ($user->is_admin == 1)
                                            Admin
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#resetPassword{{ $loop->iteration }}">
                                            <i class="fa-solid fa-unlock-keyhole"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-warning text-white"
                                            data-bs-toggle="modal" data-bs-target="#editUser{{ $loop->iteration }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button id="delete-button" class="btn btn-sm btn-danger" id="delete-button"
                                            data-bs-toggle="modal" data-bs-target="#hapusUser{{ $loop->iteration }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{--  MODAL RESET PASSWORD  --}}
                                <x-form_modal>
                                    @slot('id', "resetPassword$loop->iteration")
                                    @slot('title', 'Reset Password')
                                    @slot('route', route('user.reset'))
                                    @slot('btnPrimaryClass', 'btn-dark')
                                    @slot('btnPrimaryTitle', 'Reset')
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $user->id }}">

                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password
                                                Baru</label>
                                            <div id="pwd1" class="input-group">
                                                <input type="password"
                                                    class="form-control border-end-0 @error('password') is-invalid @enderror"
                                                    name="password" id="password" value="{{ old('password') }}" required>
                                                <span class="input-group-text cursor-pointer">
                                                    <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                                                </span>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="password2" class="form-label">Konfirmasi
                                                Password
                                                Baru</label>
                                            <div id="pwd2" class="input-group">
                                                <input type="password"
                                                    class="form-control border-end-0 @error('password2') is-invalid @enderror"
                                                    name="password2" id="password2" value="{{ old('password2') }}"
                                                    required>
                                                <span class="input-group-text cursor-pointer">
                                                    <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                                                </span>
                                                @error('password2')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </x-form_modal>
                                {{--  MODAL RESET PASSWORD  --}}

                                {{--  MODAL EDIT  --}}

                                <x-form_modal>
                                    @slot('id', "editUser$loop->iteration")
                                    @slot('title', 'Edit Data User')
                                    @slot('route', route('user.update', $user->id))
                                    @slot('method') @method('put') @endslot
                                    @slot('btnPrimaryTitle', 'Perbarui')
                                    @csrf

                                    <div class="row">
                                        <div class="mb-3">
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <label for="nim" class="form-label">NIM</label>
                                            <input type="text" class="form-control @error('nim') is-invalid @enderror"
                                                name="nim" value="{{ old('nim', $user->nim) }}" id="nim"
                                                placeholder="12345..." autofocus required>
                                            @error('nim')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="is_admin" class="form-label">Role</label>
                                            <select class="form-select" name="is_admin" id="is_admin">
                                                <option value="0"
                                                    {{ old('is_admin', $user->is_admin) == 0 ? 'selected' : '' }}>
                                                    Mahasiswa</option>
                                                <option value="1"
                                                    {{ old('is_admin', $user->is_admin) == 1 ? 'selected' : '' }}>
                                                    Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                </x-form_modal>
                                {{--  MODAL EDIT  --}}

                                {{--  MODAL DELETE  --}}
                                <x-form_modal>
                                    @slot('id', "hapusUser$loop->iteration")
                                    @slot('title', 'Hapus Data User')
                                    @slot('route', route('user.destroy', $user->id))
                                    @slot('method') @method('delete') @endslot
                                    @slot('btnPrimaryClass', 'btn-outline-danger')
                                    @slot('btnSecondaryClass', 'btn-secondary')
                                    @slot('btnPrimaryTitle', 'Hapus')

                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <p class="fs-5">Apakah anda yakin akan menghapus data dengan NIM
                                        <b>{{ $user->nim }} ?</b>
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
        @slot('id', 'tambahUser')
        @slot('title', 'Tambah Data User')
        @slot('route', route('user.store'))

        @csrf
        <div class="row">
            <input type="hidden" name="is_admin" value="1">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim"
                    id="nim" placeholder="nim" autofocus required>
                @error('nim')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div id="pwd" class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        id="password" placeholder="*****" required>
                    <span class="input-group-text cursor-pointer">
                        <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                    </span>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

        </div>
    </x-form_modal>
    {{--  MODAL ADD  --}}

    @section('scripts')
        <script>
            const input = document.querySelector("#pwd input");
            const eye = document.querySelector("#pwd .fa-eye-slash");

            eye.addEventListener("click", () => {
                if (input.type === "password") {
                    input.type = "text";

                    eye.classList.remove("fa-eye-slash");
                    eye.classList.add("fa-eye");
                } else {
                    input.type = "password";

                    eye.classList.remove("fa-eye");
                    eye.classList.add("fa-eye-slash");
                }
            });
        </script>
    @endsection

@endsection
