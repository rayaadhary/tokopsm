@extends('admin.partials.app')

@section('title')
    Ubah Pengguna
@endsection

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Akun /</span> Ubah akun</h4>
        @if (session('message'))
            <div class="alert alert-primary">
                {{ session('message') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('admin.user.update', $user) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <h5 class="card-header">Akun</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Nama pengguna akun</label>
                                <input type="text" class="form-control" id="defaultFormControlInput"
                                    placeholder="Isi Nama Pengguna Akun" aria-describedby="defaultFormControlHelp"
                                    name="name" value="{{ old('name', $user->name) }}" />
                                @error('name')
                                    <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Username</label>
                                <input type="text" class="form-control" id="defaultFormControlInput"
                                    placeholder="Isi Nama Username" aria-describedby="defaultFormControlHelp"
                                    name="username" value="{{ old('username', $user->username) }}" />
                                @error('username')
                                    <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Email</label>
                                <input type="text" class="form-control" id="defaultFormControlInput"
                                    placeholder="Isi Nama email" aria-describedby="defaultFormControlHelp" name="email"
                                    value="{{ old('email', $user->email) }}" />
                                @error('email')
                                    <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="Isi Password" aria-describedby="password" value="" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Konfirmasi Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="confirm_password"
                                        placeholder="Isi Konfirmasi Password" aria-describedby="password" value="" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                @error('confirm_password')
                                    <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                                <div class="mb-3 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary float-end mt-3">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
@endsection
