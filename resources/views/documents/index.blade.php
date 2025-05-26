@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Daftar Dokumen</h4>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <a href="{{ route('documents.create') }}" class="btn btn-primary mb-3">Upload Dokumen</a>
    
    <form method="GET" class="form-inline mb-3">
        <select name="category" class="form-control mr-2">
            <option value="">-- Semua Kategori --</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}" {{ request('category')==$cat->id?'selected':'' }}>
                {{ $cat->name }}
              </option>
            @endforeach
        </select>
        <button class="btn btn-secondary">Filter</button>
    </form>
    
    <div class="table-responsive">
        <table class="table table-striped">
          <thead>
              <tr>
                  <th>Judul</th>
                  <th>Kategori</th>
                  <th>File</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
            @forelse($documents as $doc)
              <tr>
                <td>{{ $doc->title }}</td>
                <td>{{ $doc->category->name ?? '-' }}</td>
                <td>
                    <small class="text-muted">{{ $doc->filename }}</small>
                </td>
                <td>
                  <!-- Tombol Lihat -->
                  <a href="{{ route('documents.show', $doc) }}" 
                     target="_blank" 
                     class="btn btn-sm btn-info">
                     Lihat
                  </a>
                  
                  <!-- Tombol Download -->
                  <a href="{{ route('documents.download', $doc) }}" 
                     class="btn btn-sm btn-success">
                     Download
                  </a>
                  
                  <!-- Tombol Edit -->
                  <a href="{{ route('documents.edit', $doc) }}" 
                     class="btn btn-sm btn-warning">
                     Edit
                  </a>
                  
                  <!-- Tombol Hapus -->
                  <form action="{{ route('documents.destroy', $doc) }}" 
                        method="POST" 
                        style="display:inline" 
                        onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center">Tidak ada dokumen</td>
              </tr>
            @endforelse
          </tbody>
        </table>
    </div>
    
    {{ $documents->links() }}
</div>
@endsection