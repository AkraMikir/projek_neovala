@extends('layouts.app')

@section('title', 'Login Required')

@section('content')
<div class="auth-required-container">
    <div class="auth-content">
        <div class="auth-icon">
            <i class="fas fa-lock"></i>
        </div>
        <h2 class="auth-title">Akses Terbatas</h2>
        <p class="auth-message">
            Anda harus login terlebih dahulu untuk mengakses halaman ini. <br>
            Silakan masuk dengan akun administrator Anda.
        </p>
        <div class="auth-actions">
            <a href="{{ route('admin.login') }}" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> LOGIN ADMIN
            </a>
            <a href="{{ route('home') }}" class="btn-secondary-home">
                KEMBALI KE BERANDA
            </a>
        </div>
    </div>
</div>

<style>
    .auth-required-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 85vh; /* Full screen feel */
        background-color: #fcfcfc;
        padding: 20px;
    }

    .auth-content {
        max-width: 500px;
        width: 100%;
        background: white;
        padding: 50px 40px;
        border-radius: 20px;
        text-align: center;
        box-shadow: 0 15px 35px rgba(103, 76, 29, 0.08); /* Subtle colored shadow */
        border-top: 5px solid #674c1d; /* User requested color accent */
    }

    .auth-icon {
        width: 80px;
        height: 80px;
        background-color: rgba(103, 76, 29, 0.1);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto 25px;
    }

    .auth-icon i {
        font-size: 2.5rem;
        color: #674c1d;
    }

    .auth-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2d2d2d;
        margin-bottom: 15px;
    }

    .auth-message {
        font-size: 1.05rem;
        color: #666;
        line-height: 1.6;
        margin-bottom: 35px;
    }

    .auth-actions {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .btn-login {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        background-color: #674c1d; /* User requested color */
        color: white;
        padding: 14px 20px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(103, 76, 29, 0.25);
    }

    .btn-login:hover {
        background-color: #523c17;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(103, 76, 29, 0.35);
        color: white;
    }

    .btn-secondary-home {
        color: #888;
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 500;
        transition: color 0.3s ease;
        padding: 10px;
    }

    .btn-secondary-home:hover {
        color: #674c1d;
        text-decoration: underline;
    }

    @media (max-width: 576px) {
        .auth-content {
            padding: 30px 20px;
        }
        .auth-title {
            font-size: 1.5rem;
        }
    }
</style>
@endsection

@section('skip-footer')
    {{-- Skip default footer --}}
@endsection
