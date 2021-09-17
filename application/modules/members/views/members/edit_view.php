<script>
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
					<h4 class="card-title">แก้ไขสมาชิก</h4>
				</div>
				<div class="card-body">
					<form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
						{csrf_protection_field}
						<input type="hidden" name="submit_case" value="edit" />
						<input type="hidden" name="data_id" value="{data_id}" />
						<div class="container">
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_user_id">รหัสสมาชิก :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control" id="member_user_id" name="member_user_id" value="{record_member_user_id}" readonly />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="cus_passwd">รหัสผ่าน (อย่างน้อย 6 ตัว) :</label>
									<div class="form-group has-success">
										<input type="password" class="form-control " id="cus_passwd" name="cus_passwd" value="{record_cus_passwd}" />
									</div>
								</div>
							</div>
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_fname">ชื่อ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control" id="member_fname" name="member_fname" value="{record_member_fname}" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_lname">นามสกุล :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control " id="member_lname" name="member_lname" value="{record_member_lname}" />
									</div>
								</div>
							</div>

							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_shop">ชื่อร้าน :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control" id="member_shop" name="member_shop" value="{record_member_shop}" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_mobile_no">เบอร์โทรศัพท์ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control" id="member_mobile_no" name="member_mobile_no" value="{record_member_mobile_no}" />
									</div>
								</div>
							</div>
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_email_addr">อีเมล :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control" id="member_email_addr" name="member_email_addr" value="{record_member_email_addr}" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
								</div>
							</div>
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_addr">ที่อยู่ในการจัดส่งสินค้า :</label>
									<div class="form-group has-success">
										<textarea class="form-control" id="member_addr" name="member_addr" rows="3">{record_member_addr}</textarea>
									</div>
								</div>
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_same">ที่อยู่สำหรับออกใบเสร็จรับเงิน :</label>
									<div class="form-group has-success">
										<textarea class="form-control" id="member_same" name="member_same" rows="3">{record_member_same}</textarea>
									</div>
								</div>
							</div>
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="member_note">หมายเหตุ (ถ้ามี) :</label>
									<div class="form-group has-success">
										<textarea class="form-control" id="member_note" name="member_note" rows="3">{record_member_note}</textarea>
									</div>
								</div>

								<div class="form-group col-md-4">
									<label class="control-label" for="fag_allow">สถานะ :</label>
									<select id="fag_allow" name="fag_allow" value="{record_fag_allow}">
										<option value="allow">ปกติ</option>
										<option value="block">ระงับการใช้งาน</option>
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
								<button type="button" id="btnConfirmSave" class="btn btn-success" data-toggle="modal" data-target="#editModal">
									&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;
								</button>
							</div>
						</div>
						<input type="hidden" name="encrypt_member_id" value="{encrypt_member_id}" />


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
				<button type="button" class="btn btn-Secondary" data-dismiss="modal">&nbsp;&nbsp;<i class="fa fa-close"></i> &nbsp;ปิด &nbsp;&nbsp;</button>&emsp;
				<button type="button" class="btn btn-success" id="btnSaveEdit">&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;</button>
			</div>
		</div>
	</div>
</div>