<?php
/**
 * Post: Silent Blockers: Why Your App Feels Slow
 * Slug: silent-blockers
 */

return [
    'title' => 'Silent Blockers: Why Your App Feels Slow',
    'slug' => 'silent-blockers',
    'category' => 'Performance',
    'published_at' => '2026-02-10 09:15:00',
    'excerpt' => 'Identifying non-obvious performance bottlenecks in modern JavaScript applications.',
    'content' => <<<HTML
<p>Performance isn't just about Lighthouse scores. It's about perception. "Silent blockers" are the subtle bottlenecks that don't always show up in standard benchmarks but kill the user experience.</p>
<h2>Layout Thrashing</h2>
<p>Interweaving reads and writes to the DOM can cause the browser to re-calculate styles and layouts repeatedly within a single frame. This "thrashing" leads to jank that users feel instantly.</p>
<h2>Main Thread Congestion</h2>
<p>JavaScript is single-threaded. If you're running complex data processing on the main thread, you're blocking the UI from responding to user input. Move heavy lifting to Web Workers.</p>
HTML
];
