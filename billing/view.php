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
$tax_percent = (float) ($_POST['tax_percent'] ?? 0);
$items = $_POST['items'];

$subtotal = 0;
foreach ($items as $item) {
    $subtotal += (float) $item['qty'] * (float) $item['price'];
}

$tax_amount = ($tax_percent / 100) * $subtotal;
$total_akhir = $subtotal + $tax_amount;

function format_date($date)
{
    $months = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
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
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800;900&family=JetBrains+Mono&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --accent: #c8a96e;
            --text: #000000;
            --muted: #555555;
            --border: #000000;
            --bg-paper: #f4f1ea;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            color: var(--text);
            background: #d1d5db;
            padding: 40px 20px;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: var(--bg-paper);
            padding: 60px;
            position: relative;
            min-height: 1050px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.1);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 60px;
            padding-top: 10px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 25px;
            height: 65px; /* Sesuaikan tinggi patokan */
        }

        .logo-img {
            height: 65px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .invoice-title h1 {
            font-size: 65px;
            font-weight: 900;
            line-height: 1;
            margin: 0;
            letter-spacing: -2px;
            text-transform: uppercase;
            border-left: 5px solid var(--accent);
            padding-left: 20px;
            display: flex;
            align-items: center;
            height: 65px;
        }

        .brand-section {
            text-align: right;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 65px;
        }

        .brand-name {
            font-size: 32px;
            font-weight: 900;
            color: var(--accent);
            text-transform: uppercase;
            line-height: 0.85;
            margin: 0;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-bottom: 50px;
            border-top: 2px solid var(--border);
            padding-top: 25px;
        }

        .meta-item {
            font-size: 13px;
            text-transform: uppercase;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .meta-item span {
            font-weight: 500;
            color: var(--muted);
            margin-left: 12px;
            font-family: 'JetBrains Mono', monospace;
        }

        .address-right {
            text-align: right;
            font-size: 13px;
            line-height: 1.5;
            color: var(--muted);
            text-transform: uppercase;
        }

        .billing-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-bottom: 45px;
            gap: 40px;
        }

        .section-label {
            font-size: 14px;
            font-weight: 900;
            margin-bottom: 12px;
            color: var(--accent);
            text-transform: uppercase;
        }

        .billing-info,
        .payment-info {
            font-size: 14px;
            line-height: 1.6;
            text-transform: uppercase;
        }

        /* Main Table */
        .main-table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid var(--border);
            margin-bottom: 30px;
            table-layout: fixed;
        }

        .main-table th {
            background: #000;
            color: #fff;
            padding: 15px;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .main-table td {
            border: 2px solid var(--border);
            padding: 15px;
            font-size: 13px;
            text-transform: uppercase;
            font-weight: 600;
            word-wrap: break-word;
        }

        .col-desc {
            text-align: left;
            width: 42%;
        }

        .col-qty {
            text-align: center;
            width: 8%;
        }

        .col-price {
            text-align: right;
            width: 25%;
            white-space: nowrap;
        }

        .col-total {
            text-align: right;
            width: 25%;
            white-space: nowrap;
        }

        /* Summary Table */
        .summary-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 50px;
        }

        .summary-table {
            width: 440px;
            border-collapse: collapse;
            border: 3px solid #000;
        }

        .summary-table td {
            border: 3px solid #000;
            padding: 15px 20px;
            text-transform: uppercase;
            font-weight: 900;
            vertical-align: middle;
            white-space: nowrap;
        }

        .summary-table .label-td {
            width: 40%;
            text-align: center;
            font-size: 15px;
            color: #444;
        }

        .summary-table .value-td {
            width: 60%;
            text-align: right;
            font-size: 18px;
        }

        /* Footer and Signature */
        .footer-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-top: 80px;
            gap: 60px;
            border-top: 2px solid var(--border);
            padding-top: 35px;
        }

        .terms p {
            font-size: 12px;
            line-height: 1.6;
            color: var(--muted);
        }

        .contact-sign {
            text-align: right;
        }

        .signature-area {
            display: inline-block;
            text-align: center;
            margin-top: 20px;
        }

        .sign-line {
            width: 220px;
            border-bottom: 3px solid #000;
            margin-bottom: 8px;
            padding-top: 70px;
        }

        .sign-name {
            font-weight: 900;
            text-transform: uppercase;
            font-size: 18px;
        }

        @media print {
            body {
                padding: 0;
                background: white;
            }

            .invoice-container {
                box-shadow: none;
                width: 100%;
                padding: 40px;
                margin: 0;
                min-height: auto;
            }

            .no-print {
                display: none;
            }
        }

        .btn-print {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 30px;
            background: #000;
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: 900;
            z-index: 100;
            text-transform: uppercase;
        }
    </style>
