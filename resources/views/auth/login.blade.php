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
    
    .auth-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        width: 100%;
    }
    
    .auth-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        width: 100%;
        max-width: 1200px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 600px;
    }
    
    .auth-left {
        display: flex;
        flex-direction: column;
    }
    
    .auth-right {
        background: linear-gradient(135deg, rgba(66, 153, 225, 0.08), rgba(49, 130, 206, 0.12));
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 60px 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .auth-right::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(66,153,225,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
        opacity: 0.4;
    }
    
    .brand-logo {
        width: 80px;
        height: 80px;
        background: linear-gradient(45deg, #4299e1, #3182ce);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        box-shadow: 0 8px 25px rgba(66, 153, 225, 0.25);
        position: relative;
        z-index: 2;
    }
    
    .brand-logo svg {
        width: 40px;
        height: 40px;
        color: white;
    }
    
    .brand-title {
        font-size: 32px;
        font-weight: 700;
        color: #2d3748;
        margin: 0 0 12px 0;
        position: relative;
        z-index: 2;
        background: linear-gradient(45deg, #4299e1, #3182ce);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .brand-slogan {
        font-size: 18px;
        color: #4a5568;
        margin: 0 0 20px 0;
        font-weight: 500;
        position: relative;
        z-index: 2;
        line-height: 1.4;
    }
    
    .brand-description {
        font-size: 15px;
        color: #718096;
        line-height: 1.6;
        margin: 0 0 30px 0;
        position: relative;
        z-index: 2;
        max-width: 320px;
    }
    
    .feature-list {
        list-style: none;
        padding: 0;
        margin: 0;
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 280px;
    }
    
    .feature-item {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
        color: #4a5568;
        font-size: 14px;
        text-align: left;
    }
    
    .feature-icon {
        width: 18px;
        height: 18px;
        background: linear-gradient(45deg, #4299e1, #3182ce);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        flex-shrink: 0;
    }
    
    .feature-icon svg {
        width: 10px;
        height: 10px;
        color: white;
    }
    
    .auth-header {
        background: linear-gradient(45deg, #4299e1, #3182ce);
        color: white;
        padding: 40px 40px 35px;
        text-align: center;
        position: relative;
    }
    
    .auth-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="white" opacity="0.1"/><circle cx="80" cy="40" r="0.5" fill="white" opacity="0.1"/><circle cx="40" cy="80" r="1.5" fill="white" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    }
    
    .auth-title {
        font-size: 28px;
        font-weight: 600;
        margin: 0;
        position: relative;
        z-index: 1;
    }
    
    .auth-subtitle {
        color: rgba(255, 255, 255, 0.9);
        margin: 8px 0 0;
        font-size: 15px;
        position: relative;
        z-index: 1;
    }
    
    .auth-body {
        padding: 40px;
        background: rgba(255, 255, 255, 0.9);
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-label {
        color: #4a5568;
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
    }
    
    .form-input {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid rgba(226, 232, 240, 0.8);
        border-radius: 10px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: rgba(247, 250, 252, 0.8);
        font-family: inherit;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #4299e1;
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        transform: translateY(-1px);
    }
    
    .form-input.is-invalid {
        border-color: #e53e3e;
        background: rgba(252, 165, 165, 0.1);
    }
    
    .invalid-feedback {
        color: #e53e3e;
        font-size: 13px;
        margin-top: 6px;
        display: block;
    }
    
    .remember-group {
        display: flex;
        align-items: center;
        margin-bottom: 28px;
    }
    
    .form-checkbox {
        width: 18px;
        height: 18px;
        margin-right: 10px;
        accent-color: #4299e1;
        cursor: pointer;
    }
    
    .remember-label {
        color: #4a5568;
        font-size: 14px;
        cursor: pointer;
        user-select: none;
    }
    
    .btn-login {
        width: 100%;
        background: linear-gradient(45deg, #4299e1, #3182ce);
        color: white;
        border: none;
        padding: 16px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 20px;
        font-family: inherit;
    }
    
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(66, 153, 225, 0.3);
    }
    
    .btn-login:active {
        transform: translateY(0);
    }
    
    .forgot-link {
        color: #4299e1;
        text-decoration: none;
        font-size: 14px;
        text-align: center;
        display: block;
        transition: all 0.3s ease;
        padding: 8px;
        border-radius: 6px;
    }
    
    .forgot-link:hover {
        color: #3182ce;
        text-decoration: underline;
        background: rgba(66, 153, 225, 0.05);
    }
    
    .auth-footer {
        background: rgba(247, 250, 252, 0.9);
        padding: 20px 40px;
        text-align: center;
        border-top: 1px solid rgba(226, 232, 240, 0.5);
    }
    
    .auth-footer-text {
        color: #718096;
        font-size: 14px;
        margin: 0;
    }
    
    .auth-footer-link {
        color: #4299e1;
        text-decoration: none;
        font-weight: 500;
    }
    
    .auth-footer-link:hover {
        color: #3182ce;
        text-decoration: underline;
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
    @media (max-width: 1024px) {
        .auth-card {
            max-width: 900px;
        }
        
        .auth-body {
            padding: 35px;
        }
        
        .auth-right {
            padding: 40px 30px;
        }
    }
    
    @media (max-width: 768px) {
        .auth-container {
            padding: 15px;
            align-items: flex-start;
            padding-top: 30px;
        }
        
        .auth-card {
            grid-template-columns: 1fr;
            max-width: 500px;
            min-height: auto;
        }
        
        .auth-right {
            order: -1;
            padding: 30px 25px;
            min-height: auto;
        }
        
        .brand-title {
            font-size: 28px;
        }
        
        .brand-slogan {
            font-size: 16px;
        }
        
        .brand-description {
            font-size: 14px;
            margin-bottom: 25px;
        }
        
        .feature-list {
            max-width: none;
        }
        
        .feature-item {
            font-size: 13px;
            margin-bottom: 10px;
        }
        
        .auth-header {
            padding: 25px 25px 20px;
        }
        
        .auth-title {
            font-size: 24px;
        }
        
        .auth-subtitle {
            font-size: 14px;
        }
        
        .auth-body {
            padding: 25px;
        }
        
        .auth-footer {
            padding: 15px 25px;
        }
        
        .form-input {
            font-size: 16px; /* Prevent zoom on iOS */
        }
    }
    
    @media (max-width: 480px) {
        .auth-container {
            padding: 10px;
            padding-top: 20px;
        }
        
        .auth-card {
            border-radius: 16px;
        }
        
        .auth-body {
            padding: 20px;
        }
        
        .auth-header {
            padding: 20px;
        }
        
        .auth-right {
            padding: 25px 20px;
        }
        
        .auth-footer {
            padding: 15px 20px;
        }
        
        .brand-logo {
            width: 70px;
            height: 70px;
            margin-bottom: 20px;
        }
        
        .brand-logo svg {
            width: 35px;
            height: 35px;
        }
        
        .brand-title {
            font-size: 24px;
        }
    }
    
    /* Smooth animations */
    @media (prefers-reduced-motion: no-preference) {
        .auth-card {
            animation: slideUp 0.6s ease-out;
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
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-left">
            <div class="auth-header">
                <h1 class="auth-title">Selamat Datang</h1>
                <p class="auth-subtitle">Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            <div class="auth-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" 
                               type="email" 
                               class="form-input @error('email') is-invalid @enderror" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="email" 
                               autofocus
                               placeholder="Masukkan email Anda">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" 
                               type="password" 
                               class="form-input @error('password') is-invalid @enderror" 
                               name="password" 
                               required 
                               autocomplete="current-password"
                               placeholder="Masukkan password Anda">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="remember-group">
                        <input class="form-checkbox" 
                               type="checkbox" 
                               name="remember" 
                               id="remember" 
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="remember-label" for="remember">
                            Ingat saya
                        </label>
                    </div>

                    <button type="submit" class="btn-login">
                        Masuk
                    </button>

                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            Lupa password Anda?
                        </a>
                    @endif
                </form>
            </div>

            <div class="auth-footer">
                <p class="auth-footer-text">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="auth-footer-link">Daftar sekarang</a>
                </p>
            </div>
        </div>
        
        <div class="auth-right">
            <div class="brand-logo">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            
            <h2 class="brand-title">DocManager</h2>
            <p class="brand-slogan">Kelola Dokumen dengan Mudah</p>
            <p class="brand-description">
                Platform manajemen dokumen yang powerful dan user-friendly untuk mengorganisir, menyimpan, dan mengelola semua file Anda dengan aman.
            </p>
            
            <ul class="feature-list">
                <li class="feature-item">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    Penyimpanan Aman & Terenkripsi
                </li>
                <li class="feature-item">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    Pencarian Cepat & Akurat
                </li>
                <li class="feature-item">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    Kolaborasi Tim yang Efektif
                </li>
                <li class="feature-item">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    Akses Multi-Platform
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection