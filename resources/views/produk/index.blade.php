@include ('layout.header')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include ('layout.navbar')

<div class="container mx-auto px-4">
    <div class="text-center mt-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Selamat datang, {{ Auth::user()->name }}!</h2>
    </div>
    <div class="w-full max-w-6xl mx-auto mt-10">
        <div class="bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <div class="px-6 py-4">
                <h5 class="mb-6 text-2xl font-semibold text-gray-900 dark:text-white">Daftar Semua Produk</h5>
                <div class="overflow-x-auto">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('produk.create') }}" class="inline-flex items-center px-5 py-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</a>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-collapse">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">#</th>
                                <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Nama Produk</th>
                                <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Gambar</th>
                                <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Harga</th>
                                <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Stok</th>
                                <th scope="col" class="px-6 py-3 border-b border-gray-200 dark:border-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produks as $index => $produk)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                    <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $produk->nama_produk}}</td>
                                    <td class="px-6 py-4">
                                        <img src="{{ asset('storage/' . $produk->gambar_produk) }}" class="w-16 h-16 object-cover rounded-lg">
                                    </td>
                                    <td class="px-6 py-4 text-gray-900 dark:text-white">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $produk->stock }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-4">
                                            <a href="{{ route('produk.edit', $produk->id) }}" class="py-2 px-4 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Edit</a>
                                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="py-2 px-4 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Tidak ada data produk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end mt-4">
                    <button>
                        <a href="{{ route('dashboard') }}" class="flex items-center text-blue-500 hover:text-blue-700 p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                            <span class="ms-3">Kembali</span>
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '{{ session('success') }}',
        confirmButtonColor: '#8c7ae6',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('successUpdate'))
<script>
    Swal.fire({
        icon: 'success',
        title: '{{ session('successUpdate') }}',
        confirmButtonColor: '#8c7ae6',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('successDelete'))
<script>
    Swal.fire({
        icon: 'success',
        title: '{{ session('successDelete') }}',
        confirmButtonColor: '#8c7ae6',
        confirmButtonText: 'OK'
    });
</script>
@endif



