@extends('layouts.app')

@section('content')
<h4>Tambah Kategori</h4>

<form action="{{ route('categories.store') }}" method="POST">
  @csrf

  <div class="form-group">
    <label for="name">Nama Kategori</label>
    <input
      type="text"
      name="name"
      id="name"
      class="form-control @error('name') is-invalid @enderror"
      value="{{ old('name') }}"
      required
    >
    @error('name')
      <span class="invalid-feedback">{{ $message }}</span>
    @enderror
  </div>

  <button type="submit" class="btn btn-success">Simpan</button>
  <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
