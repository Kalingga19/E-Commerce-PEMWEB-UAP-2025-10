<x-app-layout>
<h2 class="text-2xl font-bold mb-4">Manajemen User</h2>

<table class="w-full bg-white rounded shadow overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-3">Nama</th>
            <th class="p-3">Email</th>
            <th class="p-3">Role</th>
            <th class="p-3">Toko</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $user)
        <tr class="border-b">
            <td class="p-3">{{ $user->name }}</td>
            <td class="p-3">{{ $user->email }}</td>
            <td class="p-3">{{ $user->role }}</td>

            <td class="p-3">
                @if($user->store)
                    {{ $user->store->name }}
                @else
                    <span class="text-gray-500">Tidak ada toko</span>
                @endif
            </td>

            <td class="p-3">
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
</x-app-layout>