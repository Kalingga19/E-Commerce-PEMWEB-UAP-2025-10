<x-app-layout>
    <div class="p-8">
        <h1 class="text-2xl font-bold">Detail User</h1>
        <p>Nama: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Role: {{ $user->role }}</p>
    </div>
</x-app-layout>
