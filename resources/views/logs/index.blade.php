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
        background: linear-gradient(45deg, #4f46e5, #7c3aed);
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
    
    .filter-toolbar {
        background: rgba(247, 250, 252, 0.8);
        padding: 24px;
        border-radius: 16px;
        margin-bottom: 30px;
        border: 2px solid rgba(226, 232, 240, 0.8);
    }
    
    .filter-form {
        display: flex;
        align-items: end;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        min-width: 160px;
    }
    
    .form-label {
        font-size: 14px;
        font-weight: 600;
        color: #4a5568;
    }
    
    .form-input {
        padding: 12px 16px;
        border: 2px solid rgba(226, 232, 240, 0.8);
        border-radius: 8px;
        font-size: 14px;
        background: rgba(255, 255, 255, 0.9);
        color: #4a5568;
        transition: all 0.3s ease;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    
    .btn-filter {
        background: linear-gradient(45deg, #4f46e5, #7c3aed);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        height: fit-content;
    }
    
    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79, 70, 229, 0.3);
    }
    
    .btn-danger-custom {
        background: linear-gradient(45deg, #e53e3e, #c53030);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        height: fit-content;
    }
    
    .btn-danger-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(229, 62, 62, 0.3);
        color: white;
        text-decoration: none;
    }
    
    .logs-container {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(226, 232, 240, 0.5);
    }
    
    .logs-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }
    
    .logs-table thead {
        background: linear-gradient(45deg, #f8fafc, #e2e8f0);
    }
    
    .logs-table th {
        padding: 20px 24px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        color: #4a5568;
        border-bottom: 2px solid rgba(226, 232, 240, 0.8);
        position: relative;
    }
    
    .logs-table th::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(45deg, #4f46e5, #7c3aed);
        opacity: 0.3;
    }
    
    .logs-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(226, 232, 240, 0.4);
    }
    
    .logs-table tbody tr:hover {
        background: rgba(79, 70, 229, 0.05);
        transform: translateX(4px);
    }
    
    .logs-table td {
        padding: 20px 24px;
        font-size: 14px;
        color: #4a5568;
        vertical-align: middle;
    }
    
    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .user-avatar {
        width: 36px;
        height: 36px;
        background: linear-gradient(45deg, #4f46e5, #7c3aed);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 14px;
        flex-shrink: 0;
    }
    
    .user-name {
        font-weight: 600;
        color: #2d3748;
    }
    
    .action-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(45deg, rgba(79, 70, 229, 0.1), rgba(124, 58, 237, 0.15));
        color: #4f46e5;
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        border: 1px solid rgba(79, 70, 229, 0.2);
    }
    
    .ip-address {
        font-family: 'Courier New', monospace;
        background: rgba(247, 250, 252, 0.8);
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 12px;
        color: #718096;
    }
    
    .timestamp {
        color: #718096;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: rgba(247, 250, 252, 0.5);
        border-radius: 16px;
        border: 2px dashed rgba(226, 232, 240, 0.8);
    }
    
    .empty-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(45deg, rgba(79, 70, 229, 0.1), rgba(124, 58, 237, 0.15));
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
        
        .filter-form {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }
        
        .form-group {
            min-width: auto;
        }
        
        .btn-filter, .btn-danger-custom {
            justify-content: center;
        }
        
        .logs-table {
            font-size: 12px;
        }
        
        .logs-table th,
        .logs-table td {
            padding: 12px 16px;
        }
        
        .user-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            font-size: 12px;
        }
    }
    
    @media (max-width: 480px) {
        .logs-table th,
        .logs-table td {
            padding: 10px 12px;
        }
        
        .logs-table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
        
        .filter-toolbar {
            padding: 16px;
        }
    }
    
    /* Smooth animations */
    @media (prefers-reduced-motion: no-preference) {
        .content-wrapper {
            animation: slideUp 0.6s ease-out;
        }
        
        .logs-table tbody tr {
            animation: fadeInUp 0.5s ease-out;
        }
        
        .logs-table tbody tr:nth-child(2) { animation-delay: 0.05s; }
        .logs-table tbody tr:nth-child(3) { animation-delay: 0.1s; }
        .logs-table tbody tr:nth-child(4) { animation-delay: 0.15s; }
        .logs-table tbody tr:nth-child(5) { animation-delay: 0.2s; }
        
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
                transform: translateY(10px);
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                Log Aktivitas
            </h1>
        </div>

        <div class="content-body">
            @if(session('success'))
                <div class="success-alert">
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif
            
            <div class="filter-toolbar">
                <form method="GET" class="filter-form">
                    <div class="form-group">
                        <label for="from" class="form-label">Tanggal Mulai</label>
                        <input
                            type="date"
                            name="from"
                            id="from"
                            class="form-input"
                            value="{{ request('from') }}"
                        >
                    </div>

                    <div class="form-group">
                        <label for="to" class="form-label">Tanggal Akhir</label>
                        <input
                            type="date"
                            name="to"
                            id="to"
                            class="form-input"
                            value="{{ request('to') }}"
                        >
                    </div>

                    <button type="submit" class="btn-filter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Filter Data
                    </button>

                    <a
                        href="#"
                        class="btn-danger-custom"
                        onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus semua log aktivitas?')) document.getElementById('clean-form').submit();"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Menghapus Semua Log Aktivitas
                    </a>
                </form>
                
                <form
                    id="clean-form"
                    action="{{ route('logs.clean') }}"
                    method="POST"
                    style="display: none;"
                >
                    @csrf
                    @method('DELETE')
                </form>
            </div>
            
            @if($logs->isNotEmpty())
                <div class="logs-container">
                    <table class="logs-table">
                        <thead>
                            <tr>
                                <th>Pengguna</th>
                                <th>Aktivitas</th>
                                <th>Alamat IP</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td>
                                        <div class="user-info">
                                            <div class="user-avatar">
                                                {{ strtoupper(substr($log->user->name, 0, 2)) }}
                                            </div>
                                            <div class="user-name">{{ $log->user->name }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-badge">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                            {{ $log->action }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="ip-address">{{ $log->ip_address }}</div>
                                    </td>
                                    <td>
                                        <div class="timestamp">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $log->created_at }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="empty-title">Tidak Ada Log Aktivitas</h3>
                    <p class="empty-text">Belum ada aktivitas yang tercatat dalam periode ini. Coba ubah filter tanggal atau tunggu hingga ada aktivitas baru.</p>
                </div>
            @endif
            
            <div class="pagination-wrapper">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection