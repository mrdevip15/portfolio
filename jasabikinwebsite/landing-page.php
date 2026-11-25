<?php
require_once __DIR__ . '/../includes/content.php';

$whatsAppUrl = 'https://wa.link/byybuo';
$videoId = '5fLW5Q5ODiE';
$videoUrl = 'https://www.youtube.com/watch?v=' . $videoId;
$projects = array_column(get_projects(), null, 'title');

$deliverables = [
    [
        'id' => 'copy',
        'short' => 'Copy',
        'title' => 'Pesan penawaran',
        'summary' => 'Buat penawaran mudah dipahami sejak layar pertama.',
        'image' => 'Brits Campaign Landing',
        'points' => [
            'Judul dan pengantar yang sesuai dengan pesan iklan.',
            'Urutan manfaat, bukti, dan jawaban untuk pertanyaan calon pelanggan.',
            'Ajakan bertindak yang jelas di bagian utama halaman.',
        ],
    ],
    [
        'id' => 'desain',
        'short' => 'UI',
        'title' => 'Desain responsif',
        'summary' => 'Gunakan tampilan yang sesuai dengan brand Anda di ponsel dan desktop.',
        'image' => 'Genius Gate',
        'points' => [
            'Tata letak yang mengikuti identitas visual bisnis Anda.',
            'Susunan gambar dan video yang tetap terbaca di layar kecil.',
            'Tinjau rancangan sebelum halaman dikembangkan.',
        ],
    ],
    [
        'id' => 'prospek',
        'short' => 'Lead',
        'title' => 'Alur calon pelanggan',
        'summary' => 'Arahkan pengunjung ke WhatsApp atau formulir pendaftaran.',
        'image' => 'Akar Panrita',
        'points' => [
            'Tentukan satu tindakan utama untuk kampanye.',
            'Siapkan tautan WhatsApp atau formulir sesuai kebutuhan.',
            'Tentukan siapa yang menerima dan menindaklanjuti prospek.',
        ],
    ],
    [
        'id' => 'peluncuran',
        'short' => 'Uji',
        'title' => 'Persiapan peluncuran',
        'summary' => 'Periksa halaman sebelum tautannya dipakai untuk iklan.',
        'image' => 'Pioneer Class',
        'points' => [
            'Periksa keterbacaan dan tata letak di ponsel serta desktop.',
            'Uji tujuan tautan, tombol, dan formulir yang disepakati.',
            'Siapkan halaman pada alamat yang disepakati.',
        ],
    ],
];

$outcomes = [
    ['Halaman yang sesuai dengan iklan', 'Pengunjung langsung melihat program atau produk yang mereka klik.'],
    ['Penawaran yang mudah dipindai', 'Manfaat, detail program, dan cara mendaftar punya tempat yang jelas.'],
    ['Bukti di tempat yang tepat', 'Contoh kerja dan testimoni bisa muncul dekat keputusan yang harus diambil.'],
    ['Tampilan yang nyaman di ponsel', 'Pengunjung bisa membaca, menonton, dan mengetuk tombol di layar kecil.'],
    ['Satu tindakan utama', 'Pengunjung tahu apakah perlu membuka WhatsApp atau mengisi formulir.'],
    ['Alur yang sudah diperiksa', 'Tim bisa mencoba jalur dari tombol sampai tujuan sebelum iklan tayang.'],
];

// Excerpts from the client testimonials already used by the Digiserv portfolio.
$testimonials = [
    ['Brits Indonesia', 'Supercamp #1', 'They integrated a complex IRT algorithm that saved our team hundreds of hours.', 'testimoni-2.webp'],
    ['Agnes Gosali', 'Ruangguru', 'It significantly speeds up our productivity by automating repetitive tasks.', 'testimoni-3.jpeg'],
    ['Naim Syahrir', 'Navinsco', 'Excellent work! Digiserv expertise handled our professional email setup and boosted our visibility with top-tier SEO strategies.', 'testimoni-4.webp'],
];

