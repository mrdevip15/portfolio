<?php
// router.php
// Helper router for the PHP built-in web server

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 1. If it's a directory and lacks a trailing slash, redirect to have a trailing slash (to match Apache behavior)
if (is_dir(__DIR__ . $uri) && substr($uri, -1) !== '/') {
    header("Location: " . $uri . "/", true, 301);
    exit;
}

// 2. Serve index.php inside directory if directory is requested
if (is_dir(__DIR__ . $uri)) {
    $directoryIndex = rtrim(__DIR__ . $uri, '/') . '/index.php';
    if (file_exists($directoryIndex)) {
        chdir(dirname($directoryIndex));
        include basename($directoryIndex);
        exit;
    }
}

// 3. Serve static files (images, css, js, etc.) directly if they exist on disk
if ($uri !== '/' && file_exists(__DIR__ . $uri) && !is_dir(__DIR__ . $uri)) {
    return false; // Let the built-in server handle the request
}

// 4. Handle Blog post routing (matches .htaccess: blog/slug -> blog/post.php?slug=slug)
if (preg_match('#^/blog/([^/]+)$#', $uri, $matches)) {
    $_GET['slug'] = $matches[1];
    chdir(__DIR__ . '/blog');
    include 'post.php';
    exit;
}

// 5. Map clean extensionless URLs (e.g., /admin/posts -> /admin/posts.php)
$cleanPath = __DIR__ . $uri . '.php';
if (file_exists($cleanPath)) {
    chdir(dirname($cleanPath));
    include basename($cleanPath);
    exit;
}

// 6. Default fallback to root index.php
include __DIR__ . '/index.php';
