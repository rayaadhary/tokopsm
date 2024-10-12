@extends('admin.partials.app')

@section('name')
    Produk
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
@endsection

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Produk /</span> Daftar Produk </h4>
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
            <a href="{{ route('admin.product.create') }}" class="btn rounded-pill btn-outline-primary">Tambah</a>
        </div>
        <div class="card">

            <h5 class="card-header">Tabel Produk</h5>
            <div class="table-responsive text-nowrap">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($product as $products)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ substr($products->name, 0, 40) }}</td>
                                <td>{{ substr($products->category->name, 0, 40) }}</td>
                                <td>Rp. {{ number_format($products->price, 0, ',', '.') }}</td>
                                <td>
                                    <a class="" title="edit" href="{{ route('admin.product.edit', $products) }}"><i
                                            class="bx bx-edit-alt me-1"></i></a>
                                    <a href="{{ route('admin.product.destroy', $products) }}" title="hapus"
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
