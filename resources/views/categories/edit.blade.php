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
        background: rgba(255, 255, 255, 0.95);
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(226, 232, 240, 0.5);
        position: relative;
        overflow: hidden;
    }
    
    .form-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(45deg, #4299e1, #3182ce);
    }
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 8px;
        position: relative;
    }
    
    .form-control-custom {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid rgba(226, 232, 240, 0.8);
        border-radius: 12px;
        font-size: 16px;
        background: rgba(255, 255, 255, 0.9);
        color: #2d3748;
        transition: all 0.3s ease;
        font-family: inherit;
    }
    
    .form-control-custom:focus {
        outline: none;
        border-color: #4299e1;
        box-shadow: 0 0 0 4px rgba(66, 153, 225, 0.1);
        background: rgba(255, 255, 255, 1);
        transform: translateY(-1px);
    }
    
    .form-control-custom.is-invalid {
        border-color: #e53e3e;
        box-shadow: 0 0 0 4px rgba(229, 62, 62, 0.1);
    }
    
    .invalid-feedback {
        display: block;
        color: #e53e3e;
        font-size: 13px;
        margin-top: 6px;
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
    
    .breadcrumb {
        background: rgba(247, 250, 252, 0.8);
        padding: 12px 20px;
        border-radius: 10px;
        margin-bottom: 24px;
        border: 1px solid rgba(226, 232, 240, 0.5);
    }
    
    .breadcrumb-list {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0;
        padding: 0;
        list-style: none;
        font-size: 14px;
    }
    
    .breadcrumb-item {
        color: #718096;
    }
    
    .breadcrumb-item a {
        color: #4299e1;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }
    
    .breadcrumb-item a:hover {
        color: #3182ce;
    }
    
    .breadcrumb-item.active {
        color: #2d3748;
        font-weight: 600;
    }
    
    .breadcrumb-separator {
        color: #cbd5e0;
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
        
        .form-container {
            padding: 24px 20px;
        }
        
        .form-actions {
            flex-direction: column-reverse;
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
        
        .form-container {
            animation: fadeInUp 0.5s ease-out;
        }
        
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Kategori
            </h1>
        </div>

        <div class="content-body">
            <nav class="breadcrumb">
                <ol class="breadcrumb-list">
                    <li class="breadcrumb-item">
                        <a href="{{ route('categories.index') }}">Kategori</a>
                    </li>
                    <li class="breadcrumb-separator">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
            
            <div class="form-container">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: inline; margin-right: 6px;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Nama Kategori
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control-custom @error('name') is-invalid @enderror"
                            value="{{ old('name', $category->name) }}"
                            placeholder="Masukkan nama kategori..."
                            required
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-actions">
                        <a href="{{ route('categories.index') }}" class="btn-custom btn-secondary-custom">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Batal
                        </a>
                        
                        <button type="submit" class="btn-custom btn-success-custom">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Update Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection