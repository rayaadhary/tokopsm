@extends('admin.partials.app')

@section('name')
    Tambah Pengguna
@endsection

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kategori /</span> Tambah Kategori</h4>
        @if (session('error'))
            <div class="alert alert-warning">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <h5 class="card-header">Kategori</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="defaultFormControlInput"required
                                    placeholder="Isi Nama Kategori" aria-describedby="defaultFormControlHelp" name="name"
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary float-end mt-3">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
