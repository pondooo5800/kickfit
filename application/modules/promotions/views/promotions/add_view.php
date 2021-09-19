<script>
	var num = {count_image};
	var data_id = {data_id};
	var state = 'add';
</script>
<style>
	.control-label {
		font-weight: bold;
	}
</style>
<!-- [ View File name : add_view.php ] -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-info card-header-text">
					<div class="card-icon">
						<i class="material-icons">note_add</i>
					</div>
					<h4 class="card-title">เพิ่มรายการ แพ็คเกจ</h4>

				</div>
				<div class="card-body ">
					<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
						{csrf_protection_field}
						<div class="container">
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="promotion_name">ชื่อ แพ็คเกจ :</label>
									<div class="form-group has-info">
										<input type="text" class="form-control" id="promotion_name" name="promotion_name" value="" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="promotion_detail">รายละเอียดแพ็คเกจ :</label>
									<div class="form-group has-info">
										<textarea class="form-control" id="promotion_detail" name="promotion_detail" rows="3"></textarea>
									</div>
								</div>
							</div>
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="promotion_price">ราคา :</label>
									<div class="form-group has-info">
										<input type="text" class="form-control" id="promotion_price" name="promotion_price" value="" OnKeyPress="return chkNumber(this)"/>
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="promotion_discount">ส่วนลดโปรโมชั่น :</label>
									<select id="promotion_discount" name="promotion_discount" value="">
										<option value="">- เลือก ส่วนลดโปรโมชั่น -</option>
										<option value="10">10%</option>
										<option value="20">20%</option>
										<option value="30">30%</option>
										<option value="40">40%</option>
										<option value="50">50%</option>
										<option value="60">60%</option>
										<option value="70">70%</option>
										<option value="80">80%</option>
										<option value="90">90%</option>
									</select>
								</div>

							</div>
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="date_of_promotion_start">วันที่เริ่มต้น :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control datepicker" id="date_of_promotion_start" name="date_of_promotion_start" value="" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="date_of_promotion_end">วันที่สิ้นสุด :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control datepicker" id="date_of_promotion_end" name="date_of_promotion_end" value="" />
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12 text-right">
								<input type="hidden" id="add_encrypt_id" />
								<a href="{page_url}" class="my-tooltip btn btn-Secondarying btn-md" data-toggle="tooltip">
									&nbsp;&nbsp;<i class="fa fa-close"></i> &nbsp;ยกเลิก &nbsp;&nbsp;
								</a>

								<button type="button" id="btnConfirmSave" class="btn btn-success" data-toggle="modal" data-target="#addModal">
									&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;
								</button>
							</div>
						</div>
					</form>
				</div>
				<!--panel-body-->
			</div>
			<!--panel-->
		</div>
		<!--contrainer-->
	</div>
</div>


<!-- Modal Confirm Save -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addModalLabel">บันทึกข้อมูล</h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<p class="alert alert-info">ยืนยันการบันทึกข้อมูล ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-Secondary" data-dismiss="modal">&nbsp;&nbsp;<i class="fa fa-close"></i> &nbsp;ปิด &nbsp;&nbsp;</button>&emsp;
				<button type="button" class="btn btn-success" id="btnSave">&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;</button>
			</div>
		</div>
	</div>
</div>
<script language="JavaScript">
	var state = 'add';
	function chkNumber(ele) {
		var vchar = String.fromCharCode(event.keyCode);
		if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
		ele.onKeyPress = vchar;
	}
</script>