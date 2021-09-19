<script>
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
				<div class="card-header card-header-rose card-header-text">
					<div class="card-icon">
						<i class="material-icons">note_add</i>
					</div>
					<h4 class="card-title">เพิ่มข้อมูลใหม่</h4>

				</div>
				<div class="card-body ">
					<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
						{csrf_protection_field}
						<div class="container">
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_fname">ชื่อ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control" id="member_fname" name="member_fname" value="" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_lname">นามสกุล :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control " id="member_lname" name="member_lname" value="" />
									</div>
								</div>
							</div>

							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_user_id">เลขบัตรประจำตัวประชาชน :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control" id="member_user_id" name="member_user_id" value="" maxlength="13" OnKeyPress="return chkNumber(this)"/>
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="date_of_birth">วันเกิด :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control datepicker" id="date_of_birth" name="date_of_birth" value="" />
									</div>
								</div>
							</div>
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_age">อายุ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control" id="member_age" name="member_age" value="" maxlength="3" OnKeyPress="return chkNumber(this)"/>
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_mobile_no">เบอร์โทรศัพท์ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control" id="member_mobile_no" name="member_mobile_no" value="" maxlength="10" OnKeyPress="return chkNumber(this)"/>
									</div>
								</div>
							</div>
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_email_addr">อีเมล :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control" id="member_email_addr" name="member_email_addr" value="" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_employment">อาชีพ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control" id="member_employment" name="member_employment" value=""/>
									</div>
								</div>
							</div>
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_addr">ที่อยู่ :</label>
									<div class="form-group has-success">
										<textarea class="form-control" id="member_addr" name="member_addr" rows="3"></textarea>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label" for="member_type">ประเภท :</label>
									<select id="member_type" name="member_type" value="">
										<option value="">- เลือกประเภท -</option>
										<option value="th">คนไทย</option>
										<option value="en">คนต่างชาติ</option>
									</select>
								</div>
							</div>
						</div>
						<br>
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