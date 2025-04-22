<nav id="default-navbar" class="fixed top-0 left-0 z-40 w-full bg-gray-50 dark:bg-blue-800" aria-label="Navbar">
    <div class="px-3 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <a href="{{ route('dashboard') }}" class="flex items-center font-medium text-black dark:text-white p-2 rounded-lg">
                <span class="ms-3">Miniparimart</span>
            </a>
        </div>
        <ul class="flex space-x-4 font-medium">
                <li>
                    <a href="{{ route('produk.index') }}" class="flex items-center text-gray-900 dark:text-white p-2 rounded-lg">
                        <span class="ms-3">Products</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pembelian.index') }}" class="flex items-center text-gray-900 dark:text-white p-2 rounded-lg">
                        <span class="ms-3">Pembelian</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.show', ['id' => auth()->user()->id]) }}" class="flex items-center text-gray-900 dark:text-white p-2 rounded-lg">
                        <span class="ms-3">Users</span>
                    </a>
                </li>
        </ul>
    </div>
</nav>