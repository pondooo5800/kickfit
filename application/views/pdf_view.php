<!DOCTYPE html>
<html>

<head>
    <title>PDF</title>
    <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: sarabun;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        h1 {
            text-align: center;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>

    <h1>Kick Fit Boxing Club</h1>
    <h2>ใบเสร็จรับเงิน</h2>
    <p style=" font-size: 18px;font-weight: bold;">เลขที่ #<?php echo $bill['member_id']; ?> </p>
    <p style=" font-size: 18px;font-weight: bold;">วันที่ <?php echo setThaiDateFullMonth($bill['datetime_add']); ?></p>
    <table>
        <tr>
            <th style="text-align:center;">รายการ</th>
            <th style="text-align:center;">ราคา</th>
        </tr>
        <tr>
            <td style="text-align:left;"><?php echo $bill['promotion_name']; ?> ส่วนลด <?php echo $bill['promotion_discount']; ?>%</td>
            <td style="text-align:right;"><?php echo number_format($bill['promotion_price'], 2) ?> บาท</td>
        </tr>
    </table>

</body>

</html>