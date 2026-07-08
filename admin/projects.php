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
    $stmt = $db->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    $message = 'Project deleted successfully.';
}

$projects = $db->query("SELECT * FROM projects ORDER BY created_at DESC")->fetchAll();

$pageTitle = 'Manage Projects | Admin | Digiserv.id';
$basePath = '../';
include '../includes/header.php';
?>

<main class="max-w-6xl mx-auto px-6 py-24">
    <div class="mb-12 flex justify-between items-end">
        <div>
            <a href="index" class="text-sm font-medium text-brand-gray hover:text-brand-black transition mb-4 inline-block">&larr; Back to Dashboard</a>
            <h1 class="text-4xl font-semibold hero-title text-brand-black">Manage <span class="editorial-italic font-normal">Projects</span></h1>
        </div>
        <a href="project_edit" class="bg-brand-black text-white px-8 py-3 rounded-xl font-medium hover:bg-gray-800 transition">Add New Project</a>
    </div>

    <?php if ($message): ?>
        <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-8 border border-green-100">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (empty($projects)): ?>
            <div class="col-span-full p-12 text-center text-brand-gray border border-dashed border-gray-200 rounded-3xl">
                No projects found. Add your first masterpiece.
            </div>
        <?php endif; ?>
        <?php foreach ($projects as $project): ?>
            <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-sm group">
                <div class="aspect-video bg-gray-100 overflow-hidden">
                    <?php if ($project['image_path']): ?>
                        <img src="../<?php echo htmlspecialchars($project['image_path']); ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                    <?php endif; ?>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($project['title']); ?></h3>
                    <p class="text-sm text-brand-gray mb-4 line-clamp-2"><?php echo htmlspecialchars($project['description']); ?></p>
                    <div class="flex justify-between items-center">
                        <div class="flex gap-2">
                            <a href="project_edit?id=<?php echo $project['id']; ?>" class="text-xs font-bold text-brand-black hover:underline">Edit</a>
                            <a href="?delete=<?php echo $project['id']; ?>" class="text-xs font-bold text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400"><?php echo htmlspecialchars($project['tags']); ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
