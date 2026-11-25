<?php
require_once __DIR__ . '/../includes/landing-language.php';
require_once __DIR__ . '/../includes/content.php';

$whatsAppUrl = 'https://wa.link/byybuo';
$videoId = '5fLW5Q5ODiE';
$videoUrl = 'https://www.youtube.com/watch?v=' . $videoId;
$projects = array_column(get_projects(), null, 'title');

$deliverables = [
    [
        'id' => 'copy',
        'short' => 'Copy',
        'title' => $landingText('Offer messaging', 'Pesan penawaran'),
        'summary' => $landingText('Make your offer clear as soon as visitors arrive.', 'Buat penawaran mudah dipahami sejak layar pertama.'),
        'image' => 'Brits Campaign Landing',
        'points' => [
            $landingText('A headline and introduction that match the message in your ad.', 'Judul dan pengantar yang sesuai dengan pesan iklan.'),
            $landingText(
                'A clear order for benefits, proof, and answers to common questions.',
                'Urutan manfaat, bukti, dan jawaban untuk pertanyaan calon pelanggan.'
            ),
            $landingText('A clear call to action in the main sections of the page.', 'Ajakan bertindak yang jelas di bagian utama halaman.'),
        ],
    ],
    [
        'id' => 'desain',
        'short' => 'UI',
        'title' => $landingText('Responsive design', 'Desain responsif'),
        'summary' => $landingText(
            'Give your visitors a consistent brand experience on mobile and desktop.',
            'Gunakan tampilan yang sesuai dengan brand Anda di ponsel dan desktop.'
        ),
        'image' => 'Genius Gate',
        'points' => [
            $landingText('A layout that reflects your business’s visual identity.', 'Tata letak yang mengikuti identitas visual bisnis Anda.'),
            $landingText('Images and videos laid out to work on small screens.', 'Susunan gambar dan video yang tetap terbaca di layar kecil.'),
            $landingText('Review the design before development begins.', 'Tinjau rancangan sebelum halaman dikembangkan.'),
        ],
    ],
    [
        'id' => 'prospek',
        'short' => 'Lead',
        'title' => $landingText('Lead capture', 'Alur calon pelanggan'),
        'summary' => $landingText('Guide visitors to WhatsApp or a registration form.', 'Arahkan pengunjung ke WhatsApp atau formulir pendaftaran.'),
        'image' => 'Akar Panrita',
        'points' => [
            $landingText('Choose one primary action for the campaign.', 'Tentukan satu tindakan utama untuk kampanye.'),
            $landingText('Set up a WhatsApp link or form to suit your campaign.', 'Siapkan tautan WhatsApp atau formulir sesuai kebutuhan.'),
            $landingText('Decide who will receive and follow up with leads.', 'Tentukan siapa yang menerima dan menindaklanjuti prospek.'),
        ],
    ],
    [
        'id' => 'peluncuran',
        'short' => $landingText('QA', 'Uji'),
        'title' => $landingText('Launch preparation', 'Persiapan peluncuran'),
        'summary' => $landingText('Review the page before using its link in ads.', 'Periksa halaman sebelum tautannya dipakai untuk iklan.'),
        'image' => 'Pioneer Class',
        'points' => [
            $landingText('Check readability and layout on mobile and desktop.', 'Periksa keterbacaan dan tata letak di ponsel serta desktop.'),
            $landingText('Test the agreed links, buttons, and forms.', 'Uji tujuan tautan, tombol, dan formulir yang disepakati.'),
            $landingText('Set up the page at the agreed URL.', 'Siapkan halaman pada alamat yang disepakati.'),
        ],
    ],
];

