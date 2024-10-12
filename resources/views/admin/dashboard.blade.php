@extends('admin.partials.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-4  col-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-center">
                            <div class="avatar d-flex flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M19.875 3H4.125C2.953 3 2 3.897 2 5v14c0 1.103.953 2 2.125 2h15.75C21.047 21 22 20.103 22 19V5c0-1.103-.953-2-2.125-2zm0 16H4.125c-.057 0-.096-.016-.113-.016c-.007 0-.011.002-.012.008L3.988 5.046c.007-.01.052-.046.137-.046h15.75c.079.001.122.028.125.008l.012 13.946c-.007.01-.052.046-.137.046z" />
                                    <path fill="currentColor" d="M6 7h6v6H6zm7 8H6v2h12v-2h-4zm1-4h4v2h-4zm0-4h4v2h-4z" />
                                </svg>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                </button>
                            </div>
                        </div>
                        <h4 class="fw-semibold d-block mb-1 text-center text-dark">Kategori</h4>
                        <h5 class="card-title mb-2 text-center">{{ $category }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4  col-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-center">
                            <div class="avatar d-flex flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M19.875 3H4.125C2.953 3 2 3.897 2 5v14c0 1.103.953 2 2.125 2h15.75C21.047 21 22 20.103 22 19V5c0-1.103-.953-2-2.125-2zm0 16H4.125c-.057 0-.096-.016-.113-.016c-.007 0-.011.002-.012.008L3.988 5.046c.007-.01.052-.046.137-.046h15.75c.079.001.122.028.125.008l.012 13.946c-.007.01-.052.046-.137.046z" />
                                    <path fill="currentColor" d="M6 7h6v6H6zm7 8H6v2h12v-2h-4zm1-4h4v2h-4zm0-4h4v2h-4z" />
                                </svg>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                </button>
                            </div>
                        </div>
                        <h4 class="fw-semibold d-block mb-1 text-center text-dark">Produk</h4>
                        <h5 class="card-title mb-2 text-center">{{ $product }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
