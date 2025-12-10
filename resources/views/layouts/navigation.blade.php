@guest
<nav class="bg-white border-b border-gray-200 shadow">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

        <div class="flex space-x-6">
            <a href="/" class="text-gray-700 hover:text-indigo-600 font-semibold">Home</a>
            <a href="/search" class="text-gray-700 hover:text-indigo-600 font-semibold">Cari Produk</a>
        </div>

        <div class="flex space-x-4">
            <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-semibold">Login</a>
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">Register</a>
        </div>

    </div>
</nav>
@endguest

@auth
@if(auth()->user()->role === 'admin')
<nav class="bg-white border-b border-gray-200 shadow">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

        <div class="flex space-x-6">
            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-indigo-600 font-semibold">Dashboard Admin</a>

            <a href="{{ route('admin.verification') }}" class="relative text-gray-700 hover:text-indigo-600 font-semibold">
                Verifikasi Toko
                @if(($pendingStores ?? 0) > 0)
                    <span class="absolute -top-2 -right-4 bg-red-600 text-white text-xs px-2 py-0.5 rounded-full">
                        {{ $pendingStores }}
                    </span>
                @endif
            </a>

            <a href="{{ route('admin.users.index') }}" class="text-gray-700 hover:text-indigo-600 font-semibold">Users</a>
            <a href="{{ route('admin.categories.index') }}" class="text-gray-700 hover:text-indigo-600 font-semibold">Categories</a>
            <a href="{{ route('admin.products.index') }}" class="text-gray-700 hover:text-indigo-600 font-semibold">Products</a>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-gray-700 hover:text-red-600 font-semibold">Logout</button>
        </form>

    </div>
</nav>
@endif
@endauth

@auth
@if(auth()->user()->role !== 'admin')
<nav class="bg-white border-b border-gray-200 shadow">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

        <div class="flex space-x-6">
            <a href="/" class="text-gray-700 hover:text-indigo-600 font-semibold">Home</a>
            <a href="/history" class="text-gray-700 hover:text-indigo-600 font-semibold">Riwayat</a>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-gray-700 hover:text-red-600 font-semibold">Logout</button>
        </form>

    </div>
</nav>
@endif
@endauth
