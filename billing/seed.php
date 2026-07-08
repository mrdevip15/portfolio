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
