# Setup Google Ads — Digiserv

Disusun 25 Nov 2026. Semua angka budget/CPC di bawah adalah titik awal, bukan data — ganti setelah 2–4 minggu data nyata.

## 0. Sebelum iklan jalan (wajib)

1. **Domain final: `digiserv.my.id`.** Semua URL iklan (final URL, sitelink) pakai `https://digiserv.my.id/...`. Pastikan mailbox `hidayat@digiserv.my.id` sudah dibuat di cPanel → Email Accounts, karena tombol Email di website mengarah ke sana.
2. ✅ Landing page live di `/jasabikinwebsite/landing-page`.
3. ✅ Akun sudah dibuat (25 Nov 2026):
   - **GA4**: property "Digiserv - digiserv.my.id" (ID 565765507) di akun GA "Google Ads Account", stream "Digiserv Web", Measurement ID `G-23FDKLGGVR`. Zona waktu Makassar, IDR.
   - **Google Ads**: akun "Digiserv" **420-744-5560** (terpisah dari akun bimbel 748-802-2091). Indonesia, Makassar, IDR, pascabayar. Tag `AW-18594643988`. Terhubung ke GA4 di atas.
   - **Konversi** (kategori Kontak, Utama, hitung "Satu"): **WhatsApp click** label `IrzgCNOjhb8dEJSAz6JF`, **Email click** label `3ksUCNajhb8dEJSAz6JF`. Konversi yang disempurnakan: mati.
4. ✅ ID sudah diisi di `includes/tracking.php` dan live. Klik link WhatsApp/mailto mengirim `generate_lead` (GA4) + konversi Ads (diuji 25 Nov 2026).
5. Status konversi di Google Ads baru berubah dari "Belum diverifikasi" setelah ada klik nyata; cek lagi 1–2 hari setelah kampanye jalan.

## 1. Struktur akun

Satu kampanye **Search** dulu, jangan Performance Max/Display (budget kecil akan habis di traffic murah yang tidak convert).

| Setting | Nilai |
|---|---|
| Tujuan | Leads |
| Network | Search saja — **matikan** Search Partners & Display Network |
| Lokasi | Indonesia, opsi *Presence: people in or regularly in* |
| Bahasa | Indonesian + English |
| Bidding | Minggu 1–3: *Maximize clicks* dengan batas CPC maks. Setelah ≥15 konversi/bulan: *Maximize conversions* → lalu *Target CPA* |
| Jadwal | Sen–Sab 07:00–21:00 (sesuaikan dengan jam kamu bisa balas WA) |
| Budget awal | ±Rp 50.000–100.000/hari per kampanye (asumsi, uji 2–4 minggu) |

### Ad group → halaman tujuan

| Ad group | Keyword (phrase/exact) | Landing page |
|---|---|---|
| Landing Page | "jasa landing page", "jasa pembuatan landing page", "bikin landing page iklan", [jasa landing page murah] | `/jasabikinwebsite/landing-page` |
| Aplikasi Rapor | "aplikasi rapor sekolah", "aplikasi rapor digital", "software rapor kurikulum merdeka" | `/jasabikinwebsite/aplikasi-sekolah-rapor` |
| Invoice Otomatis | "aplikasi invoice otomatis", "sistem tagihan otomatis", "aplikasi tagihan bimbel" | `/jasabikinwebsite/invoice-otomatis` |
| Otomasi | "jasa otomasi bisnis", "jasa bikin script otomatis", "otomatisasi excel google sheets" | `/jasabikinwebsite/jasa-script-otomatis` |

Mulai dari **Landing Page** saja kalau budget terbatas — halamannya paling lengkap. Halaman lain masih sangat tipis (±30 baris) dan akan dapat Quality Score rendah.

### Negative keywords (level akun)

`gratis, free, tutorial, cara membuat, cara bikin, belajar, kursus, template, download, apk, mod, lowongan, loker, kerja, gaji, magang, skripsi, contoh, pdf, wordpress gratis, canva, blogspot`

Tambah dari *Search terms report* tiap minggu.

## 2. Contoh iklan (Responsive Search Ad — Landing Page)

Headline (≤30 karakter):
1. Jasa Landing Page Iklan
2. Landing Page Siap Kampanye
3. Arahkan Pengunjung ke WA
4. Desain Responsif HP & Desktop
5. Copywriting Sesuai Iklan
6. Konsultasi Gratis 30 Menit
7. Harga Tetap, Tanpa Kejutan
8. Kode & Akses Milik Anda
9. Digiserv — Web Developer
10. Cek Portofolio Kami

Description (≤90 karakter):
1. Landing page dengan pesan, desain, dan alur ke WhatsApp yang disiapkan untuk iklan Anda.
2. Diskusikan kampanye Anda gratis. Proposal dengan milestone dan harga tetap sebelum mulai.
3. Diuji di ponsel dan desktop sebelum tautan dipakai untuk iklan. Hubungi kami via WA.

Pin headline 1 di posisi 1. Tambahkan aset: Sitelink (Portofolio, Layanan, Blog, Kontak), Callout (Konsultasi Gratis, Harga Tetap, Source Code Milik Anda), dan Call asset kalau mau terima telepon.

> Jangan pakai klaim yang tidak bisa dibuktikan (lihat audit: "98%", "$1M+"). Google bisa menolak iklan karena *Misrepresentation*.

## 3. Rutinitas mingguan

- Search terms → tambah negative keyword, tambah keyword yang convert.
- Pause keyword dengan biaya ≥ 2–3× target CPA tanpa konversi.
- Bandingkan jumlah klik WA di Ads dengan chat WA yang benar-benar masuk (klik ≠ chat). Catat sumber tiap lead di WA ("dari iklan?").
