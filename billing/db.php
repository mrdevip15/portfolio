<?php
// billing/db.php
require_once __DIR__ . '/config.php';

function get_db_connection() {
    try {
        if (defined('USE_SQLITE') && USE_SQLITE) {
            $dsn = "sqlite:" . SQLITE_PATH;
            $db = new PDO($dsn);
        } else {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $db = new PDO($dsn, DB_USER, DB_PASS);
        }
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $db;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}
