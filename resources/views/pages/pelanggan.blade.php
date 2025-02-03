@extends('layouts.main')

@section('content')
    <x-dynamic-content>
        <!-- CSS DataTables -->

        <link href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap4.min.css"rel="stylesheet">
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Data Pelanggan</h6>
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="myTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Nomor Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <tbody>
                                @foreach ($pelanggans as $pelanggan)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $pelanggan->nama_pelanggan }}</td>
                                        <td>{{ $pelanggan->alamat }}</td>
                                        <td>{{ $pelanggan->nomor_telepon }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary edit-btn" data-toggle="modal"
                                                data-target="#edit" data-id="{{ $pelanggan->id_pelanggan }}"
                                                data-nama="{{ $pelanggan->nama_pelanggan }}"
                                                data-alamat="{{ $pelanggan->alamat }}"
                                                data-nomor="{{ $pelanggan->nomor_telepon }}">
                                                Edit
                                            </a>
                                            <form action="{{ route('pelanggan.hapus', $pelanggan->id_pelanggan) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data pelanggan ini?')">
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pelanggan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="user" action="{{ route('pelanggan.tambah') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="nama_pelanggan">Nama Pelanggan</label>
                                <input type="text" name="nama_pelanggan" class="form-control"
                                    placeholder="Nama Pelanggan" required>
                            </div>
                            <div class="form-group">
                                <label for="harga">Alamat Pelanggan</label>
                                <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                            </div>
                            <div class="form-group">
                                <label for="stok">NO Telepon Pelanggan</label>
                                <input type="number" name="nomor_telepon" class="form-control" placeholder="Nomor Telepon"
                                    required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Tambah Pelanggan</button>
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
                        <form class="user" action="{{ route('pelanggan.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input type="hidden" name="id_pelanggan" id="id_pelanggan" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama_pelanggan">Nama Pelanggan</label>
                                <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control"
                                    placeholder="Nama Pelanggan" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat Pelanggan</label>
                                <input type="text" name="alamat" id="alamat" class="form-control"
                                    placeholder="Alamat" required>
                            </div>
                            <div class="form-group">
                                <label for="nomor_telepon">Nomor Telepon</label>
                                <input type="number" name="nomor_telepon" id="nomor" class="form-control"
                                    placeholder="Nomor Telepon" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Update Pelanggan</button>
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
                    var alamat = $(this).data('alamat');
                    var nomor = $(this).data('nomor');


                    $('#id_pelanggan').val(id);
                    $('#nama_pelanggan').val(nama);
                    $('#alamat').val(alamat);
                    $('#nomor').val(nomor);
                });
            });
        </script>



        <!-- Bootstrap JS -->
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap4.min.js"></script>

        <!-- Skrip Inisialisasi DataTables -->

    </x-dynamic-content>
@endsection
