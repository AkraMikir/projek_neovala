document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#checkinForm');
    if (!form) return;

    const tanggalInput = form.querySelector('#tanggalCheckin');
    let hariLabel = document.createElement('div');
    hariLabel.id = 'hariTanggalCheckin';
    hariLabel.style.marginTop = '6px';
    hariLabel.style.fontSize = '1rem';
    hariLabel.style.color = '#674C1D';
    hariLabel.style.fontWeight = 'bold';
    tanggalInput.parentNode.appendChild(hariLabel);

    function updateHariTanggal() {
        const value = tanggalInput.value;
        if (!value) {
            hariLabel.textContent = '';
            return;
        }
        const hariArr = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const tgl = new Date(value);
        const hari = hariArr[tgl.getDay()];
        const tglStr = `${tgl.getDate().toString().padStart(2, '0')}/${(tgl.getMonth()+1).toString().padStart(2, '0')}/${tgl.getFullYear()}`;
        hariLabel.textContent = `${hari}, ${tglStr}`;
    }

    tanggalInput.addEventListener('change', updateHariTanggal);
    tanggalInput.addEventListener('input', updateHariTanggal);
    updateHariTanggal();

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = {
            nama: form.nama.value,
            nomor_wa: form.nomor.value,
            tipe_kamar: form.tipeKamar.value,
            tanggal_checkin: form.tanggalCheckin.value,
            jam_kedatangan: form.jamKedatangan.value,
            durasi: form.durasi.value,
            pesan: form.pesan.value,
            apartment_type: form.dataset.apartment
        };

        const btn = form.querySelector('.submit-btn');
        btn.disabled = true;
        btn.innerHTML = 'Mengirim...';

        fetch('/save-form-data ', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(formData)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const msg = `Checkin From ${formData.apartment_type} via Neovala Website\n\nNama : ${formData.nama}\nNomor WhatsApp : ${formData.nomor_wa}\nTipe Kamar : ${formData.tipe_kamar}\nTanggal Check-in : ${formData.tanggal_checkin}\nJam Kedatangan : ${formData.jam_kedatangan}\nDurasi Menginap : ${formData.durasi}\nPesan Tambahan : ${formData.pesan}`;
                const encodedMsg = encodeURIComponent(msg);

                const nomorTujuanMap = {
                    "Transpark Juanda by Neovala": "6287874176270",
                    "Transpark Cibubur by Neovala": "6281805191817",
                    "Podomoro Golf View by Neovala": "6281220391217",
                    "Patraland Urbano by Neovala": "6287852624656",
                    "Grand Kamala Lagoon by Neovala": "6285161518151",
                    "Gateway Cicadas by Neovala": "6289630253533"
                };

                const nomorTujuan = nomorTujuanMap[formData.apartment_type] || '6287815933353';
                window.location.href = `https://wa.me/${nomorTujuan}?text=${encodedMsg}`;
            } else {
                alert(data.message || 'Gagal menyimpan data.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan saat mengirim data.');
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fab fa-whatsapp"></i> Kirim via WhatsApp';
        });
    });
});
