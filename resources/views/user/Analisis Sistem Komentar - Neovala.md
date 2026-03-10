# 📝 Analisis Sistem Komentar / Review — Apartemen TPJ (Projek Neovala)

Dokumen ini menjelaskan secara lengkap cara kerja sistem komentar (review) yang sudah ada di projek ini,
dan apa saja yang dibutuhkan jika ingin menduplikasi tampilan komentar untuk halaman user lainnya.

---

## 🧱 Arsitektur Sistem

Sistem review bekerja dalam 3 lapisan utama:

```
Routes (URL) → Controller (logika) → Model (database)
                      ↓
               View / Blade (tampilan)
                      ↑
              API JSON ← Fetch JS di browser (filter & live reload)
```

Ketika user membuka halaman review:
1. Controller mengambil data dari database via Model
2. Data dikirim ke Blade View untuk di-render
3. Setelah halaman terbuka, JavaScript di dalam Blade akan **fetch ulang** data dari API (`/api/reviews`)
   setiap kali user menggunakan filter, search, atau pagination — sehingga halaman tidak perlu reload.

---

## 📁 Daftar File Lengkap

### 1. 🗄️ Models (Database Layer)

Semua model berada di `app/Models/`.

| File | Kegunaan |
|------|----------|
| `Review.php` | Model utama. Menyimpan isi komentar, rating, instagram, location, hide_identity |
| `ReviewMedia.php` | Menyimpan file gambar/video yang dilampirkan ke review (`type`: `image` / `video`) |
| `ReviewReply.php` | Menyimpan balasan admin terhadap sebuah review |
| `ReviewLike.php` | Menyimpan data siapa saja yang menyukai (like) sebuah review |

> ✅ Semua model ini sudah ada dan tidak perlu diubah.

---

### 2. 🎛️ Controllers (Business Logic)

Semua controller berada di `app/Http/Controllers/`.

| File | Method Penting | Kegunaan |
|------|----------------|----------|
| `ReviewController.php` | `store()` | Menyimpan ulasan baru yang dikirim via form (POST) |
| | `listApi()` | Mengembalikan daftar review dalam format JSON (untuk fetch JS) |
| | `keywordsApi()` | Mengembalikan kata kunci populer dari review (untuk tombol keyword filter) |
| | `detailDiscover()` | Menampilkan halaman review per lokasi, contoh: `/reviews/spl` |
| | `reviewsPage()` | Menampilkan halaman `/ulasan` (semua ulasan, bisa filter semua lokasi) |
| `ReviewLikeController.php` | `toggle()` | Toggle like/unlike sebuah review |
| | `checkLikes()` | Cek status like untuk banyak review sekaligus (dipakai komponen JS) |

> ✅ Semua controller sudah ada dan tidak perlu diubah.

---

### 3. 🌐 Routes (URL Endpoints)

Semua route review ada di `routes/web.php`.

```php
// Like system
Route::post('/reviews/check-likes', [ReviewLikeController::class, 'checkLikes'])
    ->name('reviews.like.check');
Route::post('/reviews/{review}/like', [ReviewLikeController::class, 'toggle'])
    ->name('reviews.like.toggle');

// Submit review baru
Route::post('/review', [ReviewController::class, 'store'])
    ->name('review.store');

// API untuk fetch JS (filter, search, pagination)
Route::get('/api/reviews', [ReviewController::class, 'listApi'])
    ->name('api.reviews');
Route::get('/api/reviews/keywords', [ReviewController::class, 'keywordsApi'])
    ->name('api.reviews.keywords');

// Halaman semua ulasan
Route::get('/ulasan', [ReviewController::class, 'reviewsPage'])
    ->name('reviews.page');

// Halaman ulasan per lokasi (spl, tpj, tpc, dll.)
Route::get('/reviews/{location}', [ReviewController::class, 'detailDiscover'])
    ->name('reviews.detail.discover')
    ->where('location', 'tpj|tpc|gkl|plu|gwc|pgv|gpc|bsr|spl'); // ← 'tpj' sudah terdaftar di sini
```

> ✅ `tpj` sudah terdaftar di constraint route. Halaman `/reviews/tpj` sudah bisa diakses langsung.

---

### 4. 🖼️ View / Blade Files (Tampilan)

#### A. Widget — Embed ke halaman lain
**`resources/views/user/partials/reviews-section.blade.php`**
- Berukuran besar (1060 baris), berisi:
  - **Form "Give Us Feedback"** — form submit ulasan dengan rating bintang, input Instagram, toggle samarkan, upload gambar (max 5), upload video (max 1)
  - **Carousel foto** di samping form (opsional)
  - **Bagian "What They Say?"** — slider kartu review horizontal dengan filter (Semua, Terbaru, Terpopuler, Rating, Foto/Video, Keyword)
  - Tombol like di setiap kartu review
  - Modal preview foto/video
  - Semua logika JavaScript (fetch, filter, render kartu) sudah terintegrasi di dalam file ini

**Cara pakai (embed ke halaman lain):**
```blade
@include('user.partials.reviews-section', [
    'reviews'         => $reviews,
    'reviewAggregate' => $reviewAggregate,
    'locationName'    => 'tpj',
    'locationSlug'    => 'tpj',
    'carouselImages'  => [],  // opsional
])
```

---

