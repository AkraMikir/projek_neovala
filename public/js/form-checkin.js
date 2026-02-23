document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#checkinForm");
    if (!form) return;

    const tanggalInput = form.querySelector("#tanggalCheckin");
    let hariLabel = document.createElement("div");
    hariLabel.id = "hariTanggalCheckin";
    hariLabel.style.marginTop = "6px";
    hariLabel.style.fontSize = "1rem";
    hariLabel.style.color = "#674C1D";
    hariLabel.style.fontWeight = "bold";
    tanggalInput.parentNode.appendChild(hariLabel);

    function updateHariTanggal() {
        const value = tanggalInput.value;
        if (!value) {
            hariLabel.textContent = "";
            return;
        }
        const hariArr = [
            "Minggu",
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jumat",
            "Sabtu",
        ];
        const tgl = new Date(value);
        const hari = hariArr[tgl.getDay()];
        const tglStr = `${tgl.getDate().toString().padStart(2, "0")}/${(
            tgl.getMonth() + 1
        )
            .toString()
            .padStart(2, "0")}/${tgl.getFullYear()}`;
        hariLabel.textContent = `${hari}, ${tglStr}`;
    }

    tanggalInput.addEventListener("change", updateHariTanggal);
    tanggalInput.addEventListener("input", updateHariTanggal);
    updateHariTanggal();

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = {
            nama: form.nama.value,
            nomor_wa: form.nomor.value,
            tipe_kamar: form.tipeKamar.value,
            tanggal_checkin: form.tanggalCheckin.value,
            jam_kedatangan: form.jamKedatangan.value,
            durasi: form.durasi.value,
            pesan: form.pesan.value,
            apartment_type: form.dataset.apartment,
        };

        const btn = form.querySelector(".submit-btn");
        btn.disabled = true;
        btn.innerHTML = "Mengirim...";

        fetch("/save-form-data", { // Removed extra space
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                // Safe check for meta tag
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify(formData),
        })
            .then((res) => res.json())
            .then((data) => {
                if (data.success) {
                    const msg = `Checkin From ${formData.apartment_type} via Neovala Website
                    
Nama : ${formData.nama}
Nomor WhatsApp : ${formData.nomor_wa}
Tipe Kamar : ${formData.tipe_kamar}
Tanggal Check-in : ${formData.tanggal_checkin}
Jam Kedatangan : ${formData.jam_kedatangan}
Durasi Menginap : ${formData.durasi}
Pesan Tambahan : ${formData.pesan}`;

                    const encodedMsg = encodeURIComponent(msg);

                    const nomorTujuanMap = {
                        "Transpark Juanda Via WhatsApp": "6287874176270",
                        "Transpark Cibubur Via WhatsApp": "6281805191817",
                        "Podomoro Golf View Via WhatsApp": "6281220391217",
                        "Springlake Summarecon Via WhatsApp": "628139553939",
                        "Patraland Urbano Via WhatsApp": "6287768545010",
                        "Grand Kamala Lagoon Via WhatsApp": "6285161518151",
                        "Gateway Cicadas Via WhatsApp": "6289630253533",
                        "Bassura City Via WhatsApp": "6287852624656",
                        "Green Pramuka City Via WhatsApp": "6285719035729",
                    };

                    const nomorTujuan =
                        nomorTujuanMap[formData.apartment_type] ||
                        "6287815933353";

                    // Open WhatsApp in new tab
                    window.open(`https://wa.me/${nomorTujuan}?text=${encodedMsg}`, '_blank');

                    // Optional: Reset form after successful submission
                    // form.reset(); 
                    // updateHariTanggal();
                } else {
                    alert(data.message || "Gagal menyimpan data.");
                }
            })
            .catch((err) => {
                console.error(err);
                alert("Terjadi kesalahan saat mengirim data.");
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML =
                    '<i class="fab fa-whatsapp"></i> Kirim via WhatsApp';
            });
    });
});
