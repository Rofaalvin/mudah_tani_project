<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Panel Penjual</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    @php
        $items = session('cart_pembelian', []);
        $subtotal = 0;

        foreach ($items as $item) {
            $subtotal += $item['jumlah'] * $item['harga_satuan'];
        }

        $diskon_persen = old('diskon') ?? 0; // atau request('diskon') jika dari URL
        $diskon_rupiah = ($diskon_persen / 100) * $subtotal;
        $total = $subtotal - $diskon_rupiah;
    @endphp
    <style>
        .sidebar {
            width: 220px;
            background-color: #e8f5e9;
            padding: 20px;
            min-height: 100vh;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li {
            margin-bottom: 12px;
        }

        .sidebar a {
            display: block;
            padding: 10px 15px;
            background-color: #ffffff;
            border-left: 4px solid transparent;
            color: #2e7d32;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }

        .sidebar a:hover {
            background-color: #c8e6c9;
            border-left: 4px solid #2e7d32;
            color: #1b5e20;
        }

        .sidebar a.active {
            background-color: #a5d6a7;
            border-left: 4px solid #1b5e20;
            color: #1b5e20;
        }

        .scrollbar-thin::-webkit-scrollbar {
            height: 6px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background-color: #3b82f6;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-100 via-slate-200 to-slate-100 min-h-screen font-sans">

    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <ul>
                <li><a href="/produk">Produk</a></li>
                <li><a href="/pembelian">Pembelian</a></li>
                <li><a href="/penjualan">Penjualan</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <main class="flex-1 p-5">
            <!-- Buttons -->
            <div class="mb-3 flex space-x-3">
                <a href="/pembelian"
                    class="bg-green-600 text-white text-xs sm:text-sm font-semibold px-3 py-1 rounded-sm hover:bg-green-700 transition">
                    Input Pembelian
                </a>
                <a href="{{ route('data_beli.index') }}"
                    class="bg-green-600 text-white text-xs sm:text-sm font-semibold px-3 py-1 rounded-sm hover:bg-green-700 transition">
                    Lihat Data Pembelian
                </a>
            </div>

            <form class="border border-gray-400 p-3 sm:p-5 bg-white/70 rounded-sm shadow-sm">
                <!-- Transaksi Kasir -->
                <fieldset class="border border-gray-400 p-3 rounded-sm mb-3">
                    <legend class="text-xs sm:text-sm font-semibold px-2">Transaksi Kasir</legend>

                    <div class="flex flex-col sm:flex-row sm:space-x-3">
                        <!-- Input Kiri -->
                        <div class="flex-1 grid grid-cols-[auto_1fr] gap-x-2 gap-y-2 text-xs sm:text-sm">
                            <label for="kode_trx_beli" class="text-gray-800 pt-1">Kode. Trx</label>
                            <input id="kode_trx_beli" type="text" value="{{ $lastKodeHariIni }}" readonly
                                class="bg-gray-200 border border-gray-300 rounded-sm px-2 py-1 text-xs sm:text-sm w-[150px]" />

                            <label for="id_supplyer" class="text-gray-800 pt-1">Supplyer</label>
                            <select id="id_supplyer" name="id_supplyer"
                                class="border border-gray-300 rounded-sm px-2 py-1 text-xs sm:text-sm w-[150px]">
                                <option value="">-- Pilih Supplyer --</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id_supplyer }}">{{ $supplier->nama_supplyer }}</option>
                                @endforeach
                            </select>

                            <label for="tanggal" class="text-gray-800 pt-1">Tanggal</label>
                            <input id="tanggal" type="date" value="{{ now()->format('Y-m-d') }}"
                                class="border border-gray-300 rounded-sm px-2 py-1 text-xs sm:text-sm w-[120px]" />
                        </div>

                        <!-- Box Tagihan -->
                        <div
                            class="flex-1 border border-gray-400 rounded-sm ml-0 sm:ml-3 mt-3 sm:mt-0 flex items-center justify-center">
                            <p id="tagihan" class="text-red-600 font-bold text-lg sm:text-xl">
                                Tagihan : Rp. {{ number_format($total, 2, ',', '.') }}
                            </p>
                        </div>
                    </div>
            </form>
            <!-- FORM TAMBAH ITEM DIPISAH -->
            <form action="{{ route('pembelian.addItem') }}" method="POST" class="mt-3">
                @csrf
                <div
                    class="grid grid-cols-1 sm:grid-cols-[110px_180px_70px_120px_90px_110px] gap-2 text-xs sm:text-sm items-center">
                    <!-- Kode Barang -->
                    <select name="id_produk" class="border border-gray-300 rounded-sm px-2 py-1 w-full" required
                        onchange="isiNamaBarang(this)">
                        <option value="">Pilih Barang</option>
                        @foreach ($produks as $produk)
                            <option value="{{ $produk->id_produk }}" data-nama="{{ $produk->nama_produk }}"
                                data-stok="{{ $produk->stok }}" data-harga="{{ $produk->harga }}">
                                {{ $produk->id_produk }}
                            </option>
                        @endforeach
                    </select>

                    <input type="text" id="nama_produk" name="nama_produk" placeholder="Nama Barang"
                        class="bg-gray-200 border border-gray-300 rounded-sm px-2 py-1 w-full" readonly required />

                    <input type="text" id="stok" placeholder="Stok"
                        class="border border-gray-300 rounded-sm px-2 py-1 w-full bg-gray-100" readonly />

                    <div class="flex items-center space-x-1">
                        <span class="text-xs sm:text-sm">Rp.</span>
                        <input type="text" id="harga_satuan" name="harga_satuan" placeholder="Harga Satuan"
                            class="border border-gray-300 rounded-sm px-2 py-1 w-full text-xs sm:text-sm bg-gray-100"
                            readonly required />
                    </div>

                    <input type="number" name="jumlah" id="jumlah" min="1" placeholder="Jumlah Beli"
                        class="border border-gray-300 rounded-sm px-2 py-1 w-full" required oninput="hitungTotal()" />

                    <div class="flex items-center space-x-1">
                        <span class="text-xs sm:text-sm">Rp.</span>
                        <input type="text" id="harga_akhir" placeholder="Harga Akhir"
                            class="border border-gray-300 rounded-sm px-2 py-1 w-full text-xs sm:text-sm bg-gray-100"
                            readonly />
                    </div>
                </div>
                <div class="flex items-end mt-2">
                    <button type="submit"
                        class="bg-orange-600 text-white text-xs sm:text-sm font-semibold px-3 py-1 rounded-sm hover:bg-orange-700 transition">
                        Tambahkan Data
                    </button>
                </div>
            </form>

            <!-- Tabel Barang Dijual -->
            <fieldset class="border border-gray-400 p-0 rounded-sm mb-3">
                <legend class="text-xs sm:text-sm font-semibold px-2">Barang yang dibeli</legend>
                <div class="overflow-x-auto scrollbar-thin">
                    <table class="w-full border-collapse border border-blue-500 text-xs sm:text-sm">
                        <thead>
                            <tr class="bg-blue-600 text-white text-center">
                                <th class="border border-blue-500 px-2 py-1">Kode Barang</th>
                                <th class="border border-blue-500 px-2 py-1 text-left">Nama Barang</th>
                                <th class="border border-blue-500 px-2 py-1 text-center">Harga Satuan</th>
                                <th class="border border-blue-500 px-2 py-1 text-center">Jumlah Beli</th>
                                <th class="border border-blue-500 px-2 py-1 text-center">Harga Akhir</th>
                                <th class="border border-blue-500 px-2 py-1 text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach (session('cart_pembelian', []) as $item)
                                @php
                                    $harga_akhir = $item['harga_satuan'] * $item['jumlah'];
                                    $total += $harga_akhir;
                                @endphp
                                <tr class="border border-blue-500">
                                    <td
                                        class="border border-blue-500 px-2 py-1 text-center font-mono text-[10px] sm:text-xs">
                                        {{ $item['id_produk'] }}</td>
                                    <td class="border border-blue-500 px-2 py-1">{{ $item['nama_produk'] }}</td>
                                    <td class="border border-blue-500 px-2 py-1 text-center font-mono">Rp
                                        {{ number_format($item['harga_satuan'], 0, ',', '.') }}</td>
                                    <td class="border border-blue-500 px-2 py-1 text-center">{{ $item['jumlah'] }}
                                    </td>
                                    <td class="border border-blue-500 px-2 py-1 text-center font-mono">Rp
                                        {{ number_format($harga_akhir, 0, ',', '.') }}</td>
                                    <td class="border border-blue-500 px-2 py-1 text-center">
                                        <form action="{{ route('pembelian.removeItem', $item['id_produk']) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 text-white text-xs px-2 py-1 rounded">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </fieldset>
            <div class="flex flex-col sm:flex-row sm:space-x-6 text-xs sm:text-sm">
                <div class="border border-gray-400 p-3 rounded-sm w-full sm:w-[350px] mb-3 sm:mb-0">
                    <!-- Sub Total -->
                    <div class="flex items-center mb-2">
                        <label class="flex-1 font-semibold">Sub Total</label>
                        <span class="mr-1 font-mono">Rp.</span>
                        <input type="text" value="{{ number_format($subtotal, 2, ',', '.') }}" readonly
                            class="border border-gray-300 rounded-sm px-2 py-1 w-[110px] bg-gray-200 font-mono text-right" />
                    </div>

                    <!-- Diskon -->
                    <div class="flex items-center mb-2 space-x-1">
                        <label class="flex-1 font-semibold">Diskon</label>
                        <input type="number" id="diskon" name="diskon" value="{{ old('diskon', 0) }}"
                            class="border border-gray-300 rounded-sm px-2 py-1 w-[70px] text-center"
                            oninput="hitungDiskon()" />
                        <span>% = Rp.</span>
                        <input type="text" id="diskon_rupiah"
                            value="{{ number_format($diskon_rupiah, 2, ',', '.') }}" readonly
                            class="border border-gray-300 rounded-sm px-2 py-1 w-[110px] bg-gray-200 font-mono text-right" />
                    </div>

                    <!-- Total Harga -->
                    <div class="flex items-center">
                        <label class="flex-1 font-semibold">Total Harga</label>
                        <span class="mr-1 font-mono">Rp.</span>
                        <input type="text" id="total_harga" value="{{ number_format($total, 2, ',', '.') }}"
                            readonly
                            class="border border-gray-300 rounded-sm px-2 py-1 w-[110px] bg-gray-200 font-mono text-right" />
                    </div>
                </div>
            </div>
            <!-- Kanan -->
            <div
                class="flex-1 border border-gray-400 p-3 rounded-sm grid grid-cols-[auto_1fr] gap-x-2 gap-y-2 items-center text-xs sm:text-sm sm:w-[350px]">
                <label class="text-right font-semibold">Bayar</label>
                <div class="flex items-center space-x-1">
                    <span class="font-mono">Rp.</span>
                    <input id="bayar" type="text"
                        class="border border-gray-300 rounded-sm px-2 py-1 w-full font-mono text-right"
                        oninput="hitungKembalian()" />
                </div>
                <label class="text-right font-semibold">Kembalian</label>
                <div class="flex items-center space-x-1">
                    <span class="font-mono">Rp.</span>
                    <input id="kembalian" type="text" readonly
                        class="border border-gray-300 rounded-sm px-2 py-1 w-full bg-gray-200 font-mono text-right" />
                </div>

            </div>
            <form action="{{ route('pembelian.storeFinal') }}" method="POST" class="space-y-4">
                @csrf
                <div class="flex flex-col">
                    {{-- <label for="kode_trx_beli" class="text-sm font-semibold">Kode Transaksi</label> --}}
                    <input type="text" name="kode_trx_beli" id="kode_trx_beli"
                        value="{{ $lastKodeHariIni ?? '' }}" class="border rounded-sm p-2 text-sm" readonly hidden>
                </div>

                {{-- <div class="flex flex-col">
                    <input type="number" name="total" id="total_amount" class="border rounded-sm p-2 text-sm"
                        value="{{ $total }}" placeholder="Masukkan total pembelian" hidden>
                </div> --}}

                <input type="hidden" name="diskon" id="diskon_final" value="{{ old('diskon', 0) }}">
                <input type="hidden" name="total_final" id="total_final" value="{{ $total }}">

                <button type="submit"
                    class="bg-orange-600 text-white font-semibold px-4 py-1 rounded-sm hover:bg-orange-700 transition text-sm">Simpan</button>

                <a href="{{ route('pembelian.clearAll') }}"
                    class="bg-orange-600 text-white font-semibold px-4 py-1 rounded-sm hover:bg-orange-700 transition text-sm">Batal</a>
            </form>
        </main>
    </div>
    <script>
        // Hitung Diskon dan Total
        function hitungDiskon() {
            // Ambil nilai diskon dari input
            const diskonPersen = parseFloat(document.getElementById('diskon').value) || 0;

            // Ambil subtotal yang ada di backend dan ubah jadi angka
            const subtotalString = "{{ $subtotal ?? 0 }}".replace(/\./g, '').replace(',', '.');
            const subtotal = parseFloat(subtotalString) || 0;

            // Hitung diskon dalam bentuk rupiah
            const diskonRupiah = subtotal * (diskonPersen / 100);

            // Hitung total setelah diskon
            const total = subtotal - diskonRupiah;

            // Update nilai diskon dalam rupiah dan total harga di input
            document.getElementById('diskon_rupiah').value = formatRupiah(diskonRupiah);
            document.getElementById('total_harga').value = formatRupiah(total);

            // PERUBAHAN 2: Update nilai pada input tersembunyi untuk dikirim ke controller
            document.getElementById('diskon_final').value = diskonPersen;
            document.getElementById('total_final').value = total;

            // Update tagihan
            updateTagihan(total);
        }

        // Fungsi untuk memformat angka menjadi format rupiah
        function formatRupiah(angka) {
            return angka.toLocaleString('id-ID', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        // Fungsi untuk mengupdate tagihan
        function updateTagihan(total) {
            document.getElementById('tagihan').textContent = 'Tagihan : Rp. ' + formatRupiah(total);
        }

        // Menghitung total harga setelah input jumlah
        function hitungTotal() {
            const harga = parseFloat(document.getElementById('harga_satuan').value) || 0;
            const jumlah = parseInt(document.getElementById('jumlah').value) || 0;
            const total = harga * jumlah;

            document.getElementById('harga_akhir').value = total;

            // Update tagihan
            updateTagihan(total);
        }

        // Fungsi untuk menghitung kembalian
        function hitungKembalian() {
            // Ambil nilai pembayaran dari input
            const bayar = parseFloat(document.getElementById('bayar').value.replace(/\./g, '').replace(',', '.')) || 0;

            // Ambil nilai total harga dari backend dan ubah jadi angka
            const totalString = document.getElementById('total_harga').value.replace(/\./g, '').replace(',', '.');
            const total = parseFloat(totalString) || 0;

            // Hitung kembalian
            const kembalian = bayar - total;

            // Update nilai kembalian
            document.getElementById('kembalian').value = formatRupiah(kembalian);

            // Update tagihan jika kembalian dihitung
            updateTagihan(total); // Jika total berubah karena pembayaran, kita perbarui tagihan lagi
        }

        function isiNamaBarang(select) {
            const option = select.options[select.selectedIndex];
            const nama = option.getAttribute('data-nama');
            const stok = option.getAttribute('data-stok');
            const harga = option.getAttribute('data-harga');

            document.getElementById('nama_produk').value = nama || '';
            document.getElementById('stok').value = stok || '';
            document.getElementById('harga_satuan').value = harga || '';

            // Reset jumlah dan harga akhir
            document.getElementById('jumlah').value = '';
            document.getElementById('harga_akhir').value = '';
        }

        document.getElementById('id_supplyer').addEventListener('change', function() {
            const idSupplyer = this.value;

            fetch("{{ route('pembelian.setSupplyer') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id_supplyer: idSupplyer
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Supplyer disimpan:', data.message);
                })
                .catch(error => {
                    console.error('Gagal menyimpan supplyer:', error);
                });
        });
    </script>

</body>

</html>
