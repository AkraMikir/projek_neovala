<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home Testimonials - Neovala Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/komentar.css') }}">
</head>
<body>
    @include('admin.partials.sidebar')

    <div class="main-wrapper">
        <div class="main-content-old">
            <!-- Header -->
            <div class="header-admin-old">
                <header>
                    <h1>ADMIN TAMBAHKAN DAN EDIT KOMENTAR TAMPILAN HOME</h1>
                </header>
            </div>

            <div class="komentar-container-old">
                <!-- Form Section -->
                <div class="komentar-form-old">
                    <h2>Buat Komentar Home</h2>

                    @if(session('success'))
                    <div class="alert-old success">{{ session('success') }}</div>
                    @endif

                    <form id="testimonialForm" action="{{ route('admin.dashboard1.komentar.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" id="formMethod" value="POST">
                        <input type="hidden" name="id" id="testimonialId">

                        <div class="form-group-old">
                            <label>Apartment:</label>
                            <input type="text" name="apartmen" id="apartmen" placeholder="nama apartment" class="form-input-old" required>
                        </div>

                        <div class="form-group-old">
                            <label>Instagram:</label>
                            <input type="text" name="instagram" id="instagram" placeholder="@instagram" class="form-input-old">
                        </div>

                        <div class="form-group-old">
                            <label>Pesan:</label>
                            <textarea name="isi" id="isi" placeholder="Tulis pesan..." class="form-textarea-old" required></textarea>
                        </div>

                        <div class="form-group-old">
                            <label>Bintang:</label>
                            <select name="bintang" id="bintang" class="form-input-old" required>
                                <option value="1">⭐</option>
                                <option value="2">⭐⭐</option>
                                <option value="3">⭐⭐⭐</option>
                                <option value="4">⭐⭐⭐⭐</option>
                                <option value="5" selected>⭐⭐⭐⭐⭐</option>
                            </select>
                        </div>

                        <button type="submit" id="submitBtn" class="tambah-btn-old">Tambah</button>
                    </form>
                </div>

                <!-- Komentar Cards -->
                <div class="komentar-cards-old">
                    @if($komentars->count() > 0)
                        @foreach($komentars as $komentar)
                        <div class="komentar-card-old">
                            <div class="komentar-header-old">
                                <h3>{{ strtoupper($komentar->apartmen) }}</h3>
                                <div class="action-buttons-old">
                                    <button type="button" class="edit-btn-old" 
                                            data-id="{{ $komentar->id }}"
                                            data-apartmen="{{ $komentar->apartmen }}"
                                            data-instagram="{{ $komentar->instagram }}"
                                            data-isi="{{ $komentar->isi }}"
                                            data-bintang="{{ $komentar->bintang }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.dashboard1.komentar.destroy', $komentar->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn-old" onclick="event.preventDefault(); confirmDelete(this.form);">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="komentar-content-old">
                                <p>{{ $komentar->isi }}</p>
                            </div>
                            <div class="komentar-footer-old">
                                <span class="instagram-handle-old">{{ $komentar->instagram ?: 'Anonymous' }}</span>
                                <div class="rating-old">
                                    @for($i = 1; $i <= $komentar->bintang; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="no-komentar-old">
                            <p>Tidak ada komentar tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>>

    @include('admin.partials.confirmation_modal')
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    <script src="{{ asset('js/admin/komentar.js') }}"></script>
</body>
</html>
