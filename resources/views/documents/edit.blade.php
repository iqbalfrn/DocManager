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
        max-width: 800px;
        margin: 0 auto;
        overflow: hidden;
        animation: slideUp 0.6s ease-out;
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
    
    .form-container {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(226, 232, 240, 0.5);
    }
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-label {
        display: block;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 8px;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .form-control-custom {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid rgba(226, 232, 240, 0.8);
        border-radius: 10px;
        font-size: 15px;
        background: rgba(255, 255, 255, 0.9);
        color: #4a5568;
        transition: all 0.3s ease;
        font-family: inherit;
    }
    
    .form-control-custom:focus {
        outline: none;
        border-color: #4299e1;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        background: rgba(255, 255, 255, 1);
    }
    
    .form-control-custom.is-invalid {
        border-color: #e53e3e;
        box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.1);
    }
    
    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        background: linear-gradient(45deg, rgba(66, 153, 225, 0.05), rgba(49, 130, 206, 0.1));
        border: 2px dashed rgba(66, 153, 225, 0.3);
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .file-input-wrapper:hover {
        background: linear-gradient(45deg, rgba(66, 153, 225, 0.1), rgba(49, 130, 206, 0.15));
        border-color: rgba(66, 153, 225, 0.5);
    }
    
    .file-input-wrapper input[type="file"] {
        position: absolute;
        left: -9999px;
        opacity: 0;
    }
    
    .file-input-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }
    
    .file-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(45deg, #4299e1, #3182ce);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }
    
    .file-text {
        color: #4a5568;
        font-weight: 500;
    }
    
    .file-subtext {
        color: #718096;
        font-size: 13px;
    }
    
    .current-file-info {
        background: linear-gradient(45deg, rgba(72, 187, 120, 0.05), rgba(56, 161, 105, 0.1));
        border: 1px solid rgba(72, 187, 120, 0.2);
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .current-file-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(45deg, #48bb78, #38a169);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        flex-shrink: 0;
    }
    
    .current-file-details {
        flex: 1;
    }
    
    .current-file-title {
        font-weight: 600;
        color: #2d3748;
        margin: 0 0 4px 0;
        font-size: 14px;
    }
    
    .current-file-link {
        color: #38a169;
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
    }
    
    .current-file-link:hover {
        color: #2f855a;
        text-decoration: underline;
    }
    
    .invalid-feedback {
        display: block;
        color: #e53e3e;
        font-size: 13px;
        margin-top: 8px;
        font-weight: 500;
    }
    
    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid rgba(226, 232, 240, 0.5);
    }
    
    .btn-custom {
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
        border: none;
        min-width: 120px;
        justify-content: center;
    }
    
    .btn-success-custom {
        background: linear-gradient(45deg, #48bb78, #38a169);
        color: white;
    }
    
    .btn-success-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(72, 187, 120, 0.3);
        color: white;
        text-decoration: none;
    }
    
    .btn-secondary-custom {
        background: linear-gradient(45deg, #718096, #4a5568);
        color: white;
    }
    
    .btn-secondary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(113, 128, 150, 0.3);
        color: white;
        text-decoration: none;
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
        
        .form-container {
            padding: 24px;
        }
        
        .page-header {
            padding: 25px 20px 20px;
        }
        
        .page-title {
            font-size: 24px;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .btn-custom {
            width: 100%;
        }
    }
    
    /* Smooth animations */
    @media (prefers-reduced-motion: no-preference) {
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
        
        .form-group {
            animation: fadeInUp 0.5s ease-out;
        }
        
        .form-group:nth-child(2) { animation-delay: 0.1s; }
        .form-group:nth-child(3) { animation-delay: 0.2s; }
        .form-group:nth-child(4) { animation-delay: 0.3s; }
        
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Dokumen
            </h1>
            <p class="page-subtitle">Perbarui informasi dan file dokumen Anda</p>
        </div>

        <div class="content-body">
            <div class="form-container">
                <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title" class="form-label">Judul Dokumen</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control-custom @error('title') is-invalid @enderror"
                            value="{{ old('title', $document->title) }}"
                            required
                            placeholder="Masukkan judul dokumen..."
                        >
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">File Dokumen Saat Ini</label>
                        <div class="current-file-info">
                            <div class="current-file-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="current-file-details">
                                <p class="current-file-title">File aktif:</p>
                                <a href="{{ Storage::url($document->path) }}" target="_blank" class="current-file-link">
                                    {{ $document->filename }}
                                </a>
                            </div>
                        </div>
                        
                        <label for="file" class="form-label">Ganti File (Opsional)</label>
                        <div class="file-input-wrapper" onclick="document.getElementById('file').click()">
                            <input
                                type="file"
                                name="file"
                                id="file"
                                class="@error('file') is-invalid @enderror"
                            >
                            <div class="file-input-content">
                                <div class="file-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                </div>
                                <div class="file-text">Klik untuk pilih file baru</div>
                                <div class="file-subtext">atau drag & drop file di sini</div>
                            </div>
                        </div>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select
                            name="category_id"
                            id="category_id"
                            class="form-control-custom @error('category_id') is-invalid @enderror"
                            required
                        >
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option
                                    value="{{ $cat->id }}"
                                    {{ old('category_id', $document->category_id) == $cat->id ? 'selected' : '' }}
                                >
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('documents.index') }}" class="btn-custom btn-secondary-custom">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Batal
                        </a>
                        
                        <button type="submit" class="btn-custom btn-success-custom">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Update Dokumen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Enhanced file input functionality
document.getElementById('file').addEventListener('change', function(e) {
    const wrapper = document.querySelector('.file-input-wrapper');
    const content = document.querySelector('.file-input-content');
    
    if (e.target.files.length > 0) {
        const fileName = e.target.files[0].name;
        content.innerHTML = `
            <div class="file-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="file-text">File dipilih: ${fileName}</div>
            <div class="file-subtext">Klik lagi untuk ganti file</div>
        `;
        wrapper.style.background = 'linear-gradient(45deg, rgba(72, 187, 120, 0.05), rgba(56, 161, 105, 0.1))';
        wrapper.style.borderColor = 'rgba(72, 187, 120, 0.3)';
    }
});

// Drag and drop functionality
const wrapper = document.querySelector('.file-input-wrapper');
const fileInput = document.getElementById('file');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    wrapper.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    wrapper.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    wrapper.addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
    wrapper.style.background = 'linear-gradient(45deg, rgba(66, 153, 225, 0.1), rgba(49, 130, 206, 0.2))';
    wrapper.style.borderColor = 'rgba(66, 153, 225, 0.6)';
}

function unhighlight(e) {
    wrapper.style.background = 'linear-gradient(45deg, rgba(66, 153, 225, 0.05), rgba(49, 130, 206, 0.1))';
    wrapper.style.borderColor = 'rgba(66, 153, 225, 0.3)';
}

wrapper.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    
    if (files.length > 0) {
        fileInput.files = files;
        const event = new Event('change', { bubbles: true });
        fileInput.dispatchEvent(event);
    }
}
</script>
@endsection