$outcomes = [
    [
        $landingText('A page that matches the ad', 'Halaman yang sesuai dengan iklan'),
        $landingText(
            'Visitors immediately see the program or product they clicked on.',
            'Pengunjung langsung melihat program atau produk yang mereka klik.'
        ),
    ],
    [
        $landingText('An offer that’s easy to scan', 'Penawaran yang mudah dipindai'),
        $landingText(
            'Benefits, program details, and registration steps are easy to find.',
            'Manfaat, detail program, dan cara mendaftar punya tempat yang jelas.'
        ),
    ],
    [
        $landingText('Proof where it matters', 'Bukti di tempat yang tepat'),
        $landingText(
            'Work samples and testimonials can appear where visitors make a decision.',
            'Contoh kerja dan testimoni bisa muncul dekat keputusan yang harus diambil.'
        ),
    ],
    [
        $landingText('A mobile-friendly layout', 'Tampilan yang nyaman di ponsel'),
        $landingText(
            'Visitors can read, watch, and tap buttons on small screens.',
            'Pengunjung bisa membaca, menonton, dan mengetuk tombol di layar kecil.'
        ),
    ],
    [
        $landingText('One primary action', 'Satu tindakan utama'),
        $landingText(
            'Visitors know whether to open WhatsApp or fill out a form.',
            'Pengunjung tahu apakah perlu membuka WhatsApp atau mengisi formulir.'
        ),
    ],
    [
        $landingText('A tested path to conversion', 'Alur yang sudah diperiksa'),
        $landingText(
            'Your team can test each step from the call to action before the ads go live.',
            'Tim bisa mencoba jalur dari tombol sampai tujuan sebelum iklan tayang.'
        ),
    ],
];

// Excerpts from the client testimonials already used by the Digiserv portfolio.
$testimonials = [
    [
        'Brits Indonesia', 'Supercamp #1',
        $landingText(
            'They integrated a complex IRT algorithm that saved our team hundreds of hours.',
            'Mereka mengintegrasikan algoritme IRT yang kompleks dan menghemat ratusan jam kerja tim kami.'
        ),
        'testimoni-2.webp',
    ],
    [
        'Agnes Gosali', 'Ruangguru',
        $landingText(
            'It significantly speeds up our productivity by automating repetitive tasks.',
            'Pekerjaan kami jadi jauh lebih cepat karena tugas berulang berjalan otomatis.'
        ),
        'testimoni-3.jpeg',
    ],
    [
        'Naim Syahrir', 'Navinsco',
        $landingText(
            'Excellent work! Digiserv expertise handled our professional email setup and boosted our visibility with top-tier SEO strategies.',
            'Hasilnya luar biasa! Digiserv menyiapkan email profesional kami dan meningkatkan visibilitas kami lewat strategi SEO yang efektif.'
        ),
        'testimoni-4.webp',
    ],
];

$previewSections = [
    [
        $landingText('Main offer', 'Penawaran utama'),
        $landingText(
            'Name the program or product, who it’s for, and what visitors can do right away.',
            'Sebutkan program atau produk, siapa yang dituju, dan tindakan yang bisa langsung diambil.'
        ),
    ],
    [
        $landingText('Benefits and details', 'Manfaat dan detail'),
        $landingText(
            'Share the information prospects need, such as schedules, what’s included, and how to join.',
            'Tampilkan informasi yang perlu diketahui calon pelanggan, seperti jadwal, cakupan, atau cara mengikuti program.'
        ),
    ],
    [
        $landingText('Proof and common questions', 'Bukti dan pertanyaan umum'),
        $landingText(
            'Add relevant work samples or client quotes, then answer common questions.',
            'Tambahkan contoh proyek atau kutipan klien yang relevan, lalu jawab pertanyaan yang sering muncul.'
        ),
    ],
    [
        $landingText('Call to action', 'Ajakan bertindak'),
        $landingText(
            'Place the WhatsApp button or form after the main offer and repeat it at the end.',
            'Tempatkan tombol WhatsApp atau formulir setelah penawaran utama dan ulangi di akhir halaman.'
        ),
    ],
];

