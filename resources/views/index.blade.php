<!-- resources/views/dashboard.blade.php -->
@extends('layouts.main')

@section('content')
    <x-dynamic-content>
        <div class="text-white">
            @switch($aktivitas)
                @case('login')
                    @include('auth.login')
                @break

                @case('register')
                    @include('auth.register')
                @break

                @case('dashboard')
                    @include('pages.dashboard')
                @break

                @case('operator')
                    @include('pages.operator')
                @break
                @case('produk')
                    @include('pages.produk')
                @break

                @case('pelanggan')
                    @include('pages.pelanggan')
                @break

                @case('penjualan')
                    @include('pages.penjualan')
                @break

                @case('kasir')
                    @include('pages.kasir')
                @break


                @default
                    @include('pages.dashboard')
            @endswitch
        </div>
    </x-dynamic-content>
@endsection
