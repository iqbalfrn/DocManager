@extends('layouts.app')

@section('content')
<h4>Daftar Kategori</h4>
<a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>
<table class="table">
  <thead><tr><th>Nama</th><th>Aksi</th></tr></thead>
  <tbody>
    @foreach($categories as $cat)
      <tr>
        <td>{{ $cat->name }}</td>
        <td>
          <a href="{{ route('categories.edit',$cat) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('categories.destroy',$cat) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
{{ $categories->links() }}
@endsection