$questions = [
    [
        $landingText('How much does a landing page cost?', 'Berapa biaya pembuatan landing page?'),
        $landingText(
            'The cost depends on the scope, from preparing content to integrating forms. We discuss your needs before providing a quote.',
            'Biaya mengikuti cakupan, mulai dari penyusunan materi sampai integrasi formulir. Kami membahas kebutuhan sebelum memberikan penawaran.'
        ),
    ],
    [
        $landingText('What do I need to get started?', 'Apa yang perlu saya siapkan untuk memulai?'),
        $landingText(
            'Tell us about your product or program, who you want to reach, and what visitors should do. Logos, photos, videos, and testimonials can follow.',
            'Ceritakan produk atau program Anda, siapa yang ingin dijangkau, dan apa yang sebaiknya pengunjung lakukan. Logo, foto, video, dan testimoni bisa menyusul.'
        ),
    ],
    [
        $landingText('Can I use my existing domain?', 'Bisa memakai domain yang sudah saya punya?'),
        $landingText(
            'Yes. We can discuss whether your main domain, a subdomain, or a dedicated campaign URL is the best fit.',
            'Bisa. Kami bisa membahas apakah halaman sebaiknya ditempatkan pada domain utama, subdomain, atau alamat khusus kampanye.'
        ),
    ],
    [
        $landingText('Can I use a registration form?', 'Bisakah saya memakai formulir pendaftaran?'),
        $landingText(
            'Yes. We’ll decide which information to collect and where to send form submissions.',
            'Bisa. Kita tentukan data apa yang perlu dikumpulkan dan ke mana hasil pendaftaran dikirim.'
        ),
    ],
    [
        $landingText('Can you build a landing page for an education program?', 'Bisa membuat landing page untuk program pendidikan?'),
        $landingText(
            'Yes. Our portfolio includes pages for tutoring, education programs, and school enrollment.',
            'Bisa. Portofolio kami mencakup halaman untuk bimbingan belajar, program pendidikan, dan pendaftaran sekolah.'
        ),
    ],
    [
        $landingText('What if I have more questions?', 'Bagaimana kalau saya masih punya pertanyaan?'),
        $landingText(
            'Contact us on WhatsApp to discuss your content, timeline, or campaign details.',
            'Hubungi kami melalui WhatsApp untuk membahas materi, jadwal, atau detail kampanye Anda.'
        ),
    ],
];
?>
<!doctype html>
<html lang="<?= $landingLanguage ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $landingText('Landing Page Design for Ad Campaigns | Digiserv', 'Jasa Landing Page untuk Kampanye Iklan | Digiserv') ?></title>
  <meta name="description" content="<?= $landingText(
    'Digiserv builds landing pages for businesses and educational institutions that guide ad visitors to WhatsApp or a registration form.',
    'Digiserv membantu bisnis dan lembaga pendidikan membuat landing page kampanye yang mengarahkan pengunjung ke WhatsApp atau formulir pendaftaran.'
  ) ?>">
  <link rel="icon" href="/favicon.ico">
  <?php include __DIR__ . '/../includes/tracking.php'; ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;family=Playfair+Display:ital,wght@0,400;0,600;1,400;1,600&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/jasabikinwebsite/landing-page.css">
