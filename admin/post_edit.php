<?php
session_start();
require_once __DIR__ . '/../billing/db.php';

$db = get_db_connection();

if (!isset($_SESSION['billing_auth']) || $_SESSION['billing_auth'] !== true) {
    header("Location: ../billing/index.php");
    exit;
}

$id = $_GET['id'] ?? null;
$post = null;

if ($id) {
    $stmt = $db->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch();
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $slug = $_POST['slug'] ?: strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    $category = $_POST['category'];
    $excerpt = $_POST['excerpt'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'] ?: date('Y-m-d H:i:s');

    if ($id) {
        $stmt = $db->prepare("UPDATE posts SET title = ?, slug = ?, category = ?, excerpt = ?, content = ?, published_at = ? WHERE id = ?");
        $stmt->execute([$title, $slug, $category, $excerpt, $content, $published_at, $id]);
        $message = 'Post updated successfully.';
    } else {
        $stmt = $db->prepare("INSERT INTO posts (title, slug, category, excerpt, content, published_at) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $slug, $category, $excerpt, $content, $published_at]);
        $id = $db->lastInsertId();
        $message = 'Post created successfully.';
    }
    // Refresh post data
    $stmt = $db->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch();
}

$pageTitle = ($id ? 'Edit Post' : 'New Post') . ' | Admin | Digiserv.id';
$basePath = '../';
include '../includes/header.php';
?>

<main class="max-w-4xl mx-auto px-6 py-24">
    <div class="mb-12">
        <a href="posts" class="text-sm font-medium text-brand-gray hover:text-brand-black transition mb-4 inline-block">&larr; Back to Posts</a>
        <h1 class="text-4xl font-semibold hero-title text-brand-black"><?php echo $id ? 'Edit' : 'New'; ?> <span class="editorial-italic font-normal">Post</span></h1>
    </div>

    <?php if ($message): ?>
        <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-8 border border-green-100">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="bg-white border border-gray-100 rounded-3xl p-10 shadow-sm space-y-8">
        <div>
            <label class="block text-xs font-bold text-brand-gray uppercase mb-3">Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($post['title'] ?? ''); ?>" required
                   class="w-full bg-brand-light border border-gray-100 rounded-xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-brand-black transition text-lg font-semibold">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-xs font-bold text-brand-gray uppercase mb-3">Slug (Optional)</label>
                <input type="text" name="slug" value="<?php echo htmlspecialchars($post['slug'] ?? ''); ?>" placeholder="auto-generated-from-title"
                       class="w-full bg-brand-light border border-gray-100 rounded-xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-brand-black transition">
            </div>
            <div>
                <label class="block text-xs font-bold text-brand-gray uppercase mb-3">Category</label>
                <input type="text" name="category" value="<?php echo htmlspecialchars($post['category'] ?? ''); ?>" placeholder="e.g., Security, Backend"
                       class="w-full bg-brand-light border border-gray-100 rounded-xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-brand-black transition">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-brand-gray uppercase mb-3">Excerpt</label>
            <textarea name="excerpt" rows="3" class="w-full bg-brand-light border border-gray-100 rounded-xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-brand-black transition"><?php echo htmlspecialchars($post['excerpt'] ?? ''); ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-brand-gray uppercase mb-3">Content</label>
            <textarea id="editor" name="content" class="w-full bg-brand-light border border-gray-100 rounded-xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-brand-black transition text-sm"><?php echo htmlspecialchars($post['content'] ?? ''); ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-brand-gray uppercase mb-3">Publish Date</label>
            <input type="datetime-local" name="published_at" value="<?php echo $post ? date('Y-m-d\TH:i', strtotime($post['published_at'])) : date('Y-m-d\TH:i'); ?>"
                   class="w-full bg-brand-light border border-gray-100 rounded-xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-brand-black transition">
        </div>
        
        <div class="pt-8">
            <button type="submit" class="bg-brand-black text-white px-10 py-4 rounded-xl font-medium hover:bg-gray-800 transition shadow-xl">
                <?php echo $id ? 'Update Post' : 'Create Post'; ?>
            </button>
        </div>
    </form>
</main>

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<style>
/* Custom CKEditor Styling to match Digiserv Theme */
.ck-editor__editable_inline {
    min-height: 400px;
    padding: 1.5rem !important;
    font-size: 0.95rem;
    line-height: 1.6;
}
.ck.ck-editor {
    border-radius: 16px !important;
    overflow: hidden;
}
.ck.ck-toolbar {
    background: #FAFAFA !important;
    border-color: #EAEAEA !important;
    padding: 0.75rem 1rem !important;
}
.ck.ck-content {
    border-color: #EAEAEA !important;
    border-radius: 0 0 16px 16px !important;
}
.ck.ck-editor__editable:not(.ck-editor__nested-editable).ck-focused {
    border-color: #0A0A0A !important;
    box-shadow: 0 0 0 2px rgba(10, 10, 10, 0.05) !important;
}
</style>
<script>
ClassicEditor
    .create(document.querySelector('#editor'), {
        toolbar: {
            items: [
                'heading', '|',
                'bold', 'italic', 'link', '|',
                'bulletedList', 'numberedList', 'blockQuote', '|',
                'insertTable', 'undo', 'redo'
            ]
        }
    })
    .catch(error => {
        console.error(error);
    });
</script>

<?php include '../includes/footer.php'; ?>
