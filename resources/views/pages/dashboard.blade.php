@extends('layouts.main')

@section('content')
    <x-dynamic-content>
        <h1 class="text-center mb-4">Dashboard</h1>
        <div class="row text-center">
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <h5>Total Jenis Produk</h5>
                        <h3>{{$total_produk}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <h5>Total Pelanggan</h5>
                        <h3>{{ $total_pelanggan}}</h3>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <h5>Total Penjualan</h5>
                        <h3>Rp.</h3>
                    </div>
                </div>
            </div> --}}
            <!-- Kartu statistik lainnya -->
        </div>

        <!-- Page level custom scripts -->

    </x-dynamic-content>
@endsection
