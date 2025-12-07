@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold mb-4">Ajukan Penarikan Dana</h2>

<form method="POST" action="{{ route('seller.withdrawals.store') }}">
@csrf

<label>Jumlah Penarikan:</label>
<input type="number" name="amount" class="border p-2 w-full mb-4" required>

<button class="bg-green-600 text-white px-4 py-2 rounded">
    Ajukan Withdraw
</button>

</form>

@endsection
