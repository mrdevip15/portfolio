<?php
require_once '../billing/db.php';
$db = get_db_connection();

$slug = $_GET['slug'] ?? '';
$stmt = $db->prepare("SELECT * FROM posts WHERE slug = ?");
$stmt->execute([$slug]);
$post = $stmt->fetch();

if (!$post) {
    header("Location: index");
    exit;
}

$pageTitle = $post['title'] . ' | Digiserv.id';
$pageDescription = $post['excerpt'];
$basePath = '../';
include '../includes/header.php';
?>

<main class="max-w-3xl mx-auto px-6 py-24">
  <article>
    <div class="text-xs font-semibold tracking-widest text-brand-gray mb-6 uppercase"><?php echo htmlspecialchars($post['category']); ?> // <?php echo date('Y.m.d', strtotime($post['published_at'])); ?></div>
    <h1 class="text-4xl font-semibold hero-title text-brand-black mb-12 md:text-6xl"><?php echo htmlspecialchars($post['title']); ?></h1>
    
    <div class="prose prose-lg max-w-none">
        <?php echo $post['content']; ?>
    </div>

    <?php if ($post['category'] === 'Case Study' || $post['category'] === 'Analysis'): ?>
    <div class="bg-brand-light p-10 rounded-3xl border border-gray-100 mt-16 text-center">
      <h3 class="text-2xl font-semibold mb-6">Upgrade to Production</h3>
      <p class="text-brand-gray text-sm mb-8">Jangan biarkan operasional bisnis Anda bergantung pada kode yang rapuh. Gunakan AI sebagai alat bantu, tapi serahkan standarisasi produksi pada ahlinya.</p>
      <a class="bg-brand-black text-white px-10 py-4 rounded-2xl font-medium inline-block transition hover:bg-gray-800" href="../index#contact">Hubungi Kami Sekarang</a>
    </div>
    <?php endif; ?>
  </article>
</main>

<?php include '../includes/footer.php'; ?>
