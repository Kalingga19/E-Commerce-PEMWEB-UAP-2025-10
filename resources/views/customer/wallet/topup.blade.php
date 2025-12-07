<x-app-layout>
<h2 class="text-xl font-bold mb-4">Topup Saldo</h2>

<form method="POST" action="/wallet/topup">
@csrf
    <input type="number" name="amount" placeholder="Jumlah topup" class="border p-2 w-full mb-4" required>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Buat Kode VA</button>
</form>
</x-app-layout>