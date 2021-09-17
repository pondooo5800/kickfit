<div class="columns-container">
	<div class="container" id="columns">
		<!-- page heading-->
		<h2 class="page-heading"><span class="page-heading-title2">รายการสั่งซื้อสินค้าทั้งหมด</span></h2>
		<!-- ../page heading-->
		<div class="page-content page-order">
			<div class="order-detail-content" id="view_cart">
				<div class="table-responsive">
					<table class="table table-bordered table-responsive cart_summary">
						<thead>
							<tr>
								<th class="cart_product" style="font-weight: bold;text-align: center; vertical-align: middle;">รูปสินค้า</th>
								<th style="font-weight: bold;text-align: center; vertical-align: middle;">ชื่อสินค้า</th>
								<th style="font-weight: bold;text-align: center; vertical-align: middle;width: 10%">ราคา</th>
								<th style="font-weight: bold;text-align: center; vertical-align: middle; width: 10%;">จำนวน</th>
								<th style="font-weight: bold;text-align: center; vertical-align: middle;"></th>
								<th style="font-weight: bold;text-align: right; vertical-align: middle;">รวมเป็น</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($this->cart->total_items() > 0) {
								foreach ($cartItems as $item) {    ?>
									<tr>
										<td class="cart_product" style="text-align: center; vertical-align: middle;">
											<img src="<?php echo $item["image"] ?>" alt="Image" />
										</td>
										<td class="cart_description">
											<p class="product-name"><?php echo $item["name"] ?></p>
										</td>
										<td class="price" style="text-align: center; vertical-align: middle;">
											<span>
												<?php echo number_format($item["price"]) ?>
											</span>
										</td>

										<td class="product-quantity" style="text-align: center; vertical-align: middle;">
											<div class="button-container" style="align-items: center;justify-content: space-around;">
												<button class="cart-qty-minus" type="button" value="-">-</button>
												<input type="text" min="1" id="qty" name="qty" class="qty form-control" value="<?php echo $item["qty"]; ?>" />
												<input type="hidden" class="rowid form-control" value="<?php echo $item["rowid"]; ?>" />
												<button class="cart-qty-plus" type="button" value="+">+</button>
											</div>
											<!-- <input type="number" min="1" id="qty" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"> -->

											<!-- <div class="input-counter">
										</div> -->
										</td>
										<td class="product-subtotal" style="text-align: center; vertical-align: middle;">
											<a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#my_modal" data-row-id="<?php echo $item["rowid"] ?>"><i class="fa fa-trash"></i> </a>
										</td>
										<td class="price">
											<span class="subtotal-amount"><?php echo number_format($item["subtotal"]) ?></span>
										</td>
									</tr>
								<?php }
							} else { ?>
								<tr>
									<td colspan="6">
										<p style="text-align: center;">รถเข็นของคุณว่างเปล่า .....</p>
									</td>
								<?php } ?>
								<?php if ($this->cart->total_items() > 0) { ?>
						<tfoot>
							<tr>
								<td colspan="3" rowspan="4"></td>
								<td colspan="2">รวมเป็น :</td>
								<td colspan="2"><?php echo number_format($this->cart->total()); ?></td>
							</tr>
							<tr>
							</tr>
							<tr>
							</tr>
							<tr>
								<td colspan="2">ค่าจัดส่ง :</td>
								<td colspan="2"> 0 </td>
							</tr>
							<tr>
								<td colspan="3">
								</td>
								<td colspan="2"><strong>รวมทั้งสิ้น :</strong></td>
								<td colspan="2"><strong><label id="dc_price_total"><?php echo number_format($this->cart->total()) . ' ' . 'บาท' ?></label></strong></td>
							</tr>
						</tfoot>
					<?php } ?>

					</tbody>
					</table>
				</div>

				<div class="cart_navigation">
					<a class="prev-btn" href="{base_url}shop" style="background-color: #3366cc; color: #FFFFFF"> เลือกสินค้าอื่น เพิ่มเติม</a>
				</div>
				<br><br><br>
				<br><br>
				<?php if ($this->cart->total_items() > 0) { ?>
					<h4 class="page-heading"><span class="page-heading-title2" style="font-weight: bold;color: red;font-size:20px">เงื่อนไขการสั่งซื้อสินค้า</span></h4>
					<div class="box-border">
						<div style="padding-left: 10%;padding-right: 10%;text-align: center;">
							<br><b><label style="font-size: 18px;">ร้านหยี่จั๊บ ขอขอบคุณทุกท่านที่ให้ความสนใจซื้อสินค้าของเรา</label></b>
							<br>
							<br>
							<div class="text-center" style="font-size: 15px;">
								<label class="required">
									สำหรับการสั่งซื้อสินค้า ทางเราได้กำหนดยอดสั่งซื้อขั้นต่ำ 5,000 บาท
									<br>
									โดยจะมีค่าขนส่ง 300 บาทสำหรับยอดสั่งซื้อไม่ถึง 10,000 บาท

									<br>
									และฟรีค่าจัดส่งเมื่อสั่งซื้อสินค้าตั้งแต่ 10,000 บาทขึ้นไป โดยแจ้งทางร้านหากท่านต้องการให้จัดส่ง
									<br>
									- ลูกค้าต่างจังหวัด ยอดสั่งสินค้า10,000 บาทขึ้นไป ทางร้านจะจัดส่งให้ท่าน ผ่านบริษัทขนส่งแถวพุทธมณฑล
									<br>
									- ลูกค้าในกรุงเทพฯ ยอดสั่งสินค้า10,000 บาทขึ้นไป ทางร้านจัดส่งให้ท่านถึงหน้าร้าน
								</label>

							</div>
							<br>
							<!-- <div class="text-center" style="font-size: 15px;">
								<label class="required"><input type="checkbox" id="checkboxDetermine">
									ยอมรับเงื่อนไข</label>
							</div> -->
						</div>
						<hr>
						<div class="cart_navigation text-center">
							<button type="submit" class="btn btn-success" onclick="cart_submit()">
								&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i> &nbsp;สั่งซื้อสินค้า &nbsp;&nbsp;
							</button>
						</div>
					</div>

				<?php } ?>
			</div>
		</div>
	</div>
