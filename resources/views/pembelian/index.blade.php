@include('layout.header')
@include('layout.navbar')

<div class="container mx-auto py-4">
    <div class="flex flex-col">
        <form action="{{ route('pembelian.index') }}" method="GET" class="flex gap-2 mb-4">
            <select name="tanggal" class="form-select border-gray-300 rounded-md">
                <option value="">Pilih Tanggal</option>
                @for ($i = 1; $i <= 31; $i++)
                    <option value="{{ $i }}" {{ request('tanggal') == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>

            <select name="bulan" class="form-select border-gray-300 rounded-md">
                <option value="">Pilih Bulan</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                    </option>
                @endfor
            </select>

            <select name="tahun" class="form-select border-gray-300 rounded-md">
                <option value="">Pilih Tahun</option>
                @foreach ($tahunList as $tahun)
                    <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn bg-blue-500 text-white px-4 py-2 rounded-md">Filter</button>
            <a href="{{ route('pembelian.index') }}" class="btn bg-gray-500 text-white px-4 py-2 rounded-md">Reset</a>
        </form>

        <div class="bg-white shadow-md rounded-lg">
            <div class="flex justify-between items-center p-4 border-b">
                <h6 class="text-lg font-semibold">Tabel Penjualan</h6>
                <div class="flex gap-2">
                    <form action="{{ route('pembelian.index') }}" method="GET" class="flex">
                        <input
                            type="text"
                            class="form-input border-gray-300 rounded-l-md w-full"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari pembelian..."
                        >
                        <button class="btn bg-orange-500 text-white px-4 rounded-r-md">
                            <i class="fas fa-search mr-1"></i> Cari
                        </button>
                    </form>
                    <a href="{{ route('pembelian.exportExcel', request()->query()) }}" class="btn bg-green-500 text-white px-4 py-2 rounded-md">
                        <i class="fas fa-file-excel mr-2"></i>Export Excel
                    </a>

                        <a href="{{ route('pembelian.create') }}" class="btn bg-blue-500 text-white px-4 py-2 rounded-md">
                            <i class="fas fa-plus mr-2"></i>Tambah Pembelian
                        </a>

                </div>
            </div>

            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-collapse">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600 text-center">No</th>
                                <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600 text-center">Nama Pelanggan</th>
                                <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600 text-center">Tanggal Penjualan</th>
                                <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600 text-center">Total Harga</th>
                                <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600 text-center">Dibuat Oleh</th>
                                <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pembelian as $sales)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                    <td class="px-6 py-4 text-center text-gray-900 dark:text-white">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-center text-gray-900 dark:text-white">{{ $sales->nama_pelanggan }}</td>
                                    <td class="px-6 py-4 text-center text-gray-900 dark:text-white">{{ $sales->tanggal_penjualan }}</td>
                                    <td class="px-6 py-4 text-center text-gray-900 dark:text-white">Rp {{ number_format($sales->total_harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-center text-gray-900 dark:text-white">{{ $sales->dibuat_oleh }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-800" target="_blank">
                                            <i class="fas fa-file-pdf mr-2"></i> Export PDF
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Tidak ada data pembelian.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
