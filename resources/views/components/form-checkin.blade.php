@props(['apartment'])

<section class="checkin-section" id="checkin-section">
    <h2 class="checkin-title">Form Checkin Apartemen<br>{{ $apartment }}</h2>

    <div class="checkin-form-container">
        <form id="checkinForm" data-apartment="{{ $apartment }}">
            @csrf
            <input type="hidden" name="apartment_type" value="{{ $apartment }}">

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" required placeholder="Nama Lengkap">
            </div>

            <div class="form-group">
                <label for="nomor">Nomor WhatsApp</label>
                <input type="tel" id="nomor" name="nomor" required placeholder="+62 812-3456-7890">
            </div>

            <div class="form-group">
                <label for="tipeKamar">Tipe Kamar</label>
                <select id="tipeKamar" name="tipeKamar" required>
                    <option value="">Pilih Tipe Kamar</option>
                    <option value="Studio">Studio Room</option>
                    <option value="1BR">1 Bedroom</option>
                    <option value="2BR">2 Bedroom</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tanggalCheckin">Tanggal Check-in</label>
                <input type="date" id="tanggalCheckin" name="tanggalCheckin" required>
            </div>

            <div class="form-group">
                <label for="jamKedatangan">Jam Kedatangan</label>
                <input type="time" id="jamKedatangan" name="jamKedatangan" required>
            </div>

            <div class="form-group">
                <label for="durasi">Durasi Menginap</label>
                <select id="durasi" name="durasi" required>
                    <option value="">Pilih Durasi</option>
                    <option value="Harian">Harian</option>
                    <option value="Mingguan">Mingguan</option>
                    <option value="Bulanan">Bulanan</option>
                    <option value="Tahunan">Tahunan</option>
                    <option value="Menyesuaikan">Menyesuaikan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="pesan">Pesan Tambahan</label>
                <textarea id="pesan" name="pesan" rows="4"></textarea>
            </div>

            <button type="submit" class="submit-btn">
                <i class="fab fa-whatsapp"></i> Kirim via WhatsApp
            </button>
        </form>
    </div>
</section>
