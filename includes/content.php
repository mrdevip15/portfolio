<?php
// includes/content.php
// Flat-file content loader for projects and journal posts

/**
 * Get all projects from content/projects.php
 *
 * @return array
 */
function get_projects(): array {
    $file = __DIR__ . '/../content/projects.php';
    if (file_exists($file)) {
        $data = require $file;
        return is_array($data) ? $data : [];
    }
    return [];
}

/**
 * Get all blog/journal posts sorted by published_at DESC
 *
 * @return array
 */
function get_posts(): array {
    $dir = __DIR__ . '/../content/posts';
    $posts = [];
    if (is_dir($dir)) {
        $files = glob($dir . '/*.php');
        foreach ($files as $file) {
            $post = require $file;
            if (is_array($post)) {
                // Ensure slug is set if missing
                if (empty($post['slug'])) {
                    $post['slug'] = basename($file, '.php');
                }
                $posts[] = $post;
            }
        }
        usort($posts, function ($a, $b) {
            $timeA = isset($a['published_at']) ? strtotime($a['published_at']) : 0;
            $timeB = isset($b['published_at']) ? strtotime($b['published_at']) : 0;
            return $timeB <=> $timeA;
        });
    }
    return $posts;
}

/**
 * Get a single post by slug
 *
 * @param string $slug
 * @return array|null
 */
function get_post_by_slug(string $slug): ?array {
    $slug = basename($slug);
    $file = __DIR__ . '/../content/posts/' . $slug . '.php';
    if (file_exists($file)) {
        $post = require $file;
        if (is_array($post)) {
            if (empty($post['slug'])) {
                $post['slug'] = $slug;
            }
            return $post;
        }
    }
    return null;
}
