<?php
session_start();
$ADMIN_PASSWORD = "digiserv_admin"; 

if (isset($_POST['login_password'])) {
    if ($_POST['login_password'] === $ADMIN_PASSWORD) {
        $_SESSION['billing_auth'] = true;
    } else {
        $error = "Akses ditolak. Kata sandi salah.";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$authenticated = isset($_SESSION['billing_auth']) && $_SESSION['billing_auth'] === true;
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
    </style>
</head>
<body>

<div class="container">
    <?php if (!$authenticated): ?>
        <h1>Admin <span>Login</span></h1>
        <form method="POST">
            <div class="form-group">
                <label>Kata Sandi Akses</label>
                <input type="password" name="login_password" required autofocus>
            </div>
            <button type="submit" class="btn">Masuk ke Sistem</button>
        </form>
    <?php else: ?>
        <h1>Buat <span>Invoice</span></h1>
        <form action="./view.php" method="POST" target="_blank">
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
                    <option value="BRITS INDONESIA" data-addr="Jl. Kendal Sari Barat No.17C, Tulusrejo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141">BRITS INDONESIA</option>
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
                    <input type="text" name="invoice_no" value="INV/<?php echo date('Ymd'); ?>/001">
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
            
            <button type="submit" class="btn">Buat & Cetak Invoice</button>
            <a href="?logout=1" class="logout">Keluar Aman</a>
        </form>

        <script>
            const britsItems = [
                { desc: "Pembuatan view custom tryout kedinasan", qty: 1, price: 1500000 },
                { desc: "Pembuatan custom sertifikat kedinasan", qty: 1, price: 500000 },
                { desc: "Modifikasi scoring tryout kedinasan", qty: 1, price: 1000000 },
                { desc: "Modifikasi halaman hasil tryout kedinasan", qty: 1, price: 500000 },
                { desc: "Modifikasi halaman input soal kedinasan (tkp)", qty: 1, price: 500000 },
                { desc: "Pembuatan fitur import soal kedinasan (tkp)", qty: 1, price: 500000 }
            ];

            function updateClientDetails() {
                const selector = document.getElementById('client_selector');
                const selectedOption = selector.options[selector.selectedIndex];
                const nameInput = document.getElementById('client_name');
                const detailsInput = document.getElementById('client_details');
                const container = document.getElementById('item-container');

                if (selector.value === "BRITS INDONESIA") {
                    nameInput.value = selector.value;
                    detailsInput.value = selectedOption.getAttribute('data-addr');
                    
                    // Isi item otomatis
                    container.innerHTML = '';
                    itemCount = 0;
                    britsItems.forEach(item => {
                        addItem(item.desc, item.qty, item.price);
                    });
                } else if (selector.value === "") {
                    nameInput.value = '';
                    detailsInput.value = '';
                    container.innerHTML = '';
                    itemCount = 0;
                    addItem(); // Tambah satu baris kosong
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
