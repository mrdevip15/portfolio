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
    $stmt = $db->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    $message = 'Post deleted successfully.';
}

$posts = $db->query("SELECT * FROM posts ORDER BY published_at DESC")->fetchAll();

$pageTitle = 'Manage Posts | Admin | Digiserv.id';
$basePath = '../';
include '../includes/header.php';
?>

<main class="max-w-6xl mx-auto px-6 py-24">
    <div class="mb-12 flex justify-between items-end">
        <div>
            <a href="index" class="text-sm font-medium text-brand-gray hover:text-brand-black transition mb-4 inline-block">&larr; Back to Dashboard</a>
            <h1 class="text-4xl font-semibold hero-title text-brand-black">Manage <span class="editorial-italic font-normal">Journal</span></h1>
        </div>
        <a href="post_edit" class="bg-brand-black text-white px-8 py-3 rounded-xl font-medium hover:bg-gray-800 transition">Create New Post</a>
    </div>

    <?php if ($message): ?>
        <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-8 border border-green-100">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-sm">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-brand-light border-b border-gray-100">
                    <th class="px-8 py-6 text-xs font-bold text-brand-gray uppercase">Title</th>
                    <th class="px-8 py-6 text-xs font-bold text-brand-gray uppercase">Category</th>
                    <th class="px-8 py-6 text-xs font-bold text-brand-gray uppercase">Date</th>
                    <th class="px-8 py-6 text-xs font-bold text-brand-gray uppercase text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if (empty($posts)): ?>
                    <tr>
                        <td colspan="4" class="px-8 py-12 text-center text-brand-gray">No posts found. Start by creating one.</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($posts as $post): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-8 py-6 font-semibold text-brand-black"><?php echo htmlspecialchars($post['title']); ?></td>
                        <td class="px-8 py-6"><span class="bg-gray-100 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest"><?php echo htmlspecialchars($post['category']); ?></span></td>
                        <td class="px-8 py-6 text-sm text-brand-gray"><?php echo date('Y-m-d', strtotime($post['published_at'])); ?></td>
                        <td class="px-8 py-6 text-right space-x-4">
                            <a href="post_edit?id=<?php echo $post['id']; ?>" class="text-sm font-bold text-brand-black hover:underline">Edit</a>
                            <a href="?delete=<?php echo $post['id']; ?>" class="text-sm font-bold text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
