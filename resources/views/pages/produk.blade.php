@extends('layouts.main')

@section('content')
    <x-dynamic-content>
        <!-- CSS DataTables -->

        <link href="{{ asset('css/sb-admin-2.min.css') }}"rel="stylesheet">
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}"rel="stylesheet">
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Produk</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTables" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Gambar</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($produks as $produk)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            <img class="img-fluid" src="{{ asset($produk->image) }}" alt="gambar_produk"
                                                style="max-width: 100px; max-height: 100px;">
                                        </td>
                                        <td>{{ $produk->nama_produk }}</td>
                                        <td>Rp. {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                        <td>{{ $produk->stok }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary edit-btn" data-toggle="modal"
                                                data-target="#edit" data-id="{{ $produk->id_produk }}"
                                                data-nama="{{ $produk->nama_produk }}" data-image="{{ $produk->image }}"
                                                data-harga="{{ $produk->harga }}" data-stok="{{ $produk->stok }}">
                                                Edit
                                            </a>
                                            <form action="{{ route('produk.hapus', $produk->id_produk) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data produk ini?')">
                                                    <i class="bi bi-trash-fill"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- Modal Tambah -->
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="tambah" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="user" action="{{ route('produk.tambah') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="nama_produk">Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk"
                                    required>
                            </div>
                            <div class="form-group">
                                <img id="imagePreview" class="image-preview w-25" src="#" alt="Preview Gambar"
                                    style="display: none;">
                                <label for="image">Gambar Produk</label>
                                <input type="file" name="image" class="form-control" id="imageInput"
                                    accept="image/jpg, image/png, image/jpeg " placeholder="Nama Produk" required>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" name="harga" class="form-control" placeholder="Harga" required>
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" name="stok" class="form-control" placeholder="Stok" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Tambah Produk</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="user" action="{{ route('produk.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input type="hidden" name="id_produk" id="id_produk" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama_produk">Nama Produk</label>
                                <input type="text" name="nama_produk" id="nama_produk" class="form-control"
                                    placeholder="Nama Produk" required>
                            </div>
                            <div class="form-group">
                                <img id="image_preview" class="image-preview w-25 mb-2" src="" alt="Preview Gambar"
                                    style="display: none;">
                                <label for="image">Gambar Produk</label>
                                <input type="file" name="image" class="form-control-file" id="imageInput"
                                    accept="image/jpg, image/png, image/jpeg">
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" name="harga" id="harga" class="form-control"
                                    placeholder="Harga" required>
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" name="stok" id="stok" class="form-control"
                                    placeholder="Stok" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Update Produk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.edit-btn').on('click', function() {
                    var id = $(this).data('id');
                    var nama = $(this).data('nama');
                    var image = $(this).data('image');
                    var harga = $(this).data('harga');
                    var stok = $(this).data('stok');

                    $('#id_produk').val(id);
                    $('#nama_produk').val(nama);
                    $('#harga').val(harga);
                    $('#stok').val(stok);

                    $('#image_preview').val(image);
                    $('#image_preview').attr('src', image);
                    $('#image_preview').show();
                });
            });
        </script>
        <script>
            const imageInput = document.getElementById('imageInput');
            const imagePreview = document.getElementById('imagePreview');

            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });
        </script>



        <!-- JavaScript DataTables -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>


    </x-dynamic-content>
@endsection
