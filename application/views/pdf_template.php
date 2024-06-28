<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ijazah - Nama</title>
    <style>
        .qr-code {
            position: absolute;
            top: 45mm;
            right: 10mm;
            width: 70mm;
            padding: 10px;
            text-align: center;
            border: 1px solid #000;
        }

        p {
            margin: 0 !important;
            padding: 0 !important;
        }

        .barcode {
            margin: 10px 0
        }

        .image-container {
            width: 100%;
            text-align: center;
            margin: 0;
        }

        img {
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="qr-code">
        <p>Ditandatangani secara elektronik oleh<br>Wakil Direktur 1</p>
        <barcode code="<?php echo $qr_code_url; ?>" type="QR" class="barcode" size="0.9" error="M" disableborder="1" />
        <p>Dr. Dra. Kurnia Ekasari Ak., M.M., CA.</p>
        <p>NIP. 196602141990032002</p>
        <hr>
        <p>Legalisir berlaku sampai dengan<br>31 Juli 2024</p>
    </div>
    <div class="image-container">
        <img src="<?php echo $image_path; ?>" />
    </div>
</body>

</html>