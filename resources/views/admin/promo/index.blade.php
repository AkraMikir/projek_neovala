<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Promotions - Neovala Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/promo.css') }}">
</head>
<body>
    @include('admin.partials.sidebar')

    <div class="main-wrapper">
        <div class="main-content">
            <!-- Header -->
            <div class="header-admin">
                <header>
                    <h1>ADMIN TAMBAHKAN DAN HAPUS PROMO</h1>
                </header>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
            <div class="alert-old success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
            <div class="alert-old error">{{ session('error') }}</div>
            @endif

            @if($errors->any())
            <div class="alert-old error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <!-- Promo Container -->
            <div class="promo-container" style="display: flex; gap: 20px; align-items: flex-start;">
                <!-- Form Section -->
                <form action="{{ route('admin.dashboard1.promo.store') }}" method="POST" enctype="multipart/form-data" class="promo-form">
                    @csrf

                    <div class="image-upload" onclick="document.getElementById('promoImage').click()">
                        <div class="upload-placeholder" id="previewArea">
                            <i class="fas fa-image"></i>
                            <p>Insert promo card</p>
                        </div>
                        <input type="file" id="promoImage" name="image" accept="image/*" hidden required>
                    </div>

                    <div class="apartment-selection">
                        <h3>Apartment:</h3>
                        <div class="radio-group">
                            @foreach($apartments as $apartment)
                            <label class="radio-item">
                                <input type="radio" name="title" value="{{ $apartment }}" required>
                                <span class="radio-label">{{ ucwords(strtolower(str_replace('_', ' ', $apartment))) }}</span>
                            </label>
                            @endforeach
                        </div>
                        <button type="submit" class="tambah-btn">Tambah</button>
                    </div>
                </form>

                <!-- Promo Cards Grid -->
                <div class="promo-cards">
                    @if($promos->count() > 0)
                        @foreach($promos as $promo)
                        <div class="promo-card">
                            <img src="{{ asset('storage/' . $promo->image) }}" alt="Promo">
                            <div class="promo-overlay">
                                <p>{{ $promo->title }}</p>
                                <form action="{{ route('admin.dashboard1.promo.destroy', $promo->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete-btn" onclick="event.preventDefault(); confirmDelete(this.form);">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="no-promo">
                            <p>Tidak ada promo tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('admin.partials.confirmation_modal')
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    <script src="{{ asset('js/admin/promo.js') }}"></script>
</body>
</html>
