@extends('admin.partials.app')

@section('name')
    Ubah Produk
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/enyo/dropzone/dist/min/dropzone.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> --}}
@endsection

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Produk /</span> Tambah Produk</h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('admin.product.update', $product) }}" method="post"
                            enctype="multipart/form-data" id="productForm">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="name">Nama Produk</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Isi Nama Produk" id="name"
                                        name="name" value="{{ old('name', $product->name) }}">
                                    @error('name')
                                        <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="category">Pilih
                                    Kategori</label>
                                <div class="col-sm-10">
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach ($category as $categories)
                                            <option value="{{ $categories->id }}"
                                                {{ old('category_id', $product->category_id) == $categories->id ? 'selected' : '' }}>
                                                {{ $categories->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="price">Harga</label>
                                <div class="col-sm-10">
                                    <input type="text" id="price" class="form-control phone-mask"
                                        placeholder="Isi Harga" aria-describedby="basic-default-phone" name="price"
                                        value="{{ old('price', number_format($product->price, 0, ',', '.')) }}">
                                    @error('price')
                                        <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="description">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea id="description" class="form-control" placeholder="Isi Deskripsi produk"
                                        aria-describedby="basic-icon-default-message2" name="description">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Gambar</label>
                                <div class="col-sm-10">
                                    <div class="d-flex flex-wrap">
                                        @foreach ($product->images as $image)
                                            <div class="position-relative m-2 image-container">
                                                <img src="{{ asset('storage/' . $image->image) }}" class="img-thumbnail"
                                                    style="width: 150px; height: 150px;">
                                                <button type="button"
                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                                    onclick="removeImage('{{ $image->id }}')">X</button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="deleted_images" id="deleted_images" value="">
                                </div>
                            </div>
                        </form>


                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Unggah Gambar</label>
                            <div class="col-sm-10">
                                <div class="dropzone" id="imageUpload">
                                    <div class="dz-message" data-dz-message>
                                        <span>Drop files here or click to upload.</span>
                                    </div>
                                </div>
                                <small class="form-text text-muted">Unggah gambar produk (maksimal 5 gambar).</small>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary" id="submit-button">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('vendor/enyo/dropzone/dist/min/dropzone.min.js') }}"></script>
    {{-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            $('#price').on('keyup', function() {
                var price = $(this).val().replace(/[^0-9]/g, '');

                if (price.length >= 1 && price.charAt(0) == '0') {
                    price = price.substr(1);
                }

                if (price.length > 8) {
                    price = price.substr(0, 8);
                }

                if (price) {
                    $(this).val(formatRupiah(price));
                    $('#price-error').hide();
                } else {
                    $(this).val('');
                    $('#price-error').show();
                }
            });

            function formatRupiah(angka) {
                var number_string = angka.toString(),
                    sisa = number_string.length % 3,
                    rupiah = number_string.substr(0, sisa),
                    ribuan = number_string.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                return rupiah;
            }
        });
    </script>

    <script>
        function removeImage(imageId) {
            // Ambil elemen gambar dan hitung total gambar yang tersisa
            const imageElements = document.querySelectorAll(
            '.image-container'); // Sesuaikan selector ini dengan elemen gambar Anda
            const totalImages = imageElements.length;

            // Cek jika gambar yang akan dihapus adalah gambar terakhir
            if (totalImages <= 1) {
                // Tampilkan SweetAlert jika hanya ada satu gambar tersisa
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: 'Anda tidak bisa menghapus gambar terakhir.',
                    confirmButtonText: 'OK'
                });
                return; // Hentikan fungsi jika gambar terakhir
            }

            // Tambahkan ID gambar yang akan dihapus ke input hidden
            let deletedImagesInput = document.getElementById('deleted_images');
            let deletedImages = deletedImagesInput.value ? deletedImagesInput.value.split(',') : [];
            deletedImages.push(imageId);
            deletedImagesInput.value = deletedImages.join(',');

            // Menghapus elemen gambar dari tampilan
            const button = document.querySelector(`button[onclick="removeImage('${imageId}')"]`);
            if (button) {
                button.parentElement.remove();
            }
        }
    </script>


    <script>
        // Inisialisasi Dropzone dengan benar
        Dropzone.autoDiscover = false; // Nonaktifkan auto discover untuk menghindari inisialisasi ganda

        // Konfigurasi Dropzone
        var myDropzone = new Dropzone("#imageUpload", {
            url: "{{ route('admin.product.uploadImages', ['product' => $product->id]) }}",
            method: "post",
            paramName: 'images[]', // Nama input untuk file
            maxFilesize: 10, // Ukuran maksimum file 10 MB
            maxFiles: 5,
            parallelUploads: 10, // Maksimal 5 file
            acceptedFiles: ".jpeg,.jpg,.png", // Hanya file gambar yang diterima
            autoProcessQueue: false, // Nonaktifkan pengunggahan otomatis
            addRemoveLinks: true, // Tambahkan tautan hapus file
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },


            // Fungsi init untuk menyimpan referensi Dropzone
            init: function() {
                var myDropzone = this; // Menyimpan referensi Dropzone di variabel lokal

                myDropzone.on("addedfile", function(file) {
                    if (this.files.length) {
                        var _i, _len;
                        for (_i = 0, _len = this.files.length; _i < _len -
                            1; _i++) // -1 to exclude current file
                        {
                            if (this.files[_i].name === file.name && this.files[_i].size === file
                                .size &&
                                this.files[_i].lastModified.toString() === file.lastModified.toString()
                            ) {
                                this.removeFile(file);
                                // SweetAlert for duplicate file
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'File yang sama sudah diunggah.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    }

                });


                $('#submit-button').click(function(e) {
                    e.preventDefault();
                    $(this).prop('disabled', true);

                    // Simpan produk terlebih dahulu
                    $.ajax({
                        url: "{{ route('admin.product.update', $product) }}",
                        method: 'PUT',
                        data: $('#productForm').serialize(),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (myDropzone.getQueuedFiles().length > 0) {
                                // Jika produk sudah disimpan, unggah gambar
                                myDropzone.options.url =
                                    "{{ url('admin/product') }}/" +
                                    response
                                    .product_id + "/upload-images";
                                myDropzone.processQueue();
                            } else {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Produk telah disimpan tanpa gambar.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.location.href =
                                            '{{ route('admin.product') }}';
                                    }
                                });
                            }
                        },
                        error: function(response) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menyimpan produk.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            $('#submit-button').prop('disabled', false);
                        }
                    });
                });

                myDropzone.on("queuecomplete", function() {
                    // Periksa apakah ada file yang tidak valid
                    var invalidFiles = myDropzone.getRejectedFiles();
                    if (invalidFiles.length > 0) {
                        // Jika ada file yang ditolak, tampilkan pesan kesalahan
                        Swal.fire({
                            title: 'Error!',
                            text: 'File tidak sesuai ketentuan.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        // Semua file valid
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data telah disimpan',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.location.href = '{{ route('admin.product') }}';
                            }
                        });
                    }
                });


                // Jika ada error saat mengunggah file
                myDropzone.on("error", function(file, errorMessage) {
                    console.error('Error uploading file: ' + file.name + ' Error: ' + errorMessage);
                    myDropzone.removeFile(file); // 
                    // Menampilkan SweetAlert jika ada kesalahan menggunakan RealRashid
                    Swal.fire({
                        title: 'Error!',
                        text: 'File tidak sesuai ketentuan',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });

            }
        });
    </script>
@endpush
