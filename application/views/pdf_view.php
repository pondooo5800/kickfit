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
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
}
    </style>
</head>

<body>

    <h1>Kick Fit Boxing Club</h1>
    <h2>ใบเสร็จรับเงิน</h2>
    <p style=" font-size: 18px;font-weight: bold;">เลขที่ #<?php echo $bill['member_id']; ?> </p>
    <p style=" font-size: 18px;font-weight: bold;">วันที่ <?php echo setThaiDateFullMonth($bill['datetime_add']); ?></p>
    <p style=" font-size: 18px;font-weight: bold;">ชื่อ <?php echo $bill['member_fname'] .' '.$bill['member_lname']; ?></p>
    <p style=" font-size: 18px;font-weight: bold;">ที่อยู่ <?php echo $bill['member_addr']; ?></p>
    <table>
        <tr>
            <th style="font-size: 16px;text-align:center;">จำนวน</th>
            <th style="font-size: 16px;text-align:center;">รายการ</th>
            <th style="font-size: 16px;text-align:center;">ราคา</th>
        </tr>
        <tr>
            <td style="font-size: 16px;text-align:center;">1</td>
            <td style="font-size: 16px;text-align:left;"><?php echo $bill['promotion_name']; ?> ส่วนลด <?php echo $bill['promotion_discount']; ?>%</td>
            <td style="font-size: 16px;text-align:right;"><?php echo number_format($bill['promotion_price'], 2) ?></td>
        </tr>
        <tr>
            <td height="500"></td>
            <td height="500"></td>
            <td height="500"></td>
        </tr>
        <tfoot>
            <tr>
            <td style="font-size: 16px;text-align:center;"></td>
            <td style="font-weight: bold;font-size: 16px;text-align:left;">รวมเป็นเงิน</td>
            <td style="font-weight: bold;font-size: 16px;text-align:right;"><?php echo number_format($bill['promotion_price'], 2) ?> บาท</td>
            </tr>
        </tfoot>
    </table>
    <br><br>
    <div class="footer">
        <hr>
		<p style="font-size: 16px;">ชั้น 4 ศูนย์การค้าเซ็นทรัลพลาซ่า เชียงใหม่ แอร์พอร์ต 252-252/1 ถนนมหิดล ตำบลป่าแดด อำเภอเมืองเชียงใหม่ จังหวัดเชียงใหม่ 50100</p>
		<p style="font-size: 16px;">สนใจติดต่อ 099 813 6933</p>
    </div>

</body>

</html>