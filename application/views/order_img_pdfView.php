<html>

<head>
	<style>
		@page {
			margin-top: 0.54cm;
			margin-bottom: 0.54cm;
		}

		body {
			font-family: thsarabun;
			font-size: 16pt;
		}

		p {
			margin: 0pt;
		}

		table.items {
			border: 0.1mm solid #000000;
		}

		td {
			vertical-align: top;
		}

		.items td {
			border-left: 0.1mm solid #000000;
			border-right: 0.1mm solid #000000;
			border-bottom: 0.1mm solid #000000;
		}

		table thead td {
			background-color: #EEEEEE;
			text-align: center;
			border: 0.1mm solid #000000;
			font-variant: small-caps;
		}

		.items td.blanktotal {
			background-color: #EEEEEE;
			border: 0.1mm solid #000000;
			background-color: #FFFFFF;
			border: 0mm none #000000;
			border-top: 0.1mm solid #000000;
			border-right: 0.1mm solid #000000;
		}

		.items td.totals {
			text-align: right;
			border: 0.1mm solid #000000;
		}

		.items td.cost {
			text-align: "."center;
		}

		.footer {
			position: fixed;
			padding-left: 10px;
			padding-top: 10px;
			left: 0;
			bottom: 0;
			width: 100%;
			color: #000000;
			text-align: left;
			font-size: 12pt;
			border-top: 0.1mm solid #808080;
		}

		* {
			box-sizing: border-box;
		}

		.column {
			float: left;
			width: 21.70%;
			padding: 10px;
			border: 1px solid #555;
			text-align: center;
		}

		/* Clearfix (clear floats) */
		.row::after {
			content: "";
			clear: both;
			display: table;
		}
	</style>

</head>

<body>
	<div class="container-fluid">
		<div class="container">
			<div>
				<div style="float: left; width: 50%;text-align: left;">
					<p style="font-weight: bold;font-family: thsarabun; font-size: 20pt; color:#3366cc">YEEYUB.COM | ร้านหยี่จ๊ับ </p>
				</div>
				<div style="float: right; text-align: right; width: 50%;">
					<img src="<?php echo base_url("/assets/themes/frontend/assets/img/icon/logo_yeejub.png") ?>" width="100" />
				</div>
			</div>
			<div style="text-align: center;">
				<p><span style="font-weight: bold;font-size: 16pt;">ใบสั่งซื้อสินค้า</span></p>
			</div>
			<div>
				<div style="float: right; width: 50%;text-align: right;">
					<p style="font-weight: bold;font-size: 14pt;">หมายเลขใบสั่งซื้อ <span style="font-weight: normal;font-size: 14pt;">#<?php echo $order['id']; ?></span></p>
					<p style="font-weight: bold;font-size: 14pt;">วันที่ส่ังสินค้า <span style="font-weight: normal;font-size: 14pt;"><?php echo setThaiDateFullMonth($order['created']); ?></span></p>
					<p style="font-weight: bold;font-size: 14pt;">ที่อยู่ออกใบเสร็จ <span style="font-weight: normal;font-size: 14pt;"><?php echo $order['member_same']; ?></span></p>
					<p style="font-weight: bold;font-size: 14pt;">หมายเหตุ <span style="font-weight: normal;font-size: 14pt;"><?php echo $order['member_note']; ?></span></p>
				</div>
				<div style="float: left; width: 50%;">
					<p style="font-weight: bold;font-size: 14pt;">รหัสสมาชิก <span style="font-weight: normal;font-size: 14pt;"><?php echo $order['member_user_id']; ?></span></p>
					<p style="font-weight: bold;font-size: 14pt;">ชื่อ-สกุล <span style="font-weight: normal;font-size: 14pt;"><?php echo $order['name']; ?></span></p>
					<p style="font-weight: bold;font-size: 14pt;">เบอร์โทร <span style="font-weight: normal;font-size: 14pt;"><?php echo $order['phone']; ?></span></p>
					<p style="font-weight: bold;font-size: 14pt;">สถานที่จัดสินค้า <span style="font-weight: normal;font-size: 14pt;"><?php echo $order['member_addr']; ?></span></p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<?php
		foreach ($order_product as $key => $value) { ?>
			<div class="column">
				<img class="img-responsive" style="width:130px; height:130px; object-fit:contain" alt="product" src="<?php echo base_url($value['product_img1']) ?>" /></a>
				<p style="font-weight: bold;font-size: 10pt;">จํานวน : <?php echo $value['quantity'] ?> ชิ้น</p>
			</div>
		<?php } ?>
	</div>
	<div class="footer">
		<p>ถ้าท่านมีข้อสงสัยเพิ่มเติม กรุณาติดต่อศูนย์บริการลูกค้าทาง yeejub20online@gmail.com หรือโทร 088-025-8888</p>
	</div>
</body>

</html>