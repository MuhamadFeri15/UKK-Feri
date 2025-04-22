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
                    @if(auth()->check() && auth()->user()->role === 'petugas')
                        <a href="{{ route('pembelian.create') }}" class="btn bg-blue-500 text-white px-4 py-2 rounded-md">
                            <i class="fas fa-plus mr-2"></i>Tambah Pembelian
                        </a>
                    @endif
                </div>
            </div>

            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-center">No</th>
                                <th class="px-4 py-2 text-center">Nama Pelanggan</th>
                                <th class="px-4 py-2 text-center">Tanggal Penjualan</th>
                                <th class="px-4 py-2 text-center">Total Harga</th>
                                <th class="px-4 py-2 text-center">Dibuat Oleh</th>
                                <th class="px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembelian as $sales)
                                <tr class="border-t">
                                    <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 text-center">{{ $sales->nama_pelanggan }}</td>
                                    <td class="px-4 py-2 text-center">{{ $sales->tanggal_penjualan }}</td>
                                    <td class="px-4 py-2 text-center">{{ $sales->total_harga }}</td>
                                    <td class="px-4 py-2 text-center">{{ $sales->dibuat_oleh }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <a href="" class="btn bg-gray-500 text-white px-4 py-2 rounded-md" target="_blank">
                                            Export PDF
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
