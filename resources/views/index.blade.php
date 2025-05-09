@include('layout.header')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
 </button>

<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="max-w-sm p-6 bg-white rounded-lg shadow-md">
        <h2 class="mb-4 text-2xl font-bold text-gray-800">Selamat Datang!</h2>
        <p class="mb-6 text-gray-600">Silakan klik tombol di bawah untuk login.</p>
        <a href="{{ route('login') }}" class="block px-4 py-2 text-center text-white bg-blue-500 rounded-lg hover:bg-blue-600">
            Login
        </a>
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
  </body>
</html>