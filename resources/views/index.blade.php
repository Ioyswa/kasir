<!-- resources/views/dashboard.blade.php -->
@extends('layouts.main')

@section('content')
    <x-dynamic-content>
        @switch($aktivitas)
            @case('register')
                @include('pages.register')
            @break

            @case('dashboard')
                @include('pages.dashboard')
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
    </x-dynamic-content>
@endsection
