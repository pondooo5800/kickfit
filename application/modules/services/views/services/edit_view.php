<script>
	var data_id = {data_id};
	var state = 'edit';
</script>
<!--  [ View File name : edit_view.php ] -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-rose card-header-text">
					<div class="card-icon">
						<i class="material-icons">edit</i>
					</div>
					<h4 class="card-title">การเข้าใช้บริการ</h4>
				</div>
				<div class="card-body">
					<form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
						{csrf_protection_field}
						<input type="hidden" name="submit_case" value="edit" />
						<input type="hidden" name="data_id" value="{data_id}" />
						<div class="container">
							<div class="form-row justify-content-around">
								<div class="form-group col-md-4 ">
									<label class="control-label" for="ser_date">วันที่เข้าใช้บริการ :</label>
									<div class="form-group has-success">
										<input type="text" class="form-control datepicker" id="ser_date" name="ser_date" value="" />
									</div>
								</div>
								<div class="form-group col-md-4 ">
								<label class="control-label" for="ser_time">รอบ :</label>
									<select id="ser_time" name="ser_time" value="">
										<option value="">- เลือกรอบ -</option>
										<option value="13:00 - 14:30">13:00 - 14:30</option>
										<option value="14:30 - 16:00">14:30 - 16:00</option>
										<option value="17:00 - 18:30">17:00 - 18:30</option>
										<option value="18:30 - 20:00">18:30 - 20:00</option>
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
						<input type="hidden" name="encrypt_service_id" value="{encrypt_service_id}" />
						<input type="hidden" name="service_count" value="{record_service_count}" />


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