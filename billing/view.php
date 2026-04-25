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
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800;900&family=JetBrains+Mono&family=Sacramento&display=swap"
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
            padding: 20px 10px;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: var(--bg-paper);
            padding: 40px;
            position: relative;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.1);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-top: 5px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
            height: 50px;
        }

        .logo-img {
            height: 50px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .invoice-title h1 {
            font-size: 50px;
            font-weight: 900;
            line-height: 1;
            margin: 0;
            letter-spacing: -2px;
            text-transform: uppercase;
            border-left: 5px solid var(--accent);
            padding-left: 15px;
            display: flex;
            align-items: center;
            height: 50px;
        }

        .brand-section {
            text-align: right;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 50px;
        }

        .brand-name {
            font-size: 28px;
            font-weight: 900;
            color: var(--accent);
            text-transform: uppercase;
            line-height: 0.85;
            margin: 0;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-bottom: 25px;
            border-top: 2px solid var(--border);
            padding-top: 15px;
        }

        .meta-item {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .meta-item span {
            font-weight: 500;
            color: var(--muted);
            margin-left: 10px;
            font-family: 'JetBrains Mono', monospace;
        }

        .address-right {
            text-align: right;
            font-size: 12px;
            line-height: 1.4;
            color: var(--muted);
            text-transform: uppercase;
        }

        .billing-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-bottom: 25px;
            gap: 30px;
        }

        .section-label {
            font-size: 13px;
            font-weight: 900;
            margin-bottom: 8px;
            color: var(--accent);
            text-transform: uppercase;
        }

        .billing-info,
        .payment-info {
            font-size: 13px;
            line-height: 1.4;
            text-transform: uppercase;
        }

        /* Main Table */
        .main-table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid var(--border);
            margin-bottom: 20px;
            table-layout: fixed;
        }

        .main-table th {
            background: #000;
            color: #fff;
            padding: 10px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .main-table td {
            border: 2px solid var(--border);
            padding: 10px;
            font-size: 12px;
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
            margin-bottom: 25px;
        }

        .summary-table {
            width: 380px;
            border-collapse: collapse;
            border: 3px solid #000;
        }

        .summary-table td {
            border: 3px solid #000;
            padding: 10px 15px;
            text-transform: uppercase;
            font-weight: 900;
            vertical-align: middle;
            white-space: nowrap;
        }

        .summary-table .label-td {
            width: 40%;
            text-align: center;
            font-size: 13px;
            color: #444;
        }

        .summary-table .value-td {
            width: 60%;
            text-align: right;
            font-size: 16px;
        }

        /* Footer and Signature */
        .footer-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-top: 30px;
            gap: 40px;
            border-top: 2px solid var(--border);
            padding-top: 22px;
        }

        .terms p {
            font-size: 11px;
            line-height: 1.4;
            color: var(--muted);
        }

        .contact-sign {
            text-align: right;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .signature-area {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 10px;
        }

        .signature-qr {
            width: 70px;
            height: 70px;
            border: 1px solid #000;
            padding: 5px;
            background: #fff;
        }

        .signature-text {
            text-align: center;
        }

        .sign-line {
            width: 180px;
            border-bottom: 2px solid #000;
            margin-bottom: 5px;
            height: 40px;
            position: relative;
        }

        .sign-name {
            font-family: 'Sacramento', cursive;
            font-size: 36px;
            font-weight: 400;
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            color: #000;
        }

        .sign-label {
            font-weight: 900;
            text-transform: uppercase;
            font-size: 14px;
        }

        @media print {
            @page {
                size: A4;
                margin: 0;
            }

            body {
                padding: 0;
                background: white;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .invoice-container {
                box-shadow: none;
                width: 100%;
                padding: 40px;
                margin: 0;
                min-height: 100vh;
                background: var(--bg-paper) !important;
            }

            header {
                margin-bottom: 25px;
            }

            .meta-grid {
                margin-bottom: 20px;
                padding-top: 10px;
            }

            .billing-grid {
                margin-bottom: 20px;
                gap: 15px;
            }

            .main-table {
                margin-bottom: 12px;
            }

            .summary-wrapper {
                margin-bottom: 20px;
            }

            .footer-grid {
                margin-top: 25px;
                padding-top: 15px;
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
            <div style="text-align: right;">
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
                            <?php echo $currency; ?>&nbsp;<?php echo number_format($price, 0, ',', '.'); ?>
                        </td>
                        <td class="col-total">
                            <?php echo $currency; ?>&nbsp;<?php echo number_format($amount, 0, ',', '.'); ?>
                        </td>
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
                        <?php echo $currency; ?>&nbsp;<?php echo number_format($subtotal, 0, ',', '.'); ?>
                    </td>
                </tr>
                <tr>
                    <td class="label-td">PAJAK (<?php echo $tax_percent; ?>%)</td>
                    <td class="value-td">
                        <?php echo $currency; ?>&nbsp;<?php echo number_format($tax_amount, 0, ',', '.'); ?>
                    </td>
                </tr>
                <tr class="grand-total-row">
                    <td class="label-td" style="background:#000; color:white;">TOTAL AKHIR</td>
                    <td class="value-td">
                        <?php echo $currency; ?>&nbsp;<?php echo number_format($total_akhir, 0, ',', '.'); ?>
                    </td>
                </tr>
            </table>
        </div>

        <div class="footer-grid">
            <div class="terms">
                <h4 style="text-transform:uppercase; margin-bottom:10px; font-weight:900;">Syarat & Ketentuan</h4>
                <p style="font-size: 14px;">
                    1. Pembayaran dilakukan penuh di muka atau sesuai termin.<br>
                    2. Pekerjaan dimulai setelah konfirmasi pembayaran.<br>
                    3. Revisi fitur di luar lingkup awal akan dikenakan biaya.<br>
                    4. Penyerahan aset dilakukan setelah pelunasan.
                </p>
            </div>
            <div class="contact-sign">
                <div style="font-size: 13px; font-weight: 800; margin-bottom: 20px; text-transform:uppercase;"
                    class="section-label">
                    HIDAYAT@DIGISERV.ID<br>
                    +62 895-1829-6820
                </div>

                <div class="signature-area" style="margin-top: 20px;">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo urlencode("VERIFIED INVOICE: " . $invoice_no . " | TOTAL: " . $currency . " " . number_format($total_akhir, 0, ',', '.')); ?>"
                        alt="Digital Verification" class="signature-qr">

                    <div class="signature-text">
                        <p class="sign-label">Hormat Kami,</p>
                        <div class="sign-line">
                            <div class="sign-name">M. Hidayat</div>
                        </div>
                        <p style="font-size: 11px; font-weight: 700; color: #444;">DIGITALLY SIGNED</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>