@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Manajemen User</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ strtoupper($user->role) }}</td>
                <td>{{ $user->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection
