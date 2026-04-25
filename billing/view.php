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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;700&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent: #c8a96e;
            --text: #1a1b1e;
            --muted: #64748b;
            --border: #e2e8f0;
            --surface: #ffffff;
            --bg: #f8fafc;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            background: var(--bg);
            line-height: 1.5;
            padding: 40px 20px;
        }

        .invoice-wrapper {
            max-width: 850px;
            margin: 0 auto;
            background: var(--surface);
            padding: 80px;
            box-shadow: 0 40px 100px -20px rgba(0,0,0,0.04);
            position: relative;
            overflow: hidden;
        }

        /* Decorative top border */
        .invoice-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: var(--accent);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 80px;
        }

        .brand {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .logo-img {
            height: 60px;
            width: auto;
            object-fit: contain;
            filter: grayscale(1) contrast(1.2);
            margin-bottom: 8px;
        }

        .brand h2 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 900;
            letter-spacing: -0.5px;
        }

        .brand h2 span { color: var(--accent); }

        .invoice-meta {
            text-align: right;
        }

        .invoice-meta h1 {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 900;
            line-height: 1;
            color: #f1f5f9;
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-bottom: 12px;
        }

        .invoice-meta .id-badge {
            display: inline-block;
            font-family: 'JetBrains Mono', monospace;
            font-size: 14px;
            background: #f1f5f9;
            padding: 6px 12px;
            border-radius: 4px;
            color: var(--text);
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            margin-bottom: 60px;
        }

        .info-section h4 {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--accent);
            margin-bottom: 16px;
            font-weight: 700;
        }

        .info-section p {
            font-size: 15px;
            color: var(--text);
            margin-bottom: 4px;
        }

        .info-section strong {
            font-size: 18px;
            display: block;
            margin-bottom: 4px;
        }

        .dates-bar {
            display: flex;
            gap: 40px;
            padding: 24px 0;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            margin-bottom: 60px;
        }

        .date-item h4 {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--muted);
            margin-bottom: 4px;
        }

        .date-item p {
            font-weight: 600;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        th {
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--muted);
            padding: 16px 0;
            border-bottom: 2px solid var(--text);
        }

        td {
            padding: 24px 0;
            border-bottom: 1px solid var(--border);
            font-size: 15px;
            vertical-align: top;
        }

        .col-qty { width: 80px; text-align: center; }
        .col-price { width: 140px; text-align: right; }
        .col-total { width: 140px; text-align: right; font-weight: 700; }

        .total-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 80px;
        }

        .total-box {
            width: 300px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
        }

        .total-row.grand-total {
            border-top: 2px solid var(--text);
            margin-top: 8px;
            padding-top: 20px;
            font-size: 22px;
            font-weight: 700;
        }

        .total-row.grand-total .label { color: var(--accent); }

        .signature-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 40px;
        }

        .signature-box {
            text-align: center;
            width: 220px;
        }

        .signature-box p {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 60px;
        }

        .signature-line {
            border-bottom: 1px solid var(--text);
            margin-bottom: 8px;
        }

        .signature-name {
            font-weight: 700;
            font-size: 16px;
        }

        footer {
            margin-top: 100px;
            text-align: center;
            font-size: 12px;
            color: var(--muted);
            border-top: 1px solid var(--border);
            padding-top: 40px;
        }

        @media print {
            body { background: white; padding: 0; }
            .invoice-wrapper { box-shadow: none; max-width: 100%; padding: 40px; }
            .no-print { display: none; }
        }

        .no-print-tools {
            position: fixed;
            top: 30px;
            right: 30px;
            z-index: 100;
        }

        .btn-print {
            background: var(--text);
            color: white;
            border: none;
            padding: 12px 24px;
            font-weight: 600;
            cursor: pointer;
            border-radius: 4px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }

        .btn-print:hover { transform: translateY(-2px); }
    </style>
</head>
<body>

<div class="no-print-tools">
    <button class="btn-print" onclick="window.print()">Simpan sebagai PDF</button>
</div>

<div class="invoice-wrapper">
    <header>
        <div class="brand">
            <img src="../img/logo.jpg" alt="Digiserv Logo" class="logo-img" onerror="this.style.display='none'">
            <h2>DIGISERV<span>.ID</span></h2>
            <p style="font-size: 13px; color: var(--muted);">High-Performance Digital Solutions</p>
        </div>
        <div class="invoice-meta">
            <h1>Invoice</h1>
            <div class="id-badge"><?php echo $invoice_no; ?></div>
        </div>
    </header>

    <div class="info-grid">
        <div class="info-section">
            <h4>Penyedia Layanan</h4>
            <p><strong>Muhammad Hidayat</strong></p>
            <p>Digiserv.ID</p>
            <p>Makassar, Sulawesi Selatan</p>
            <p>Indonesia</p>
        </div>
        <div class="info-section">
            <h4>Ditujukan Kepada</h4>
            <p><strong><?php echo $client_name; ?></strong></p>
            <p><?php echo $client_details; ?></p>
        </div>
    </div>

    <div class="dates-bar">
        <div class="date-item">
            <h4>Tanggal Terbit</h4>
            <p><?php echo format_date($date); ?></p>
        </div>
        <div class="date-item">
            <h4>Tanggal Jatuh Tempo</h4>
            <p><?php echo format_date($due_date); ?></p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Deskripsi Pekerjaan</th>
                <th class="col-qty">Qty</th>
                <th class="col-price">Harga</th>
                <th class="col-total">Total</th>
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
                <td><?php echo htmlspecialchars($item['desc']); ?></td>
                <td class="col-qty"><?php echo $qty; ?></td>
                <td class="col-price"><?php echo $currency; ?> <?php echo number_format($price, 0, ',', '.'); ?></td>
                <td class="col-total"><?php echo $currency; ?> <?php echo number_format($amount, 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total-wrapper">
        <div class="total-box">
            <div class="total-row">
                <span class="label">Subtotal</span>
                <span><?php echo $currency; ?> <?php echo number_format($total, 0, ',', '.'); ?></span>
            </div>
            <div class="total-row grand-total">
                <span class="label">Total Pembayaran</span>
                <span><?php echo $currency; ?> <?php echo number_format($total, 0, ',', '.'); ?></span>
            </div>
        </div>
    </div>

    <div class="signature-section">
        <div class="signature-box">
            <p>Makassar, <?php echo format_date($date); ?></p>
            <div class="signature-line"></div>
            <p class="signature-name">Muhammad Hidayat</p>
            <p style="font-size: 11px;">Digiserv.ID</p>
        </div>
    </div>

    <footer>
        <p>Pembayaran dapat dilakukan melalui transfer bank ke rekening yang telah disepakati.</p>
        <p style="margin-top: 8px;"><strong>Terima kasih atas kepercayaan Anda bekerjasama dengan Digiserv.ID</strong></p>
    </footer>
</div>

</body>
</html>
