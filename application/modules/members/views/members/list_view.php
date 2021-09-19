<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-rose card-header-icon">
					<div class="card-icon">
						<i class="material-icons">library_books</i>
					</div>
					<h4 class="card-title">ข้อมูลลูกค้า</h4>
				</div>
				<div class="card-body">
					<form class="form-horizontal" name="formSearch" method="post" action="{page_url}/search">
						{csrf_protection_field}
						<div class="row">
							<div class="col-sm-12">
								<div class="row align-items-center">
									<div class="col-md-2">
										<div class="form-group has-info bmd-form-group">
											<a href="{page_url}" id="btn-search" class="btn btn-success ">ทั้งหมด</a>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group has-warning bmd-form-group" id="search">
											<select class="select2-search" name="search_field" class="span2">
												<option value="member_user_id">เลขบัตรประจำตัวประชาชน</option>
												<option value="member_fname">ชื่อ</option>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group has-info bmd-form-group">
											<input type="text" class="form-control col" id="txtSearch" name="txtSearch" value="{txt_search}">
										</div>
									</div>
									<input type="hidden" value="{order_by}" name="order_by" />
									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<button type="submit" name="submit" class="btn btn-info" id="btn-search">
												<span class="glyphicon glyphicon-search"></span> ค้นหา
											</button>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<select class="select2-search" id="set_order_by" class="span2" value="{order_by}">
												<option value="">- จัดเรียงตาม -</option>
												<option value="member_fname|asc">ชื่อ ก - ฮ</option>
												<option value="member_fname|desc">ชื่อ ฮ - ก</option>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group bmd-form-group">
											<a href="{page_url}/add" class="btn btn-success" data-toggle="tooltip" title="เพิ่มข้อมูลใหม่" id="btn-search">
												<i class="fa fa-plus-square"></i></span>&nbsp;&nbsp;เพิ่มรายการ
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>

					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">เลขบัตรประจำตัวประชาชน</th>
									<th class="text-center">ชื่อ สกุล</th>
									<th class="text-center">วันเดือนปีเกิด</th>
									<th class="text-center">ที่อยู่</th>
									<th class="text-center">อีเมล</th>
									<th class="text-center">อาชีพ</th>
									<th class="text-center">เบอร์โทรศัพท์</th>
									<th class="text-center">ประเภท</th>
									<th class="text-center" style="width:200px">เครื่องมือ</th>
								</tr>
							</thead>
							<tbody>
								<tr parser-repeat="[data_list]" id="row_{record_number}">
									<td style="text-align:center;">{record_number}</td>
									<td style="text-align:left;">{record_member_user_id}</td>
									<td style="text-align:left;">{record_fullname}</td>
									<td style="text-align:left;">{date_of_birth}</td>
									<td style="text-align:left;">{record_member_addr}</td>
									<td style="text-align:left;">{record_member_email_addr}</td>
									<td style="text-align:left;">{record_member_employment}</td>
									<td style="text-align:left;">{record_member_mobile_no}</td>
									<td style="text-align:center;">{record_member_type}</td>
									<td class="td-actions text-center">
										<a href="{page_url}/preview/{url_encrypt_id}" class="my-tooltip btn btn-info btn-md" data-toggle="tooltip" title="แสดงข้อมูลรายละเอียด">
											<i class="material-icons">list</i>
										</a>
										<a href="{page_url}/edit/{url_encrypt_id}" class="my-tooltip btn btn-warning " data-toggle="tooltip" title="แก้ไขข้อมูล">
											<i class="material-icons">edit</i>
										</a>
										<a href="javascript:void(0);" class="btn-delete-row my-tooltip btn btn-danger" data-toggle="tooltip" title="ลบรายการนี้" data-member_id="{encrypt_member_id}" data-row-number="{record_number}">
											<i class="material-icons">delete_forever</i>
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="row dataTables_wrapper">
						<div class="col-sm-12 col-md-5">
							<div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
								แสดงรายการที่ <b>{start_row}</b> ถึง <b>{end_row}</b> จากทั้งหมด <span class="badge badge-info"> {search_row}</span> รายการ
							</div>
						</div>
						<div class="col-sm-12 col-md-7">
							<div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
								{pagination_link}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal Delete -->
<div class="modal fade" id="confirmDelModal" tabindex="-1" role="dialog" aria-labelledby="confirmDelModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="confirmDelModalLabel">ยืนยันการลบข้อมูล !</h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>
			<div class="modal-body">
				<h4 style="font-weight: bold" class="text-center">* ท่านต้องการลบข้อมูลใช่หรือไม่ *</h4>
				<form id="formDelete">
					<input type="hidden" name="encrypt_member_id" />
				</form>
			</div>
			<div class="modal-footer" style="justify-content: center;">
				<button type="button" class="btn btn-Secondary" data-dismiss="modal">&nbsp;ยกเลิก&nbsp;</button>&emsp;
				<button type="button" class="btn btn-danger" id="btn_confirm_delete">&nbsp;ยืนยัน&nbsp;</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPreview" tabindex="-1" role="dialog" aria-labelledby="modalPreviewLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">ปิด</span></button>
				<h4 class="modal-title" id="modalPreviewLabel">แสดงข้อมูล</h4>
			</div>
			<div class="modal-body">
				<div id="divPreview"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-Secondary" data-dismiss="modal">ปิด</button>
			</div>
		</div>
	</div>
</div>
<script>
	var param_search_field = '{search_field}';
	var param_current_page = '{current_page_offset}';
</script>
