<?php
session_start();
require_once __DIR__ . '/../billing/db.php';

$db = get_db_connection();

if (!isset($_SESSION['billing_auth']) || $_SESSION['billing_auth'] !== true) {
    header("Location: ../billing/index.php");
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['settings'] as $key => $value) {
        $stmt = $db->prepare("UPDATE site_settings SET setting_value = ? WHERE setting_key = ?");
        $stmt->execute([$value, $key]);
    }
    $message = 'Settings updated successfully.';
}

$settings = $db->query("SELECT * FROM site_settings")->fetchAll();

$pageTitle = 'Site Settings | Admin | Digiserv.id';
$basePath = '../';
include '../includes/header.php';
?>

<main class="max-w-4xl mx-auto px-6 py-24">
    <div class="mb-12">
        <a href="index" class="text-sm font-medium text-brand-gray hover:text-brand-black transition mb-4 inline-block">&larr; Back to Dashboard</a>
        <h1 class="text-4xl font-semibold hero-title text-brand-black">Site <span class="editorial-italic font-normal">Settings</span></h1>
    </div>

    <?php if ($message): ?>
        <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-8 border border-green-100">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="bg-white border border-gray-100 rounded-3xl p-10 shadow-sm">
        <div class="space-y-8">
            <?php foreach ($settings as $setting): ?>
                <div>
                    <label class="block text-xs font-bold text-brand-gray uppercase mb-3">
                        <?php echo str_replace('_', ' ', $setting['setting_key']); ?>
                    </label>
                    <input type="text" 
                           name="settings[<?php echo $setting['setting_key']; ?>]" 
                           value="<?php echo htmlspecialchars($setting['setting_value']); ?>" 
                           class="w-full bg-brand-light border border-gray-100 rounded-xl px-6 py-4 focus:outline-none focus:ring-2 focus:ring-brand-black transition">
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="mt-12">
            <button type="submit" class="bg-brand-black text-white px-10 py-4 rounded-xl font-medium hover:bg-gray-800 transition shadow-xl">
                Save Settings
            </button>
        </div>
    </form>
</main>

<?php include '../includes/footer.php'; ?>
