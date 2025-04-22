@include('layout.header')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('layout.navbar')

<div class="flex justify-center items-center h-screen flex-col space-y-6">
    <!-- Card for logged-in user -->
    <div class="w-full max-w-md bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-end px-4 pt-6">
            <!-- Dropdown menu -->
        </div>
        <div class="flex flex-col items-center pb-12">
            @if(auth()->user()->role == 'admin')
                <h5 class="mb-2 text-2xl font-semibold text-gray-900 dark:text-white">Selamat Datang Admin</h5>
            @elseif(auth()->user()->role == 'petugas')
                <h5 class="mb-2 text-2xl font-semibold text-gray-900 dark:text-white">Selamat Datang Petugas</h5>
            @endif
            <div class="flex mt-6">
                @if(auth()->user()->role == 'admin')
                <a href="{{ route('user.index') }}" class="py-3 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">tabel</a>
                <a href="#" onclick="confirmLogout()" class="py-3 px-5 ms-3 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">logout</a>
                @elseif(auth()->user()->role == 'petugas')
                <a href="#" onclick="confirmLogout()" class="py-3 px-5 ms-3 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">logout</a>
                @endif
            </div>
        </div>
    </div>
    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Apakah Anda yakin ingin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('logout') }}";
                }
            });
        }
    </script>
    