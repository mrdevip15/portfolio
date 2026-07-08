<?php
session_start();
require_once __DIR__ . '/../billing/db.php';

$db = get_db_connection();

if (!isset($_SESSION['billing_auth']) || $_SESSION['billing_auth'] !== true) {
    header("Location: ../billing/index.php");
    exit;
}

$id = $_GET['id'] ?? null;
$project = null;

if ($id) {
    $stmt = $db->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $project = $stmt->fetch();
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_path = $_POST['image_path'];
    $tags = $_POST['tags'];
    $link = $_POST['link'];

    if ($id) {
        $stmt = $db->prepare("UPDATE projects SET title = ?, description = ?, image_path = ?, tags = ?, link = ? WHERE id = ?");
        $stmt->execute([$title, $description, $image_path, $tags, $link, $id]);
        $message = 'Project updated successfully.';
    } else {
        $stmt = $db->prepare("INSERT INTO projects (title, description, image_path, tags, link) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $description, $image_path, $tags, $link]);
        $id = $db->lastInsertId();
        $message = 'Project added successfully.';
    }
    // Refresh data
    $stmt = $db->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $project = $stmt->fetch();
}

$pageTitle = ($id ? 'Edit Project' : 'New Project') . ' | Admin | Digiserv.id';
$basePath = '../';
include '../includes/header.php';
?>

<main class="max-w-4xl mx-auto px-6 py-24">
    <div class="mb-12">
        <a href="projects" class="text-sm font-medium text-brand-gray hover:text-brand-black transition mb-4 inline-block">&larr; Back to Projects</a>
        <h1 class="text-4xl font-semibold hero-title text-brand-black"><?php echo $id ? 'Edit' : 'New'; ?> <span class="editorial-italic font-normal">Project</span></h1>
    </div>

    <?php if ($message): ?>
        <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-8 border border-green-100">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="bg-white border border-gray-100 rounded-3xl p-10 shadow-sm space-y-8">
        <div>
            <label class="block text-xs font-bold text-brand-gray uppercase mb-3">Project Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($project['title'] ?? ''); ?>" required
                   class="w-full bg-brand-light border border-gray-100 rounded-xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-brand-black transition text-lg font-semibold">
        </div>

        <div>
            <label class="block text-xs font-bold text-brand-gray uppercase mb-3">Description</label>
            <textarea name="description" rows="4" class="w-full bg-brand-light border border-gray-100 rounded-xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-brand-black transition"><?php echo htmlspecialchars($project['description'] ?? ''); ?></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-xs font-bold text-brand-gray uppercase mb-3">Image Path (e.g., img/navins.png)</label>
                <input type="text" name="image_path" value="<?php echo htmlspecialchars($project['image_path'] ?? ''); ?>"
                       class="w-full bg-brand-light border border-gray-100 rounded-xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-brand-black transition font-mono text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-brand-gray uppercase mb-3">Tags (comma separated)</label>
                <input type="text" name="tags" value="<?php echo htmlspecialchars($project['tags'] ?? ''); ?>" placeholder="Corporate, UI/UX"
                       class="w-full bg-brand-light border border-gray-100 rounded-xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-brand-black transition">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-brand-gray uppercase mb-3">Project Link (External or relative)</label>
            <input type="text" name="link" value="<?php echo htmlspecialchars($project['link'] ?? ''); ?>"
                   class="w-full bg-brand-light border border-gray-100 rounded-xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-brand-black transition font-mono text-sm">
        </div>
        
        <div class="pt-8">
            <button type="submit" class="bg-brand-black text-white px-10 py-4 rounded-xl font-medium hover:bg-gray-800 transition shadow-xl">
                <?php echo $id ? 'Update Project' : 'Save Project'; ?>
            </button>
        </div>
    </form>
</main>

<?php include '../includes/footer.php'; ?>