</div>

<div class='modal fade' id='my_modal' tabindex='-1' role='dialog' aria-labelledby='delModalLabel' aria-hidden='true'>
	<div class='modal-dialog' role='document'>
		<div class='modal-content'>
			<div class='modal-header'>
				<h4 class='modal-title' id='delModalLabel'>ยืนยันการลบรายการ</h4>
			</div>
			<div class='modal-body' style="text-align: center;">
				<p class="alert alert-danger">คุณต้องการลบรายการนี้ใช่หรือไม่ ?</p>
				<form id="formDelete">
					<input type="hidden" name="rowId" />
				</form>
			</div>
			<div class='modal-footer text-center'>
				<button type="button" class="btn btn-default" data-dismiss="modal">&nbsp;&nbsp;<i class="fa fa-close"></i> &nbsp;ปิด &nbsp;&nbsp;</button>&emsp;
				<button type="button" class="btn btn-danger" onclick="removeCartItem()" data-dismiss="modal">&nbsp;&nbsp;<i class="fa fa-trash"></i> &nbsp;ลบ &nbsp;&nbsp;</button>&emsp;
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script>
	var incrementQty;
	var decrementQty;
	var plusBtn = $(".cart-qty-plus");
	var minusBtn = $(".cart-qty-minus");
	var incrementQty = plusBtn.click(function() {
		var $n = $(this)
			.parent(".button-container")
			.find(".qty");
		$n.val(Number($n.val()) + 1);
		updateCartItem();
	});

	var decrementQty = minusBtn.click(function() {
		var $n = $(this)
			.parent(".button-container")
			.find(".qty");
		var QtyVal = Number($n.val());
		if (QtyVal > 1) {
			$n.val(QtyVal - 1);
		}
		updateCartItem();
	});

	// Update item quantity
	function updateCartItem() {
		$('.qty').each(function() {
			var qty = $(this).parent(".button-container").find('.qty').val();
			var rowid = $(this).parent(".button-container").find('.rowid').val();
			// console.log(qty);
			// console.log(rowid);
			$.get("<?php echo base_url('cart/updateItemQty/'); ?>", {
				rowid: rowid,
				qty: qty
			}, function(resp) {
				if (resp == 'ok') {
					location.reload();
				} else {
					alert('โปรดกรอกจำนวนมากกว่า 1 ชิ้น');
					document.getElementById('qty').value = '1'
				}
			});

		})
		// alert("1");
	}

	function removeCartItem() {
		var fdata = $('#formDelete').serialize();
		var str = fdata.substring(6);
		window.location.replace('cart/removeItem/' + str);
	}

	function cart_submit() {
		setTimeout(function() {
			window.location.replace('cart/checkout');
		}, 300);

	}
</script>
<script>
	// Get your checkbox who determine the condition
	var determine = document.getElementById("checkboxDetermine");
	// Make a function who disabled or enabled your conditioned checkbox
	var disableCheckboxConditioned = function() {
		if (determine.checked) {
			document.getElementById("checkboxConditioned").disabled = false;
			document.getElementById('checkboxConditioned').value = ''
		} else {
			document.getElementById("checkboxConditioned").disabled = true;
		}
	}
	// On click active your function
	determine.onclick = disableCheckboxConditioned;
	disableCheckboxConditioned();
</script>
<script>
	$(document).ready(function() {
		$('#my_modal').on('show.bs.modal', function(e) {
			var rowId = $(e.relatedTarget).data('row-id');
			$(e.currentTarget).find('input[name="rowId"]').val(rowId);
		});
	});
</script>