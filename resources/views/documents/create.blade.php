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
        max-width: 600px;
        margin: 0 auto;
    }
    
    .form-group {
        margin-bottom: 28px;
    }
    
    .form-label {
        display: block;
        font-size: 15px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 8px;
        position: relative;
    }
    
    .form-label::after {
        content: '*';
        color: #e53e3e;
        margin-left: 4px;
    }
    
    .form-control-custom {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid rgba(226, 232, 240, 0.8);
        border-radius: 12px;
        font-size: 15px;
        background: rgba(255, 255, 255, 0.9);
        color: #4a5568;
        transition: all 0.3s ease;
        font-family: inherit;
    }
    
    .form-control-custom:focus {
        outline: none;
        border-color: #4299e1;
        box-shadow: 0 0 0 4px rgba(66, 153, 225, 0.1);
        background: rgba(255, 255, 255, 1);
    }
    
    .form-control-custom.is-invalid {
        border-color: #e53e3e;
        box-shadow: 0 0 0 4px rgba(229, 62, 62, 0.1);
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
        border-color: #4299e1;
        background: linear-gradient(45deg, rgba(66, 153, 225, 0.1), rgba(49, 130, 206, 0.15));
    }
    
    .file-input-wrapper.has-file {
        border-color: #48bb78;
        background: linear-gradient(45deg, rgba(72, 187, 120, 0.05), rgba(56, 161, 105, 0.1));
    }
    
    .file-input {
        position: absolute;
        left: -9999px;
        opacity: 0;
    }
    
    .file-input-content {
        pointer-events: none;
    }
    
    .file-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(45deg, #4299e1, #3182ce);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        color: white;
    }
    
    .file-text {
        font-size: 16px;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 4px;
    }
    
    .file-subtext {
        font-size: 13px;
        color: #718096;
    }
    
    .file-name {
        font-size: 14px;
        color: #48bb78;
        font-weight: 500;
        margin-top: 8px;
        padding: 8px 12px;
        background: rgba(72, 187, 120, 0.1);
        border-radius: 6px;
        display: inline-block;
    }
    
    .invalid-feedback-custom {
        color: #e53e3e;
        font-size: 13px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
    }
    
    .form-actions {
        display: flex;
        gap: 16px;
        justify-content: center;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid rgba(226, 232, 240, 0.8);
    }
    
    .btn-custom {
        padding: 14px 28px;
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
        min-width: 140px;
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
    
    .btn-success-custom:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
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
    
    /* Loading spinner */
    .loading-spinner {
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        display: none;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
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
        
        .form-actions {
            flex-direction: column;
        }
        
        .btn-custom {
            width: 100%;
        }
    }
    
    /* Smooth animations */
    @media (prefers-reduced-motion: no-preference) {
        .content-wrapper {
            animation: slideUp 0.6s ease-out;
        }
        
        .form-group {
            animation: fadeInUp 0.5s ease-out;
        }
        
        .form-group:nth-child(2) { animation-delay: 0.1s; }
        .form-group:nth-child(3) { animation-delay: 0.2s; }
        .form-group:nth-child(4) { animation-delay: 0.3s; }
        
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                Upload Dokumen
            </h1>
            <p class="page-subtitle">Tambahkan dokumen baru ke dalam sistem</p>
        </div>

        <div class="content-body">
            <div class="form-container">
                <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf

                    <div class="form-group">
                        <label for="title" class="form-label">Judul Dokumen</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control-custom @error('title') is-invalid @enderror"
                            value="{{ old('title') }}"
                            placeholder="Masukkan judul dokumen..."
                            required
                        >
                        @error('title')
                            <div class="invalid-feedback-custom">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="file" class="form-label">File Dokumen</label>
                        <div class="file-input-wrapper" onclick="document.getElementById('file').click()">
                            <input
                                type="file"
                                name="file"
                                id="file"
                                class="file-input @error('file') is-invalid @enderror"
                                required
                                onchange="updateFileName(this)"
                            >
                            <div class="file-input-content">
                                <div class="file-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                </div>
                                <div class="file-text">Klik untuk memilih file</div>
                                <div class="file-subtext">atau drag & drop file di sini</div>
                                <div class="file-name" id="fileName" style="display: none;"></div>
                            </div>
                        </div>
                        @error('file')
                            <div class="invalid-feedback-custom">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </div>
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
                                    {{ old('category_id') == $cat->id ? 'selected' : '' }}
                                >
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback-custom">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-custom btn-success-custom" id="submitBtn">
                            <div class="loading-spinner" id="loadingSpinner"></div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="uploadIcon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <span id="submitText">Upload Dokumen</span>
                        </button>
                        
                        <a href="{{ route('documents.index') }}" class="btn-custom btn-secondary-custom">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function updateFileName(input) {
    const fileName = document.getElementById('fileName');
    const fileWrapper = input.closest('.file-input-wrapper');
    
    if (input.files && input.files[0]) {
        fileName.textContent = input.files[0].name;
        fileName.style.display = 'inline-block';
        fileWrapper.classList.add('has-file');
    } else {
        fileName.style.display = 'none';
        fileWrapper.classList.remove('has-file');
    }
}

// Handle form submission with loading state
document.getElementById('uploadForm').addEventListener('submit', function() {
    const submitBtn = document.getElementById('submitBtn');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const uploadIcon = document.getElementById('uploadIcon');
    const submitText = document.getElementById('submitText');
    
    submitBtn.disabled = true;
    loadingSpinner.style.display = 'block';
    uploadIcon.style.display = 'none';
    submitText.textContent = 'Mengupload...';
});

// Handle drag and drop
const fileWrapper = document.querySelector('.file-input-wrapper');
const fileInput = document.getElementById('file');

fileWrapper.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.style.borderColor = '#4299e1';
    this.style.background = 'linear-gradient(45deg, rgba(66, 153, 225, 0.1), rgba(49, 130, 206, 0.15))';
});

fileWrapper.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.style.borderColor = 'rgba(66, 153, 225, 0.3)';
    this.style.background = 'linear-gradient(45deg, rgba(66, 153, 225, 0.05), rgba(49, 130, 206, 0.1))';
});

fileWrapper.addEventListener('drop', function(e) {
    e.preventDefault();
    this.style.borderColor = 'rgba(66, 153, 225, 0.3)';
    this.style.background = 'linear-gradient(45deg, rgba(66, 153, 225, 0.05), rgba(49, 130, 206, 0.1))';
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        fileInput.files = files;
        updateFileName(fileInput);
    }
});
</script>
@endsection