<?php
require_once '../billing/db.php';
$db = get_db_connection();

$posts = $db->query("SELECT * FROM posts ORDER BY published_at DESC")->fetchAll();

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
    <?php foreach ($posts as $post): ?>
    <a class="group block py-10 border-b border-gray-100" href="<?php echo htmlspecialchars($post['slug']); ?>">
      <div class="text-xs font-bold tracking-widest text-brand-gray mb-3 uppercase"><?php echo htmlspecialchars($post['category']); ?> // <?php echo date('Y.m.d', strtotime($post['published_at'])); ?></div>
      <h2 class="text-3xl font-semibold mb-4 transition group-hover:text-brand-black"><?php echo htmlspecialchars($post['title']); ?></h2>
      <p class="text-brand-gray leading-relaxed"><?php echo htmlspecialchars($post['excerpt']); ?></p>
    </a>
    <?php endforeach; ?>
  </section>
</main>

<?php include '../includes/footer.php'; ?>
