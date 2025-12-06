@extends('layouts.app')

@section('title', 'Manajemen Toko')

@section('content')
<div class="container py-4">

    <h3 class="mb-4">Manajemen Toko</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Nama Toko</th>
                <th>Pemilik</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($stores as $store)
            <tr>
                <td>{{ $store->id }}</td>
                <td>{{ $store->name }}</td>
                <td>{{ $store->user->name }}</td>
                <td>
                    @if($store->is_verified)
                        <span class="badge bg-success">Terverifikasi</span>
                    @else
                        <span class="badge bg-warning">Menunggu</span>
                    @endif
                </td>
                <td>
                    @if(!$store->is_verified)
                    <form action="{{ route('admin.stores.verify', $store->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-success btn-sm">Verifikasi</button>
                    </form>
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $stores->links() }}

</div>
@endsection
