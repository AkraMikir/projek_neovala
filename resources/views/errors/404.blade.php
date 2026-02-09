@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<div class="error-container">
    <div class="error-content">
        <h1 class="error-code">404</h1>
        <h2 class="error-title">Halaman Tidak Ditemukan</h2>
        <p class="error-message">
            Ups! Sepertinya Anda tersesat. Halaman yang Anda cari tidak tersedia atau mungkin salah penulisan alamat.
        </p>
        <a href="{{ route('home') }}" class="btn-home">
            <i class="fas fa-home"></i> KEMBALI KE BERANDA
        </a>
    </div>
</div>

<style>
    .error-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        background-color: #f8f9fa;
        text-align: center;
        padding: 20px;
    }

    .error-content {
        max-width: 600px;
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    }

    .error-code {
        font-size: 8rem;
        font-weight: 800;
        color: #674c1d; /* User requested color */
        margin: 0;
        line-height: 1;
        opacity: 0.2;
    }

    .error-title {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
        margin-top: -40px;
        margin-bottom: 20px;
    }

    .error-message {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .btn-home {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background-color: #674c1d; /* User requested color */
        color: white;
        padding: 12px 30px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(103, 76, 29, 0.2);
    }

    .btn-home:hover {
        background-color: #523c17;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(103, 76, 29, 0.3);
        color: white;
    }

    @media (max-width: 768px) {
        .error-code {
            font-size: 6rem;
        }
        .error-title {
            font-size: 1.5rem;
            margin-top: -30px;
        }
    }
</style>
@endsection

@section('skip-footer')
    {{-- Skip default footer for cleaner look --}}
@endsection
