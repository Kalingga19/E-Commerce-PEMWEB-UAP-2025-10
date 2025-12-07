<x-app-layout>
<h2 class="text-xl font-bold mb-4">Edit Kategori</h2>

<form method="POST" action="{{ route('admin.categories.update', $category) }}">
@csrf
@method('PUT')

<label>Nama:</label>
<input type="text" name="name" class="border p-2 w-full mb-3" value="{{ $category->name }}">

<label>Slug:</label>
<input type="text" name="slug" class="border p-2 w-full mb-3" value="{{ $category->slug }}">

<label>Tagline:</label>
<input type="text" name="tagline" class="border p-2 w-full mb-3" value="{{ $category->tagline }}">

<label>Deskripsi:</label>
<textarea name="description" class="border p-2 w-full mb-3">{{ $category->description }}</textarea>

<button class="bg-green-600 text-white px-4 py-2 rounded">Update</button>

</form>
</x-app-layout>