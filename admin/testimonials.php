<?php
session_start();
require_once __DIR__ . '/../billing/db.php';

$db = get_db_connection();

if (!isset($_SESSION['billing_auth']) || $_SESSION['billing_auth'] !== true) {
    header("Location: ../billing/index.php");
    exit;
}

$message = '';
if (isset($_GET['delete'])) {
    $stmt = $db->prepare("DELETE FROM testimonials WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    $message = 'Testimonial deleted successfully.';
}

$testimonials = $db->query("SELECT * FROM testimonials ORDER BY created_at DESC")->fetchAll();

$pageTitle = 'Manage Testimonials | Admin | Digiserv.id';
$basePath = '../';
include '../includes/header.php';
?>

<main class="max-w-6xl mx-auto px-6 py-24">
    <div class="mb-12 flex justify-between items-end">
        <div>
            <a href="index" class="text-sm font-medium text-brand-gray hover:text-brand-black transition mb-4 inline-block">&larr; Back to Dashboard</a>
            <h1 class="text-4xl font-semibold hero-title text-brand-black">Manage <span class="editorial-italic font-normal">Testimonials</span></h1>
        </div>
        <a href="testimonial_edit" class="bg-brand-black text-white px-8 py-3 rounded-xl font-medium hover:bg-gray-800 transition">Add New Testimonial</a>
    </div>

    <?php if ($message): ?>
        <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-8 border border-green-100">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (empty($testimonials)): ?>
            <div class="col-span-full p-12 text-center text-brand-gray border border-dashed border-gray-200 rounded-3xl">
                No testimonials found.
            </div>
        <?php endif; ?>
        <?php foreach ($testimonials as $t): ?>
            <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-sm">
                <p class="text-brand-gray text-sm italic mb-6 leading-relaxed">"<?php echo htmlspecialchars($t['testimonial']); ?>"</p>
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <img src="../<?php echo htmlspecialchars($t['image_path']); ?>" class="w-10 h-10 rounded-full grayscale">
                        <div>
                            <div class="text-sm font-bold text-brand-black"><?php echo htmlspecialchars($t['client_name']); ?></div>
                            <div class="text-[10px] text-brand-gray uppercase tracking-widest"><?php echo htmlspecialchars($t['company_name']); ?></div>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <a href="testimonial_edit?id=<?php echo $t['id']; ?>" class="text-xs font-bold text-brand-black hover:underline">Edit</a>
                        <a href="?delete=<?php echo $t['id']; ?>" class="text-xs font-bold text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
