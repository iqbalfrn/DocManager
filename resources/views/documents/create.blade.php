@extends('layouts.app')

@section('content')
<h4>Upload Dokumen</h4>

<form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="form-group">
    <label for="title">Judul</label>
    <input
      type="text"
      name="title"
      id="title"
      class="form-control @error('title') is-invalid @enderror"
      value="{{ old('title') }}"
      required
    >
    @error('title')
      <span class="invalid-feedback">{{ $message }}</span>
    @enderror
  </div>

  <div class="form-group">
    <label for="file">File Dokumen</label>
    <input
      type="file"
      name="file"
      id="file"
      class="form-control-file @error('file') is-invalid @enderror"
      required
    >
    @error('file')
      <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group">
    <label for="category_id">Kategori</label>
    <select
      name="category_id"
      id="category_id"
      class="form-control @error('category_id') is-invalid @enderror"
      required
    >
      <option value="">-- Pilih Kategori --</option>
      @foreach($categories as $cat)
        <option
          value="{{ $cat->id }}"
          {{ old('category_id') == $cat->id ? 'selected' : '' }}
        >
          {{ $cat->name }}
        </option>
      @endforeach
    </select>
    @error('category_id')
      <span class="invalid-feedback">{{ $message }}</span>
    @enderror
  </div>

  <button type="submit" class="btn btn-success">Upload</button>
  <a href="{{ route('documents.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
