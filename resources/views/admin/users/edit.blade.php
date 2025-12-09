<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-10 px-6">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl p-8 border border-gray-200">

            <h1 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                </svg>
                Edit User: {{ $user->name }}
            </h1>

            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ $user->name }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                </div>

                {{-- Role --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select name="role" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                        <option value="customer" @selected($user->role=='customer')>Customer</option>
                        <option value="seller" @selected($user->role=='seller')>Seller</option>
                        <option value="admin" @selected($user->role=='admin')>Admin</option>
                    </select>
                </div>

                {{-- Password Optional --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Password Baru (Opsional)
                    </label>
                    <input type="password" name="password" minlength="6"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500"
                        placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end">
                    <a href="{{ route('admin.users.index') }}"
                        class="px-5 py-3 bg-gray-200 hover:bg-gray-300 rounded-xl mr-3 text-gray-700">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl shadow-lg">
                        Perbarui User
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
