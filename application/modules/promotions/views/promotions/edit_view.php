<script>
	var num = {count_image};
	var data_id = {data_id};
	var state = 'edit';
</script>
<!--  [ View File name : edit_view.php ] -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-success card-header-text">
					<div class="card-icon">
						<i class="material-icons">edit</i>
					</div>
					<h4 class="card-title">แก้ไข แพ็กเกจ</h4>
				</div>
				<div class="card-body">
				<form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
						{csrf_protection_field}
						<input type="hidden" name="submit_case" value="edit" />
						<input type="hidden" name="data_id" value="{data_id}" />
						<div class="container">
						<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="promotion_name">ชื่อ แพ็กเกจ :</label>
									<div class="form-group has-info">
										<input type="text" class="form-control" id="promotion_name" name="promotion_name" value="{record_promotion_name}" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="promotion_detail">รายละเอียดแพ็กเกจ :</label>
									<div class="form-group has-info">
										<textarea class="form-control" id="promotion_detail" name="promotion_detail" rows="3">{record_promotion_detail}</textarea>
									</div>
								</div>
							</div>

							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="promotion_price">ราคา :</label>
									<div class="form-group has-info">
										<input type="text" class="form-control" id="promotion_price" name="promotion_price" value="{record_promotion_price}" OnKeyPress="return chkNumber(this)"/>
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="promotion_discount">ส่วนลดโปรโมชั่น :</label>
									<select id="promotion_discount" name="promotion_discount" value="{promotion_discount}">
										<option value="">- เลือก ส่วนลดโปรโมชั่น -</option>
										<option value="10">10%</option>
										<option value="20">20%</option>
										<option value="30">30%</option>
										<option value="40">40%</option>
										<option value="50">50%</option>
									</select>
								</div>

							</div>
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
								<label class="control-label" for="promotion_type">ประเภท :</label>
									<select id="promotion_type" name="promotion_type" value="{promotion_type}">
										<option value="">- เลือก ประเภท -</option>
										<option value="รายเดือน (30 วัน)">รายเดือน (30 วัน)</option>
										<option value="รายครั้ง (15 ครั้ง">รายครั้ง (15 ครั้ง)</option>
										<option value="รายครั้ง (10 ครั้ง)">รายครั้ง (10 ครั้ง)</option>
									</select>
								</div>
								<div class="form-group col-md-4 ">
								</div>
							</div>

							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="date_of_promotion_start">วันที่เริ่มต้น :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control datepicker" id="date_of_promotion_start" name="date_of_promotion_start" value="{date_of_promotion_start}" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="date_of_promotion_end">วันที่สิ้นสุด :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control datepicker" id="date_of_promotion_end" name="date_of_promotion_end" value="{date_of_promotion_end}" />
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

								<button type="button" id="btnConfirmSave" class="btn btn-success" data-toggle="modal" data-target="#editModal">
									&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;
								</button>
							</div>
						</div>
						<input type="hidden" name="encrypt_promotion_id" value="{encrypt_promotion_id}" />

					</form>

			</div>
			<!--card-body-->
		</div>
		<!--card-->
	</div>
</div>
</div>
<!-- Modal -->
<div class='modal fade' id='editModal' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>
	<div class='modal-dialog' role='document'>
		<div class='modal-content'>
			<div class='modal-header'>
				<h4 class='modal-title' id='editModalLabel'>บันทึกข้อมูล</h4>
				<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
			</div>
			<div class='modal-body'>
				<p class="alert alert-info">ยืนยันการเปลี่ยนแปลงแก้ไขข้อมูล ?</p>
				<form class="form-horizontal" onsubmit="return false;">
					<div class="form-group">
					</div>
				</form>
			</div>
			<div class='modal-footer'>
				<button type="button" class="btn btn-warnSecondarying" data-dismiss="modal">&nbsp;&nbsp;<i class="fa fa-close"></i> &nbsp;ปิด &nbsp;&nbsp;</button>&emsp;
				<button type="button" class="btn btn-success" id="btnSaveEdit">&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;</button>
			</div>
		</div>
	</div>
</div>
