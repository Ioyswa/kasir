@extends('layouts.main')

@section('content')
    <x-dynamic-content>
        <div class="container">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Detail Penjualan</h3>
                        </div>
                        <div class="card-body">
                            {{-- <h5>ID Penjualan: {{ $penjualan->id_penjualan }}</h5> --}}
                            <h5>Pelanggan: {{ $penjualan->pelanggan->nama_pelanggan }}</h5>
                            <h5>Tanggal: {{ $penjualan->tanggal_penjualan }}</h5>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penjualan->detailPenjualans as $item)
                                        <tr>
                                            <td>{{ $item->produk->nama_produk }}</td>
                                            <td>{{ $item->jumlah_produk }}</td>
                                            <td>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <h5>Total: Rp. {{ number_format($penjualan->total_harga, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-dynamic-content>
@endsection
