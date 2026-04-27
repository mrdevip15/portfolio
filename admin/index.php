<?php
session_start();
require_once __DIR__ . '/../billing/db.php';

$db = get_db_connection();

// Simple auth check (using the same session as billing for now)
if (!isset($_SESSION['billing_auth']) || $_SESSION['billing_auth'] !== true) {
    header("Location: ../billing/index.php");
    exit;
}

// Fetch stats for dashboard
$post_count = $db->query("SELECT COUNT(*) FROM posts")->fetchColumn();
$client_count = $db->query("SELECT COUNT(*) FROM clients")->fetchColumn();
$invoice_count = $db->query("SELECT COUNT(*) FROM invoices")->fetchColumn();
$project_count = $db->query("SELECT COUNT(*) FROM projects")->fetchColumn();

$pageTitle = 'Admin Dashboard | Digiserv.id';
$basePath = '../';
include '../includes/header.php';
?>

<main class="max-w-6xl mx-auto px-6 py-24">
    <div class="flex justify-between items-center mb-12">
        <h1 class="text-4xl font-semibold hero-title text-brand-black">Admin <span class="editorial-italic font-normal">Dashboard</span></h1>
        <a href="../billing/index.php?logout=1" class="text-sm font-medium text-red-600 hover:text-red-800">Sign Out</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-brand-light p-8 rounded-3xl border border-gray-100">
            <div class="text-xs font-bold text-brand-gray uppercase mb-2">Total Posts</div>
            <div class="text-3xl font-semibold"><?php echo $post_count; ?></div>
        </div>
        <div class="bg-brand-light p-8 rounded-3xl border border-gray-100">
            <div class="text-xs font-bold text-brand-gray uppercase mb-2">Clients</div>
            <div class="text-3xl font-semibold"><?php echo $client_count; ?></div>
        </div>
        <div class="bg-brand-light p-8 rounded-3xl border border-gray-100">
            <div class="text-xs font-bold text-brand-gray uppercase mb-2">Invoices</div>
            <div class="text-3xl font-semibold"><?php echo $invoice_count; ?></div>
        </div>
        <div class="bg-brand-light p-8 rounded-3xl border border-gray-100">
            <div class="text-xs font-bold text-brand-gray uppercase mb-2">Projects</div>
            <div class="text-3xl font-semibold"><?php echo $project_count; ?></div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <section>
            <h2 class="text-2xl font-semibold mb-6">Quick Links</h2>
            <div class="space-y-4">
                <a href="posts.php" class="block p-6 bg-white border border-gray-100 rounded-2xl hover:shadow-lg transition">
                    <div class="font-semibold text-brand-black">Manage Blog Posts</div>
                    <div class="text-sm text-brand-gray">Create, edit, or delete articles in the engineering journal.</div>
                </a>
                <a href="../billing/index.php" class="block p-6 bg-white border border-gray-100 rounded-2xl hover:shadow-lg transition">
                    <div class="font-semibold text-brand-black">Invoice System</div>
                    <div class="text-sm text-brand-gray">Generate and manage client invoices and billing.</div>
                </a>
                <a href="projects.php" class="block p-6 bg-white border border-gray-100 rounded-2xl hover:shadow-lg transition">
                    <div class="font-semibold text-brand-black">Selected Work</div>
                    <div class="text-sm text-brand-gray">Update your portfolio projects and case studies.</div>
                </a>
                <a href="settings.php" class="block p-6 bg-white border border-gray-100 rounded-2xl hover:shadow-lg transition">
                    <div class="font-semibold text-brand-black">Site Settings</div>
                    <div class="text-sm text-brand-gray">Update experience stats and other global content.</div>
                </a>
            </div>
        </section>

        <section>
            <h2 class="text-2xl font-semibold mb-6">Recent Activity</h2>
            <div class="bg-brand-light p-8 rounded-3xl border border-gray-100">
                <p class="text-sm text-brand-gray">Database connected to: <span class="font-mono text-brand-black"><?php echo USE_SQLITE ? 'SQLite' : 'MySQL'; ?></span></p>
                <div class="mt-8 space-y-4">
                    <div class="text-sm border-l-2 border-brand-black pl-4">
                        <div class="font-medium">System Ready</div>
                        <div class="text-xs text-brand-gray">Admin dashboard initialized.</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
