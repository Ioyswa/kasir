@extends('layouts.main')

@section('content')
    <x-dynamic-content class="">
        <h1 class="text-center mb-4">Dashboard</h1>
        <div class="row text-center">
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card bg-dark shadow h-100 py-2">
                    <div class="card-body">
                        <h5 class="text-white" >Total Jenis Produk</h5>
                        <h3 class="text-white">{{ $total_produk }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card bg-dark shadow h-100 py-2">
                    <div class="card-body">
                        <h5 class="text-white">Total Pelanggan</h5>
                        <h3 class="text-white">{{ $total_pelanggan }}</h3>
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
        <!-- Content Row -->
        <div class="row">
            <!-- Donut Chart -->
            <div class="col-xl-12 col-lg-1">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header bg-dark py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-center">Produk dengan Stok Terbanyak</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body bg-dark">
                        <div class="row">
                            <div class="col-xl-4 text-dark">
                                <div class="card-body">
                                    <div class="card-header py-3 text-center bg-secondary text-primary">
                                        <h6 class="">Ranking Produk Terbanyak</h6>
                                    </div>
                                    <div class="card-body bg-secondary text-white">
                                        <?php $i = 1 ;?>
                                        @foreach ($produks as $produk)
                                        <ol>{{$i++}} | {{$produk->nama_produk}} = {{$produk->stok}} </ol>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 chart-pie pt-4 text-dark">
                                <canvas id="myPieChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page level custom scripts -->
        <script>
            var data_produk = @json($produks)
        </script>

    </x-dynamic-content>
@endsection
