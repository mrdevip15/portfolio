# Setup Google Ads — Digiserv

Disusun 25 Nov 2026. Semua angka budget/CPC di bawah adalah titik awal, bukan data — ganti setelah 2–4 minggu data nyata.

## 0. Sebelum iklan jalan (wajib)

1. **Domain final: `digiserv.my.id`.** Semua URL iklan (final URL, sitelink) pakai `https://digiserv.my.id/...`. Pastikan mailbox `hidayat@digiserv.my.id` sudah dibuat di cPanel → Email Accounts, karena tombol Email di website mengarah ke sana.
2. **Deploy landing page.** `/jasabikinwebsite/landing-page` masih 404 di live (file belum di-commit).
3. **Buat akun** (harus kamu sendiri, butuh login & pembayaran):
   - Google Analytics 4 → buat property + Web data stream → salin `G-XXXXXXXXXX`.
   - Google Ads → pilih *Switch to Expert Mode* → buat akun **tanpa** kampanye dulu.
   - Google Ads → Goals → Conversions → New → Website → "Set up manually" → buat 2 aksi: **WhatsApp click** (kategori *Contact*) dan **Email click** (*Contact*). Salin `AW-…` dan label masing-masing.
   - Link GA4 ↔ Google Ads (GA4 Admin → Product links).
4. **Isi ID** di `includes/tracking.php` lalu deploy. Kode sudah mengirim event `generate_lead` (GA4) + konversi Ads setiap klik link WhatsApp / mailto.
5. Cek dengan **Google Tag Assistant** (tagassistant.google.com) bahwa tag & konversi terbaca.

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