$previewSections = [
    ['Penawaran utama', 'Sebutkan program atau produk, siapa yang dituju, dan tindakan yang bisa langsung diambil.'],
    ['Manfaat dan detail', 'Tampilkan informasi yang perlu diketahui calon pelanggan, seperti jadwal, cakupan, atau cara mengikuti program.'],
    ['Bukti dan pertanyaan umum', 'Tambahkan contoh proyek atau kutipan klien yang relevan, lalu jawab pertanyaan yang sering muncul.'],
    ['Ajakan bertindak', 'Tempatkan tombol WhatsApp atau formulir setelah penawaran utama dan ulangi di akhir halaman.'],
];

$questions = [
    ['Berapa biaya pembuatan landing page?', 'Biaya mengikuti cakupan, mulai dari penyusunan materi sampai integrasi formulir. Kami membahas kebutuhan sebelum memberikan penawaran.'],
    ['Apa yang perlu saya siapkan untuk memulai?', 'Ceritakan produk atau program Anda, siapa yang ingin dijangkau, dan apa yang sebaiknya pengunjung lakukan. Logo, foto, video, dan testimoni bisa menyusul.'],
    ['Bisa memakai domain yang sudah saya punya?', 'Bisa. Kami bisa membahas apakah halaman sebaiknya ditempatkan pada domain utama, subdomain, atau alamat khusus kampanye.'],
    ['Bisakah saya memakai formulir pendaftaran?', 'Bisa. Kita tentukan data apa yang perlu dikumpulkan dan ke mana hasil pendaftaran dikirim.'],
    ['Bisa membuat landing page untuk program pendidikan?', 'Bisa. Portofolio kami mencakup halaman untuk bimbingan belajar, program pendidikan, dan pendaftaran sekolah.'],
    ['Bagaimana kalau saya masih punya pertanyaan?', 'Hubungi kami melalui WhatsApp untuk membahas materi, jadwal, atau detail kampanye Anda.'],
];
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jasa Landing Page untuk Kampanye Iklan | Digiserv</title>
  <meta name="description" content="Digiserv membantu bisnis dan lembaga pendidikan membuat landing page kampanye yang mengarahkan pengunjung ke WhatsApp atau formulir pendaftaran.">
  <link rel="icon" href="/favicon.ico">
  <?php include __DIR__ . '/../includes/tracking.php'; ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;family=Playfair+Display:ital,wght@0,400;0,600;1,400;1,600&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/jasabikinwebsite/landing-page.css">
