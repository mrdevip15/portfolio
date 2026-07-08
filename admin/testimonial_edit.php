<?php
session_start();
require_once __DIR__ . '/../billing/db.php';

$db = get_db_connection();

if (!isset($_SESSION['billing_auth']) || $_SESSION['billing_auth'] !== true) {
    header("Location: ../billing/index.php");
    exit;
}

$id = $_GET['id'] ?? null;
$testimonial = null;

if ($id) {
    $stmt = $db->prepare("SELECT * FROM testimonials WHERE id = ?");
    $stmt->execute([$id]);
    $testimonial = $stmt->fetch();
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_name = $_POST['client_name'];
    $company_name = $_POST['company_name'];
    $text = $_POST['testimonial'];
    $image_path = $_POST['image_path'];

    if ($id) {
        $stmt = $db->prepare("UPDATE testimonials SET client_name = ?, company_name = ?, testimonial = ?, image_path = ? WHERE id = ?");
        $stmt->execute([$client_name, $company_name, $text, $image_path, $id]);
        $message = 'Testimonial updated successfully.';
    } else {
        $stmt = $db->prepare("INSERT INTO testimonials (client_name, company_name, testimonial, image_path) VALUES (?, ?, ?, ?)");
        $stmt->execute([$client_name, $company_name, $text, $image_path]);
        $id = $db->lastInsertId();
        $message = 'Testimonial added successfully.';
    }
    // Refresh data
    $stmt = $db->prepare("SELECT * FROM testimonials WHERE id = ?");
    $stmt->execute([$id]);
    $testimonial = $stmt->fetch();
}

$pageTitle = ($id ? 'Edit Testimonial' : 'New Testimonial') . ' | Admin | Digiserv.id';
$basePath = '../';
include '../includes/header.php';
?>

<main class="max-w-4xl mx-auto px-6 py-24">
    <div class="mb-12">
        <a href="testimonials" class="text-sm font-medium text-brand-gray hover:text-brand-black transition mb-4 inline-block">&larr; Back to Testimonials</a>
        <h1 class="text-4xl font-semibold hero-title text-brand-black"><?php echo $id ? 'Edit' : 'New'; ?> <span class="editorial-italic font-normal">Testimonial</span></h1>
    </div>

    <?php if ($message): ?>
        <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-8 border border-green-100">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="bg-white border border-gray-100 rounded-3xl p-10 shadow-sm space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-xs font-bold text-brand-gray uppercase mb-3">Client Name</label>
                <input type="text" name="client_name" value="<?php echo htmlspecialchars($testimonial['client_name'] ?? ''); ?>" required
                       class="w-full bg-brand-light border border-gray-100 rounded-xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-brand-black transition">
            </div>
            <div>
                <label class="block text-xs font-bold text-brand-gray uppercase mb-3">Company / Role</label>
                <input type="text" name="company_name" value="<?php echo htmlspecialchars($testimonial['company_name'] ?? ''); ?>"
                       class="w-full bg-brand-light border border-gray-100 rounded-xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-brand-black transition">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-brand-gray uppercase mb-3">Testimonial Text</label>
            <textarea name="testimonial" rows="4" required class="w-full bg-brand-light border border-gray-100 rounded-xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-brand-black transition"><?php echo htmlspecialchars($testimonial['testimonial'] ?? ''); ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-brand-gray uppercase mb-3">Avatar Image Path (e.g., img/testimoni-1.png)</label>
            <input type="text" name="image_path" value="<?php echo htmlspecialchars($testimonial['image_path'] ?? ''); ?>"
                   class="w-full bg-brand-light border border-gray-100 rounded-xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-brand-black transition font-mono text-sm">
        </div>
        
        <div class="pt-8">
            <button type="submit" class="bg-brand-black text-white px-10 py-4 rounded-xl font-medium hover:bg-gray-800 transition shadow-xl">
                <?php echo $id ? 'Update Testimonial' : 'Save Testimonial'; ?>
            </button>
        </div>
    </form>
</main>

<?php include '../includes/footer.php'; ?>
