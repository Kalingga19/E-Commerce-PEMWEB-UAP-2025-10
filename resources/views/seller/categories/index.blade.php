<x-app-layout>
<h3>Kategori Produk</h3>

<a href="{{ route('seller.categories.create') }}" class="btn btn-primary">Tambah Kategori</a>

<table class="table mt-3">
    <tr>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>

    @foreach ($categories as $c)
    <tr>
        <td>{{ $c->name }}</td>
        <td>
            <a href="{{ route('seller.categories.edit', $c->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('seller.categories.destroy', $c->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button onclick="return confirm('Hapus kategori?')" class="btn btn-sm btn-danger">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
</x-app-layout>