</head>
<body>
  <header class="announcement">
    <a href="#penawaran">Jasa landing page Digiserv <span aria-hidden="true">·</span> Lihat cakupan layanan</a>
  </header>

  <main>
    <section class="hero" aria-labelledby="hero-title">
      <div class="wrap">
        <p class="hero-badge"><img src="/img/logo.jpg" alt="" width="24" height="24"> Jasa landing page kampanye</p>
        <h1 id="hero-title">Landing page untuk kampanye Anda,<br class="desktop-break"> dari klik iklan ke <em>chat pelanggan.</em></h1>
        <p class="hero-offer">Copy, desain, dan pengembangan.</p>
        <p class="hero-support">Terhubung ke WhatsApp atau formulir pendaftaran.</p>
        <div class="scope-row">
          <span>Cakupan</span>
          <div class="scope-links">
            <?php foreach ($deliverables as $deliverable): ?>
              <a href="#<?= htmlspecialchars($deliverable['id']) ?>" aria-label="<?= htmlspecialchars($deliverable['title']) ?>"><?= htmlspecialchars($deliverable['short']) ?></a>
            <?php endforeach; ?>
          </div>
        </div>

        <figure class="video">
          <div class="video-frame">
            <a class="video-cover" href="<?= htmlspecialchars($videoUrl) ?>" aria-label="Putar video contoh dari Chrome for Developers">
              <img src="/img/brits-landing.webp" alt="" width="767" height="497" fetchpriority="high">
              <span class="video-play" aria-hidden="true"></span>
            </a>
            <template id="campaign-video">
              <iframe src="https://www.youtube-nocookie.com/embed/<?= htmlspecialchars($videoId) ?>?autoplay=1&amp;rel=0" title="Improving Load Performance — Chrome for Developers" allow="autoplay; encrypted-media; picture-in-picture; fullscreen" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </template>
          </div>
          <figcaption><span>Video contoh sementara</span><a href="<?= htmlspecialchars($videoUrl) ?>">Tonton di YouTube</a></figcaption>
        </figure>
        <a class="button" href="<?= htmlspecialchars($whatsAppUrl) ?>">Diskusi via WhatsApp</a>
      </div>
    </section>

    <section class="section section-compact wrap" id="layanan" aria-labelledby="services-title">
      <div class="section-heading">
        <h2 id="services-title">Empat bagian dalam <em>satu layanan.</em></h2>
      </div>
      <div class="grid grid-four">
        <?php foreach ($deliverables as $deliverable): ?>
          <?php $project = $projects[$deliverable['image']]; ?>
          <a class="card inclusion" href="#<?= htmlspecialchars($deliverable['id']) ?>">
            <img src="/<?= htmlspecialchars($project['image_path']) ?>" alt="" loading="lazy" decoding="async">
            <div class="card-body">
              <h3><?= htmlspecialchars($deliverable['title']) ?></h3>
              <p><?= htmlspecialchars($deliverable['summary']) ?></p>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="section band" aria-labelledby="problem-title">
      <div class="wrap split">
        <div class="media"><img src="/img/geniusgate.webp" alt="Halaman Genius Gate dengan penawaran dan tombol daftar" loading="lazy" decoding="async"></div>
        <div class="split-copy">
          <h2 id="problem-title">Pengunjung sudah klik.<br> <em>Apa yang mereka lihat?</em></h2>
          <p>Jika iklan Anda menawarkan program tertentu, tampilkan detail program itu begitu pengunjung tiba. Letakkan jadwal, manfaat, dan cara mendaftar di halaman yang sama agar mereka bisa langsung mengambil langkah berikutnya.</p>
          <a class="button" href="<?= htmlspecialchars($whatsAppUrl) ?>">Bahas kampanye Anda</a>
        </div>
      </div>
    </section>

    <section class="section wrap" aria-labelledby="outcomes-title">
      <div class="section-heading">
        <h2 id="outcomes-title">Apa yang akan dilihat <em>calon pelanggan.</em></h2>
      </div>
      <div class="grid grid-three outcome-grid">
        <?php foreach ($outcomes as [$title, $description]): ?>
          <div class="card card-body"><h3><?= htmlspecialchars($title) ?></h3><p><?= htmlspecialchars($description) ?></p></div>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="section band" aria-labelledby="clients-title">
      <div class="wrap">
        <div class="section-heading">
          <h2 id="clients-title">Pengalaman <em>klien Digiserv.</em></h2>
          <p>Umpan balik atas proyek pengembangan dan layanan Digiserv.</p>
        </div>
        <div class="grid grid-three">
          <?php foreach ($testimonials as [$name, $company, $quote, $image]): ?>
            <figure class="card card-body quote">
              <blockquote lang="en">“<?= htmlspecialchars($quote) ?>”</blockquote>
              <figcaption><img src="/img/<?= htmlspecialchars($image) ?>" alt="" width="44" height="44" loading="lazy"><span><strong><?= htmlspecialchars($name) ?></strong><small><?= htmlspecialchars($company) ?></small></span></figcaption>
            </figure>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="section wrap" id="portofolio" aria-labelledby="portfolio-title">
      <div class="section-heading">
        <h2 id="portfolio-title">Lihat <em>hasilnya.</em></h2>
      </div>
      <div class="grid grid-three">
        <?php foreach (['Genius Gate', 'Brits Campaign Landing', 'Akar Panrita'] as $title): ?>
          <?php $project = $projects[$title]; ?>
          <figure class="card project">
            <img src="/<?= htmlspecialchars($project['image_path']) ?>" alt="Tampilan halaman <?= htmlspecialchars($title) ?>" loading="lazy" decoding="async">
            <figcaption class="card-body"><h3><?= htmlspecialchars($title) ?></h3><p><?= htmlspecialchars($project['description']) ?></p></figcaption>
          </figure>
        <?php endforeach; ?>
      </div>
      <div class="section-action"><a class="button" href="<?= htmlspecialchars($whatsAppUrl) ?>">Diskusi via WhatsApp</a></div>
    </section>

    <section class="section band" id="penawaran" aria-labelledby="package-title">
      <div class="wrap">
        <div class="section-heading">
          <p class="eyebrow">Rincian layanan</p>
          <h2 id="package-title">Yang kami kerjakan <em>untuk kampanye Anda.</em></h2>
        </div>
        <div class="package-list">
          <?php foreach ($deliverables as $deliverable): ?>
            <?php $project = $projects[$deliverable['image']]; ?>
            <section class="split package-item" id="<?= htmlspecialchars($deliverable['id']) ?>" aria-labelledby="title-<?= htmlspecialchars($deliverable['id']) ?>">
              <div class="split-copy">
                <h3 id="title-<?= htmlspecialchars($deliverable['id']) ?>"><?= htmlspecialchars($deliverable['title']) ?></h3>
                <ul class="checks">
                  <?php foreach ($deliverable['points'] as $point): ?>
                    <li><?= htmlspecialchars($point) ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <div class="media"><img src="/<?= htmlspecialchars($project['image_path']) ?>" alt="Contoh proyek <?= htmlspecialchars($project['title']) ?>" loading="lazy" decoding="async"></div>
            </section>
          <?php endforeach; ?>
        </div>
        <div class="section-action"><a class="button" href="<?= htmlspecialchars($whatsAppUrl) ?>">Minta penawaran</a></div>
      </div>
    </section>

    <section class="section wrap" aria-labelledby="journey-title">
      <div class="section-heading">
        <h2 id="journey-title">Dari halaman kampanye <em>ke aplikasi.</em></h2>
        <p>Dua proyek Brits Indonesia yang melayani kebutuhan berbeda.</p>
      </div>
      <div class="grid grid-two">
        <figure class="card project">
          <img src="/img/brits-landing.webp" alt="Tampilan landing page kampanye Brits" loading="lazy" decoding="async">
          <figcaption class="card-body"><h3>Brits Campaign Landing</h3><p>Calon peserta bisa melihat program dan menuju pendaftaran.</p></figcaption>
        </figure>
        <figure class="card project">
          <img src="/img/brits.webp" alt="Tampilan aplikasi ujian Brits Tryout" loading="lazy" decoding="async">
          <figcaption class="card-body"><h3>Brits Tryout</h3><p>Peserta menggunakan platform terpisah untuk mengikuti ujian dan tryout.</p></figcaption>
        </figure>
      </div>
    </section>

    <section class="section band" aria-labelledby="other-work-title">
      <div class="wrap">
        <div class="section-heading">
          <h2 id="other-work-title">Proyek Digiserv <em>lainnya.</em></h2>
        </div>
        <div class="grid grid-two">
          <?php foreach (['Pioneer Class', 'NAV|INS CO'] as $title): ?>
            <?php $project = $projects[$title]; ?>
            <figure class="card project">
              <img src="/<?= htmlspecialchars($project['image_path']) ?>" alt="Tampilan proyek <?= htmlspecialchars($title) ?>" loading="lazy" decoding="async">
              <figcaption class="card-body"><h3><?= htmlspecialchars($title) ?></h3><p><?= htmlspecialchars($project['description']) ?></p></figcaption>
            </figure>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="section wrap" id="pratinjau" aria-labelledby="preview-title">
      <div class="section-heading">
        <h2 id="preview-title">Pratinjau <em>isi halaman.</em></h2>
      </div>
      <div class="split preview">
        <div class="media"><img src="/img/brits-landing.webp" alt="Contoh susunan halaman kampanye Brits" loading="lazy" decoding="async"></div>
        <div class="questions">
          <?php foreach ($previewSections as $index => [$title, $description]): ?>
            <details name="page-preview"<?= $index === 0 ? ' open' : '' ?>>
              <summary><?= htmlspecialchars($title) ?></summary>
              <p><?= htmlspecialchars($description) ?></p>
            </details>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="section section-compact band" aria-labelledby="offer-title">
      <div class="wrap">
        <div class="offer-box">
          <p class="eyebrow">Landing page kampanye</p>
          <h2 id="offer-title">Siapkan halaman <em>sebelum iklan tayang.</em></h2>
          <p>Bahas pesan penawaran, desain, dan alur pendaftaran dalam satu proyek.</p>
          <a class="button" href="<?= htmlspecialchars($whatsAppUrl) ?>">Diskusi via WhatsApp</a>
        </div>
      </div>
    </section>

    <section class="section wrap" aria-labelledby="process-title" id="proses">
      <div class="section-heading">
        <h2 id="process-title">Cakupan jelas <em>sebelum mulai.</em></h2>
        <p>Kita bahas tujuan, kebutuhan, dan biaya sebelum pekerjaan dimulai.</p>
      </div>
      <ol class="grid grid-three steps">
        <li class="card card-body"><h3>Bahas kampanye</h3><p>Ceritakan penawaran, audiens, dan tindakan yang diharapkan dari pengunjung.</p></li>
        <li class="card card-body"><h3>Tinjau rancangan</h3><p>Lihat alur, teks, dan desain halaman sebelum pengembangan.</p></li>
        <li class="card card-body"><h3>Uji dan luncurkan</h3><p>Coba halaman, tombol, dan formulir yang disepakati sebelum kampanye berjalan.</p></li>
      </ol>
    </section>

    <section class="section band" id="faq" aria-labelledby="faq-title">
      <div class="wrap narrow">
        <div class="section-heading"><h2 id="faq-title">Pertanyaan <em>umum.</em></h2></div>
        <div class="questions">
          <?php foreach ($questions as [$title, $description]): ?>
            <details>
              <summary><?= htmlspecialchars($title) ?></summary>
              <p><?= htmlspecialchars($description) ?></p>
            </details>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="section closing" aria-labelledby="closing-title">
      <div class="wrap narrow">
        <h2 id="closing-title">Sedang menyiapkan <em>kampanye?</em></h2>
        <p>Ceritakan penawaran Anda dan ke mana calon pelanggan perlu diarahkan.</p>
        <a class="button" href="<?= htmlspecialchars($whatsAppUrl) ?>">Diskusi via WhatsApp</a>
      </div>
    </section>
  </main>

  <footer class="campaign-footer">
    <div class="wrap footer-inner">
      <a class="wordmark" href="/"><img src="/img/logo.jpg" alt="" width="32" height="32"> Digiserv</a>
      <a href="/jasabikinwebsite/">Semua layanan</a>
    </div>
  </footer>

  <script>
    const videoCover = document.querySelector('.video-cover');
    const videoTemplate = document.querySelector('#campaign-video');

    videoCover.addEventListener('click', (event) => {
      if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
      event.preventDefault();
      const player = videoTemplate.content.firstElementChild.cloneNode(true);
      videoCover.replaceWith(player);
      player.focus();
    });
  </script>
</body>
</html>