</head>
<body>
  <header class="announcement">
    <a href="#penawaran"><?= $landingText(
      'Digiserv landing page design <span aria-hidden="true">·</span> See what’s included',
      'Jasa landing page Digiserv <span aria-hidden="true">·</span> Lihat cakupan layanan'
    ) ?></a>
  </header>

  <main>
    <section class="hero" aria-labelledby="hero-title">
      <div class="wrap">
        <p class="hero-badge"><img src="/img/logo.jpg" alt="" width="24" height="24"> <?= $landingText('Campaign landing page design', 'Jasa landing page kampanye') ?></p>
        <h1 id="hero-title"><?= $landingText(
          'Landing pages for your campaign,<br class="desktop-break"> from ad clicks to <em>customer chats.</em>',
          'Landing page untuk kampanye Anda,<br class="desktop-break"> dari klik iklan ke <em>chat pelanggan.</em>'
        ) ?></h1>
        <p class="hero-offer"><?= $landingText('Copy, design, and development.', 'Copy, desain, dan pengembangan.') ?></p>
        <p class="hero-support"><?= $landingText('Connected to WhatsApp or a registration form.', 'Terhubung ke WhatsApp atau formulir pendaftaran.') ?></p>
        <div class="scope-row">
          <span><?= $landingText('Scope', 'Cakupan') ?></span>
          <div class="scope-links">
            <?php foreach ($deliverables as $deliverable): ?>
              <a href="#<?= htmlspecialchars($deliverable['id']) ?>" aria-label="<?= htmlspecialchars($deliverable['title']) ?>"><?= htmlspecialchars($deliverable['short']) ?></a>
            <?php endforeach; ?>
          </div>
        </div>

        <figure class="video">
          <div class="video-frame">
            <a class="video-cover" href="<?= htmlspecialchars($videoUrl) ?>" aria-label="<?= $landingText('Play the sample video from Chrome for Developers', 'Putar video contoh dari Chrome for Developers') ?>">
              <img src="/img/brits-landing.webp" alt="" width="767" height="497" fetchpriority="high">
              <span class="video-play" aria-hidden="true"></span>
            </a>
            <template id="campaign-video">
              <iframe src="https://www.youtube-nocookie.com/embed/<?= htmlspecialchars($videoId) ?>?autoplay=1&amp;rel=0" title="Improving Load Performance — Chrome for Developers" allow="autoplay; encrypted-media; picture-in-picture; fullscreen" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </template>
          </div>
          <figcaption><span><?= $landingText('Placeholder video', 'Video contoh sementara') ?></span><a href="<?= htmlspecialchars($videoUrl) ?>"><?= $landingText('Watch on YouTube', 'Tonton di YouTube') ?></a></figcaption>
        </figure>
        <a class="button" href="<?= htmlspecialchars($whatsAppUrl) ?>"><?= $landingText('Chat on WhatsApp', 'Diskusi via WhatsApp') ?></a>
      </div>
    </section>

    <section class="section section-compact wrap" id="layanan" aria-labelledby="services-title">
      <div class="section-heading">
        <h2 id="services-title"><?= $landingText('Four parts to <em>one service.</em>', 'Empat bagian dalam <em>satu layanan.</em>') ?></h2>
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
        <div class="media"><img src="/img/geniusgate.webp" alt="<?= $landingText('Genius Gate page showing the offer and registration button', 'Halaman Genius Gate dengan penawaran dan tombol daftar') ?>" loading="lazy" decoding="async"></div>
        <div class="split-copy">
          <h2 id="problem-title"><?= $landingText('They’ve clicked your ad.<br> <em>What do they see?</em>', 'Pengunjung sudah klik.<br> <em>Apa yang mereka lihat?</em>') ?></h2>
          <p><?= $landingText(
            'If your ad promotes a specific program, show those details as soon as visitors land on the page. Put the schedule, benefits, and registration steps together so they can take the next step right away.',
            'Jika iklan Anda menawarkan program tertentu, tampilkan detail program itu begitu pengunjung tiba. Letakkan jadwal, manfaat, dan cara mendaftar di halaman yang sama agar mereka bisa langsung mengambil langkah berikutnya.'
          ) ?></p>
          <a class="button" href="<?= htmlspecialchars($whatsAppUrl) ?>"><?= $landingText('Discuss your campaign', 'Bahas kampanye Anda') ?></a>
        </div>
      </div>
    </section>

    <section class="section wrap" aria-labelledby="outcomes-title">
      <div class="section-heading">
        <h2 id="outcomes-title"><?= $landingText('What your <em>prospects will see.</em>', 'Apa yang akan dilihat <em>calon pelanggan.</em>') ?></h2>
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
          <h2 id="clients-title"><?= $landingText('What <em>our clients say.</em>', 'Pengalaman <em>klien Digiserv.</em>') ?></h2>
          <p><?= $landingText('Feedback on Digiserv’s development projects and services.', 'Umpan balik atas proyek pengembangan dan layanan Digiserv.') ?></p>
        </div>
        <div class="grid grid-three">
          <?php foreach ($testimonials as [$name, $company, $quote, $image]): ?>
            <figure class="card card-body quote">
              <blockquote>“<?= htmlspecialchars($quote) ?>”</blockquote>
              <figcaption><img src="/img/<?= htmlspecialchars($image) ?>" alt="" width="44" height="44" loading="lazy"><span><strong><?= htmlspecialchars($name) ?></strong><small><?= htmlspecialchars($company) ?></small></span></figcaption>
            </figure>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="section wrap" id="portofolio" aria-labelledby="portfolio-title">
      <div class="section-heading">
        <h2 id="portfolio-title"><?= $landingText('See <em>our work.</em>', 'Lihat <em>hasilnya.</em>') ?></h2>
      </div>
      <div class="grid grid-three">
        <?php foreach (['Genius Gate', 'Brits Campaign Landing', 'Akar Panrita'] as $title): ?>
          <?php $project = $projects[$title]; ?>
          <figure class="card project">
            <img src="/<?= htmlspecialchars($project['image_path']) ?>" alt="<?= htmlspecialchars($landingText('Screenshot of ', 'Tampilan halaman ') . $title) ?>" loading="lazy" decoding="async">
            <figcaption class="card-body"><h3><?= htmlspecialchars($title) ?></h3><p><?= htmlspecialchars($project['description_' . $landingLanguage] ?? $project['description']) ?></p></figcaption>
          </figure>
        <?php endforeach; ?>
      </div>
      <div class="section-action"><a class="button" href="<?= htmlspecialchars($whatsAppUrl) ?>"><?= $landingText('Chat on WhatsApp', 'Diskusi via WhatsApp') ?></a></div>
    </section>

    <section class="section band" id="penawaran" aria-labelledby="package-title">
      <div class="wrap">
        <div class="section-heading">
          <p class="eyebrow"><?= $landingText('What’s included', 'Rincian layanan') ?></p>
          <h2 id="package-title"><?= $landingText('What we build <em>for your campaign.</em>', 'Yang kami kerjakan <em>untuk kampanye Anda.</em>') ?></h2>
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
              <div class="media"><img src="/<?= htmlspecialchars($project['image_path']) ?>" alt="<?= htmlspecialchars($landingText('Example project ', 'Contoh proyek ') . $project['title']) ?>" loading="lazy" decoding="async"></div>
            </section>
          <?php endforeach; ?>
        </div>
        <div class="section-action"><a class="button" href="<?= htmlspecialchars($whatsAppUrl) ?>"><?= $landingText('Request a quote', 'Minta penawaran') ?></a></div>
      </div>
    </section>

    <section class="section wrap" aria-labelledby="journey-title">
      <div class="section-heading">
        <h2 id="journey-title"><?= $landingText('From campaign page <em>to web app.</em>', 'Dari halaman kampanye <em>ke aplikasi.</em>') ?></h2>
        <p><?= $landingText('Two projects for Brits Indonesia that serve different needs.', 'Dua proyek Brits Indonesia yang melayani kebutuhan berbeda.') ?></p>
      </div>
      <div class="grid grid-two">
        <figure class="card project">
          <img src="/img/brits-landing.webp" alt="<?= $landingText('Screenshot of the Brits campaign landing page', 'Tampilan landing page kampanye Brits') ?>" loading="lazy" decoding="async">
          <figcaption class="card-body"><h3>Brits Campaign Landing</h3><p><?= $landingText('Prospective participants can explore programs and proceed to registration.', 'Calon peserta bisa melihat program dan menuju pendaftaran.') ?></p></figcaption>
        </figure>
        <figure class="card project">
          <img src="/img/brits.webp" alt="<?= $landingText('Screenshot of the Brits Tryout exam application', 'Tampilan aplikasi ujian Brits Tryout') ?>" loading="lazy" decoding="async">
          <figcaption class="card-body"><h3>Brits Tryout</h3><p><?= $landingText('Participants use a separate platform to take exams and practice tests.', 'Peserta menggunakan platform terpisah untuk mengikuti ujian dan tryout.') ?></p></figcaption>
        </figure>
      </div>
    </section>

    <section class="section band" aria-labelledby="other-work-title">
      <div class="wrap">
        <div class="section-heading">
          <h2 id="other-work-title"><?= $landingText('More <em>Digiserv projects.</em>', 'Proyek Digiserv <em>lainnya.</em>') ?></h2>
        </div>
        <div class="grid grid-two">
          <?php foreach (['Pioneer Class', 'NAV|INS CO'] as $title): ?>
            <?php $project = $projects[$title]; ?>
            <figure class="card project">
              <img src="/<?= htmlspecialchars($project['image_path']) ?>" alt="<?= htmlspecialchars($landingText('Screenshot of ', 'Tampilan proyek ') . $title) ?>" loading="lazy" decoding="async">
              <figcaption class="card-body"><h3><?= htmlspecialchars($title) ?></h3><p><?= htmlspecialchars($project['description_' . $landingLanguage] ?? $project['description']) ?></p></figcaption>
            </figure>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="section wrap" id="pratinjau" aria-labelledby="preview-title">
      <div class="section-heading">
        <h2 id="preview-title"><?= $landingText('Preview <em>the page structure.</em>', 'Pratinjau <em>isi halaman.</em>') ?></h2>
      </div>
      <div class="split preview">
        <div class="media"><img src="/img/brits-landing.webp" alt="<?= $landingText('Example layout from the Brits campaign page', 'Contoh susunan halaman kampanye Brits') ?>" loading="lazy" decoding="async"></div>
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
          <p class="eyebrow"><?= $landingText('Campaign landing page', 'Landing page kampanye') ?></p>
          <h2 id="offer-title"><?= $landingText('Get your page ready <em>before ads go live.</em>', 'Siapkan halaman <em>sebelum iklan tayang.</em>') ?></h2>
          <p><?= $landingText('Plan the messaging, design, and registration flow as one project.', 'Bahas pesan penawaran, desain, dan alur pendaftaran dalam satu proyek.') ?></p>
          <a class="button" href="<?= htmlspecialchars($whatsAppUrl) ?>"><?= $landingText('Chat on WhatsApp', 'Diskusi via WhatsApp') ?></a>
        </div>
      </div>
    </section>

    <section class="section wrap" aria-labelledby="process-title" id="proses">
      <div class="section-heading">
        <h2 id="process-title"><?= $landingText('A clear scope <em>before we start.</em>', 'Cakupan jelas <em>sebelum mulai.</em>') ?></h2>
        <p><?= $landingText('We discuss goals, requirements, and cost before work begins.', 'Kita bahas tujuan, kebutuhan, dan biaya sebelum pekerjaan dimulai.') ?></p>
      </div>
      <ol class="grid grid-three steps">
        <li class="card card-body"><h3><?= $landingText('Discuss the campaign', 'Bahas kampanye') ?></h3><p><?= $landingText('Tell us about your offer, your audience, and what you want visitors to do.', 'Ceritakan penawaran, audiens, dan tindakan yang diharapkan dari pengunjung.') ?></p></li>
        <li class="card card-body"><h3><?= $landingText('Review the design', 'Tinjau rancangan') ?></h3><p><?= $landingText('Review the flow, copy, and design before development begins.', 'Lihat alur, teks, dan desain halaman sebelum pengembangan.') ?></p></li>
        <li class="card card-body"><h3><?= $landingText('Test and launch', 'Uji dan luncurkan') ?></h3><p><?= $landingText('Test the page, buttons, and agreed forms before the campaign goes live.', 'Coba halaman, tombol, dan formulir yang disepakati sebelum kampanye berjalan.') ?></p></li>
      </ol>
    </section>

    <section class="section band" id="faq" aria-labelledby="faq-title">
      <div class="wrap narrow">
        <div class="section-heading"><h2 id="faq-title"><?= $landingText('Common <em>questions.</em>', 'Pertanyaan <em>umum.</em>') ?></h2></div>
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
        <h2 id="closing-title"><?= $landingText('Planning <em>a campaign?</em>', 'Sedang menyiapkan <em>kampanye?</em>') ?></h2>
        <p><?= $landingText('Tell us what you’re offering and where visitors should go next.', 'Ceritakan penawaran Anda dan ke mana calon pelanggan perlu diarahkan.') ?></p>
        <a class="button" href="<?= htmlspecialchars($whatsAppUrl) ?>"><?= $landingText('Chat on WhatsApp', 'Diskusi via WhatsApp') ?></a>
      </div>
    </section>
  </main>

  <footer class="campaign-footer">
    <div class="wrap footer-inner">
      <a class="wordmark" href="/"><img src="/img/logo.jpg" alt="" width="32" height="32"> Digiserv</a>
      <a href="/jasabikinwebsite/"><?= $landingText('All services', 'Semua layanan') ?></a>
    </div>
    <p class="wrap geoip-credit"><a href="https://db-ip.com/"><?= $landingText('IP geolocation by DB-IP', 'Geolokasi IP oleh DB-IP') ?></a></p>
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
