@include('layout.header')
@include('layout.navbar')

<div class="container mx-auto px-4 py-6 mt-24">
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form id="formPenjualan" method="POST" action="{{ route('pembelian.store') }}">
        @csrf

        {{-- Step 1: Pilih Produk --}}
        <div id="step-1">
            <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">🛒 Pilih Produk</h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($produk as $produks)
                <div class="border border-gray-200 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 p-4 flex flex-col justify-between bg-white">
                    <div>
                        <img src="{{ asset('storage/' . $produks->gambar_produk) }}" class="w-full h-40 object-cover rounded-md mb-4">
                        <h5 class="text-xl font-semibold text-gray-800">{{ $produks->nama_produk }}</h5>
                        <input type="hidden" name="produk[{{ $produks->id }}][nama_produk]" value="{{ $produks->nama_produk }}">

                        <p class="text-sm text-gray-500 mt-1">Stok: <span class="stok">{{ $produks->stock }}</span></p>

                        <p class="text-sm mt-1">Harga: <span class="text-green-600 font-semibold">Rp {{ number_format($produks->harga, 0, ',', '.') }}</span></p>
                        <input type="hidden" name="produk[{{ $produks->id }}][harga]" value="{{ $produks->harga }}">
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah:</label>
                        <input type="number" name="produk[{{ $produks->id }}][qty]" value="0" min="0" class="qty-input w-full border border-gray-300 rounded px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400">

                        <div class="mt-2 text-sm text-gray-700">
                            Subtotal: <span class="subtotal font-semibold">Rp 0</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-right mt-8">
                <button type="button" id="toStep2" class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition">Selanjutnya</button>
            </div>
        </div>


    </form>
</div>


        {{-- Step 2: Info Pelanggan --}}
        <div id="step-2" class="hidden">
            <h4 class="text-lg font-semibold mb-4">Status Pelanggan</h4>
            <div class="mb-4">
                <label class="mr-4"><input type="radio" name="status_pelanggan" value="member" checked> Member</label>
                <label><input type="radio" name="status_pelanggan" value="non-member"> Non-Member</label>
            </div>

            <div id="formMember">
                <input type="hidden" name="member_id" id="member_id">
                <input type="text" name="no_telp" id="no_telp" placeholder="No Telepon Member" class="w-full border border-gray-300 rounded px-2 py-1 mb-2">
                <input type="text" name="nama_member" id="nama_member" placeholder="Nama Member (jika baru)" class="w-full border border-gray-300 rounded px-2 py-1 mb-2">
                <div>
                    <label><input type="checkbox" id="gunakanPoin" name="gunakan_poin" value="1"> Gunakan Poin</label>
                </div>
            </div>

            <div id="formNonMember" class="hidden">
                <p><strong>Nama Pelanggan:</strong> NON-MEMBER</p>
            </div>

            <h5 class="mt-3 text-lg font-semibold">Total Bayar: <span id="totalBayarView">Rp 0</span></h5>
            <input type="hidden" name="total_harga" id="totalBayarInput">

            <label for="jumlahBayar" class="mt-2 block">Jumlah Bayar:</label>
            <input
                type="number"
                id="jumlahBayar"
                name="jumlah_bayar"
                class="w-full border border-gray-300 rounded px-2 py-1"
                step="0.01"
                max="99999999999.99"
                oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);"
            >
            <p id="notifKurang" class="text-red-500 hidden">Jumlah bayar kurang dari total!</p>

            <label class="mt-2 block">Deskripsi Pembayaran (optional):</label>
            <textarea name="deskripsi_pembayaran" class="w-full border border-gray-300 rounded px-2 py-1"></textarea>

            <div class="mt-3 flex space-x-2">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan & Cetak</button>
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600" id="backStep1">Kembali</button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        function updateSubtotal() {
            let total = 0;
            document.querySelectorAll("tbody tr").forEach(row => {
                const qtyInput = row.querySelector(".qty-input");
                const stok = parseInt(row.querySelector(".stok").innerText);
                const hargaInput = row.querySelector("input[name^='produk'][name$='[harga]']");
                const harga = hargaInput ? parseInt(hargaInput.value) : 0;
                const subtotalCell = row.querySelector(".subtotal");
                const qty = parseInt(qtyInput.value) || 0;

                if (qty > stok) {
                    alert("Jumlah melebihi stok!");
                    qtyInput.value = stok;
                }

                const subtotal = qty * harga;
                subtotalCell.innerText = `Rp ${subtotal.toLocaleString()}`;
                total += subtotal;
            });

            document.getElementById("totalBayarView").innerText = `Rp ${total.toLocaleString()}`;
            document.getElementById("totalBayarInput").value = total;
        }

        document.querySelectorAll(".qty-input").forEach(input => {
            input.addEventListener("input", updateSubtotal);
        });

        document.getElementById("jumlahBayar").addEventListener("input", function () {
            const bayar = parseInt(this.value) || 0;
            const total = parseInt(document.getElementById("totalBayarInput").value);
            document.getElementById("notifKurang").classList.toggle("d-none", bayar >= total);
        });

        document.getElementById("toStep2").addEventListener("click", function () {
            updateSubtotal();
            document.getElementById("step-1").style.display = "none";
            document.getElementById("step-2").style.display = "block";
        });

        document.getElementById("backStep1").addEventListener("click", function () {
            document.getElementById("step-2").style.display = "none";
            document.getElementById("step-1").style.display = "block";
        });

        document.querySelectorAll("input[name='status_pelanggan']").forEach(radio => {
            radio.addEventListener("change", function () {
                if (this.value === "member") {
                    document.getElementById("formMember").style.display = "block";
                    document.getElementById("formNonMember").style.display = "none";
                } else {
                    document.getElementById("formMember").style.display = "none";
                    document.getElementById("formNonMember").style.display = "block";
                }
            });
        });

        document.getElementById('no_telp').addEventListener('input', function () {
            const telp = this.value.trim();
            if (telp === '08123456789') {
                document.getElementById('member_id').value = 1;
                document.getElementById('nama_member').value = "Contoh Member";
            } else {
                document.getElementById('member_id').value = "";
            }
        });
    });
    </script>
@endpush
