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
    <title>Invoice - <?php echo $invoice_no; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent: #c8a96e;
            --text: #111827;
            --muted: #6b7280;
            --border: #e5e7eb;
        }

        body { font-family: 'DM Sans', sans-serif; color: var(--text); margin: 0; padding: 40px; background: #f3f4f6; }
        .invoice-box { max-width: 800px; margin: auto; padding: 60px; background: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.05); position: relative; }

        header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 60px; border-bottom: 2px solid var(--accent); padding-bottom: 30px; }
        .logo { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; }
        .logo span { color: var(--accent); }

        .invoice-title h1 { font-family: 'Playfair Display', serif; margin: 0; font-size: 36px; text-transform: uppercase; color: #eee; }

        .details { display: flex; justify-content: space-between; margin-bottom: 40px; }
        .info-block h4 { text-transform: uppercase; font-size: 11px; letter-spacing: 0.1em; color: var(--muted); margin-bottom: 8px; }
        .info-block p { margin: 0; font-size: 14px; line-height: 1.6; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        th { text-align: left; font-size: 11px; text-transform: uppercase; letter-spacing: 0.1em; color: var(--muted); border-bottom: 1px solid var(--border); padding: 15px 0; }
        td { padding: 15px 0; border-bottom: 1px solid var(--border); font-size: 14px; }

        .text-right { text-align: right; }
        .total-section { display: flex; justify-content: flex-end; }
        .total-table { width: 250px; }
        .total-table td { border: none; padding: 8px 0; }
        .grand-total { font-size: 18px; font-weight: 700; color: var(--accent); border-top: 1px solid var(--border) !important; }

        .signature-container { margin-top: 60px; display: flex; justify-content: flex-end; }
        .signature-box { text-align: center; width: 200px; }
        .signature-space { height: 80px; border-bottom: 1px solid var(--text); margin-bottom: 10px; }
        .signature-name { font-weight: 700; font-size: 14px; }

        footer { margin-top: 60px; padding-top: 20px; border-top: 1px solid var(--border); text-align: center; font-size: 11px; color: var(--muted); }

        @media print {
            body { background: #fff; padding: 0; }
            .invoice-box { box-shadow: none; border: none; width: 100%; padding: 40px; }
            .no-print { display: none; }
        }

        .no-print-btn { position: fixed; top: 20px; right: 20px; background: var(--accent); color: #fff; padding: 12px 24px; border: none; cursor: pointer; font-weight: 600; }
    </style>
</head>
<body>

<button class="no-print no-print-btn" onclick="window.print()">Cetak Invoice (PDF)</button>

<div class="invoice-box">
    <header>
        <div class="logo">DIGISERV<span>.ID</span></div>
        <div class="invoice-title">
            <h1>INVOICE</h1>
            <p style="text-align:right; margin:0; font-size:14px; font-family:monospace;"><?php echo $invoice_no; ?></p>
        </div>
    </header>

    <div class="details">
        <div class="info-block">
            <h4>Dari</h4>
            <p><strong>Muhammad Hidayat</strong></p>
            <p>Digiserv.ID — Digital Solutions</p>
            <p>Makassar, Indonesia</p>
        </div>
        <div class="info-block text-right">
            <h4>Kepada</h4>
            <p><strong><?php echo $client_name; ?></strong></p>
            <p><?php echo $client_details; ?></p>
        </div>
    </div>

    <div class="details">
        <div class="info-block">
            <h4>Tanggal Terbit</h4>
            <p><?php echo format_date($date); ?></p>
        </div>
        <div class="info-block text-right">
            <h4>Tanggal Jatuh Tempo</h4>
            <p><?php echo format_date($due_date); ?></p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Deskripsi Layanan</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Total</th>
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
                <td class="text-right"><?php echo $qty; ?></td>
                <td class="text-right"><?php echo $currency; ?> <?php echo number_format($price, 0, ',', '.'); ?></td>
                <td class="text-right"><?php echo $currency; ?> <?php echo number_format($amount, 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total-section">
        <table class="total-table">
            <tr class="grand-total">
                <td>Total Pembayaran</td>
                <td class="text-right"><?php echo $currency; ?> <?php echo number_format($total, 0, ',', '.'); ?></td>
            </tr>
        </table>
    </div>

    <div class="signature-container">
        <div class="signature-box">
            <p style="font-size: 12px; margin-bottom: 40px;">Hormat Saya,</p>
            <div class="signature-space"></div>
            <p class="signature-name">Muhammad Hidayat</p>
            <p style="font-size: 11px; color: var(--muted);">Digiserv.ID</p>
        </div>
    </div>

    <footer>
        <p>Terima kasih atas kepercayaan Anda. Pembayaran dapat dilakukan via transfer bank.</p>
        <p>Digiserv.ID — Digital Partner Anda</p>
    </footer>
</div>

</body>
</html>
