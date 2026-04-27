<?php
$pageTitle = 'Silent Blockers | Portfolio Blog | Digiserv.id';
$basePath = '../';
include '../includes/header.php';
?>

<main class="max-w-3xl mx-auto px-6 py-24">
  <article>
    <div class="text-xs font-semibold tracking-widest text-brand-gray mb-6 uppercase">Performance // 2026.02.10</div>
    <h1 class="text-4xl font-semibold hero-title text-brand-black mb-12 md:text-6xl">Silent Blockers: Why Your App <span class="editorial-italic font-normal">Feels Slow.</span></h1>
    <p>Performance isn't just about Lighthouse scores. It's about perception. "Silent blockers" are the subtle bottlenecks that don't always show up in standard benchmarks but kill the user experience.</p>
    <h2>Layout Thrashing</h2>
    <p>Interweaving reads and writes to the DOM can cause the browser to re-calculate styles and layouts repeatedly within a single frame. This "thrashing" leads to jank that users feel instantly.</p>
    <h2>Main Thread Congestion</h2>
    <p>JavaScript is single-threaded. If you're running complex data processing on the main thread, you're blocking the UI from responding to user input. Move heavy lifting to Web Workers.</p>
  </article>
</main>

<?php include '../includes/footer.php'; ?>
