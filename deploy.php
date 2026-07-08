<?php
// deploy.php
// GitHub Webhook Auto-Deployment Script for cPanel

// 1. Security Token (Change this to a custom token for your setup)
$secret_token = "DigiservDeployToken2026!";

if (!isset($_GET['token']) || $_GET['token'] !== $secret_token) {
    header('HTTP/1.0 403 Forbidden');
    die('Unauthorized: Invalid or missing token.');
}

// 2. Define repository path
$repo_path = "/home/dige2484/repositories/portfolio";

if (!is_dir($repo_path)) {
    die("Error: Repository path not found.");
}

// 3. Change directory to repository path
chdir($repo_path);

// 4. Perform Git pull and trigger cPanel deployment
echo "<pre>";
echo "=== Starting Git Pull ===\n";
$pull_output = [];
exec("git pull origin main 2>&1", $pull_output);
echo implode("\n", $pull_output) . "\n\n";

echo "=== Starting cPanel Deployment ===\n";
$deploy_output = [];
exec("/usr/local/cpanel/bin/git-deploy 2>&1", $deploy_output);
echo implode("\n", $deploy_output) . "\n";
echo "=== Deployment Finished ===\n";
echo "</pre>";
