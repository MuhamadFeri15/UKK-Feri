        @include('layout.header')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @include('layout.navbar')

            <div class="container mx-auto flex items-center justify-center min-h-screen"> <!-- Flex container untuk ketengahkan card -->
                <div class="flex flex-wrap justify-center gap-4"> <!-- Flex container dengan gap antar card -->
                @php
                $userCount = \App\Models\User::count();
                @endphp


                <div class="w-64 p-4 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 text-center">
                <h5 class="mb-2 text-3xl font-bold tracking-tight text-blue-600 dark:text-white">
                    {{ $userCount }}
                </h5>
                <p class="font-medium text-gray-700 dark:text-gray-400">Jumlah user saat ini</p>
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
            </body>
            </html>
