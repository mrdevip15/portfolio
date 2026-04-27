<?php
$pageTitle = 'Blog | Engineering Insights | Digiserv.id';
$basePath = '../';
include '../includes/header.php';
?>

<main class="max-w-4xl mx-auto px-6 py-24">
  <section class="mb-20">
    <h1 class="text-5xl font-semibold hero-title text-brand-black mb-8 md:text-7xl">Engineering <span class="editorial-italic font-normal">Journal.</span></h1>
    <p class="text-xl text-brand-gray leading-relaxed">Thoughts on software architecture, automation, and the future of web engineering.</p>
  </section>
  <section class="space-y-12">
    <a class="group block py-10 border-b border-gray-100" href="claw-revolution.php">
      <div class="text-xs font-bold tracking-widest text-brand-gray mb-3 uppercase">Security // 2026.04.15</div>
      <h2 class="text-3xl font-semibold mb-4 transition group-hover:text-brand-black">The Claw Revolution: Reshaping Web Security</h2>
      <p class="text-brand-gray leading-relaxed">Exploring new paradigms in distributed security systems and why the old models are failing.</p>
    </a>
    <a class="group block py-10 border-b border-gray-100" href="sequelize-vuln.php">
      <div class="text-xs font-bold tracking-widest text-brand-gray mb-3 uppercase">Backend // 2026.03.20</div>
      <h2 class="text-3xl font-semibold mb-4 transition group-hover:text-brand-black">Analyzing Critical Vulnerabilities in Sequelize ORM</h2>
      <p class="text-brand-gray leading-relaxed">A deep dive into common pitfalls when using ORMs in production environments.</p>
    </a>
    <a class="group block py-10 border-b border-gray-100" href="silent-blockers.php">
      <div class="text-xs font-bold tracking-widest text-brand-gray mb-3 uppercase">Performance // 2026.02.10</div>
      <h2 class="text-3xl font-semibold mb-4 transition group-hover:text-brand-black">Silent Blockers: Why Your App Feels Slow</h2>
      <p class="text-brand-gray leading-relaxed">Identifying non-obvious performance bottlenecks in modern JavaScript applications.</p>
    </a>
  </section>
</main>

<?php include '../includes/footer.php'; ?>