</head>

<body>

    <button class="btn-print no-print" onclick="window.print()">Cetak Invoice</button>

    <div class="invoice-container">
        <header>
            <div class="header-left">
                <img src="../img/logo.jpg" alt="Logo" class="logo-img" onerror="this.style.display='none'">
                <div class="invoice-title">
                    <h1>INVOICE</h1>
                </div>
            </div>
            <div class="brand-section">
                <div class="brand-name">DIGISERV<br>ID</div>
            </div>
        </header>

        <div class="meta-grid">
            <div class="meta-left">
                <div class="meta-item">NO. INVOICE: <span>#<?php echo str_replace('INV/', '', $invoice_no); ?></span>
                </div>
                <div class="meta-item">TGL. TERBIT: <span><?php echo format_date($date); ?></span></div>
                <div class="meta-item">JATUH TEMPO: <span><?php echo format_date($due_date); ?></span></div>
            </div>
            <div class="address-right">
                MAKASSAR, INDONESIA<br>
                SULAWESI SELATAN<br>
                +62 895-1829-6820
            </div>
        </div>

        <div class="billing-grid">
            <div>
                <div class="section-label">Tagihan Untuk:</div>
                <div class="billing-info">
                    <strong><?php echo $client_name; ?></strong><br>
                    <?php echo $client_details; ?>
                </div>
            </div>
            <div>
                <div class="section-label">Metode Pembayaran:</div>
                <div class="payment-info">
                    TRANSFER BANK<br>
                    SEABANK (MUH. HIDAYAT)<br>
                    901090185124
                </div>
            </div>
        </div>

        <table class="main-table">
            <thead>
                <tr>
                    <th class="col-desc">DESKRIPSI PEKERJAAN</th>
                    <th class="col-qty">QTY</th>
                    <th class="col-price">HARGA</th>
                    <th class="col-total">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <?php
                    $qty = (float) $item['qty'];
                    $price = (float) $item['price'];
                    $amount = $qty * $price;
                    ?>
                    <tr>
                        <td class="col-desc"><?php echo htmlspecialchars($item['desc']); ?></td>
                        <td class="col-qty"><?php echo sprintf('%02d', $qty); ?></td>
                        <td class="col-price">
                            <?php echo $currency; ?>&nbsp;<?php echo number_format($price, 0, ',', '.'); ?></td>
                        <td class="col-total">
                            <?php echo $currency; ?>&nbsp;<?php echo number_format($amount, 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php for ($i = 0; $i < (4 - count($items)); $i++): ?>
                    <tr style="height:45px;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <div class="summary-wrapper">
            <table class="summary-table">
                <tr>
                    <td class="label-td">SUBTOTAL</td>
                    <td class="value-td">
                        <?php echo $currency; ?>&nbsp;<?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td class="label-td">PAJAK (<?php echo $tax_percent; ?>%)</td>
                    <td class="value-td">
                        <?php echo $currency; ?>&nbsp;<?php echo number_format($tax_amount, 0, ',', '.'); ?></td>
                </tr>
                <tr class="grand-total-row">
                    <td class="label-td">TOTAL AKHIR</td>
                    <td class="value-td">
                        <?php echo $currency; ?>&nbsp;<?php echo number_format($total_akhir, 0, ',', '.'); ?>
                    </td>
                </tr>
            </table>
        </div>

        <div class="footer-grid">
            <div class="terms">
                <h4 style="text-transform:uppercase; margin-bottom:10px; font-weight:900;">Syarat & Ketentuan</h4>
                <p>
                    1. Pembayaran dilakukan penuh di muka atau sesuai termin.<br>
                    2. Pekerjaan dimulai setelah konfirmasi pembayaran.<br>
                    3. Revisi fitur di luar lingkup awal akan dikenakan biaya.<br>
                    4. Penyerahan aset dilakukan setelah pelunasan.
                </p>
            </div>
            <div class="contact-sign">
                <div style="font-size: 13px; font-weight: 800; margin-bottom: 30px; text-transform:uppercase;">
                    HIDAYAT@DIGISERV.ID<br>
                    +62 895-1829-6820
                </div>

                <div class="signature-area">
                    <p style="font-size: 14px; font-weight: 900; text-transform: uppercase;">Hormat Kami,</p>
                    <div class="sign-line"></div>
                    <div class="sign-name">Muhammad Hidayat</div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>