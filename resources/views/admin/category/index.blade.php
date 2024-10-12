@extends('admin.partials.app')

@section('name')
    Kategori
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
@endsection

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kategori /</span> Daftar Kategori </h4>
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
        <!-- Basic Bootstrap Table -->
        <div class="mb-3">
            <a href="{{ route('admin.category.create') }}" class="btn rounded-pill btn-outline-primary">Tambah</a>
        </div>
        <div class="card">

            <h5 class="card-header">Tabel Kategori</h5>
            <div class="table-responsive text-nowrap">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($category as $categories)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ substr($categories->name, 0, 40) }}</td>
                                <td>
                                    <a class="" title="edit"
                                        href="{{ route('admin.category.edit', $categories) }}"><i
                                            class="bx bx-edit-alt me-1"></i></a>
                                    <a href="{{ route('admin.category.destroy', $categories) }}" title="hapus"
                                        data-confirm-delete="true" class="bx bx-trash me-1"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
    <!-- / Content -->
@endsection

@push('scripts')
    <script src="{{ asset('amsify/jquery.amsify.suggestags.js') }}"></script>


    <script>
        // let table = new DataTable('#myTable');
        $(document).ready(function() {
            $('#myTable').DataTable({
                "language": {
                    "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json"
                },
                "columnDefs": [{
                    "className": "dt-center",
                    "targets": "_all"
                }]
            });
        });
    </script>
@endpush
