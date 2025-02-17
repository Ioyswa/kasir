@extends('layouts.main')

@section('content')
    <x-dynamic-content>
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-dark">
                            <div class="alert alert-info">
                                Tip: Tekan <kbd>SPASI</kbd> untuk menambahkan produk ke daftar
                            </div>
                            <h3>Checkout Pembayaran</h3>
                        </div>
                        <div class="card-body">
                            <form id="checkout-form" action="{{ route('penjualan.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="order_items" id="order-items-input">
                                <div class="row text-dark">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Pilih Pelanggan</label>
                                            <select name="id_pelanggan" class="form-control" required>
                                                <option value="">Pilih Pelanggan</option>
                                                @foreach ($pelanggans as $pelanggan)
                                                    <option value="{{ $pelanggan->id_pelanggan }}">
                                                        {{ $pelanggan->nama_pelanggan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Pilih Produk</label>
                                            <select name="id_produk" class="form-control">
                                                <option value="">Pilih Produk</option>
                                                @foreach ($produks as $produk)
                                                    <option value="{{ $produk->id_produk }}"
                                                        data-harga="{{ $produk->harga }}" data-stok="{{ $produk->stok }}"
                                                        {{ $produk->stok <= 0 ? 'disabled' : '' }}>
                                                        {{ $produk->nama_produk }} - Rp. @convert($produk->harga), Stok
                                                        {{ $produk->stok }}
                                                        {{ $produk->stok <= 0 ? ' (Stok Habis)' : '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group mb-2">
                                            <label>Jumlah</label>
                                            <input type="text" name="jumlah_produk" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-2">
                                            <label>Bayar</label>
                                            <input type="text" name="total_bayar" id="total-bayar-input"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3 text-dark">
                                    <div class="card-header">
                                        Detail Pesanan
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Produk</th>
                                                    <th>Harga</th>
                                                    <th>Jumlah</th>
                                                    <th>Subtotal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table table-border" id="order-items">
                                                <!-- Produk akan ditambahkan di sini -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card mb-3 text-dark">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>Total Belanja:</strong>
                                            </div>
                                            <div class="col-md-6 text-end" id="total-belanja">
                                                <strong>Rp. 0</strong>
                                            </div>
                                            <div class="col-md-6">
                                                <strong>Total Bayar:</strong>
                                            </div>
                                            <div class="col-md-6 text-end" id="total-bayar-display">
                                                <strong>Rp. 0</strong>
                                            </div>
                                            <div class="col-md-6">
                                                <strong>Kembalian:</strong>
                                            </div>
                                            <div class="col-md-6 text-end" id="kembalian-display">
                                                <strong>Rp. 0</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Checkout</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('checkout-form');
                const produkSelect = document.querySelector('select[name="id_produk"]');
                const jumlahInput = document.querySelector('input[name="jumlah_produk"]');
                const tableBody = document.getElementById('order-items');

                const totalBelanja = document.getElementById('total-belanja');
                const totalBayarInput = document.getElementById('total-bayar-input');
                const totalBayarDisplay = document.getElementById('total-bayar-display');
                const kembalianDisplay = document.getElementById('kembalian-display');

                let totalAmount = 0;
                let orderItems = [];

                // Fungsi untuk format rupiah
                function formatRupiah(angka) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(angka);
                }

                // Mencegah submit form secara default
                // form.addEventListener('submit', function(event) {
                //     event.preventDefault();
                // });

                // Event listener saat spasi ditekan di input jumlah
                jumlahInput.addEventListener('keydown', function(event) {
                    // event.preventDefault(); // Mencegah karakter spasi ditambahkan ke input
                    if (event.key === ' ') {

                        // Ambil data produk yang dipilih
                        const selectedProduk = produkSelect.options[produkSelect.selectedIndex];
                        const namaProduk = selectedProduk.text.split(' - ')[0];
                        const idProduk = selectedProduk.value;
                        const hargaProduk = parseFloat(selectedProduk.getAttribute('data-harga') || 0);
                        const maxStok = parseInt(selectedProduk.getAttribute('data-stok') || 0);

                        const jumlah = parseInt(jumlahInput.value);

                        // Validasi input
                        if (!idProduk || !jumlah || jumlah <= 0) {
                            alert('Pilih produk dan masukkan jumlah yang valid');
                            return;
                        }

                        // Pastikan jumlah tidak melebihi stok
                        if (jumlah > maxStok) {
                            jumlah = maxStok;
                            this.value = maxStok;
                            alert(`Stok produk hanya tersedia ${maxStok}. Jumlah telah disesuaikan.`);
                        }


                        // Cek apakah produk sudah ada di daftar
                        const existingItemIndex = orderItems.findIndex(item => item.idProduk === idProduk);

                        if (existingItemIndex !== -1) {
                            // Hitung total jumlah produk yang sudah ada di keranjang
                            const currentItemQuantity = orderItems[existingItemIndex].jumlah;
                            const totalQuantity = currentItemQuantity + jumlah;

                            // Pastikan total jumlah tidak melebihi stok
                            if (totalQuantity > maxStok) {
                                jumlah = maxStok - currentItemQuantity;
                                alert(
                                    `Jumlah produk melebihi stok tersedia. Maksimal yang dapat ditambahkan: ${jumlah}`
                                    );

                                // Jika tidak bisa menambahkan lagi, kembalikan
                                if (jumlah <= 0) {
                                    return;
                                }
                            }

                            // Jika produk sudah ada, update jumlah dan subtotal
                            orderItems[existingItemIndex].jumlah += jumlah;
                            orderItems[existingItemIndex].subtotal =
                                orderItems[existingItemIndex].hargaProduk * orderItems[existingItemIndex]
                                .jumlah;

                            // Update baris tabel yang sudah ada
                            const existingRow = tableBody.querySelector(`tr[data-id="${idProduk}"]`);
                            if (existingRow) {
                                existingRow.querySelector('td:nth-child(3)').textContent =
                                    orderItems[existingItemIndex].jumlah;
                                existingRow.querySelector('td:nth-child(4)').textContent =
                                    formatRupiah(orderItems[existingItemIndex].subtotal);
                            }
                        } else {
                            // Hitung subtotal
                            const subtotal = hargaProduk * jumlah;

                            // Tambahkan item ke array
                            const orderItem = {
                                idProduk,
                                namaProduk,
                                hargaProduk,
                                jumlah,
                                subtotal
                            };
                            orderItems.push(orderItem);

                            // Buat baris baru di tabel
                            const newRow = document.createElement('tr');
                            newRow.setAttribute('data-id', idProduk);
                            newRow.innerHTML = `
                                <td>${namaProduk}</td>
                                <td>${formatRupiah(hargaProduk)}</td>
                                <td>${jumlah}</td>
                                <td>${formatRupiah(subtotal)}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm remove-item" data-id="${idProduk}">
                                        Hapus
                                    </button>
                                </td>
                            `;

                            // Tambahkan event listener untuk tombol hapus
                            newRow.querySelector('.remove-item').addEventListener('click', function() {
                                const itemId = this.getAttribute('data-id');
                                const index = orderItems.findIndex(item => item.idProduk === itemId);

                                if (index !== -1) {
                                    totalAmount -= orderItems[index].subtotal;
                                    orderItems.splice(index, 1);
                                    updateTotalBelanja();
                                    newRow.remove();
                                }
                            });

                            // Tambahkan baris ke tabel
                            tableBody.appendChild(newRow);
                        }

                        // Update total belanja
                        updateTotalBelanja();

                        // Reset input
                        produkSelect.selectedIndex = 0;
                        jumlahInput.value = '';
                    }
                });
                totalBayarInput.addEventListener('input', function() {
                    // Hapus karakter non-numeric
                    let bayarValue = this.value.replace(/[^\d]/g, '');

                    // Konversi ke angka
                    let bayarAmount = parseFloat(bayarValue);

                    // Update display total bayar
                    totalBayarDisplay.innerHTML = `<strong>${formatRupiah(bayarAmount || 0)}</strong>`;

                    // Hitung kembalian
                    let kembalian = bayarAmount - totalAmount;

                    // Update display kembalian
                    if (kembalian >= 0) {
                        kembalianDisplay.innerHTML = `<strong>${formatRupiah(kembalian)}</strong>`;
                    } else {
                        kembalianDisplay.innerHTML = `<strong>${formatRupiah(0)}</strong>`;
                    }
                });

                // Fungsi update total belanja
                function updateTotalBelanja() {
                    totalAmount = orderItems.reduce((total, item) => total + item.subtotal, 0);
                    totalBelanja.innerHTML = `<strong>${formatRupiah(totalAmount)}</strong>`;
                }

                form.addEventListener('submit', function(event) {
                    // Masukkan data order ke input hidden
                    const orderItemsInput = document.getElementById('order-items-input');
                    orderItemsInput.value = JSON.stringify(orderItems);

                    // Tambahkan total bayar dan kembalian ke form
                    const totalBayarHidden = document.createElement('input');
                    totalBayarHidden.type = 'hidden';
                    totalBayarHidden.name = 'total_bayar';
                    totalBayarHidden.value = totalBayarInput.value.replace(/[^\d]/g, '');
                    form.appendChild(totalBayarHidden);

                    const kembalianHidden = document.createElement('input');
                    kembalianHidden.type = 'hidden';
                    kembalianHidden.name = 'kembalian';
                    kembalianHidden.value = Math.max(totalBayarInput.value.replace(/[^\d]/g, '') - totalAmount,
                        0);
                    form.appendChild(kembalianHidden);
                });
            });
        </script>
    </x-dynamic-content>
@endsection
