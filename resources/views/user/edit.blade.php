@include('layout.header')

<div class="container mx-auto mt-10">
    <div class="flex justify-center">
        <div class="w-full max-w-lg">
            <div class="bg-white shadow-md rounded-lg">
                <div class="bg-blue-500 text-white text-lg font-semibold px-6 py-4 rounded-t-lg">
                    Edit User
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

                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-medium mb-2">Nama <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{ old('name', $user->name) }}" placeholder="Masukkan nama">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{ old('email', $user->email) }}" placeholder="Masukkan email">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                            <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan password baru (opsional)">
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan ulang password baru (opsional)">
                        </div>

                        <div class="mb-4">
                            <label for="role" class="block text-gray-700 font-medium mb-2">Role <span class="text-red-500">*</span></label>
                            <select id="role" name="role" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                            </select>
                        </div>

                        <div class="flex justify-between items-center">
                            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Simpan</button>

                            <a href="{{ route('user.index') }}" class="flex items-center text-blue-500 hover:text-blue-700 p-2 rounded-lg">
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