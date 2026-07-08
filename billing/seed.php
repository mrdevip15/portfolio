<?php
// billing/seed.php
require_once __DIR__ . '/db.php';

function run_seeding() {
    $db = get_db_connection();

    // Check if tables exist
    try {
        $db->query("SELECT 1 FROM users LIMIT 1");
    } catch (PDOException $e) {
        die("Error: Database tables do not exist. Please run migrations (migrate.php) first.\n");
    }

    echo "Starting seeding...\n";

    // 1. Seed Users (admin)
    $users = [
        [
            'username' => 'admin',
            'password_hash' => '$2y$10$y.AUrjWuXP37K5YDLFyTAeCzAYUrJuZb2AJ/N15PPBHqKp.bu/Al6'
        ]
    ];
    $stmt = $db->prepare("INSERT IGNORE INTO users (username, password_hash) VALUES (?, ?)");
    foreach ($users as $user) {
        $stmt->execute([$user['username'], $user['password_hash']]);
    }
    echo "Seeded users.\n";

    // 2. Seed Clients
    $clients = [
        [
            'name' => 'BRITS INDONESIA',
            'details' => 'Jl. Kendal Sari Barat No.17C, Tulusrejo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141'
        ]
    ];
    $stmt = $db->prepare("INSERT IGNORE INTO clients (name, details) VALUES (?, ?)");
    foreach ($clients as $client) {
        $stmt->execute([$client['name'], $client['details']]);
    }
    echo "Seeded clients.\n";

    // 3. Seed Site Settings
    $settings = [
        ['setting_key' => 'experience_years', 'setting_value' => '5+ Years'],
        ['setting_key' => 'successful_deploys', 'setting_value' => '500+'],
        ['setting_key' => 'generated_revenue', 'setting_value' => '$1M+'],
        ['setting_key' => 'client_retention', 'setting_value' => '98%']
    ];
    $stmt = $db->prepare("INSERT IGNORE INTO site_settings (setting_key, setting_value) VALUES (?, ?)");
    foreach ($settings as $setting) {
        $stmt->execute([$setting['setting_key'], $setting['setting_value']]);
    }
    echo "Seeded site settings.\n";

    // 4. Seed Projects (checks if project title already exists first)
    $projects = [
        [
            'title' => 'NAV|INS CO',
            'description' => 'Corporate website for a navigation and insurance company. Clean, professional design with a focus on brand presence and user trust.',
            'image_path' => 'img/navins.png',
            'tags' => 'Corporate, UI/UX',
            'link' => '#'
        ],
        [
            'title' => 'Brits Tryout',
            'description' => 'A comprehensive online examination and tryout platform for students. Developed with a focus on comprehensive web architecture.',
            'image_path' => 'img/brits.png',
            'tags' => 'Vue.js, IRT Scoring',
            'link' => '#'
        ]
    ];
    
    $stmt_check = $db->prepare("SELECT 1 FROM projects WHERE title = ? LIMIT 1");
    $stmt_insert = $db->prepare("INSERT INTO projects (title, description, image_path, tags, link) VALUES (?, ?, ?, ?, ?)");
    
    foreach ($projects as $project) {
        $stmt_check->execute([$project['title']]);
        if (!$stmt_check->fetch()) {
            $stmt_insert->execute([$project['title'], $project['description'], $project['image_path'], $project['tags'], $project['link']]);
            echo "Seeded project: {$project['title']}\n";
        } else {
            echo "Project already exists, skipped: {$project['title']}\n";
        }
    }

    // 5. Seed Testimonials (checks if testimonial by client + company exists first)
    $testimonials = [
        [
            'client_name' => 'Brits Indonesia',
            'company_name' => 'Supercamp #1',
            'testimonial' => 'What sets Digiserv.ID apart is their ability to handle sophisticated data requirements. They integrated a complex IRT algorithm that saved our team hundreds of hours.',
            'image_path' => 'img/testimoni-2.webp'
        ],
        [
            'client_name' => 'Agnes Gosali',
            'company_name' => 'Ruangguru',
            'testimonial' => 'The OpenClaw AI Assistant built by Digiserv has been a game-changer for our team. It significantly speeds up our productivity by automating repetitive tasks.',
            'image_path' => 'img/testimoni-3.jpeg'
        ],
        [
            'client_name' => 'Naim Syahrir',
            'company_name' => 'Navinsco',
            'testimonial' => 'Excellent work! Digiserv expertise handled our professional email setup and boosted our visibility with top-tier SEO strategies. A truly comprehensive digital partner.',
            'image_path' => 'img/testimoni-4.webp'
        ]
    ];
    
    $stmt_check = $db->prepare("SELECT 1 FROM testimonials WHERE client_name = ? AND company_name = ? LIMIT 1");
    $stmt_insert = $db->prepare("INSERT INTO testimonials (client_name, company_name, testimonial, image_path) VALUES (?, ?, ?, ?)");
    
    foreach ($testimonials as $t) {
        $stmt_check->execute([$t['client_name'], $t['company_name']]);
        if (!$stmt_check->fetch()) {
            $stmt_insert->execute([$t['client_name'], $t['company_name'], $t['testimonial'], $t['image_path']]);
            echo "Seeded testimonial for: {$t['client_name']}\n";
        } else {
            echo "Testimonial already exists, skipped: {$t['client_name']}\n";
        }
    }

    // 6. Seed Posts (checks if post slug already exists first)
    $posts = [
        [
            'title' => 'The Claw Revolution: Reshaping Web Security',
            'slug' => 'claw-revolution',
            'category' => 'Security',
            'excerpt' => 'Exploring new paradigms in distributed security systems and why the old models are failing.',
            'content' => "\n<p>Security in the modern web era is no longer about perimeter defense. It's about distributed resilience. The \"Claw\" model represents a paradigm shift where every node in a network acts as an active participant in its own defense.</p>\n<h2>The Death of the Firewall</h2>\n<p>Traditional firewalls were designed for a world where we knew exactly where the boundaries were. In today's serverless and edge-computed world, there are no boundaries. We need something more agile, more \"claw-like\" that can latch onto threats at the very edge.</p>\n<h2>Resilience Over Prevention</h2>\n<p>We've spent decades trying to prevent breaches. The Claw model assumes breaches will happen and focuses on absolute resilience — the ability to compartmentalize and heal automatically.</p>",
            'published_at' => '2026-04-15 10:00:00'
        ],
        [
            'title' => 'Analyzing Critical Vulnerabilities in Sequelize ORM',
            'slug' => 'sequelize-vuln',
            'category' => 'Backend',
            'excerpt' => 'A deep dive into common pitfalls when using ORMs in production environments.',
            'content' => "\n<p>Object-Relational Mapping (ORM) tools are powerful, but they abstract away critical database interactions that can lead to security vulnerabilities if not handled with care. Sequelize, one of the most popular ORMs for Node.js, is no exception.</p>\n<h2>The Risk of Raw Queries</h2>\n<p>While Sequelize provides a robust query builder, developers often resort to raw queries for complex logic. This is where most SQL injection vulnerabilities creep in. Always use bind parameters.</p>\n<h2>Improper Data Validation</h2>\n<p>Never trust the ORM's built-in validation as your only line of defense. Always validate at the API entry point to ensure data integrity before it even reaches the database layer.</p>",
            'published_at' => '2026-03-20 14:30:00'
        ],
        [
            'title' => 'Silent Blockers: Why Your App Feels Slow',
            'slug' => 'silent-blockers',
            'category' => 'Performance',
            'excerpt' => 'Identifying non-obvious performance bottlenecks in modern JavaScript applications.',
            'content' => "\n<p>Performance isn't just about Lighthouse scores. It's about perception. \"Silent blockers\" are the subtle bottlenecks that don't always show up in standard benchmarks but kill the user experience.</p>\n<h2>Layout Thrashing</h2>\n<p>Interweaving reads and writes to the DOM can cause the browser to re-calculate styles and layouts repeatedly within a single frame. This \"thrashing\" leads to jank that users feel instantly.</p>\n<h2>Main Thread Congestion</h2>\n<p>JavaScript is single-threaded. If you're running complex data processing on the main thread, you're blocking the UI from responding to user input. Move heavy lifting to Web Workers.</p>",
            'published_at' => '2026-02-10 09:15:00'
        ],
        [
            'title' => 'Mengapa AI Sering Gagal Membuat Aplikasi Production-Ready',
            'slug' => 'ai-failure-in-production',
            'category' => 'Case Study',
            'excerpt' => 'Anda meminta AI membuat sistem invoice. Dalam 2 menit, kodenya keluar. Tapi saat Anda mencoba mencetaknya menjadi PDF dengan 500 baris data, sistem tersebut hang.',
            'content' => "\n<p class=\"text-xl font-medium text-brand-black italic border-l-4 border-gray-100 pl-8 mb-12 leading-relaxed\">Anda meminta AI membuat sistem invoice. Dalam 2 menit, kodenya keluar. Tapi saat Anda mencoba mencetaknya menjadi PDF dengan 500 baris data, sistem tersebut hang. Mengapa?</p>\n<p>AI saat ini (LLM) bekerja berdasarkan probabilitas kata berikutnya. Ia tahu seperti apa \"bentuk\" kode yang benar, tapi ia tidak benar-benar memahami \"konteks operasional\" dari kode tersebut. Inilah tiga alasan utama mengapa aplikasi hasil prompt AI seringkali gagal di tahap produksi.</p>\n<h2>1. Kurangnya Pemahaman Terhadap Edge Cases</h2>\n<p>AI sangat bagus dalam menangani \"happy path\" — skenario di mana semuanya berjalan normal. Namun, dunia nyata penuh dengan skenario aneh. Apa yang terjadi jika koneksi internet terputus saat upload? Tanpa pengawasan manusia yang berpengalaman, <i>edge cases</i> ini akan menjadi bug yang mematikan bisnis Anda.</p>\n<h2>2. Optimasi Resource yang Buruk</h2>\n<p>AI cenderung memberikan solusi yang paling umum. Seringkali, solusi ini memakan banyak memori atau CPU karena tidak dioptimalkan untuk beban kerja spesifik. Untuk aplikasi sekolah atau kantor yang berjalan di server dengan resource terbatas, optimasi adalah kunci.</p>\n<h2>3. Maintainability (Kemudahan Perawatan)</h2>\n<p>Software yang baik bukan cuma yang jalan sekarang, tapi yang bisa diperbaiki 6 bulan lagi. Kode hasil AI seringkali sulit dipahami oleh developer manusia karena strukturnya yang tidak konsisten atau penamaan variabel yang generik.</p>",
            'published_at' => '2026-04-27 08:00:00'
        ],
        [
            'title' => 'Vibe Coding vs Production Grade: Mengapa Prompt Saja Tidak Cukup',
            'slug' => 'vibe-coding-vs-production-grade',
            'category' => 'Analysis',
            'excerpt' => 'Mengapa aplikasi hasil prompt AI seringkali gagal di tahap produksi? Mari bedah perbedaan mendalam antara kode vibe-coding instan dan standar production-grade.',
            'content' => "<blockquote><p>\"Vibe coding\" mungkin terasa menyenangkan saat Anda membangun MVP dalam 5 menit. Tapi saat aplikasi tersebut harus menangani ribuan transaksi dan pengguna aktif secara serentak, \"vibe\" saja tidak akan cukup.</p></blockquote><p>Fenomena AI coding telah mengubah lanskap rekayasa perangkat lunak secara drastis. Dengan asisten bertenaga Large Language Models (LLM) seperti ChatGPT, Claude, dan GitHub Copilot, siapa pun kini dapat menghasilkan ribuan baris kode hanya dalam hitungan detik. Lahirlah istilah baru: Vibe Coding, gaya pemrograman di mana developer hanya mengandalkan intuisi, mengetik prompt bertubi-tubi, dan mengabaikan kedalaman arsitektur selama aplikasi \"kelihatannya jalan\".</p><p>Namun di balik kecepatan fantastis tersebut, ada kenyataan pahit yang sering diabaikan. Ada jurang pemisah yang sangat lebar antara kode hasil generator AI yang sekadar berfungsi di komputer lokal, dengan kode standar industri yang siap untuk produksi (production-grade code). Ketika produk Anda mulai diakses pengguna riil secara serentak, kode yang ditulis tanpa fondasi kuat akan runtuh seketika.</p><p><strong>1. Ilusi Keberhasilan di Lingkungan Lokal (Happy Path Bias)</strong></p><p>AI dilatih untuk memecahkan masalah secara terisolasi dengan memberikan solusi tercepat yang paling umum. Ini sering disebut bias happy path, skenario di mana semua input valid, koneksi internet stabil, dan database selalu responsif.</p><p>Di dunia nyata, aplikasi bisnis hidup dalam ketidakpastian. Koneksi ke database bisa terputus sesaat, API pihak ketiga (seperti payment gateway) sering mengalami latency tinggi atau timeout, dan pengguna sering memasukkan data dengan cara-cara tak terduga. Kode produksi wajib memiliki mekanisme pertahanan seperti:</p><ul><li><strong>Graceful Degradation</strong>: menampilkan pesan error yang ramah kepada user, bukan layar putih kosong (white screen of death).</li><li><strong>Retry Mechanism &amp; Circuit Breaker</strong>: mencoba kembali request yang gagal secara otomatis, namun segera menghentikan request jika layanan pihak ketiga mati total, agar sistem tidak ikut terbebani.</li><li><strong>Validation Barrier</strong>: memvalidasi dan menyaring semua input data di layer terluar sebelum masuk ke logika bisnis atau database.</li></ul><p><strong>2. Hutang Teknis yang Tersembunyi (Technical Debt)</strong></p><p>Ketika Anda terus-menerus menyalin dan menempel kode yang disarankan AI tanpa memahaminya secara mendalam, Anda sedang menimbun hutang teknis yang besar. AI tidak memiliki gambaran arsitektur jangka panjang dari sistem Anda.</p><p>Akibatnya, kode menjadi berantakan (spaghetti code), banyak duplikasi fungsi, dan struktur folder menjadi tidak konsisten. Begitu aplikasi bertambah besar, menambahkan satu fitur kecil saja bisa merusak fitur lainnya. Kode yang diproduksi secara profesional mengutamakan modularitas, pemisahan tanggung jawab (separation of concerns), dan pola desain (design patterns) yang teruji, agar mudah dirawat (maintainable) di masa depan.</p><p><strong>3. Keamanan yang Rapuh dan Celah Eksploitasi</strong></p><p>Salah satu bahaya terbesar dari kode instan buatan AI adalah isu keamanan. AI seringkali menyarankan pustaka (library) yang sudah usang atau memiliki kerentanan bawaan. Lebih buruk lagi, AI sering menulis kueri database mentah tanpa parameter binding, yang membuka celah SQL Injection.</p><p>Selain SQL Injection, celah seperti Cross-Site Scripting (XSS) dan kebocoran kredensial (akibat menyimpan API key langsung di dalam kode, bukan di .env) sering ditemukan pada aplikasi hasil vibe coding. Standar produksi mengharuskan audit keamanan yang ketat, enkripsi data sensitif baik saat disimpan maupun dikirim, serta implementasi otorisasi yang aman.</p><p><strong>4. Performa Skala Besar: Masalah N+1 dan Kebocoran Memori</strong></p><p>Aplikasi vibe coding sering kali terasa sangat cepat saat diuji dengan 2 atau 3 baris data sampel di database lokal Anda. Namun bagaimana jika database tersebut berisi 500.000 baris data transaksi?</p><p>Di sinilah masalah performa klasik seperti N+1 Query Problem muncul (melakukan kueri database berulang-ulang di dalam sebuah perulangan). AI yang kurang optimal sering kali tidak menggunakan kueri JOIN atau teknik eager loading. Tanpa optimasi indeks database, caching memori (seperti Redis), dan pengelolaan koneksi (connection pooling), server Anda akan langsung mengalami overload (CPU 100%) begitu menerima beberapa ratus request bersamaan.</p><p><strong>5. Observabilitas: Buta Arah saat Terjadi Error</strong></p><p>Apa yang Anda lakukan ketika pengguna mengeluh transaksinya gagal, tetapi Anda tidak melihat error apa pun di layar? Pada aplikasi vibe coding, logging sering kali diabaikan, atau hanya mengandalkan perintah cetak sederhana seperti console.log or echo.</p><p>Pada standar industri, aplikasi dilengkapi dengan sistem observabilitas yang matang:</p><ul><li><strong>Structured Logging</strong>: menyimpan log dalam format JSON terstruktur dengan metadata lengkap (timestamp, user ID, request ID).</li><li><strong>Error Tracking &amp; Monitoring</strong>: mengintegrasikan tool seperti Sentry untuk menangkap error, melacak stack trace, dan mengirim alert secara real-time ke tim developer, sebelum pengguna menyadarinya.</li></ul><p><strong>AI Sebagai Co-Pilot, Bukan Pilot Tunggal</strong></p><p>AI adalah katalis produktivitas yang luar biasa untuk melipatgandakan kecepatan coding Anda. Namun tanggung jawab atas keandalan, keamanan, dan skalabilitas sistem tetap berada di tangan engineer profesional. Gunakan AI untuk bereksperimen dengan cepat, tetapi serahkan rekayasa dan standarisasi produksi pada prinsip engineering yang disiplin.</p>",
            'published_at' => '2026-04-27 15:00:00'
        ]
    ];

    $stmt_check = $db->prepare("SELECT 1 FROM posts WHERE slug = ? LIMIT 1");
    $stmt_insert = $db->prepare("INSERT INTO posts (title, slug, category, excerpt, content, published_at) VALUES (?, ?, ?, ?, ?, ?)");

    foreach ($posts as $post) {
        $stmt_check->execute([$post['slug']]);
        if (!$stmt_check->fetch()) {
            $stmt_insert->execute([$post['title'], $post['slug'], $post['category'], $post['excerpt'], $post['content'], $post['published_at']]);
            echo "Seeded post: {$post['title']}\n";
        } else {
            echo "Post already exists, skipped: {$post['title']}\n";
        }
    }

    echo "Seeding completed successfully!\n";
}

if (php_sapi_name() === 'cli') {
    run_seeding();
} else {
    session_start();
    if (isset($_SESSION['billing_auth']) && $_SESSION['billing_auth'] === true) {
        echo "<pre>";
        run_seeding();
        echo "</pre>";
    } else {
        die("Unauthorized access to seeding.");
    }
}
