<?php
session_start();
require_once __DIR__ . '/db.php';

$db = get_db_connection();

// Generate CSRF token if not exists
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Rate limiting: max 5 attempts per 10 minutes
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_attempt_time'] = time();
}

if (time() - $_SESSION['last_attempt_time'] > 600) {
    $_SESSION['login_attempts'] = 0;
}

if (isset($_POST['login_password'])) {
    // CSRF Validation
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = "Kesalahan validasi keamanan (CSRF).";
    } elseif ($_SESSION['login_attempts'] >= 5) {
        $error = "Terlalu banyak percobaan. Silakan coba lagi nanti.";
    } else {
        // Mixed Multi-Algorithm Hash Chain (matches original logic)
        $pass = $_POST['login_password'];
        $pass = hash('sha256', $pass);
        $pass = hash('sha512', $pass);
        $pass = hash('ripemd160', $pass);

        $stmt = $db->prepare("SELECT password_hash FROM users WHERE username = 'admin'");
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($pass, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['billing_auth'] = true;
            $_SESSION['login_attempts'] = 0;
            // Regenerate CSRF token after login
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        } else {
            $_SESSION['login_attempts']++;
            $_SESSION['last_attempt_time'] = time();
            $error = "Akses ditolak. Kata sandi salah.";
        }
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$authenticated = isset($_SESSION['billing_auth']) && $_SESSION['billing_auth'] === true;

// Fetch clients from database
$clients = [];
$next_invoice_no = "INV/" . date('Ymd') . "/001";
if ($authenticated) {
    $clients = $db->query("SELECT * FROM clients ORDER BY name ASC")->fetchAll();
    
    // Calculate next invoice number
    $today_pattern = "INV/" . date('Ymd') . "/%";
    $stmt = $db->prepare("SELECT invoice_no FROM invoices WHERE invoice_no LIKE ? ORDER BY id DESC LIMIT 1");
    $stmt->execute([$today_pattern]);
    $last_invoice = $stmt->fetch();

    if ($last_invoice) {
        $parts = explode('/', $last_invoice['invoice_no']);
        $last_seq = (int) end($parts);
        $next_seq = str_pad($last_seq + 1, 3, '0', STR_PAD_LEFT);
        $next_invoice_no = "INV/" . date('Ymd') . "/" . $next_seq;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generator Invoice | Digiserv.ID</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0a0b0f;
            --surface: #111318;
            --surface2: #181c24;
            --border: rgba(255, 255, 255, 0.07);
            --accent: #c8a96e;
            --text: #f0ede8;
            --muted: #7a7d8a;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 10px;
        }

        .container {
            width: 100%;
            max-width: 600px;
            padding: 25px;
            background: var(--surface);
            border: 1px solid var(--border);
            position: relative;
        }

        .container::before {
            content: '';
            position: absolute;
            top: -1px;
            left: 20px;
            right: 20px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
        }

        h1 { font-family: 'Playfair Display', serif; font-size: 24px; margin-bottom: 15px; }
        h1 span { color: var(--accent); }

        .form-group { margin-bottom: 12px; }
        label { display: block; font-size: 10px; text-transform: uppercase; letter-spacing: 0.1em; color: var(--muted); margin-bottom: 4px; }

        input, textarea, select {
            width: 100%;
            background: var(--surface2);
            border: 1px solid var(--border);
            padding: 8px;
            color: var(--text);
            font-size: 13px;
            outline: none;
        }

        input:focus { border-color: var(--accent); }

        .btn {
            background: var(--accent);
            color: var(--bg);
            border: none;
            padding: 10px;
            font-weight: 600;
            text-transform: uppercase;
            cursor: pointer;
            width: 100%;
            margin-top: 5px;
        }

        .btn-add {
            background: transparent;
            border: 1px dashed var(--accent);
            color: var(--accent);
            padding: 6px;
            font-size: 11px;
            margin-bottom: 15px;
        }

        .item-row {
            display: grid;
            grid-template-columns: 2fr 0.5fr 1fr 40px;
            gap: 10px;
            margin-bottom: 8px;
            align-items: center;
        }

        .btn-remove {
            background: #ff4444;
            color: white;
            border: none;
            padding: 8px;
            cursor: pointer;
            font-size: 12px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logout { display: block; text-align: center; margin-top: 15px; color: var(--muted); text-decoration: none; font-size: 11px; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .error { color: #ff4444; font-size: 12px; margin-bottom: 15px; text-align: center; }
    </style>
</head>
<body>

<div class="container">
    <?php if (!$authenticated): ?>
        <h1>Admin <span>Login</span></h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="form-group">
                <label>Kata Sandi Akses</label>
                <input type="password" name="login_password" required autofocus>
            </div>
            <button type="submit" class="btn">Masuk ke Sistem</button>
        </form>
    <?php else: ?>
        <h1>Buat <span>Invoice</span></h1>
        <form action="./view" method="POST" target="_blank">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <script>
                // Memastikan URL berakhir dengan / agar path relatif ./view.php benar
                if (!window.location.pathname.endsWith('/')) {
                    window.history.replaceState(null, '', window.location.pathname + '/');
                }
            </script>
            <div class="form-group">
                <label>Pilih Klien</label>
                <select id="client_selector" onchange="updateClientDetails()">
                    <option value="">-- Input Manual --</option>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?php echo htmlspecialchars($client['name']); ?>" data-addr="<?php echo htmlspecialchars($client['details']); ?>"><?php echo htmlspecialchars($client['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Nama Klien</label>
                <input type="text" name="client_name" id="client_name" placeholder="Contoh: PT. Maju Jaya" required>
            </div>
            <div class="form-group">
                <label>Detail / Alamat Klien</label>
                <textarea name="client_details" id="client_details" rows="2"></textarea>
            </div>
            <div class="grid-2">
                <div class="form-group">
                    <label>Nomor Invoice</label>
                    <input type="text" name="invoice_no" value="<?php echo $next_invoice_no; ?>">
                </div>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Mata Uang</label>
                        <input type="text" name="currency" value="Rp" placeholder="Rp atau $">
                    </div>
                    <div class="form-group">
                        <label>Pajak (%)</label>
                        <input type="number" name="tax_percent" value="0" step="0.1">
                    </div>
                </div>
            </div>
            <div class="grid-2">
                <div class="form-group">
                    <label>Tanggal Terbit</label>
                    <input type="date" name="date" id="issue_date" value="<?php echo date('Y-m-d'); ?>" onchange="updateDueDate()">
                </div>
                <div class="form-group">
                    <label>Tanggal Jatuh Tempo</label>
                    <input type="date" name="due_date" id="due_date" value="<?php echo date('Y-m-d', strtotime('+3 days')); ?>">
                </div>
            </div>

            <label>Daftar Item</label>
            <div id="item-container">
                <div class="item-row">
                    <input type="text" name="items[0][desc]" placeholder="Deskripsi Layanan" required>
                    <input type="number" name="items[0][qty]" value="1" placeholder="Qty">
                    <input type="number" name="items[0][price]" placeholder="Harga Satuan" required>
                    <button type="button" class="btn-remove" onclick="this.parentElement.remove()">×</button>
                </div>
            </div>
            <button type="button" class="btn btn-add" onclick="addItem()">+ Tambah Item</button>
            
            <button type="submit" name="save_invoice" class="btn">Buat & Cetak Invoice</button>
            <a href="migrate" class="logout" target="_blank">Update Database (Migration)</a>
            <a href="?logout=1" class="logout">Keluar Aman</a>
        </form>

        <script>
            function updateClientDetails() {
                const selector = document.getElementById('client_selector');
                const selectedOption = selector.options[selector.selectedIndex];
                const nameInput = document.getElementById('client_name');
                const detailsInput = document.getElementById('client_details');
                const container = document.getElementById('item-container');

                if (selector.value !== "") {
                    nameInput.value = selector.value;
                    detailsInput.value = selectedOption.getAttribute('data-addr');
                    
                    // Specific logic for BRITS if still needed or let it be generic
                    if (selector.value === "BRITS INDONESIA") {
                        const britsItems = [
                            { desc: "Pembuatan view custom tryout kedinasan", qty: 1, price: 1500000 },
                            { desc: "Pembuatan custom sertifikat kedinasan", qty: 1, price: 500000 },
                            { desc: "Modifikasi scoring tryout kedinasan", qty: 1, price: 1000000 },
                            { desc: "Modifikasi halaman hasil tryout kedinasan", qty: 1, price: 500000 },
                            { desc: "Modifikasi halaman input soal kedinasan (tkp)", qty: 1, price: 500000 },
                            { desc: "Pembuatan fitur import soal kedinasan (tkp)", qty: 1, price: 500000 }
                        ];
                        container.innerHTML = '';
                        itemCount = 0;
                        britsItems.forEach(item => {
                            addItem(item.desc, item.qty, item.price);
                        });
                    }
                } else {
                    nameInput.value = '';
                    detailsInput.value = '';
                }
            }

            function updateDueDate() {
                const issueDateVal = document.getElementById('issue_date').value;
                if (!issueDateVal) return;

                const date = new Date(issueDateVal);
                date.setDate(date.getDate() + 3);
                
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                
                document.getElementById('due_date').value = `${year}-${month}-${day}`;
            }

            let itemCount = 1;
            function addItem(desc = '', qty = 1, price = '') {
                const container = document.getElementById('item-container');
                const row = document.createElement('div');
                row.className = 'item-row';
                row.innerHTML = `
                    <input type="text" name="items[${itemCount}][desc]" placeholder="Deskripsi Layanan" value="${desc}" required>
                    <input type="number" name="items[${itemCount}][qty]" value="${qty}">
                    <input type="number" name="items[${itemCount}][price]" placeholder="Harga" value="${price}" required>
                    <button type="button" class="btn-remove" onclick="this.parentElement.remove()">×</button>
                `;
                container.appendChild(row);
                itemCount++;
            }
        </script>
    <?php endif; ?>
</div>

</body>
</html>


