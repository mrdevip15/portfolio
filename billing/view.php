<?php
session_start();

if (!isset($_SESSION['billing_auth']) || $_SESSION['billing_auth'] !== true) {
    die("Akses tidak sah.");
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Permintaan tidak valid.");
}

$client_name = htmlspecialchars($_POST['client_name']);
$client_details = nl2br(htmlspecialchars($_POST['client_details']));
$invoice_no = htmlspecialchars($_POST['invoice_no']);
$date = htmlspecialchars($_POST['date']);
$due_date = htmlspecialchars($_POST['due_date']);
$currency = htmlspecialchars($_POST['currency']);
$items = $_POST['items'];

$total = 0;
foreach ($items as $item) {
    $total += (float)$item['qty'] * (float)$item['price'];
}

function format_date($date) {
    $months = [
        'January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret',
        'April' => 'April', 'May' => 'Mei', 'June' => 'Juni',
        'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September',
        'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'
    ];
    $formatted = date('j F Y', strtotime($date));
    return strtr($formatted, $months);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - <?php echo $invoice_no; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&family=JetBrains+Mono&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent: #d15a5a; /* Warna merah sesuai referensi */
            --text: #333333;
            --muted: #666666;
            --border: #444444;
            --bg-paper: #e9e4de; /* Warna kertas vintage sesuai referensi */
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Outfit', sans-serif;
            color: var(--text);
            background: #cccccc;
            padding: 40px 20px;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: var(--bg-paper);
            padding: 60px;
            position: relative;
            min-height: 1000px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 50px;
        }

        .invoice-title h1 {
            font-size: 80px;
            font-weight: 800;
            color: var(--accent);
            line-height: 0.8;
            letter-spacing: -2px;
            text-transform: uppercase;
        }

        .brand-section {
            text-align: right;
        }

        .brand-name {
            font-size: 28px;
            font-weight: 800;
            color: var(--accent);
            text-transform: uppercase;
            line-height: 1;
            margin-bottom: 5px;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-bottom: 50px;
        }

        .meta-item {
            font-size: 13px;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 5px;
            letter-spacing: 0.5px;
        }

        .meta-item span {
            font-weight: 400;
            color: var(--muted);
            margin-left: 10px;
        }

        .address-right {
            text-align: right;
            font-size: 13px;
            line-height: 1.4;
            color: var(--muted);
        }

        .billing-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            margin-bottom: 40px;
            gap: 20px;
        }

        .section-label {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .billing-info, .payment-info {
            font-size: 14px;
            line-height: 1.5;
            text-transform: uppercase;
        }

        /* Table Styling matching the grid style */
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1.5px solid var(--border);
            margin-bottom: 20px;
        }

        th {
            background: transparent;
            border: 1.5px solid var(--border);
            padding: 12px;
            text-align: center;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
        }

        td {
            border: 1.5px solid var(--border);
            padding: 12px;
            font-size: 13px;
            text-transform: uppercase;
        }

        .col-desc { text-align: left; padding-left: 20px; width: 50%; }
        .col-qty { text-align: center; }
        .col-price { text-align: center; }
        .col-subtotal { text-align: center; font-weight: 600; }

        /* Empty rows to match style */
        .empty-row td { height: 40px; }

        .summary-table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }

        .summary-table td {
            border: none;
            padding: 8px 12px;
            text-align: right;
            font-weight: 700;
            text-transform: uppercase;
        }

        .grand-total-row td {
            font-size: 18px;
            padding-top: 15px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            margin-top: 60px;
            gap: 40px;
        }

        .terms h4 {
            font-size: 14px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .terms p {
            font-size: 11px;
            line-height: 1.4;
            color: var(--muted);
            text-align: justify;
        }

        .contact-sign {
            text-align: left;
            font-size: 12px;
            line-height: 1.4;
        }

        .signature-area {
            margin-top: 30px;
            position: relative;
        }

        .sign-img {
            max-width: 150px;
            position: absolute;
            top: -20px;
            left: 0;
        }

        .sign-line {
            width: 180px;
            border-bottom: 1.5px solid var(--text);
            margin-bottom: 5px;
            padding-top: 60px;
        }

        .sign-name {
            font-weight: 700;
            text-transform: uppercase;
        }

        @media print {
            body { padding: 0; background: white; }
            .invoice-container { box-shadow: none; width: 100%; padding: 40px; }
            .no-print { display: none; }
        }

        .btn-print {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 20px;
            background: var(--accent);
            color: white;
            border: none;
            cursor: pointer;
            font-weight: 700;
            border-radius: 5px;
            z-index: 100;
        }
    </style>
</head>
<body>

<button class="btn-print no-print" onclick="window.print()">PRINT INVOICE</button>

<div class="invoice-container">
    <header>
        <div class="invoice-title">
            <h1>INVOICE</h1>
        </div>
        <div class="brand-section">
            <div class="brand-name">DIGISERV<br>ID</div>
        </div>
    </header>

    <div class="meta-grid">
        <div class="meta-left">
            <div class="meta-item">INVOICE NUMBER: <span>#<?php echo str_replace('INV/', '', $invoice_no); ?></span></div>
            <div class="meta-item">DATE: <span><?php echo format_date($date); ?></span></div>
            <div class="meta-item">DUE DATE: <span><?php echo format_date($due_date); ?></span></div>
        </div>
        <div class="address-right">
            MAKASSAR, INDONESIA<br>
            SULAWESI SELATAN<br>
            +62 895-1829-6820
        </div>
    </div>

    <div class="billing-grid">
        <div>
            <div class="section-label">Bill To:</div>
            <div class="billing-info">
                <strong><?php echo $client_name; ?></strong><br>
                <?php echo $client_details; ?>
            </div>
        </div>
        <div>
            <div class="section-label">Payment Method:</div>
            <div class="payment-info">
                BANK TRANSFER<br>
                SEABANK (MUH. HIDAYAT)<br>
                901090185124
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="col-desc">DESCRIPTION</th>
                <th class="col-qty">QTY</th>
                <th class="col-price">PRICE</th>
                <th class="col-subtotal">SUBTOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
            <?php 
                $qty = (float)$item['qty'];
                $price = (float)$item['price'];
                $amount = $qty * $price;
            ?>
            <tr>
                <td class="col-desc"><?php echo htmlspecialchars($item['desc']); ?></td>
                <td class="col-qty"><?php echo sprintf('%02d', $qty); ?></td>
                <td class="col-price"><?php echo $currency; ?> <?php echo number_format($price, 0, ',', '.'); ?></td>
                <td class="col-subtotal"><?php echo $currency; ?> <?php echo number_format($amount, 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
            
            <!-- Padding Rows -->
            <?php for($i=0; $i < (6 - count($items)); $i++): ?>
            <tr class="empty-row">
                <td></td><td></td><td></td><td></td>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>

    <table class="summary-table">
        <tr>
            <td style="width: 75%;">SUBTOTAL</td>
            <td style="width: 25%; border: 1.5px solid var(--border);"><?php echo $currency; ?> <?php echo number_format($total, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td>TAX</td>
            <td style="border: 1.5px solid var(--border);">--</td>
        </tr>
        <tr class="grand-total-row">
            <td>GRAND TOTAL</td>
            <td style="border: 1.5px solid var(--border); background: #eee;"><?php echo $currency; ?> <?php echo number_format($total, 0, ',', '.'); ?></td>
        </tr>
    </table>

    <div class="footer-grid">
        <div class="terms">
            <h4>Syarat & Ketentuan</h4>
            <p>
                1. Pembayaran dilakukan penuh di muka atau sesuai kesepakatan termin yang berlaku.<br>
                2. Pekerjaan akan dimulai setelah konfirmasi pembayaran diterima.<br>
                3. Perubahan desain atau fitur setelah masa pengembangan akan dikenakan biaya tambahan.<br>
                4. Seluruh aset digital akan diserahkan setelah pelunasan sisa pembayaran dilakukan.
            </p>
        </div>
        <div class="contact-sign">
            <p>UNTUK PERTANYAAN, SILAKAN HUBUNGI</p>
            <p>HIDAYAT@DIGISERV.ID<br>ATAU +62 895-1829-6820</p>
            
            <div class="signature-area">
                <div class="sign-line"></div>
                <div class="sign-name">Muhammad Hidayat</div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
