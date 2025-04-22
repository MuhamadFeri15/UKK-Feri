@include('layout.header')
@include('layout.header')

<div class="container mx-auto mt-10">
    <div class="flex justify-center">
        <div class="w-full max-w-lg">
            <div class="bg-white shadow-md rounded-lg">
                <div class="bg-blue-500 text-white text-lg font-semibold px-6 py-4 rounded-t-lg">
                    Edit Produk
                </div>

                <div class="p-6">
                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nama_produk" class="block text-gray-700 font-medium mb-2">
                                Nama Produk <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama_produk" name="nama_produk" autocomplete="nama_produk"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Masukkan nama produk" required>
                        </div>
                    
                        <div class="mb-4">
                            <label for="gambar_produk" class="block text-gray-700 font-medium mb-2">
                                Gambar Produk <span class="text-red-500">*</span>
                            </label>
                            <input type="file" id="gambar_produk" name="gambar_produk" accept="image/*" autocomplete="off"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    
                        <div class="mb-4">
                            <label for="harga" class="block text-gray-700 font-medium mb-2">
                                Harga <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="harga" name="harga" min="0" autocomplete="off"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Masukkan harga produk" required>
                        </div>
                    
                        <div class="mb-4">
                            <label for="stock" class="block text-gray-700 font-medium mb-2">
                                Stok <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="stock" name="stock" min="0" autocomplete="off"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   v placeholder="Masukkan jumlah stok" required>
                        </div>

                        <div class="flex justify-between items-center">
                            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Simpan</button>

                            <a href="{{ route('produk.index') }}" class="flex items-center text-blue-500 hover:text-blue-700 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                                <span class="ms-3">Kembali</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