#### B. Halaman Penuh — Review per Lokasi
**`resources/views/user/reviews/detail.blade.php`**
- Halaman standalone yang di-render di URL `/reviews/{location}`, contoh: `/reviews/tpj`
- Berisi:
  - Tombol kembali
  - Judul halaman dinamis sesuai lokasi
  - Statistik rating rata-rata + jumlah ulasan
  - Filter (Desktop: tombol-tombol | Mobile: dropdown select)
  - Filter: Semua / Terbaru / Terpopuler / Waktu Terlama / Per Bintang / Foto/Video / Kata Kunci
  - Search box pencarian
  - List ulasan dalam bentuk `<article>` card — lebih besar dan detail dari widget
  - Pagination
  - Modal preview foto/video
  - Fitur "pin" — ulasan tertentu muncul paling atas (via `?pin=ID`)
  - Semua interaktivitas via JavaScript fetch

---

#### C. Halaman Penuh — Semua Ulasan
**`resources/views/user/reviews/page.blade.php`**
- Halaman standalone di URL `/ulasan`
- Sama seperti `detail.blade.php` tapi dengan tambahan:
  - Dropdown filter lokasi (bisa pilih semua lokasi)
  - Form submit ulasan juga tersedia di sini (dengan pilih lokasi via select)

---

#### D. Template Pagination
**`resources/views/user/reviews/pagination.blade.php`**
- Template tombol-tombol navigasi halaman (prev / nomor / next)
- Digunakan oleh `detail.blade.php` dan `page.blade.php` melalui:
  ```blade
  {{ $reviews->withQueryString()->links('user.reviews.pagination') }}
  ```

---

### 5. 🧩 Blade Component

**`resources/views/components/like-button.blade.php`**
- Komponen tombol like yang muncul di setiap kartu review
- Cara pakai di Blade:
  ```blade
  <x-like-button :review="$review" />
  ```
- Menampilkan icon thumbs-up + jumlah like
- State (liked/not liked) diinisialisasi oleh JavaScript via `window.initLikeStates()`

---

## 📦 Variabel yang Dibutuhkan View

### Untuk `reviews-section.blade.php` (widget):

| Variabel | Tipe | Contoh Nilai |
|----------|------|-------------|
| `$reviews` | `Collection` | Koleksi review TPJ (eager load: `media`, `replies.admin`, `likes`) |
| `$reviewAggregate` | `array` | `['avg' => 4.5, 'count' => 87, 'count_has_media' => 30]` |
| `$locationName` | `string` | `'tpj'` |
| `$locationSlug` | `string` | `'tpj'` |
| `$carouselImages` | `array` | `['/storage/img/tpj1.jpg', '/storage/img/tpj2.jpg']` *(opsional)* |

### Untuk `reviews/detail.blade.php` (halaman `/reviews/tpj`):

| Variabel | Tipe | Contoh Nilai |
|----------|------|-------------|
| `$reviews` | `LengthAwarePaginator` | `Review::where('location', 'tpj')->paginate(12)` |
| `$aggregate` | `array` | `['avg' => 4.5, 'count' => 87, 'count_has_media' => 30]` |
| `$currentLocation` | `string` | `'tpj'` |
| `$locations` | `array\|null` | `null` (sembunyikan dropdown lokasi lain) |
| `$backUrl` | `string` | `route('home')` atau URL halaman sebelumnya |

---

## 🚀 Cara Menduplikasi (2 Opsi)

### ✅ Opsi A — Embed Widget (Paling Mudah)

Cukup panggil `@include` di halaman yang sudah ada, dan kirim variabel yang dibutuhkan dari controller.

**Contoh di controller:**
```php
use App\Models\Review;

$reviews = Review::with(['media', 'replies.admin', 'likes'])
    ->where('location', 'tpj')
    ->where('is_visible', true)
    ->latest()
    ->take(20)
    ->get();

$reviewAggregate = [
    'avg'             => Review::where('location', 'tpj')->where('is_visible', true)->avg('rating') ?? 0,
    'count'           => Review::where('location', 'tpj')->where('is_visible', true)->count(),
    'count_has_media' => Review::where('location', 'tpj')->where('is_visible', true)->whereHas('media')->count(),
];

return view('user.namahalaman', compact('reviews', 'reviewAggregate'));
```

**Contoh di blade:**
```blade
@include('user.partials.reviews-section', [
    'reviews'         => $reviews,
    'reviewAggregate' => $reviewAggregate,
    'locationName'    => 'tpj',
    'locationSlug'    => 'tpj',
])
```

---

### ✅ Opsi B — Halaman Tersendiri

Halaman `/reviews/tpj` **sudah ada** karena `tpj` sudah terdaftar di route!
Tinggal buka: **`http://localhost/reviews/tpj`**

Jika ingin halaman dengan URL berbeda (misal `/komentar-tpj`):

1. Tambah route baru di `routes/web.php`:
   ```php
   Route::get('/komentar-tpj', function () {
       return app(ReviewController::class)->detailDiscover(request(), 'tpj');
   })->name('komentar.tpj');
   ```

2. Atau salin `reviews/detail.blade.php` ke file baru dan sesuaikan tampilan sesuai kebutuhan.

---

## 🔍 Catatan Penting

- Semua filter (Rating, Terbaru, Foto/Video, Keyword) bekerja via **JavaScript fetch** ke endpoint `/api/reviews` — bukan reload halaman
- Sistem **like** membutuhkan session/cookie browser untuk melacak like per user
- Kolom `location` di tabel `reviews` menentukan review ini milik apartemen mana
- Untuk dokumen ini, lokasi yang digunakan adalah **`tpj`** (Taman Permata Jingga)
- Nilai valid lainnya: `tpc`, `gkl`, `plu`, `gwc`, `pgv`, `gpc`, `bsr`, `spl`
- `$review->hide_identity` = `true` → nama tampil sebagai "Anonymous"
- Balasan admin (`replies`) hanya tampil sebagai **baca-only** di sisi user — tidak bisa dibalas kembali

---

*Dokumen ini dibuat untuk referensi internal pengembangan Projek Neovala.*
*Last updated: 2026-03-09*
