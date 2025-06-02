@extends('layouts.app')

@section('content')
<style>
    * {
        box-sizing: border-box;
    }
    
    body {
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .main-container {
        min-height: 100vh;
        padding: 20px;
        width: 100%;
    }
    
    .content-wrapper {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
        max-width: 1400px;
        margin: 0 auto;
        overflow: hidden;
    }
    
    .page-header {
        background: linear-gradient(45deg, #4299e1, #3182ce);
        color: white;
        padding: 40px 40px 35px;
        text-align: center;
        position: relative;
    }
    
    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="white" opacity="0.1"/><circle cx="80" cy="40" r="0.5" fill="white" opacity="0.1"/><circle cx="40" cy="80" r="1.5" fill="white" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    }
    
    .page-title {
        font-size: 32px;
        font-weight: 700;
        margin: 0;
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }
    
    .page-subtitle {
        color: rgba(255, 255, 255, 0.9);
        margin: 8px 0 0;
        font-size: 16px;
        position: relative;
        z-index: 1;
    }
    
    .content-body {
        padding: 40px;
        background: rgba(255, 255, 255, 0.9);
    }
    
    .success-alert {
        background: linear-gradient(45deg, #48bb78, #38a169);
        color: white;
        padding: 16px 20px;
        border-radius: 10px;
        margin-bottom: 24px;
        box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
        border: none;
        font-weight: 500;
    }
    
    .toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .btn-primary-custom {
        background: linear-gradient(45deg, #4299e1, #3182ce);
        color: white;
        border: none;
        padding: 14px 24px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: inherit;
    }
    
    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(66, 153, 225, 0.3);
        color: white;
        text-decoration: none;
    }
    
    .filter-form {
        display: flex;
        align-items: center;
        gap: 12px;
        background: rgba(247, 250, 252, 0.8);
        padding: 16px 20px;
        border-radius: 12px;
        border: 2px solid rgba(226, 232, 240, 0.8);
    }
    
    .filter-select {
        padding: 10px 16px;
        border: 2px solid rgba(226, 232, 240, 0.8);
        border-radius: 8px;
        font-size: 14px;
        background: rgba(255, 255, 255, 0.9);
        color: #4a5568;
        min-width: 200px;
        transition: all 0.3s ease;
    }
    
    .filter-select:focus {
        outline: none;
        border-color: #4299e1;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
    }
    
    .btn-filter {
        background: linear-gradient(45deg, #718096, #4a5568);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .btn-filter:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(113, 128, 150, 0.3);
    }
    
    .documents-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 24px;
        margin-bottom: 30px;
    }
    
    .document-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(226, 232, 240, 0.5);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .document-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(45deg, #4299e1, #3182ce);
    }
    
    .document-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
    }
    
    .document-title {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
        margin: 0 0 8px 0;
        line-height: 1.3;
    }
    
    .document-category {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(45deg, rgba(66, 153, 225, 0.1), rgba(49, 130, 206, 0.15));
        color: #3182ce;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        margin-bottom: 12px;
        border: 1px solid rgba(66, 153, 225, 0.2);
    }
    
    .document-filename {
        color: #718096;
        font-size: 13px;
        background: rgba(247, 250, 252, 0.8);
        padding: 8px 12px;
        border-radius: 8px;
        margin-bottom: 16px;
        word-break: break-all;
    }
    
    .document-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .btn-sm-custom {
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    
    .btn-info-custom {
        background: linear-gradient(45deg, #4299e1, #3182ce);
        color: white;
    }
    
    .btn-info-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(66, 153, 225, 0.3);
        color: white;
        text-decoration: none;
    }
    
    .btn-success-custom {
        background: linear-gradient(45deg, #48bb78, #38a169);
        color: white;
    }
    
    .btn-success-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(72, 187, 120, 0.3);
        color: white;
        text-decoration: none;
    }
    
    .btn-warning-custom {
        background: linear-gradient(45deg, #ed8936, #dd6b20);
        color: white;
    }
    
    .btn-warning-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(237, 137, 54, 0.3);
        color: white;
        text-decoration: none;
    }
    
    .btn-danger-custom {
        background: linear-gradient(45deg, #e53e3e, #c53030);
        color: white;
    }
    
    .btn-danger-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(229, 62, 62, 0.3);
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: rgba(247, 250, 252, 0.5);
        border-radius: 16px;
        border: 2px dashed rgba(226, 232, 240, 0.8);
    }
    
    .empty-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(45deg, rgba(66, 153, 225, 0.1), rgba(49, 130, 206, 0.15));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    
    .empty-title {
        font-size: 20px;
        font-weight: 600;
        color: #4a5568;
        margin: 0 0 8px 0;
    }
    
    .empty-text {
        color: #718096;
        font-size: 14px;
        margin: 0;
    }
    
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }
    
    /* Reset untuk container Laravel */
    html, body {
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }
    
    .container, .container-fluid {
        background: transparent !important;
        padding: 0 !important;
        margin: 0 !important;
        max-width: none !important;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .main-container {
            padding: 10px;
        }
        
        .content-body {
            padding: 20px;
        }
        
        .page-header {
            padding: 25px 20px 20px;
        }
        
        .page-title {
            font-size: 24px;
        }
        
        .toolbar {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }
        
        .filter-form {
            flex-direction: column;
            gap: 10px;
        }
        
        .filter-select {
            min-width: auto;
            width: 100%;
        }
        
        .documents-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        
        .document-card {
            padding: 20px;
        }
        
        .document-actions {
            justify-content: center;
        }
    }
    
    @media (max-width: 480px) {
        .btn-primary-custom {
            width: 100%;
            justify-content: center;
        }
        
        .document-actions {
            flex-direction: column;
        }
        
        .btn-sm-custom {
            justify-content: center;
        }
    }
    
    /* Smooth animations */
    @media (prefers-reduced-motion: no-preference) {
        .content-wrapper {
            animation: slideUp 0.6s ease-out;
        }
        
        .document-card {
            animation: fadeInUp 0.5s ease-out;
        }
        
        .document-card:nth-child(2) { animation-delay: 0.1s; }
        .document-card:nth-child(3) { animation-delay: 0.2s; }
        .document-card:nth-child(4) { animation-delay: 0.3s; }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    }
</style>

<div class="main-container">
    <div class="content-wrapper">
        <div class="page-header">
            <h1 class="page-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Daftar Dokumen
            </h1>
        </div>

        <div class="content-body">
            @if(session('success'))
                <div class="success-alert">
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif
            
            <div class="toolbar">
                <a href="{{ route('documents.create') }}" class="btn-primary-custom">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Upload Dokumen
                </a>
                
                <form method="GET" class="filter-form">
                    <select name="category" class="filter-select">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($categories as $cat)
                          <option value="{{ $cat->id }}" {{ request('category')==$cat->id?'selected':'' }}>
                            {{ $cat->name }}
                          </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-filter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Filter
                    </button>
                </form>
            </div>
            
            @if($documents->isNotEmpty())
                <div class="documents-grid">
                    @foreach($documents as $doc)
                        <div class="document-card">
                            <h3 class="document-title">{{ $doc->title }}</h3>
                            
                            <div class="document-category">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                {{ $doc->category->name ?? 'Tanpa Kategori' }}
                            </div>
                            
                            <div class="document-filename">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                {{ $doc->filename }}
                            </div>
                            
                            <div class="document-actions">
                                <a href="{{ route('documents.show', $doc) }}" 
                                   target="_blank" 
                                   class="btn-sm-custom btn-info-custom">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Lihat
                                </a>
                                
                                <a href="{{ route('documents.download', $doc) }}" 
                                   class="btn-sm-custom btn-success-custom">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Download
                                </a>
                                
                                <a href="{{ route('documents.edit', $doc) }}" 
                                   class="btn-sm-custom btn-warning-custom">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                
                                <form action="{{ route('documents.destroy', $doc) }}" 
                                      method="POST" 
                                      style="display:inline" 
                                      onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-sm-custom btn-danger-custom">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="empty-title">Tidak Ada Dokumen</h3>
                    <p class="empty-text">Belum ada dokumen yang tersedia. Mulai dengan mengupload dokumen pertama Anda!</p>
                </div>
            @endif
            
            <div class="pagination-wrapper">
                {{ $documents->links() }}
            </div>
        </div>
    </div>
</div>
@endsection