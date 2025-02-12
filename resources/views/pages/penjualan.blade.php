@extends('layouts.main')

@section('content')
    <x-dynamic-content>
        <!-- CSS DataTables -->

        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Data Penjualan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTables" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pembeli</th>
                                    <th>Total</th>
                                    <th>Bayar</th>
                                    <th>Kembalian</th>
                                    <th>Tanggal</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <tbody>
                                @foreach ($penjualans as $penjualan)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $penjualan->pelanggan->nama_pelanggan }}</td>
                                        <td>Rp. @convert($penjualan->total_harga)</td>
                                        <td>Rp. @convert($penjualan->total_bayar)</td>
                                        <td>Rp. @convert($penjualan->kembalian)</td>
                                        <td>{{ $penjualan->tanggal_penjualan }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary detail-btn"
                                                data-id="{{ $penjualan->id_penjualan }}" data-toggle="modal"
                                                data-target="#detailModal">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- Modal Detail Penjualan -->
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog text-dark" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Penjualan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-detail-body">
                        <!-- Detail penjualan akan ditampilkan di sini -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
        <script>
            $(document).ready(function() {

                $('.detail-btn').on('click', function() {
                    var id = $(this).data('id');

                    // Mengambil detail penjualan menggunakan AJAX
                    $.ajax({
                        url: '/penjualan/' + id, // Sesuaikan dengan route Anda
                        method: 'GET',
                        success: function(data) {
                            // Tampilkan detail penjualan di modal
                            console.log(data); // Tambahkan ini untuk debugging
                            var modalBody = $('#modal-detail-body');
                            modalBody.empty(); // Kosongkan isi modal

                            // Tampilkan informasi penjualan
                            modalBody.append('<p><strong>Pembeli:</strong> ' + data.pelanggan.nama_pelanggan + '</p>');
                            modalBody.append('<p><strong>Total Harga:</strong> Rp. ' + data.total_harga + '</p>');
                            modalBody.append('<p><strong>Total Bayar:</strong> Rp. ' + data.total_bayar + '</p>');
                            modalBody.append('<p><strong>Kembalian:</strong> Rp. ' + data.kembalian + '</p>');
                            modalBody.append('<p><strong>Tanggal:</strong> ' + data.tanggal_penjualan + '</p>');
                            modalBody.append('<hr>');
                            modalBody.append('<h5>Detail Produk:</h5>');

                            // Loop melalui detail penjualan dan tambahkan ke modal
                            $.each(data.detail_penjualans, function(index, item) {
                                modalBody.append('<p>Produk: ' + item.produk.nama_produk + '</p>');
                                modalBody.append('<p>Jumlah: ' + item.jumlah_produk + '</p>');
                                modalBody.append('<p>Subtotal: Rp. ' + item.subtotal + '</p>');
                                modalBody.append('<hr>');
                            });
                        },
                        error: function(xhr) {
                            console.error(xhr);
                        }
                    });
                });
            });
        </script>

    </x-dynamic-content>
@endsection
