<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=42dot+Sans:wght@300..800&family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=42dot+Sans:wght@300..800&family=Allura&family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=National+Park:wght@200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo/footer-logo.png') }}">
    <title>Neovala Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo home-link" style="cursor: pointer;">
            <img src="{{ asset('images/logo/NEOVALA-DARK.png') }}" alt="Neovala Admin">
            <h2>NEOVALA ADMIN</h2>
        </div>
        <nav>
            <ul>
                <li class="menu-item">
                    <a href="#" class="menu-button">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                        <i class="fas fa-chevron-down arrow"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="#" class="promo-link">Promo</a></li>
                        <li><a href="#" class="komentar-link">Komentar</a></li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-button">
                        <i class="fas fa-building"></i>
                        <span>Apartment</span>
                        <i class="fas fa-chevron-down arrow"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="#" class="tpj-link">TPJ</a></li>
                        <li><a href="#" class="tpc-link">TPC</a></li>
                        <li><a href="#" class="gkl-link">LAGOON</a></li>
                        <li><a href="#" class="plu-link">URBANO</a></li>
                        <li><a href="#" class="gtw-link">CICADAS</a></li>
                        <li><a href="#" class="pgv-link">PODOMORO</a></li>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class= "btn-logout">Logout</button>
                        </form>

                    </ul>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Section Admin Panel -->
        <div class="admin-section" id="adminPanel">
            <div class="header-admin">
                <header>
                    <h1>Welcome to Neovala Apartment Website Admin</h1>
                </header>
            </div>

            <div class="admin-cards">
                <div class="admin-card"
                    style="background-image: url('../../images/images/Admin-page/IMG_0030\ \(Copy\).jpg');">
                    <div class="card-content">
                        <h2>TESTIMONI HOME ADMIN PANEL</h2>
                        <button class="komentar-link">Lihat Komentar</button>
                    </div>
                </div>
                <div class="admin-card"
                    style="background-image: url('../../images/images/Admin-page/IMG_0115\ \(Copy\).jpg');">
                    <div class="card-content">
                        <h2>PROMO ADMIN PANEL</h2>
                        <button class="promo-link">Lihat Promo</button>
                    </div>
                </div>
                <div class="admin-card"
                    style="background-image: url('../../images/images/Admin-page/IMG_0115 (Copy) copy.jpg');">
                    <div class="card-content">
                        <h2>JUANDA ROOM ADMIN PANEL</h2>
                        <button class="tpj-link">Click here to go to Admin Panel</button>
                    </div>
                </div>
                <div class="admin-card" style="background-image: url('../../images/images/Admin-page/IMG_8672.jpg');">
                    <div class="card-content">
                        <h2>CIBUBUR ROOM ADMIN PANEL</h2>
                        <button class="tpc-link">Click here to go to Admin Panel</button>
                    </div>
                </div>
                <div class="admin-card"
                    style="background-image: url('../../images/images/Admin-page/IMG_0117\ \(Copy\).jpg');">
                    <div class="card-content">
                        <h2>LAGOON ROOM ADMIN PANEL</h2>
                        <button class="gkl-link">Click here to go to Admin Panel</button>
                    </div>
                </div>
                <div class="admin-card" style="background-image: url('../../images/images/Admin-page/IMG_1073.png');">
                    <div class="card-content">
                        <h2>URBANO ROOM ADMIN PANEL</h2>
                        <button class="plu-link">Click here to go to Admin Panel</button>
                    </div>
                </div>
                <div class="admin-card" style="background-image: url('../../images/images/Admin-page/IMG_3976.png');">
                    <div class="card-content">
                        <h2>GATEWAY CICADAS ROOM ADMIN PANEL</h2>
                        <button class="gtw-link">Click here to go to Admin Panel</button>
                    </div>
                </div>
                <div class="admin-card" style="background-image: url('../../images/images/Admin-page/IMG_0333.jpg');">
                    <div class="card-content">
                        <h2>PODOMORO ROOM ADMIN PANEL</h2>
                        <button class="pgv-link">Click here to go to Admin Panel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Promo -->
        <div class="promo-section" id="promoSection" style="display: none;">
            <div class="header-admin">
                <header>
                    <h1>ADMIN TAMBAHKAN DAN HAPUS PROMO</h1>
                </header>
            </div>

            <div class="promo-container" style="display: flex; gap: 20px; align-items: flex-start;">
                <!-- Form Section -->
                <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data"
                    class="promo-form">
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
                            @foreach (['TRANSPARK JUANDA', 'TRANSPARK CIBUBUR', 'GRAND KAMALA LAGOON', 'PATRALAND
                            URBANO',
                            'GATEWAY CICADAS', 'PODOMORO GOLF VIEW'] as $title)
                            <label class="radio-item">
                                <input type="radio" name="title" value="{{ $title }}" required>
                                <span
                                    class="radio-label">{{ ucwords(strtolower(str_replace('_', ' ', $title))) }}</span>
                            </label>
                            @endforeach
                        </div>
                        <button type="submit" class="tambah-btn">Tambah</button>
                    </div>
                </form>

                <!-- Promo Cards Grid -->
                <div class="promo-cards">
                    @if(isset($promos) && count($promos) > 0)
                    @foreach($promos as $promo)
                    <div class="promo-card">
                        <img src="{{ asset('storage/' . $promo->image) }}" alt="Promo">
                        <div class="promo-overlay">
                            <p>{{ $promo->title }}</p>
                            <form action="{{ route('admin.delete', ['tipe' => 'promo', 'id' => $promo->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="delete-btn" onclick="return confirm('Yakin ingin menghapus promo ini?')">
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


        <!-- Section Komentar -->
        <div class="komentar-section" id="komentarSection" style="display: none;">
            <div class="header-admin">
                <header>
                    <h1>ADMIN TAMBAHKAN DAN EDIT KOMENTAR TAMPILAN HOME</h1>
                </header>
            </div>

            <div class="komentar-container">
                <!-- Form Section -->
                <div class="komentar-form">
                    <h2>Buat Komentar Home</h2>

                    @if (session('success'))
                    <div>{{ session('success') }}</div>
                    @endif
                    <form id="komentarForm" action="{{ route('admin.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" id="formMethod" value="POST">
                        <input type="hidden" name="id" id="komentarId"> <!-- hanya terisi saat edit -->

                        <div class="form-group">
                            <label>Apartment:</label>
                            <input type="text" name="apartmen" id="apartmenInput" placeholder="nama apartment"
                                class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label>Instagram:</label>
                            <input type="text" name="instagram" id="instagramInput" placeholder="@instagram"
                                class="form-input">
                        </div>

                        <div class="form-group">
                            <label>Pesan:</label>
                            <textarea name="isi" id="isiInput" placeholder="Tulis pesan..." class="form-textarea"
                                required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Bintang:</label>
                            <select name="bintang" id="bintangInput" class="form-input" required>
                                <option value="1">⭐</option>
                                <option value="2">⭐⭐</option>
                                <option value="3">⭐⭐⭐</option>
                                <option value="4">⭐⭐⭐⭐</option>
                                <option value="5">⭐⭐⭐⭐⭐</option>
                            </select>
                        </div>

                        <button type="submit" id="submitBtn" class="tambah-btn">Tambah</button>
                    </form>
                </div>

                <!-- Komentar Cards -->
                <div class="komentar-cards">
                    <!-- Komentar Card 1 -->
                    @if(isset($komentars) && count($komentars) > 0)
                    @foreach($komentars as $komentar)
                    <div class="komentar-card">
                        <div class="komentar-header">
                            <h3>{{ strtoupper($komentar->apartmen) }}</h3>
                            <div class="action-buttons">
                                <!-- Tombol edit dengan data-* atribut -->
                                <button type="button" class="edit-btn" data-id="{{ $komentar->id }}"
                                    data-apartmen="{{ $komentar->apartmen }}"
                                    data-instagram="{{ $komentar->instagram }}" data-isi="{{ $komentar->isi }}"
                                    data-bintang="{{ $komentar->bintang }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form
                                    action="{{ route('admin.delete', ['tipe' => 'komentar', 'id' => $komentar->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="komentar-content">
                            <p>{{ $komentar->isi }}</p>
                        </div>
                        <div class="komentar-footer">
                            <span class="instagram-handle">{{ $komentar->instagram }}</span>
                            <div class="rating">
                                @for ($i = 1; $i <= $komentar->bintang; $i++)
                                    <i class="fas fa-star"></i>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="no-komentar">
                        <p>Tidak ada komentar tersedia</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Section TPJ Start-->
        <div class="tpj-section" id="tpjSection" style="display: none;">
            <div class="header-admin">
                <header>
                    <h1>TRANSPARK JUANDA ADMIN PANEL</h1>
                </header>
            </div>

            <!-- Current Slide Show Section -->
            <div class="slide-section">
                <div class="section-header">
                    <h2>Current Slide Show</h2>
                    <button class="change-btn" type="button">Change Now</button>
                </div>
                <div class="current-slide">
                    <div class="carousel-container">
                        <div class="carousel-slide">
                            <img src="{{ $carouselImagesBySection['TPJ'][1] ?? asset('img/default-slide.png') }}"
                                alt="Slide 1 TPJ">
                        </div>
                        <div class="carousel-slide">
                            <img src="{{ $carouselImagesBySection['TPJ'][2] ?? asset('img/default-slide.png') }}"
                                alt="Slide 2 TPJ">

                        </div>
                        <div class="carousel-slide">
                            <img src="{{ $carouselImagesBySection['TPJ'][3] ?? asset('img/default-slide.png') }}"
                                alt="Slide 3 TPJ">

                        </div>
                        <div class="carousel-slide">
                            <img src="{{ $carouselImagesBySection['TPJ'][4] ?? asset('img/default-slide.png') }}"
                                alt="Slide 4 TPJ">

                        </div>
                    </div>
                    <button class="carousel-button prev">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="carousel-button next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <div class="carousel-nav">
                        <div class="carousel-dot active"></div>
                        <div class="carousel-dot"></div>
                        <div class="carousel-dot"></div>
                        <div class="carousel-dot"></div>
                    </div>
                </div>
            </div>



            <!-- Room Section -->
            <div class="room-section">
                <div class="section-header">
                    <h2>Showing Apartemen Room</h2>
                    <button class="add-room-btn" onclick="showSection(document.getElementById('createRoomSection'))">
                        + ROOM</button>
                </div>
                <div class="room-cards">
                    @foreach ($roomsBySection['room_transpark_juanda'] as $room)
                    <!-- Room Card -->
                    <div class="room-card">
                        <div class="room-card-header">
                            <div class="left-text">NEOVALA <span class="room-type">ROOMS</span></div>
                            <img src="{{ asset('images/logo/room-title.png') }}" alt="Neovala Logo" class="room-logo">
                            <div class="right-text">TRANSPARK <span class="room-type">JUANDA</span></div>
                        </div>
                        <div class="room-card-image">
                            <img src="{{ $room['main_photo'] }}" alt="Room {{ $room['room_name'] }}">
                        </div>
                        <div class="room-action-buttons">
                            <button class="edit-room-btn" data-room='@json($room)'>
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="more-btn" data-popup-id="roomPopup{{ $room['room_name'] }}">MORE</button>
                            <button class="delete-room-btn" data-room-id="{{ $room['folder'] }}"
                                data-room-section="{{ $room['section'] }}" data-db-id="{{ $room['id'] }}">
                                <i class="fas fa-trash"></i>
                            </button>

                        </div>
                    </div>

                    <!-- Popup Room -->
                    <div class="room-popup-overlay" id="roomPopup{{ $room['room_name'] }}">
                        <div class="room-popup-container" id="carousel-{{ Str::slug($room['room_name']) }}">
                            <button class="room-popup-close">
                                <i class="fas fa-times"></i>
                            </button>
                            <div class="room-popup-carousel">
                                <div class="room-popup-carousel-container">
                                    @foreach ($room['popup_photos'] as $index => $popup)
                                    <div class="room-popup-slide {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ $popup }}"
                                            alt="Room {{ $room['room_name'] }} View {{ $index + 1 }}">
                                    </div>
                                    @endforeach

                                </div>
                                <button class="room-popup-nav next" data-room="{{ Str::slug($room['room_name']) }}">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                                <button class="room-popup-nav prev" data-room="{{ Str::slug($room['room_name']) }}">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>



            <!-- Comment Section -->
            <div class="comment-section">
                <div class="section-header">
                    <h2>All TPJ Comment</h2>
                </div>
                <div class="comment-cards">
                    <!-- Comment Card 1 -->
                    @foreach (\App\Models\KomentarTpj::where('section', 'tpj')->latest()->get() as $komen)

                    <div class="comment-card">
                        <div class="comment-header tpj-quote-wrapper">
                            <span class="tpj-quote-icon">"</span>
                        </div>
                        <div class="comment-content">
                            <p class="tpj-comment-text">{{ $komen->message }}</p>
                        </div>
                        <div class="comment-footer">
                            <div class="comment-info">
                                <span class="tpj-comment-user">
                                    {{ $komen->hide_identity ? '@***********' : '@' . $komen->instagram }}
                                </span>
                                <div class="tpj-star-rating">
                                    @for ($i = 1; $i <= 5; $i++) <i
                                        class="fas fa-star {{ $i > $komen->rating ? 'text-muted' : '' }}"></i>
                                        @endfor
                                </div>
                            </div>
                            <div class="comment-actions">
                                @if ($komen->status === 'pending')
                                <button type="button" class="apply-btn" data-id="{{ $komen->id }}"
                                    data-section="tpj">Apply</button>
                                @else
                                <button type="button" class="unapply-btn" data-id="{{ $komen->id }}"
                                    data-section="tpj">Unapply</button>
                                @endif

                                <button type="button" class="delete-btn" data-id="{{ $komen->id }}"
                                    data-section="tpj"><i class="fas fa-trash"></i></button>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- APPLY TPJ -->
            <div class="apply-comment-popup apply-popup-tpj" style="display: none;">
                <div class="popup-content apply-content">
                    <p>Anda yakin ingin menambahkan komentar ini?</p>
                    <form id="applyForm-tpj" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="popup-buttons">
                            <button type="button" class="popup-btn popup-cancel-comment">Tidak</button>
                            <button type="submit" class="popup-btn popup-apply-comment">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- UNAPPLY TPJ -->
            <div class="apply-comment-popup unapply-popup-tpj" style="display: none;">
                <div class="popup-content apply-content">
                    <p>Anda yakin ingin mengembalikan komentar ke status pending?</p>
                    <form id="unapplyForm-tpj" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="popup-buttons">
                            <button type="button" class="popup-btn popup-cancel-unapply-comment">Tidak</button>
                            <button type="submit" class="popup-btn popup-apply-comment">Unapply</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- DELETE TPJ -->
            <div class="delete-comment-popup delete-popup-tpj" style="display: none;">
                <div class="popup-content delete-comment-content">
                    <p>Anda yakin ingin menghapus komentar ini?</p>
                    <form id="deleteForm-tpj" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="popup-buttons">
                            <button type="button" class="popup-btn popup-cancel-delete-comment">Tidak</button>
                            <button type="submit" class="popup-btn popup-delete-comment">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Form Data Section -->
            <div class="form-data-section" data-apartment="Transpark Juanda by Neovala">
                <div class="section-header">
                    <h2>Form Data TPJ</h2>
                </div>
                <div class="form-data-container">
                    <div class="form-data-header">
                        <div class="header-cell">Nama</div>
                        <div class="header-cell">No HP</div>
                        <div class="header-cell">Lama Sewa</div>
                        <div class="header-cell">Ukuran Kamar</div>
                        <div class="header-cell">Actions</div>
                    </div>
                    <div class="form-data-body">
                        @if(isset($formData) && count($formData) > 0)
                        @foreach($formData as $data)
                        <div class="form-data-row" data-id="{{ $data->id }}">
                            <div class="data-cell">{{ $data->nama }}</div>
                            <div class="data-cell">{{ $data->nomor_wa }}</div>
                            <div class="data-cell">{{ $data->durasi }}</div>
                            <div class="data-cell">{{ $data->tipe_kamar }}</div>
                            <div class="data-cell actions">
                                <button class="detail-btn" onclick="showDetail('{{ $data->id }}')">Detail</button>
                                <button class="delete-btn-data trigger-delete-popup" data-id="{{ $data->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="form-data-row">
                            <div class="data-cell" colspan="5">Tidak ada data</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>


            <!-- <script>
            function loadFormData() {
                fetch('/get-form-data')
                    .then(response => response.json())
                    .then(data => {
                        const formDataBody = document.querySelector('.form-data-body');
                        formDataBody.innerHTML = '';

                        if (data.length > 0) {
                            data.forEach(item => {
                                formDataBody.innerHTML += `
                            <div class="form-data-row">
                                <div class="data-cell">${item.nama}</div>
                                <div class="data-cell">${item.nomor_wa}</div>
                                <div class="data-cell">${item.durasi}</div>
                                <div class="data-cell">${item.tipe_kamar}</div>
                                <div class="data-cell actions">
                                    <button class="detail-btn" onclick="showDetail(${item.id})">Detail</button>
                                    <button class="delete-btn-data trigger-delete-popup" data-id="${item.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                            });
                        } else {
                            formDataBody.innerHTML = `
                        <div class="form-data-row">
                            <div class="data-cell" colspan="5">Tidak ada data</div>
                        </div>
                    `;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            // Reload data setiap 5 detik
            setInterval(loadFormData, 5000);

            // Load data saat halaman dimuat
            document.addEventListener('DOMContentLoaded', loadFormData);
            </script> -->
        </div>


        <!-- Detail Data Section -->
        <div class="detail-data-section" id="detailDataSection" style="display: none;">
            <div class="detail-container">
                <div class="detail-header">
                    <h2>Detail Data Penyewa</h2>
                    <!-- <button class="back-btn" onclick="hideDetail()">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button> -->
                </div>

                <div class="detail-content">
                    <table class="detail-table">
                        <tr>
                            <td class="detail-label">Nama</td>
                            <td class="detail-divider">:</td>
                            <td class="detail-value" id="detailNama"></td>
                        </tr>
                        <tr>
                            <td class="detail-label">No Telp</td>
                            <td class="detail-divider">:</td>
                            <td class="detail-value" id="detailNoTelp"></td>
                        </tr>
                        <tr>
                            <td class="detail-label">Lama Sewa</td>
                            <td class="detail-divider">:</td>
                            <td class="detail-value" id="detailLamaSewa"></td>
                        </tr>
                        <tr>
                            <td class="detail-label">Ukuran Kamar</td>
                            <td class="detail-divider">:</td>
                            <td class="detail-value" id="detailUkuranKamar"></td>
                        </tr>
                        <tr>
                            <td class="detail-label">Tanggal Masuk</td>
                            <td class="detail-divider">:</td>
                            <td class="detail-value" id="detailTanggalMasuk"></td>
                        </tr>
                        <tr>
                            <td class="detail-label">Jam Kedatangan</td>
                            <td class="detail-divider">:</td>
                            <td class="detail-value" id="detailJamKedatangan"></td>
                        </tr>
                        <tr>
                            <td class="detail-label">Catatan Tambahan</td>
                            <td class="detail-divider">:</td>
                            <td class="detail-value" id="detailCatatan"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>


        <!-- <script>
        function showDetail(id) {
            fetch(`/form-data/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('detailNama').textContent = data.nama;
                    document.getElementById('detailNoTelp').textContent = data.nomor_wa;
                    document.getElementById('detailLamaSewa').textContent = data.durasi;
                    document.getElementById('detailUkuranKamar').textContent = data.tipe_kamar;
                    document.getElementById('detailTanggalMasuk').textContent = data.tanggal_checkin;
                    document.getElementById('detailJamKedatangan').textContent = data.jam_kedatangan;
                    document.getElementById('detailCatatan').textContent = data.pesan || '-';

                    document.getElementById('detailDataSection').style.display = 'flex';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat detail data');
                });
        }

        function hideDetail() {
            document.getElementById('detailDataSection').style.display = 'none';
        }

        // Close detail when clicking outside
        document.getElementById('detailDataSection').addEventListener('click', function(e) {
            if (e.target === this) {
                hideDetail();
            }
        });
        </script> -->

        <!-- Change Slide Section -->
        <div class="change-slide-section" id="changeSlideSection" style="display: none;">
            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="carousel_section" value="TPJ">

                <div class="header-admin">
                    <header>
                        <h1>Change Slide Transpark Juanda</h1>
                    </header>
                    <div class="button-container">
                        <button type="button" class="back-btn">Back</button>
                        <button type="submit" class="update-btn">Update</button>
                    </div>
                </div>

                <div class="slide-grid">
                    <div class="slide-item" data-index="0">
                        <div class="slide-image">
                            <img src="{{ $carouselImagesBySection['TPJ'][1] ?? asset('img/default-slide.png') }}"
                                alt="Slide 1 TPJ">

                            <div class="slide-overlay">
                                <input type="file" class="file-input" name="images[1]" accept="image/*" hidden>
                                <button type="button" class="select-btn">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="slide-item" data-index="1">
                        <div class="slide-image">
                            <img src="{{ $carouselImagesBySection['TPJ'][2] ?? asset('img/default-slide.png') }}"
                                alt="Slide 2 TPJ">
                            <div class="slide-overlay">
                                <input type="file" class="file-input" name="images[2]" accept="image/*" hidden>
                                <button type="button" class="select-btn">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="slide-item" data-index="2">
                        <div class="slide-image">
                            <img src="{{ $carouselImagesBySection['TPJ'][3] ?? asset('img/default-slide.png') }}"
                                alt="Slide 3 TPJ">
                            <div class="slide-overlay">
                                <input type="file" class="file-input" name="images[3]" accept="image/*" hidden>
                                <button type="button" class="select-btn">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="slide-item" data-index="3">
                        <div class="slide-image">
                            <img src="{{ $carouselImagesBySection['TPJ'][4] ?? asset('img/default-slide.png') }}"
                                alt="Slide 4 TPJ">
                            <div class="slide-overlay">
                                <input type="file" class="file-input" name="images[4]" accept="image/*" hidden>
                                <button type="button" class="select-btn">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Edit Room Section -->
        <div class="edit-room-section" id="editRoomSection" style="display: none;">
            <div class="header-admin">
                <header>
                    <h1>Edit Room Transpark Juanda</h1>
                </header>
            </div>

            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="room_section" value="{{ $selectedRoom['section'] ?? '' }}">
                <input type="hidden" name="room_id" value="{{ $selectedRoom['id'] ?? '' }}">

                <div class="room-form-container">

                    <!-- Main Room Image -->
                    <div class="room-main-image">
                        <div class="image-upload-large">
                            @if (!empty($selectedRoom['main_photo']))
                            <img id="mainEditImage" src="{{ $selectedRoom['main_photo'] }}" alt="Main Room Photo">
                            @else
                            <i class="fas fa-image"></i>
                            <p>Insert Room Main Photo</p>
                            <img id="mainEditImage" src="" alt="Main Room Photo" style="display: none;">
                            @endif
                            <input type="file" name="main_photo" class="room-photo-input" accept="image/*" hidden>
                        </div>
                    </div>

                    <!-- Additional Room Photos -->
                    <div class="room-additional-images">
                        @for ($i = 0; $i < 4; $i++) <div class="image-upload-small">
                            @php
                            $popupKey = 'popup' . ($i + 1);
                            @endphp

                            @if (!empty($selectedRoom[$popupKey]))
                            <img class="popupEditImage" src="{{ $selectedRoom[$popupKey] }}"
                                alt="Room Additional {{ $i + 1 }}">
                            @else
                            <i class="fas fa-image"></i>
                            <p>Insert Room Photo</p>
                            <img class="popupEditImage" src="" alt="Room Additional {{ $i + 1 }}"
                                style="display: none;">
                            @endif

                            <input type="file" name="popup{{ $i + 1 }}" class="room-photo-input" accept="image/*"
                                hidden>
                    </div>
                    @endfor

                </div>

                <!-- Action Buttons -->
                <div class="back-button-container">
                    <button type="button" class="edit-back-btn">Back</button>
                    <button type="submit" class="edit-save-btn">Edit</button>
                </div>
        </div>
        </form>
    </div>



    <!-- Create New Room Section -->
    <div class="create-room-section" id="createRoomSection" style="display: none;">
        <div class="header-admin">
            <header>
                <h1>Buat Room Transpark Juanda</h1>
            </header>
        </div>

        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="room_section" value="room_transpark_juanda">

            <div class="room-form-container">
                <!-- Main Image -->
                <div class="room-main-image">
                    <div class="image-upload-large">
                        <i class="fas fa-image"></i>
                        <p>Insert room main photo</p>
                        <input type="file" name="main_photo" class="room-photo-input" accept="image/*" hidden required>
                    </div>
                </div>

                <!-- Additional Images -->
                <div class="room-additional-images">
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>Insert room photo</p>
                        <input type="file" name="popup1" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>Insert room photo</p>
                        <input type="file" name="popup2" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>Insert room photo</p>
                        <input type="file" name="popup3" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>Insert room photo</p>
                        <input type="file" name="popup4" class="room-photo-input" accept="image/*" hidden>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="back-button-container">
                    <button type="button" class="create-back-btn">Back</button>
                    <button type="submit" class="create-save-btn">Buat</button>
                </div>
            </div>
        </form>
    </div>

    <!--TPJ End-->


    <!-- Section TPC Start-->
    <div class="tpc-section" id="tpcSection" style="display: none;">
        <div class="header-admin">
            <header>
                <h1>TRANSPARK CIBUBUR ADMIN PANEL</h1>
            </header>
        </div>

        <!-- Current Slide Show Section -->
        <div class="tpc-slide-section">
            <div class="section-header">
                <h2>Current Slide Show</h2>
                <button class="tpc-change-btn" type="button">Change Now</button>
            </div>
            <div class="tpc-current-slide">
                <div class="tpc-carousel-container">
                    <div class="tpc-carousel-slide">
                        <img src="{{ $carouselImagesBySection['TPC'][1] ?? asset('img/default-slide.png') }}"
                            alt="Slide 1 TPC">
                    </div>
                    <div class="tpc-carousel-slide">
                        <img src="{{ $carouselImagesBySection['TPC'][2] ?? asset('img/default-slide.png') }}"
                            alt="Slide 2 TPC">
                    </div>
                    <div class="tpc-carousel-slide">
                        <img src="{{ $carouselImagesBySection['TPC'][3] ?? asset('img/default-slide.png') }}"
                            alt="Slide 3 TPC">
                    </div>
                    <div class="tpc-carousel-slide">
                        <img src="{{ $carouselImagesBySection['TPC'][4] ?? asset('img/default-slide.png') }}"
                            alt="Slide 4 TPC">
                    </div>
                </div>
                <button class="tpc-carousel-button prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="tpc-carousel-button next">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <div class="tpc-carousel-nav">
                    <div class="tpc-carousel-dot active"></div>
                    <div class="tpc-carousel-dot"></div>
                    <div class="tpc-carousel-dot"></div>
                    <div class="tpc-carousel-dot"></div>
                </div>
            </div>
        </div>

        <!-- Room Section - Transpark Cibubur -->
        <div class="room-section">
            <div class="section-header">
                <h2>Showing Apartemen Room - Transpark Cibubur</h2>
                <button class="tpc-add-room-btn" onclick="showSection(document.getElementById('tpcCreateRoomSection'))">
                    + ROOM
                </button>
            </div>

            <div class="room-cards">
                @if(isset($roomsBySection['room_transpark_cibubur']) && count($roomsBySection['room_transpark_cibubur'])
                > 0)
                @foreach($roomsBySection['room_transpark_cibubur'] as $room)
                <!-- Room Card -->
                <div class="room-card">
                    <div class="room-card-header">
                        <div class="left-text">NEOVALA <span class="room-type">ROOMS</span></div>
                        <img src="{{ asset('images/logo/room-title.png') }}" alt="Neovala Logo" class="room-logo">
                        <div class="right-text">TRANSPARK <span class="room-type">CIBUBUR</span></div>
                    </div>
                    <div class="room-card-image">
                        <img src="{{ $room['main_photo'] }}" alt="Room {{ $room['room_name'] }}">
                    </div>
                    <div class="room-action-buttons">
                        <button class="tpc-edit-room-btn" data-room='@json($room)'>
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="more-btn" data-popup-id="roomPopup{{ $room['room_name'] }}">MORE</button>
                        <button class="delete-room-btn" data-room-id="{{ $room['folder'] }}"
                            data-room-section="{{ $room['section'] }}" data-db-id="{{ $room['id'] }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <!-- Room Popup -->
                <div class="room-popup-overlay" id="roomPopup{{ $room['room_name'] }}">
                    <div class="room-popup-container" id="carousel-{{ $room['safe_id'] }}">
                        <button class="room-popup-close">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="room-popup-carousel">
                            <div class="room-popup-carousel-container">
                                @foreach ($room['popup_photos'] as $index => $popup)
                                <div class="room-popup-slide {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ $popup }}" alt="Room {{ $room['room_name'] }} View {{ $index + 1 }}">
                                </div>
                                @endforeach
                            </div>
                            <button class="room-popup-nav prev" data-room="{{ $room['safe_id'] }}">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="room-popup-nav next" data-room="{{ $room['safe_id'] }}">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="no-rooms">
                    <p>Tidak ada data kamar tersedia untuk Transpark Cibubur</p>
                </div>
                @endif
            </div>
        </div>



        <!-- Comment Section -->
        <div class="comment-section">
            <div class="section-header">
                <h2>All TPC Comment</h2>
            </div>
            <div class="comment-cards">
                @foreach (\App\Models\KomentarTpc::where('section', 'tpc')->latest()->get() as $komen)
                <div class="comment-card">
                    <div class="comment-header tpj-quote-wrapper">
                        <span class="tpj-quote-icon">"</span>
                    </div>
                    <div class="comment-content">
                        <p class="tpj-comment-text">{{ $komen->message }}</p>
                    </div>
                    <div class="comment-footer">
                        <div class="comment-info">
                            <span class="tpj-comment-user">
                                {{ $komen->hide_identity ? '@***********' : '@' . $komen->instagram }}
                            </span>
                            <div class="tpj-star-rating">
                                @for ($i = 1; $i <= 5; $i++) <i
                                    class="fas fa-star {{ $i > $komen->rating ? 'text-muted' : '' }}"></i>
                                    @endfor
                            </div>
                        </div>
                        <div class="comment-actions">
                            @if ($komen->status === 'pending')
                            <button type="button" class="apply-btn" data-id="{{ $komen->id }}"
                                data-section="tpc">Apply</button>
                            @else
                            <button type="button" class="unapply-btn" data-id="{{ $komen->id }}"
                                data-section="tpc">Unapply</button>
                            @endif
                            <button type="button" class="delete-btn" data-id="{{ $komen->id }}" data-section="tpc">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


        <!-- APPLY tpc -->
        <div class="apply-comment-popup apply-popup-tpc" style="display: none;">
            <div class="popup-content apply-content">
                <p>Anda yakin ingin menambahkan komentar ini?</p>
                <form id="applyForm-tpc" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="popup-buttons">
                        <button type="button" class="popup-btn popup-cancel-comment">Tidak</button>
                        <button type="submit" class="popup-btn popup-apply-comment">Tambah</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- UNAPPLY tpc -->
        <div class="apply-comment-popup unapply-popup-tpc" style="display: none;">
            <div class="popup-content apply-content">
                <p>Anda yakin ingin mengembalikan komentar ke status pending?</p>
                <form id="unapplyForm-tpc" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="popup-buttons">
                        <button type="button" class="popup-btn popup-cancel-unapply-comment">Tidak</button>
                        <button type="submit" class="popup-btn popup-apply-comment">Unapply</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- DELETE tpc -->
        <div class="delete-comment-popup delete-popup-tpc" style="display: none;">
            <div class="popup-content delete-comment-content">
                <p>Anda yakin ingin menghapus komentar ini?</p>
                <form id="deleteForm-tpc" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="popup-buttons">
                        <button type="button" class="popup-btn popup-cancel-delete-comment">Tidak</button>
                        <button type="submit" class="popup-btn popup-delete-comment">Hapus</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Form Data Section -->
        <div class="form-data-section" data-apartment="Transpark Cibubur by Neovala">
            <div class="section-header">
                <h2>Form Data TPC</h2>
            </div>
            <div class="form-data-container">
                <div class="form-data-header">
                    <div class="header-cell">Nama</div>
                    <div class="header-cell">No HP</div>
                    <div class="header-cell">Lama Sewa</div>
                    <div class="header-cell">Ukuran Kamar</div>
                    <div class="header-cell">Actions</div>
                </div>
                <div class="form-data-body">
                    @if(isset($formData) && count($formData) > 0)
                    @foreach($formData as $data)
                    <div class="form-data-row" data-id="{{ $data->id }}">
                        <div class="data-cell">{{ $data->nama }}</div>
                        <div class="data-cell">{{ $data->nomor_wa }}</div>
                        <div class="data-cell">{{ $data->durasi }}</div>
                        <div class="data-cell">{{ $data->tipe_kamar }}</div>
                        <div class="data-cell actions">
                            <button class="detail-btn" onclick="showDetail('{{ (int) $data->id }}')">Detail</button>
                            <button class="delete-btn-data trigger-delete-popup" data-id="{{ $data->id }}">
                                <i class="fas fa-trash"></i>
                            </button>

                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="form-data-row">
                        <div class="data-cell" colspan="5">Tidak ada data</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!--@if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif-->

    <!-- Change Slide Section -->
    <div class="tpc-change-slide-section" id="tpcChangeSlideSection" style="display: none;">
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="carousel_section" value="TPC">

            <div class="header-admin">
                <header>
                    <h1>Change Slide Transpark Cibubur</h1>
                </header>
                <div class="button-container">
                    <button type="button" class="tpc-back-btn-slide">Back</button>
                    <button type="submit" class="tpc-update-btn-slide" style="display: none;">Update</button>
                </div>
            </div>

            <div class="slide-grid">
                <div class="slide-item" data-index="0">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['TPC'][1] ?? asset('img/default-slide.png') }}"
                            alt="Slide 1 TPC">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[1]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="slide-item" data-index="1">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['TPC'][2] ?? asset('img/default-slide.png') }}"
                            alt="Slide 2 TPC">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[2]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="slide-item" data-index="2">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['TPC'][3] ?? asset('img/default-slide.png') }}"
                            alt="Slide 3 TPC">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[3]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="slide-item" data-index="3">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['TPC'][4] ?? asset('img/default-slide.png') }}"
                            alt="Slide 4 TPC">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[4]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Edit Room Section Transpark Cibubur -->
    <div class="tpc-edit-room-section" id="tpcEditRoomSection" style="display: none;">
        <div class="header-admin">
            <header>
                <h1>Edit Room Transpark Cibubur</h1>
            </header>
        </div>

        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="room_section" value="{{ $selectedRoom['section'] ?? '' }}">
            <input type="hidden" name="room_id" value="{{ $selectedRoom['id'] ?? '' }}">

            <div class="room-form-container">
                <!-- Main Room Image -->
                <div class="room-main-image">
                    <div class="image-upload-large">
                        @if (!empty($selectedRoom['main_photo']))
                        <img id="mainEditImage" src="{{ $selectedRoom['main_photo'] }}" alt="Main Room Photo">
                        @else
                        <i class="fas fa-image"></i>
                        <p>Insert Room Main Photo</p>
                        <img id="mainEditImage" src="" alt="Main Room Photo" style="display: none;">
                        @endif
                        <input type="file" name="main_photo" class="room-photo-input" accept="image/*" hidden>
                    </div>
                </div>

                <!-- Additional Room Photos -->
                <div class="room-additional-images">
                    @for ($i = 0; $i < 4; $i++) <div class="image-upload-small">
                        @php
                        $popupKey = 'popup' . ($i + 1);
                        @endphp

                        @if (!empty($selectedRoom[$popupKey]))
                        <img class="popupEditImage" src="{{ $selectedRoom[$popupKey] }}"
                            alt="Room Additional {{ $i + 1 }}">
                        @else
                        <i class="fas fa-image"></i>
                        <p>Insert Room Photo</p>
                        <img class="popupEditImage" src="" alt="Room Additional {{ $i + 1 }}" style="display: none;">
                        @endif

                        <input type="file" name="popup{{ $i + 1 }}" class="room-photo-input" accept="image/*" hidden>
                </div>
                @endfor

            </div>

            <!-- Action Buttons -->
            <div class="back-button-container">
                <button type="button" class="tpc-edit-back-btn">Back</button>
                <button type="submit" class="edit-save-btn">Edit</button>
            </div>
    </div>
    </form>
    </div>


    <!-- Create New Room Section -->
    <div class="tpc-create-room-section" id="tpcCreateRoomSection" style="display: none;">
        <div class="header-admin">
            <header>
                <h1>Buat Room Transpark Cibubur</h1>
            </header>
        </div>


        <!-- Create New Room Section -->
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="room_section" value="room_transpark_cibubur">

            <div class="room-form-container">
                <!-- Main Image -->
                <div class="room-main-image">
                    <div class="image-upload-large">
                        <i class="fas fa-image"></i>
                        <p>insert room main photo</p>
                        <input type="file" name="main_photo" class="room-photo-input" accept="image/*" hidden>
                    </div>
                </div>

                <!-- Additional Images -->
                <div class="room-additional-images">
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup1" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup2" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup3" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup4" class="room-photo-input" accept="image/*" hidden>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="back-button-container">
                    <button type="button" class="tpc-create-back-btn">Back</button>
                    <button type="submit" class="tpc-create-save-btn">Buat</button>
                </div>
            </div>
        </form>

    </div>

    <!-- Detail Data Section -->
    <div class="detail-data-section" id="detailDataSection" style="display: none;">
        <div class="detail-container">
            <div class="detail-header">
                <h2>Detail Data Penyewa</h2>
                <!-- <button class="back-btn" onclick="hideDetail()">
                    <i class="fas fa-arrow-left"></i> Kembali
                </button> -->
            </div>

            <div class="detail-content">
                <table class="detail-table">
                    <tr>
                        <td class="detail-label">Nama</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailNama"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">No Telp</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailNoTelp"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Lama Sewa</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailLamaSewa"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Ukuran Kamar</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailUkuranKamar"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Tanggal Masuk</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailTanggalMasuk"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Jam Kedatangan</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailJamKedatangan"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Catatan Tambahan</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailCatatan"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <!--TPC End-->


    <!-- Section LAGOON Start-->
    <div class="gkl-section" id="gklSection" style="display: none;">
        <div class="header-admin">
            <header>
                <h1>GRAND KAMALA LAGOON ADMIN PANEL</h1>
            </header>
        </div>

        <!-- Current Slide Show Section -->
        <div class="gkl-slide-section">
            <div class="section-header">
                <h2>Current Slide Show</h2>
                <button class="gkl-change-btn" type="button">Change Now</button>
            </div>
            <div class="gkl-current-slide">
                <div class="gkl-carousel-container">
                    <div class="gkl-carousel-slide">
                        <img src="{{ $carouselImagesBySection['GKL'][1] ?? asset('img/default-slide.png') }}"
                            alt="Slide 1 GKL">
                    </div>
                    <div class="gkl-carousel-slide">
                        <img src="{{ $carouselImagesBySection['GKL'][2] ?? asset('img/default-slide.png') }}"
                            alt="Slide 2 GKL">
                    </div>
                    <div class="gkl-carousel-slide">
                        <img src="{{ $carouselImagesBySection['GKL'][3] ?? asset('img/default-slide.png') }}"
                            alt="Slide 3 GKL">
                    </div>
                    <div class="gkl-carousel-slide">
                        <img src="{{ $carouselImagesBySection['GKL'][4] ?? asset('img/default-slide.png') }}"
                            alt="Slide 4 GKL">
                    </div>
                </div>
                <button class="gkl-carousel-button prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="gkl-carousel-button next">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <div class="gkl-carousel-nav">
                    <div class="gkl-carousel-dot active"></div>
                    <div class="gkl-carousel-dot"></div>
                    <div class="gkl-carousel-dot"></div>
                    <div class="gkl-carousel-dot"></div>
                </div>
            </div>
        </div>

        <!-- Room Section -->
        <div class="room-section">
            <div class="section-header">
                <h2>Showing Apartemen Room</h2>
                <button class="gkl-add-room-btn"
                    onclick="showSection(document.getElementById('gklCreateRoomSection'))">+ ROOM</button>
            </div>
            <div class="room-cards">
                @if(isset($roomsBySection['room_grand_kamala_lagoon']) &&
                count($roomsBySection['room_grand_kamala_lagoon'])
                > 0)
                @foreach($roomsBySection['room_grand_kamala_lagoon'] as $room)
                <!-- Room Card 1 -->
                <div class="room-card">
                    <div class="room-card-header">
                        <div class="left-text">NEOVALA <span class="room-type">ROOMS</span></div>
                        <img src="{{ asset('images/logo/room-title.png') }}" alt="Neovala Logo" class="room-logo">
                        <div class="right-text">GRAND KAMALA <span class="room-type">LAGOON</span></div>
                    </div>
                    <div class="room-card-image">
                        <img src="{{ $room['main_photo'] }}" alt="Room {{ $room['room_name'] }}">
                    </div>
                    <div class="room-action-buttons">
                        <button class="gkl-edit-room-btn" data-room='@json($room)'>
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="more-btn" data-popup-id="roomPopup{{ $room['room_name'] }}">MORE</button>
                        <button class="delete-room-btn" data-room-id="{{ $room['folder'] }}"
                            data-room-section="{{ $room['section'] }}" data-db-id="{{ $room['id'] }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <!-- Room Popup -->
                <div class="room-popup-overlay" id="roomPopup{{ $room['room_name'] }}">
                    <div class="room-popup-container" id="carousel-{{ $room['safe_id'] }}">
                        <button class="room-popup-close">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="room-popup-carousel">
                            <div class="room-popup-carousel-container">
                                @foreach ($room['popup_photos'] as $index => $popup)
                                <div class="room-popup-slide {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ $popup }}" alt="Room {{ $room['room_name'] }} View {{ $index + 1 }}">
                                </div>
                                @endforeach
                            </div>
                            <button class="room-popup-nav prev" data-room="{{ $room['safe_id'] }}">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="room-popup-nav next" data-room="{{ $room['safe_id'] }}">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="no-rooms">
                    <p>Tidak ada data kamar tersedia untuk Grand Kamala Lagoon</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Comment Section -->
        <div class="comment-section">
            <div class="section-header">
                <h2>All GKL Comment</h2>
            </div>
            <div class="comment-cards">
                @foreach (\App\Models\KomentarGkl::where('section', 'gkl')->latest()->get() as $komen)
                <div class="comment-card">
                    <div class="comment-header tpj-quote-wrapper">
                        <span class="tpj-quote-icon">"</span>
                    </div>
                    <div class="comment-content">
                        <p class="tpj-comment-text">{{ $komen->message }}</p>
                    </div>
                    <div class="comment-footer">
                        <div class="comment-info">
                            <span class="tpj-comment-user">
                                {{ $komen->hide_identity ? '@***********' : '@' . $komen->instagram }}
                            </span>
                            <div class="tpj-star-rating">
                                @for ($i = 1; $i <= 5; $i++) <i
                                    class="fas fa-star {{ $i > $komen->rating ? 'text-muted' : '' }}"></i>
                                    @endfor
                            </div>
                        </div>
                        <div class="comment-actions">
                            @if ($komen->status === 'pending')
                            <button type="button" class="apply-btn" data-id="{{ $komen->id }}"
                                data-section="gkl">Apply</button>
                            @else
                            <button type="button" class="unapply-btn" data-id="{{ $komen->id }}"
                                data-section="gkl">Unapply</button>
                            @endif
                            <button type="button" class="delete-btn" data-id="{{ $komen->id }}" data-section="gkl">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- APPLY gkl -->
        <div class="apply-comment-popup apply-popup-gkl" style="display: none;">
            <div class="popup-content apply-content">
                <p>Anda yakin ingin menambahkan komentar ini?</p>
                <form id="applyForm-gkl" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="popup-buttons">
                        <button type="button" class="popup-btn popup-cancel-comment">Tidak</button>
                        <button type="submit" class="popup-btn popup-apply-comment">Tambah</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- UNAPPLY gkl -->
        <div class="apply-comment-popup unapply-popup-gkl" style="display: none;">
            <div class="popup-content apply-content">
                <p>Anda yakin ingin mengembalikan komentar ke status pending?</p>
                <form id="unapplyForm-gkl" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="popup-buttons">
                        <button type="button" class="popup-btn popup-cancel-unapply-comment">Tidak</button>
                        <button type="submit" class="popup-btn popup-apply-comment">Unapply</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- DELETE gkl -->
        <div class="delete-comment-popup delete-popup-gkl" style="display: none;">
            <div class="popup-content delete-comment-content">
                <p>Anda yakin ingin menghapus komentar ini?</p>
                <form id="deleteForm-gkl" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="popup-buttons">
                        <button type="button" class="popup-btn popup-cancel-delete-comment">Tidak</button>
                        <button type="submit" class="popup-btn popup-delete-comment">Hapus</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Form Data Section -->
        <div class="form-data-section" data-apartment="Grand Kamala Lagoon by Neovala">
            <div class="section-header">
                <h2>Form Data GKL</h2>
            </div>
            <div class="form-data-container">
                <div class="form-data-header">
                    <div class="header-cell">Nama</div>
                    <div class="header-cell">No HP</div>
                    <div class="header-cell">Lama Sewa</div>
                    <div class="header-cell">Ukuran Kamar</div>
                    <div class="header-cell">Actions</div>
                </div>
                <div class="form-data-body">
                    @if(isset($formData) && count($formData) > 0)
                    @foreach($formData as $data)
                    <div class="form-data-row" data-id="{{ $data->id }}">
                        <div class="data-cell">{{ $data->nama }}</div>
                        <div class="data-cell">{{ $data->nomor_wa }}</div>
                        <div class="data-cell">{{ $data->durasi }}</div>
                        <div class="data-cell">{{ $data->tipe_kamar }}</div>
                        <div class="data-cell actions">
                            <button class="detail-btn" onclick="showDetail('{{ (int) $data->id }}')">Detail</button>
                            <button class="delete-btn-data trigger-delete-popup" data-id="{{ $data->id }}">
                                <i class="fas fa-trash"></i>
                            </button>

                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="form-data-row">
                        <div class="data-cell" colspan="5">Tidak ada data</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Change Slide Section -->
    <div class="gkl-change-slide-section" id="gklChangeSlideSection" style="display: none;">
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="carousel_section" value="GKL">

            <div class="header-admin">
                <header>
                    <h1>Change Slide Grand Kamala Lagoon</h1>
                </header>
                <div class="button-container">
                    <button type="button" class="gkl-back-btn-slide">Back</button>
                    <button type="submit" class="gkl-update-btn-slide" style="display: none;">Update</button>
                </div>
            </div>

            <div class="slide-grid">
                <div class="slide-item" data-index="0">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['GKL'][1] ?? asset('img/default-slide.png') }}"
                            alt="Slide 1 GKL">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[1]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="slide-item" data-index="1">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['GKL'][2] ?? asset('img/default-slide.png') }}"
                            alt="Slide 2 GKL">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[2]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="slide-item" data-index="2">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['GKL'][3] ?? asset('img/default-slide.png') }}"
                            alt="Slide 3 GKL">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[3]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="slide-item" data-index="3">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['GKL'][4] ?? asset('img/default-slide.png') }}"
                            alt="Slide 4 GKL">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[4]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Edit Room Section -->
    <div class="gkl-edit-room-section" id="gklEditRoomSection" style="display: none;">
        <div class="header-admin">
            <header>
                <h1>Edit Room Grand Kamala Lagoon</h1>
            </header>
        </div>
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="room_section" value="{{ $selectedRoom['section'] ?? '' }}">
            <input type="hidden" name="room_id" value="{{ $selectedRoom['id'] ?? '' }}">

            <div class="room-form-container">
                <div class="room-main-image">
                    <div class="image-upload-large">
                        @if (!empty($selectedRoom['main_photo']))
                        <img id="mainEditImage" src="{{ $selectedRoom['main_photo'] }}" alt="Main Room Photo">
                        @else
                        <i class="fas fa-image"></i>
                        <p>Insert Room Main Photo</p>
                        <img id="mainEditImage" src="" alt="Main Room Photo" style="display: none;">
                        @endif
                        <input type="file" name="main_photo" class="room-photo-input" accept="image/*" hidden>
                    </div>
                </div>

                <!-- Additional Room Photos -->
                <div class="room-additional-images">
                    @for ($i = 0; $i < 4; $i++) <div class="image-upload-small">
                        @php
                        $popupKey = 'popup' . ($i + 1);
                        @endphp

                        @if (!empty($selectedRoom[$popupKey]))
                        <img class="popupEditImage" src="{{ $selectedRoom[$popupKey] }}"
                            alt="Room Additional {{ $i + 1 }}">
                        @else
                        <i class="fas fa-image"></i>
                        <p>Insert Room Photo</p>
                        <img class="popupEditImage" src="" alt="Room Additional {{ $i + 1 }}" style="display: none;">
                        @endif

                        <input type="file" name="popup{{ $i + 1 }}" class="room-photo-input" accept="image/*" hidden>
                </div>
                @endfor

            </div>

            <div class="back-button-container">
                <button type="button" class="gkl-edit-back-btn">Back</button>
                <button type="submit" class="edit-save-btn">Edit</button>
            </div>
    </div>
    </form>
    </div>

    <!-- Create New Room Section -->
    <div class="gkl-create-room-section" id="gklCreateRoomSection" style="display: none;">
        <div class="header-admin">
            <header>
                <h1>Buat Room Grand Kamala Lagoon</h1>
            </header>
        </div>

        <!-- Create New Room Section -->
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="room_section" value="room_grand_kamala_lagoon">

            <div class="room-form-container">
                <!-- Main Image -->
                <div class="room-main-image">
                    <div class="image-upload-large">
                        <i class="fas fa-image"></i>
                        <p>insert room main photo</p>
                        <input type="file" name="main_photo" class="room-photo-input" accept="image/*" hidden>
                    </div>
                </div>

                <!-- Additional Images -->
                <div class="room-additional-images">
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup1" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup2" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup3" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup4" class="room-photo-input" accept="image/*" hidden>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="back-button-container">
                    <button type="button" class="gkl-create-back-btn">Back</button>
                    <button type="submit" class="gkl-create-save-btn">Buat</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Detail Data Section -->
    <div class="gkl-detail-data-section" id="gklDetailDataSection" style="display: none;">
        <div class="header-admin">
            <header>
                <h1>Detail Data Penyewa</h1>
            </header>
        </div>

        <div class="gkl-detail-container">
            <button class="gkl-back-btn" onclick="showSection(document.getElementById('gklSection'))">Back</button>

            <div class="detail-content">
                <table class="detail-table">
                    <tr>
                        <td class="detail-label">Nama</td>
                        <td class="detail-value" id="detailNama">Ahmad Ilyas Dessar Rukmana</td>
                    </tr>
                    <tr>
                        <td class="detail-label">No Telp</td>
                        <td class="detail-value" id="detailNoTelp">0812 3456 7890</td>
                    </tr>
                    <tr>
                        <td class="detail-label">Lama Sewa</td>
                        <td class="detail-value" id="detailLamaSewa">Option 1</td>
                    </tr>
                    <tr>
                        <td class="detail-label">Ukuran Kamar</td>
                        <td class="detail-value" id="detailUkuranKamar">Option 1</td>
                    </tr>
                    <tr>
                        <td class="detail-label">Tanggal Masuk</td>
                        <td class="detail-value" id="detailTanggalMasuk">31 Februari 2012</td>
                    </tr>
                    <tr>
                        <td class="detail-label">Jam Kedatangan</td>
                        <td class="detail-value" id="detailJamKedatangan">16:30</td>
                    </tr>
                    <tr>
                        <td class="detail-label">Catatan Tambah</td>
                        <td class="detail-value" id="detailCatatan">
                            Neovala is lorem ipsum dolor sit amet, concensitcious liear coloniameni
                            Vivamus sed sollicitudin urna. Aenean volutpat eleifend arcu, sit amet
                            suscipit mi euismod sed. Integer vitae sapien quam. Sed congue at dui
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <!--LAGOON End-->

    <!-- Section URBANO Start-->
    <div class="plu-section" id="pluSection" style="display: none;">
        <div class="header-admin">
            <header>
                <h1>PATRALAND URBANO ADMIN PANEL</h1>
            </header>
        </div>

        <!-- Current Slide Show Section -->
        <div class="plu-slide-section">
            <div class="section-header">
                <h2>Current Slide Show</h2>
                <button class="plu-change-btn" type="button">Change Now</button>
            </div>
            <div class="plu-current-slide">
                <div class="plu-carousel-container">
                    <div class="plu-carousel-slide">
                        <img src="{{ $carouselImagesBySection['PLU'][1] ?? asset('img/default-slide.png') }}"
                            alt="Slide 1 PLU">
                    </div>
                    <div class="plu-carousel-slide">
                        <img src="{{ $carouselImagesBySection['PLU'][2] ?? asset('img/default-slide.png') }}"
                            alt="Slide 2 PLU">
                    </div>
                    <div class="plu-carousel-slide">
                        <img src="{{ $carouselImagesBySection['PLU'][3] ?? asset('img/default-slide.png') }}"
                            alt="Slide 3 PLU">
                    </div>
                    <div class="plu-carousel-slide">
                        <img src="{{ $carouselImagesBySection['PLU'][4] ?? asset('img/default-slide.png') }}"
                            alt="Slide 4 PLU">
                    </div>
                </div>
                <button class="plu-carousel-button prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="plu-carousel-button next">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <div class="plu-carousel-nav">
                    <div class="plu-carousel-dot active"></div>
                    <div class="plu-carousel-dot"></div>
                    <div class="plu-carousel-dot"></div>
                    <div class="plu-carousel-dot"></div>
                </div>
            </div>
        </div>

        <!-- Room Section -->
        <div class="room-section">
            <div class="section-header">
                <h2>Showing Apartemen Room</h2>
                <button class="plu-add-room-btn"
                    onclick="showSection(document.getElementById('pluCreateRoomSection'))">+ ROOM</button>
            </div>
            <div class="room-cards">
                @if(isset($roomsBySection['room_patraland_urbano']) &&
                count($roomsBySection['room_patraland_urbano'])
                > 0)
                @foreach($roomsBySection['room_patraland_urbano'] as $room)
                <!-- Room Card 1 -->
                <div class="room-card">
                    <div class="room-card-header">
                        <div class="left-text">NEOVALA <span class="room-type">ROOMS</span></div>
                        <img src="{{ asset('images/logo/room-title.png') }}" alt="Neovala Logo" class="room-logo">
                        <div class="right-text">PATRALAND <span class="room-type">URBANO</span></div>
                    </div>
                    <div class="room-card-image">
                        <img src="{{ $room['main_photo'] }}" alt="Room {{ $room['room_name'] }}">
                    </div>
                    <div class="room-action-buttons">
                        <button class="plu-edit-room-btn" data-room='@json($room)'>
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="more-btn" data-popup-id="roomPopup{{ $room['room_name'] }}">MORE</button>
                        <button class="delete-room-btn" data-room-id="{{ $room['folder'] }}"
                            data-room-section="{{ $room['section'] }}" data-db-id="{{ $room['id'] }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <div class="room-popup-overlay" id="roomPopup{{ $room['room_name'] }}">
                    <div class="room-popup-container" id="carousel-{{ $room['safe_id'] }}">
                        <button class="room-popup-close">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="room-popup-carousel">
                            <div class="room-popup-carousel-container">
                                @foreach ($room['popup_photos'] as $index => $popup)
                                <div class="room-popup-slide {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ $popup }}" alt="Room {{ $room['room_name'] }} View {{ $index + 1 }}">
                                </div>
                                @endforeach
                            </div>
                            <button class="room-popup-nav prev" data-room="{{ $room['safe_id'] }}">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="room-popup-nav next" data-room="{{ $room['safe_id'] }}">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="no-rooms">
                    <p>Tidak ada data kamar tersedia untuk Patraland Urbano</p>
                </div>
                @endif
            </div>
        </div>



        <!-- Comment Section -->
        <div class="comment-section">
            <div class="section-header">
                <h2>All PLU Comment</h2>
            </div>
            <div class="comment-cards">
                @foreach (\App\Models\KomentarPlu::where('section', 'plu')->latest()->get() as $komen)
                <div class="comment-card">
                    <div class="comment-header tpj-quote-wrapper">
                        <span class="tpj-quote-icon">"</span>
                    </div>
                    <div class="comment-content">
                        <p class="tpj-comment-text">{{ $komen->message }}</p>
                    </div>
                    <div class="comment-footer">
                        <div class="comment-info">
                            <span class="tpj-comment-user">
                                {{ $komen->hide_identity ? '@***********' : '@' . $komen->instagram }}
                            </span>
                            <div class="tpj-star-rating">
                                @for ($i = 1; $i <= 5; $i++) <i
                                    class="fas fa-star {{ $i > $komen->rating ? 'text-muted' : '' }}"></i>
                                    @endfor
                            </div>
                        </div>
                        <div class="comment-actions">
                            @if ($komen->status === 'pending')
                            <button type="button" class="apply-btn" data-id="{{ $komen->id }}"
                                data-section="plu">Apply</button>
                            @else
                            <button type="button" class="unapply-btn" data-id="{{ $komen->id }}"
                                data-section="plu">Unapply</button>
                            @endif
                            <button type="button" class="delete-btn" data-id="{{ $komen->id }}" data-section="plu">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- APPLY plu -->
        <div class="apply-comment-popup apply-popup-plu" style="display: none;">
            <div class="popup-content apply-content">
                <p>Anda yakin ingin menambahkan komentar ini?</p>
                <form id="applyForm-plu" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="popup-buttons">
                        <button type="button" class="popup-btn popup-cancel-comment">Tidak</button>
                        <button type="submit" class="popup-btn popup-apply-comment">Tambah</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- UNAPPLY plu -->
        <div class="apply-comment-popup unapply-popup-plu" style="display: none;">
            <div class="popup-content apply-content">
                <p>Anda yakin ingin mengembalikan komentar ke status pending?</p>
                <form id="unapplyForm-plu" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="popup-buttons">
                        <button type="button" class="popup-btn popup-cancel-unapply-comment">Tidak</button>
                        <button type="submit" class="popup-btn popup-apply-comment">Unapply</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- DELETE plu -->
        <div class="delete-comment-popup delete-popup-plu" style="display: none;">
            <div class="popup-content delete-comment-content">
                <p>Anda yakin ingin menghapus komentar ini?</p>
                <form id="deleteForm-plu" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="popup-buttons">
                        <button type="button" class="popup-btn popup-cancel-delete-comment">Tidak</button>
                        <button type="submit" class="popup-btn popup-delete-comment">Hapus</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Form Data Section -->
        <div class="form-data-section" data-apartment="Patraland Urbano by Neovala">
            <div class="section-header">
                <h2>Form Data PLU</h2>
            </div>
            <div class="form-data-container">
                <div class="form-data-header">
                    <div class="header-cell">Nama</div>
                    <div class="header-cell">No HP</div>
                    <div class="header-cell">Lama Sewa</div>
                    <div class="header-cell">Ukuran Kamar</div>
                    <div class="header-cell">Actions</div>
                </div>
                <div class="form-data-body">
                    @if(isset($formData) && count($formData) > 0)
                    @foreach($formData as $data)
                    <div class="form-data-row" data-id="{{ $data->id }}">
                        <div class="data-cell">{{ $data->nama }}</div>
                        <div class="data-cell">{{ $data->nomor_wa }}</div>
                        <div class="data-cell">{{ $data->durasi }}</div>
                        <div class="data-cell">{{ $data->tipe_kamar }}</div>
                        <div class="data-cell actions">
                            <button class="detail-btn" onclick="showDetail('{{ (int) $data->id }}')">Detail</button>
                            <button class="delete-btn-data trigger-delete-popup" data-id="{{ $data->id }}">
                                <i class="fas fa-trash"></i>
                            </button>

                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="form-data-row">
                        <div class="data-cell" colspan="5">Tidak ada data</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Change Slide Section -->
    <div class="plu-change-slide-section" id="pluChangeSlideSection" style="display: none;">
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="carousel_section" value="PLU">

            <div class="header-admin">
                <header>
                    <h1>Change Slide Patraland Urbano</h1>
                </header>
                <div class="button-container">
                    <button type="button" class="plu-back-btn-slide">Back</button>
                    <button type="submit" class="plu-update-btn-slide" style="display: none;">Update</button>
                </div>
            </div>


            <div class="slide-grid">
                <div class="slide-item" data-index="0">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['PLU'][1] ?? asset('img/default-slide.png') }}"
                            alt="Slide 1 PLU">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[1]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="slide-item" data-index="1">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['PLU'][2] ?? asset('img/default-slide.png') }}"
                            alt="Slide 2 PLU">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[2]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="slide-item" data-index="2">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['PLU'][3] ?? asset('img/default-slide.png') }}"
                            alt="Slide 3 PLU">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[3]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="slide-item" data-index="3">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['PLU'][4] ?? asset('img/default-slide.png') }}"
                            alt="Slide 4 PLU">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[4]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Edit Room Section -->
    <div class="plu-edit-room-section" id="pluEditRoomSection" style="display: none;">
        <div class="header-admin">
            <header>
                <h1>Edit Room Patraland Urbano </h1>
            </header>
        </div>

        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="room_section" value="{{ $selectedRoom['section'] ?? '' }}">
            <input type="hidden" name="room_id" value="{{ $selectedRoom['id'] ?? '' }}">

            <div class="room-form-container">
                <div class="room-main-image">
                    <div class="image-upload-large">
                        @if (!empty($selectedRoom['main_photo']))
                        <img id="mainEditImage" src="{{ $selectedRoom['main_photo'] }}" alt="Main Room Photo">
                        @else
                        <i class="fas fa-image"></i>
                        <p>Insert Room Main Photo</p>
                        <img id="mainEditImage" src="" alt="Main Room Photo" style="display: none;">
                        @endif
                        <input type="file" name="main_photo" class="room-photo-input" accept="image/*" hidden>
                    </div>
                </div>

                <!-- Additional Room Photos -->
                <div class="room-additional-images">
                    @for ($i = 0; $i < 4; $i++) <div class="image-upload-small">
                        @php
                        $popupKey = 'popup' . ($i + 1);
                        @endphp

                        @if (!empty($selectedRoom[$popupKey]))
                        <img class="popupEditImage" src="{{ $selectedRoom[$popupKey] }}"
                            alt="Room Additional {{ $i + 1 }}">
                        @else
                        <i class="fas fa-image"></i>
                        <p>Insert Room Photo</p>
                        <img class="popupEditImage" src="" alt="Room Additional {{ $i + 1 }}" style="display: none;">
                        @endif

                        <input type="file" name="popup{{ $i + 1 }}" class="room-photo-input" accept="image/*" hidden>
                </div>
                @endfor
            </div>

            <div class="back-button-container">
                <button type="button" class="plu-edit-back-btn">Back</button>
                <button type="submit" class="edit-save-btn">Edit</button>
            </div>
    </div>
    </form>
    </div>

    <!-- Create New Room Section -->
    <div class="plu-create-room-section" id="pluCreateRoomSection" style="display: none;">
        <div class="header-admin">
            <header>
                <h1>Buat Room Patraland Urbano</h1>
            </header>
        </div>

        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="room_section" value="room_patraland_urbano">

            <div class="room-form-container">
                <!-- Main Image -->
                <div class="room-main-image">
                    <div class="image-upload-large">
                        <i class="fas fa-image"></i>
                        <p>insert room main photo</p>
                        <input type="file" name="main_photo" class="room-photo-input" accept="image/*" hidden>
                    </div>
                </div>

                <!-- Additional Images -->
                <div class="room-additional-images">
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup1" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup2" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup3" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup4" class="room-photo-input" accept="image/*" hidden>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="back-button-container">
                    <button type="button" class="tpc-create-back-btn">Back</button>
                    <button type="submit" class="tpc-create-save-btn">Buat</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Detail Data Section -->
    <div class="detail-data-section" id="detailDataSection" style="display: none;">
        <div class="detail-container">
            <div class="detail-header">
                <h2>Detail Data Penyewa</h2>
                <!-- <button class="back-btn" onclick="hideDetail()">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button> -->
            </div>

            <div class="detail-content">
                <table class="detail-table">
                    <tr>
                        <td class="detail-label">Nama</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailNama"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">No Telp</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailNoTelp"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Lama Sewa</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailLamaSewa"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Ukuran Kamar</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailUkuranKamar"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Tanggal Masuk</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailTanggalMasuk"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Jam Kedatangan</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailJamKedatangan"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Catatan Tambahan</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailCatatan"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <!--URBANO End-->

    <!-- Section GATEWAY Start-->
    <div class="gtw-section" id="gtwSection" style="display: none;">
        <div class="header-admin">
            <header>
                <h1>GATEWAY CICADAS ADMIN PANEL</h1>
            </header>
        </div>

        <!-- Current Slide Show Section -->
        <div class="gtw-slide-section">
            <div class="section-header">
                <h2>Current Slide Show</h2>
                <button class="gtw-change-btn" type="button">Change Now</button>
            </div>
            <div class="gtw-current-slide">
                <div class="gtw-carousel-container">
                    <div class="gtw-carousel-slide">
                        <img src="{{ $carouselImagesBySection['GWC'][1] ?? asset('img/default-slide.png') }}"
                            alt="Slide 1 GWC">
                    </div>
                    <div class="gtw-carousel-slide">
                        <img src="{{ $carouselImagesBySection['GWC'][2] ?? asset('img/default-slide.png') }}"
                            alt="Slide 2 GWC">
                    </div>
                    <div class="gtw-carousel-slide">
                        <img src="{{ $carouselImagesBySection['GWC'][3] ?? asset('img/default-slide.png') }}"
                            alt="Slide 3 GWC">
                    </div>
                    <div class="gtw-carousel-slide">
                        <img src="{{ $carouselImagesBySection['GWC'][4] ?? asset('img/default-slide.png') }}"
                            alt="Slide 4 GWC">
                    </div>
                </div>
                <button class="gtw-carousel-button prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="gtw-carousel-button next">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <div class="gtw-carousel-nav">
                    <div class="gtw-carousel-dot active"></div>
                    <div class="gtw-carousel-dot"></div>
                    <div class="gtw-carousel-dot"></div>
                    <div class="gtw-carousel-dot"></div>
                </div>
            </div>
        </div>

        <!-- Room Section -->
        <div class="room-section">
            <div class="section-header">
                <h2>Showing Apartemen Room</h2>
                <button class="gtw-add-room-btn"
                    onclick="showSection(document.getElementById('gtwCreateRoomSection'))">+ ROOM</button>
            </div>
            <div class="room-cards">
                @if(isset($roomsBySection['room_gateway_cicadas']) &&
                count($roomsBySection['room_gateway_cicadas'])
                > 0)
                @foreach($roomsBySection['room_gateway_cicadas'] as $room)
                <!-- Room Card 1 -->
                <div class="room-card">
                    <div class="room-card-header">
                        <div class="left-text">NEOVALA <span class="room-type">ROOMS</span></div>
                        <img src="{{ asset('images/logo/room-title.png') }}" alt="Neovala Logo" class="room-logo">
                        <div class="right-text">GATEWAY <span class="room-type">CICADAS</span></div>
                    </div>
                    <div class="room-card-image">
                        <img src="{{ $room['main_photo'] }}" alt="Room {{ $room['room_name'] }}">
                    </div>
                    <div class="room-action-buttons">
                        <button class="gtw-edit-room-btn" data-room='@json($room)'>
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="more-btn" data-popup-id="roomPopup{{ $room['room_name'] }}">MORE</button>
                        <button class="delete-room-btn" data-room-id="{{ $room['folder'] }}"
                            data-room-section="{{ $room['section'] }}" data-db-id="{{ $room['id'] }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <!-- Room Popup -->
                <div class="room-popup-overlay" id="roomPopup{{ $room['room_name'] }}">
                    <div class="room-popup-container" id="carousel-{{ $room['safe_id'] }}">
                        <button class="room-popup-close">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="room-popup-carousel">
                            <div class="room-popup-carousel-container">
                                @foreach ($room['popup_photos'] as $index => $popup)
                                <div class="room-popup-slide {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ $popup }}" alt="Room {{ $room['room_name'] }} View {{ $index + 1 }}">
                                </div>
                                @endforeach
                            </div>
                            <button class="room-popup-nav prev" data-room="{{ $room['safe_id'] }}">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="room-popup-nav next" data-room="{{ $room['safe_id'] }}">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="no-rooms">
                    <p>Tidak ada data kamar tersedia untuk Gateway Cicadas</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Comment Section -->
        <div class="comment-section">
            <div class="section-header">
                <h2>All GWC Comment</h2>
            </div>
            <div class="comment-cards">
                @foreach (\App\Models\KomentarGwc::where('section', 'gwc')->latest()->get() as $komen)
                <!-- Comment Card 1 -->
                <div class="comment-card">
                    <div class="comment-header tpj-quote-wrapper">
                        <span class="tpj-quote-icon">"</span>
                    </div>
                    <div class="comment-content">
                        <p class="tpj-comment-text">{{ $komen->message }}</p>
                    </div>
                    <div class="comment-footer">
                        <div class="comment-info">
                            <span class="tpj-comment-user">
                                {{ $komen->hide_identity ? '@***********' : '@' . $komen->instagram }}
                            </span>
                            <div class="tpj-star-rating">
                                @for ($i = 1; $i <= 5; $i++) <i
                                    class="fas fa-star {{ $i > $komen->rating ? 'text-muted' : '' }}"></i>
                                    @endfor
                            </div>
                        </div>
                        <div class="comment-actions">
                            @if ($komen->status === 'pending')
                            <button type="button" class="apply-btn" data-id="{{ $komen->id }}"
                                data-section="gwc">Apply</button>
                            @else
                            <button type="button" class="unapply-btn" data-id="{{ $komen->id }}"
                                data-section="gwc">Unapply</button>
                            @endif
                            <button type="button" class="delete-btn" data-id="{{ $komen->id }}" data-section="gwc">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- APPLY gwc -->
        <div class="apply-comment-popup apply-popup-gwc" style="display: none;">
            <div class="popup-content apply-content">
                <p>Anda yakin ingin menambahkan komentar ini?</p>
                <form id="applyForm-gwc" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="popup-buttons">
                        <button type="button" class="popup-btn popup-cancel-comment">Tidak</button>
                        <button type="submit" class="popup-btn popup-apply-comment">Tambah</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- UNAPPLY gwc -->
        <div class="apply-comment-popup unapply-popup-gwc" style="display: none;">
            <div class="popup-content apply-content">
                <p>Anda yakin ingin mengembalikan komentar ke status pending?</p>
                <form id="unapplyForm-gwc" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="popup-buttons">
                        <button type="button" class="popup-btn popup-cancel-unapply-comment">Tidak</button>
                        <button type="submit" class="popup-btn popup-apply-comment">Unapply</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- DELETE gwc -->
        <div class="delete-comment-popup delete-popup-gwc" style="display: none;">
            <div class="popup-content delete-comment-content">
                <p>Anda yakin ingin menghapus komentar ini?</p>
                <form id="deleteForm-gwc" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="popup-buttons">
                        <button type="button" class="popup-btn popup-cancel-delete-comment">Tidak</button>
                        <button type="submit" class="popup-btn popup-delete-comment">Hapus</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Form Data Section -->
        <div class="form-data-section" data-apartment="Gateway Cicadas by Neovala">
            <div class="section-header">
                <h2>Form Data GWC</h2>
            </div>
            <div class="form-data-container">
                <div class="form-data-header">
                    <div class="header-cell">Nama</div>
                    <div class="header-cell">No HP</div>
                    <div class="header-cell">Lama Sewa</div>
                    <div class="header-cell">Ukuran Kamar</div>
                    <div class="header-cell">Actions</div>
                </div>
                <div class="form-data-body">
                    @if(isset($formData) && count($formData) > 0)
                    @foreach($formData as $data)
                    <div class="form-data-row" data-id="{{ $data->id }}">
                        <div class="data-cell">{{ $data->nama }}</div>
                        <div class="data-cell">{{ $data->nomor_wa }}</div>
                        <div class="data-cell">{{ $data->durasi }}</div>
                        <div class="data-cell">{{ $data->tipe_kamar }}</div>
                        <div class="data-cell actions">
                            <button class="detail-btn" onclick="showDetail('{{ (int) $data->id }}')">Detail</button>
                            <button class="delete-btn-data trigger-delete-popup" data-id="{{ $data->id }}">
                                <i class="fas fa-trash"></i>
                            </button>

                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="form-data-row">
                        <div class="data-cell" colspan="5">Tidak ada data</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Change Slide Section -->
    <div class="gtw-change-slide-section" id="gtwChangeSlideSection" style="display: none;">
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="carousel_section" value="GWC">

            <div class="header-admin">
                <header>
                    <h1>Change Slide Gateway Cicadas</h1>
                </header>
                <div class="button-container">
                    <button type="button" class="gtw-back-btn-slide">Back</button>
                    <button class="gtw-update-btn-slide" style="display: none;">Update</button>
                </div>
            </div>

            <div class="slide-grid">
                <div class="slide-item" data-index="0">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['GWC'][1] ?? asset('img/default-slide.png') }}"
                            alt="Slide 1 GWC">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[1]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="slide-item" data-index="1">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['GWC'][2] ?? asset('img/default-slide.png') }}"
                            alt="Slide 2 GWC">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[2]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="slide-item" data-index="2">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['GWC'][3] ?? asset('img/default-slide.png') }}"
                            alt="Slide 3 GWC">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[3]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="slide-item" data-index="3">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['GWC'][4] ?? asset('img/default-slide.png') }}"
                            alt="Slide 4 GWC">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[4]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Edit Room Section -->
    <div class="gtw-edit-room-section" id="gtwEditRoomSection" style="display: none;">
        <div class="header-admin">
            <header>
                <h1>Edit Room Gateway Cicadas </h1>
            </header>
        </div>
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="room_section" value="{{ $selectedRoom['section'] ?? '' }}">
            <input type="hidden" name="room_id" value="{{ $selectedRoom['id'] ?? '' }}">

            <div class="room-form-container">
                <div class="room-main-image">
                    <div class="image-upload-large">
                        @if (!empty($selectedRoom['main_photo']))
                        <img id="mainEditImage" src="{{ $selectedRoom['main_photo'] }}" alt="Main Room Photo">
                        @else
                        <i class="fas fa-image"></i>
                        <p>Insert Room Main Photo</p>
                        <img id="mainEditImage" src="" alt="Main Room Photo" style="display: none;">
                        @endif
                        <input type="file" name="main_photo" class="room-photo-input" accept="image/*" hidden>
                    </div>
                </div>

                <!-- Additional Room Photos -->
                <div class="room-additional-images">
                    @for ($i = 0; $i < 4; $i++) <div class="image-upload-small">
                        @php
                        $popupKey = 'popup' . ($i + 1);
                        @endphp

                        @if (!empty($selectedRoom[$popupKey]))
                        <img class="popupEditImage" src="{{ $selectedRoom[$popupKey] }}"
                            alt="Room Additional {{ $i + 1 }}">
                        @else
                        <i class="fas fa-image"></i>
                        <p>Insert Room Photo</p>
                        <img class="popupEditImage" src="" alt="Room Additional {{ $i + 1 }}" style="display: none;">
                        @endif

                        <input type="file" name="popup{{ $i + 1 }}" class="room-photo-input" accept="image/*" hidden>
                </div>
                @endfor

            </div>

            <div class="back-button-container">
                <button type="button" class="gtw-edit-back-btn">Back</button>
                <button type="submit" class="edit-save-btn">Edit</button>
            </div>
    </div>
    </form>
    </div>

    <!-- Create New Room Section -->
    <div class="gtw-create-room-section" id="gtwCreateRoomSection" style="display: none;">
        <div class="header-admin">
            <header>
                <h1>Buat Room Gateway Cicadas</h1>
            </header>
        </div>
        <!-- Create New Room Section -->
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="room_section" value="room_gateway_cicadas">
            <div class=" room-form-container">
                <!-- Main Image -->
                <div class="room-main-image">
                    <div class="image-upload-large">
                        <i class="fas fa-image"></i>
                        <p>insert room main photo</p>
                        <input type="file" name="main_photo" class="room-photo-input" accept="image/*" hidden>
                    </div>
                </div>

                <!-- Additional Images -->
                <div class="room-additional-images">
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup1" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup2" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup3" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup4" class="room-photo-input" accept="image/*" hidden>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="back-button-container">
                    <button type="button" class="gtw-create-back-btn">Back</button>
                    <button type="submit" class="gtw-create-save-btn">Buat</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Detail Data Section -->
    <div class="detail-data-section" id="detailDataSection" style="display: none;">
        <div class="detail-container">
            <div class="detail-header">
                <h2>Detail Data Penyewa</h2>
                <!-- <button class="back-btn" onclick="hideDetail()">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button> -->
            </div>

            <div class="detail-content">
                <table class="detail-table">
                    <tr>
                        <td class="detail-label">Nama</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailNama"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">No Telp</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailNoTelp"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Lama Sewa</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailLamaSewa"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Ukuran Kamar</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailUkuranKamar"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Tanggal Masuk</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailTanggalMasuk"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Jam Kedatangan</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailJamKedatangan"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Catatan Tambahan</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailCatatan"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>



    <!--GATEWAY End-->

    <!-- Section PODOMORO Start-->
    <div class="pgv-section" id="pgvSection" style="display: none;">
        <div class="header-admin">
            <header>
                <h1>PODOMORO GOLF VIEW ADMIN PANEL</h1>
            </header>
        </div>

        <!-- Current Slide Show Section -->
        <div class="pgv-slide-section">
            <div class="section-header">
                <h2>Current Slide Show</h2>
                <button class="pgv-change-btn" type="button">Change Now</button>
            </div>
            <div class="pgv-current-slide">
                <div class="pgv-carousel-container">
                    <div class="pgv-carousel-slide">
                        <img src="{{ $carouselImagesBySection['PGV'][1] ?? asset('img/default-slide.png') }}"
                            alt="Slide 1 PGV">
                    </div>
                    <div class="pgv-carousel-slide">
                        <img src="{{ $carouselImagesBySection['PGV'][2] ?? asset('img/default-slide.png') }}"
                            alt="Slide 2 PGV">
                    </div>
                    <div class="pgv-carousel-slide">
                        <img src="{{ $carouselImagesBySection['PGV'][3] ?? asset('img/default-slide.png') }}"
                            alt="Slide 3 PGV">
                    </div>
                    <div class="pgv-carousel-slide">
                        <img src="{{ $carouselImagesBySection['PGV'][4] ?? asset('img/default-slide.png') }}"
                            alt="Slide 4 PGV">
                    </div>
                </div>
                <button class="pgv-carousel-button prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="pgv-carousel-button next">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <div class="pgv-carousel-nav">
                    <div class="pgv-carousel-dot active"></div>
                    <div class="pgv-carousel-dot"></div>
                    <div class="pgv-carousel-dot"></div>
                    <div class="pgv-carousel-dot"></div>
                </div>
            </div>
        </div>

        <!-- Room Section -->
        <div class="room-section">
            <div class="section-header">
                <h2>Showing Apartemen Room</h2>
                <button class="pgv-add-room-btn"
                    onclick="showSection(document.getElementById('pgvCreateRoomSection'))">+ ROOM</button>
            </div>
            <div class="room-cards">
                @if(isset($roomsBySection['room_podomoro_golf_view']) &&
                count($roomsBySection['room_podomoro_golf_view'])
                > 0)
                @foreach($roomsBySection['room_podomoro_golf_view'] as $room)
                <!-- Room Card 1 -->
                <div class="room-card">
                    <div class="room-card-header">
                        <div class="left-text">NEOVALA <span class="room-type">ROOMS</span></div>
                        <img src="{{ asset('images/logo/room-title.png') }}" alt="Neovala Logo" class="room-logo">
                        <div class="right-text">PODOMORO<span class="room-type">GOLF VIEW</span></div>
                    </div>
                    <div class="room-card-image">
                        <img src="{{ $room['main_photo'] }}" alt="Room {{ $room['room_name'] }}">
                    </div>
                    <div class="room-action-buttons">
                        <button class="pgv-edit-room-btn" data-room='@json($room)'>
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="more-btn" data-popup-id="roomPopup{{ $room['room_name'] }}">MORE</button>
                        <button class="delete-room-btn" data-room-id="{{ $room['folder'] }}"
                            data-room-section="{{ $room['section'] }}" data-db-id="{{ $room['id'] }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <!-- Room Popup -->
                <div class="room-popup-overlay" id="roomPopup{{ $room['room_name'] }}">
                    <div class="room-popup-container" id="carousel-{{ $room['safe_id'] }}">
                        <button class="room-popup-close">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="room-popup-carousel">
                            <div class="room-popup-carousel-container">
                                @foreach ($room['popup_photos'] as $index => $popup)
                                <div class="room-popup-slide {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ $popup }}" alt="Room {{ $room['room_name'] }} View {{ $index + 1 }}">
                                </div>
                                @endforeach
                            </div>
                            <button class="room-popup-nav prev" data-room="{{ $room['safe_id'] }}">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="room-popup-nav next" data-room="{{ $room['safe_id'] }}">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="no-rooms">
                    <p>Tidak ada data kamar tersedia untuk Podomoro Golf View</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Comment Section -->
        <div class="comment-section">
            <div class="section-header">
                <h2>All PGV Comment</h2>
            </div>
            <div class="comment-cards">
                @foreach (\App\Models\KomentarPgv::where('section', 'pgv')->latest()->get() as $komen)
                <!-- Comment Card 1 -->
                <div class="comment-card">
                    <div class="comment-header tpj-quote-wrapper">
                        <span class="tpj-quote-icon">"</span>
                    </div>
                    <div class="comment-content">
                        <p class="tpj-comment-text">{{ $komen->message }}</p>
                    </div>
                    <div class="comment-footer">
                        <div class="comment-info">
                            <span class="tpj-comment-user">
                                {{ $komen->hide_identity ? '@***********' : '@' . $komen->instagram }}
                            </span>
                            <div class="tpj-star-rating">
                                @for ($i = 1; $i <= 5; $i++) <i
                                    class="fas fa-star {{ $i > $komen->rating ? 'text-muted' : '' }}"></i>
                                    @endfor
                            </div>
                        </div>
                        <div class="comment-actions">
                            @if ($komen->status === 'pending')
                            <button type="button" class="apply-btn" data-id="{{ $komen->id }}"
                                data-section="pgv">Apply</button>
                            @else
                            <button type="button" class="unapply-btn" data-id="{{ $komen->id }}"
                                data-section="pgv">Unapply</button>
                            @endif
                            <button type="button" class="delete-btn" data-id="{{ $komen->id }}" data-section="pgv">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


        <!-- APPLY pgv -->
        <div class="apply-comment-popup apply-popup-pgv" style="display: none;">
            <div class="popup-content apply-content">
                <p>Anda yakin ingin menambahkan komentar ini?</p>
                <form id="applyForm-pgv" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="popup-buttons">
                        <button type="button" class="popup-btn popup-cancel-comment">Tidak</button>
                        <button type="submit" class="popup-btn popup-apply-comment">Tambah</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- UNAPPLY pgv -->
        <div class="apply-comment-popup unapply-popup-pgv" style="display: none;">
            <div class="popup-content apply-content">
                <p>Anda yakin ingin mengembalikan komentar ke status pending?</p>
                <form id="unapplyForm-pgv" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="popup-buttons">
                        <button type="button" class="popup-btn popup-cancel-unapply-comment">Tidak</button>
                        <button type="submit" class="popup-btn popup-apply-comment">Unapply</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- DELETE pgv -->
        <div class="delete-comment-popup delete-popup-pgv" style="display: none;">
            <div class="popup-content delete-comment-content">
                <p>Anda yakin ingin menghapus komentar ini?</p>
                <form id="deleteForm-pgv" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="popup-buttons">
                        <button type="button" class="popup-btn popup-cancel-delete-comment">Tidak</button>
                        <button type="submit" class="popup-btn popup-delete-comment">Hapus</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Form Data Section -->
        <div class="form-data-section" data-apartment="Podomoro Golf View by Neovala">
            <div class="section-header">
                <h2>Form Data PGV</h2>
            </div>
            <div class="form-data-container">
                <div class="form-data-header">
                    <div class="header-cell">Nama</div>
                    <div class="header-cell">No HP</div>
                    <div class="header-cell">Lama Sewa</div>
                    <div class="header-cell">Ukuran Kamar</div>
                    <div class="header-cell">Actions</div>
                </div>
                <div class="form-data-body">
                    @if(isset($formData) && count($formData) > 0)
                    @foreach($formData as $data)
                    <div class="form-data-row" data-id="{{ $data->id }}">
                        <div class="data-cell">{{ $data->nama }}</div>
                        <div class="data-cell">{{ $data->nomor_wa }}</div>
                        <div class="data-cell">{{ $data->durasi }}</div>
                        <div class="data-cell">{{ $data->tipe_kamar }}</div>
                        <div class="data-cell actions">
                            <button class="detail-btn" onclick="showDetail('{{ (int) $data->id }}')">Detail</button>
                            <button class="delete-btn-data trigger-delete-popup" data-id="{{ $data->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="form-data-row">
                        <div class="data-cell" colspan="5">Tidak ada data</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Change Slide Section -->
    <div class="pgv-change-slide-section" id="pgvChangeSlideSection" style="display: none;">
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="carousel_section" value="PGV">

            <div class="header-admin">
                <header>
                    <h1>Change Slide Podomoro Golf View</h1>
                </header>
                <div class="button-container">
                    <button type="button" class="pgv-back-btn-slide">Back</button>
                    <button class="pgv-update-btn-slide" style="display: none;">Update</button>
                </div>
            </div>

            <div class="slide-grid">
                <div class="slide-item" data-index="0">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['PGV'][1] ?? asset('img/default-slide.png') }}"
                            alt="Slide 1 PGV">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[1]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="slide-item" data-index="1">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['PGV'][2] ?? asset('img/default-slide.png') }}"
                            alt="Slide 2 PGV">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[2]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="slide-item" data-index="2">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['PGV'][3] ?? asset('img/default-slide.png') }}"
                            alt="Slide 3 PGV">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[3]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="slide-item" data-index="3">
                    <div class="slide-image">
                        <img src="{{ $carouselImagesBySection['PGV'][4] ?? asset('img/default-slide.png') }}"
                            alt="Slide 4 PGV">
                        <div class="slide-overlay">
                            <input type="file" class="file-input" name="images[4]" accept="image/*" hidden>
                            <button type="button" class="select-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Edit Room Section -->
    <div class="pgv-edit-room-section" id="pgvEditRoomSection" style="display: none;">
        <div class="header-admin">
            <header>
                <h1>Edit Room Podomoro Golf View </h1>
            </header>
        </div>
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="room_section" value="{{ $selectedRoom['section'] ?? '' }}">
            <input type="hidden" name="room_id" value="{{ $selectedRoom['id'] ?? '' }}">

            <div class="room-form-container">
                <div class="room-main-image">
                    <div class="image-upload-large">
                        @if (!empty($selectedRoom['main_photo']))
                        <img id="mainEditImage" src="{{ $selectedRoom['main_photo'] }}" alt="Main Room Photo">
                        @else
                        <i class="fas fa-image"></i>
                        <p>Insert Room Main Photo</p>
                        <img id="mainEditImage" src="" alt="Main Room Photo" style="display: none;">
                        @endif
                        <input type="file" name="main_photo" class="room-photo-input" accept="image/*" hidden>
                    </div>
                </div>

                <!-- Additional Room Photos -->
                <div class="room-additional-images">
                    @for ($i = 0; $i < 4; $i++) <div class="image-upload-small">
                        @php
                        $popupKey = 'popup' . ($i + 1);
                        @endphp

                        @if (!empty($selectedRoom[$popupKey]))
                        <img class="popupEditImage" src="{{ $selectedRoom[$popupKey] }}"
                            alt="Room Additional {{ $i + 1 }}">
                        @else
                        <i class="fas fa-image"></i>
                        <p>Insert Room Photo</p>
                        <img class="popupEditImage" src="" alt="Room Additional {{ $i + 1 }}" style="display: none;">
                        @endif

                        <input type="file" name="popup{{ $i + 1 }}" class="room-photo-input" accept="image/*" hidden>
                </div>
                @endfor

            </div>

            <div class="back-button-container">
                <button type="button" class="pgv-edit-back-btn">Back</button>
                <button type="submit" class="edit-save-btn">Edit</button>
            </div>
    </div>
    </form>
    </div>

    <!-- Create New Room Section -->
    <div class="pgv-create-room-section" id="pgvCreateRoomSection" style="display: none;">
        <div class="header-admin">
            <header>
                <h1>Buat Room Patraland Urbano</h1>
            </header>
        </div>
        <!-- Create New Room Section -->
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="room_section" value="room_podomoro_golf_view">
            <div class=" room-form-container">
                <!-- Main Image -->
                <div class="room-main-image">
                    <div class="image-upload-large">
                        <i class="fas fa-image"></i>
                        <p>insert room main photo</p>
                        <input type="file" name="main_photo" class="room-photo-input" accept="image/*" hidden>
                    </div>
                </div>

                <!-- Additional Images -->
                <div class="room-additional-images">
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup1" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup2" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup3" class="room-photo-input" accept="image/*" hidden>
                    </div>
                    <div class="image-upload-small">
                        <i class="fas fa-image"></i>
                        <p>insert room photo</p>
                        <input type="file" name="popup4" class="room-photo-input" accept="image/*" hidden>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="back-button-container">
                    <button type="button" class="pgv-create-back-btn">Back</button>
                    <button type="submit" class="pgv-create-save-btn">Buat</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Detail Data Section -->
    <div class="detail-data-section" id="detailDataSection" style="display: none;">
        <div class="detail-container">
            <div class="detail-header">
                <h2>Detail Data Penyewa</h2>
                <!-- <button class="back-btn" onclick="hideDetail()">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button> -->
            </div>

            <div class="detail-content">
                <table class="detail-table">
                    <tr>
                        <td class="detail-label">Nama</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailNama"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">No Telp</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailNoTelp"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Lama Sewa</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailLamaSewa"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Ukuran Kamar</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailUkuranKamar"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Tanggal Masuk</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailTanggalMasuk"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Jam Kedatangan</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailJamKedatangan"></td>
                    </tr>
                    <tr>
                        <td class="detail-label">Catatan Tambahan</td>
                        <td class="detail-divider">:</td>
                        <td class="detail-value" id="detailCatatan"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <!--PODOMORO End-->

    <!-- Delete Confirmation Popup -->
    <div class="delete-popup">
        <div class="popup-content delete-content">
            <p>Anda yakin ingin menghapus Room ini?</p>
            <div class="popup-buttons">
                <button class="popup-btn popup-cancel" type="button">Tidak</button>
                <button class="popup-btn popup-delete" type="button">Hapus</button>
            </div>
        </div>
    </div>



    <!-- Delete Data Popup -->
    <div class="delete-data-popup" id="deletePopup">
        <div class="popup-content delete-data-content">
            <p>Anda yakin ingin menghapus Data ini?</p>
            <div class="popup-buttons">
                <button class="popup-btn popup-cancel-delete-data" type="button">Tidak</button>
                <button class="popup-btn popup-delete-data" type="button">Hapus</button>
            </div>
        </div>
    </div>

    </div>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script>
    let logoutTimer;
    let hasLogged = false; // Flag to ensure only one log

    function resetLogoutTimer() {
        clearTimeout(logoutTimer);

        if (!hasLogged) {
            console.log("Inactivity timer started");
            hasLogged = true;
        }

        clearTimeout(logoutTimer);
        logoutTimer = setTimeout(() => {
            document.getElementById('logoutForm').submit();
        }, 10 * 60 * 1000); // 10 minutes
    }

    // These events reset the timer
    ['click', 'mousemove', 'keydown', 'scroll', 'touchstart'].forEach(event => {
        window.addEventListener(event, resetLogoutTimer);
    });

    resetLogoutTimer(); // Start the timer when page loads
    </script>
</body>

</html>