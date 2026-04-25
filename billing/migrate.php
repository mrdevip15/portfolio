<?php
// billing/migrate.php
require_once __DIR__ . '/db.php';

function run_migrations() {
    $db = get_db_connection();

    // Create migrations table if not exists
    $db->exec("CREATE TABLE IF NOT EXISTS migrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        migration_name VARCHAR(255) NOT NULL,
        executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    $executed_migrations = $db->query("SELECT migration_name FROM migrations")->fetchAll(PDO::FETCH_COLUMN);

    $migration_files = glob(__DIR__ . '/migrations/*.sql');
    sort($migration_files);

    foreach ($migration_files as $file) {
        $name = basename($file);
        if (!in_array($name, $executed_migrations)) {
            echo "Executing migration: $name... ";
            $sql = file_get_contents($file);
            try {
                $db->exec($sql);
                
                $stmt = $db->prepare("INSERT INTO migrations (migration_name) VALUES (?)");
                $stmt->execute([$name]);
                echo "Done.\n";
            } catch (PDOException $e) {
                echo "Failed: " . $e->getMessage() . "\n";
                exit(1);
            }
        }
    }
}

// Check if running from CLI or if an authorized user is doing it via web
if (php_sapi_name() === 'cli') {
    run_migrations();
} else {
    session_start();
    if (isset($_SESSION['billing_auth']) && $_SESSION['billing_auth'] === true) {
        echo "<pre>";
        run_migrations();
        echo "Migrations completed successfully.";
        echo "</pre>";
    } else {
        die("Unauthorized access to migrations.");
    }
}
