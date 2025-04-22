        @include('layout.header')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @include('layout.navbar')
       
        <div class="container mx-auto mt-8">
            <h1 class="text-2xl font-bold">Selamat Datang di Dashboard</h1>
            <p class="mt-4">Pilih menu di atas untuk melanjutkan.</p>
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