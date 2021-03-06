<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-info card-header-icon">
					<div class="card-icon">
						<i class="material-icons">category</i>
					</div>
					<h4 class="card-title">รายการสั่งซื้อสินค้า</h4>
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
												<option value="id">เลขที่ใบสั่งซื้อ</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
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
									<div class="col-md-3">
										<div class="form-group bmd-form-group">
											<select class="select2-search" id="set_order_by" class="span2" value="{order_by}">
												<option value="">- จัดเรียงตาม -</option>
												<option value="id|asc">เลขที่ใบสั่งซื้อ เก่า - ล่าสุด</option>
												<option value="id|desc">เลขที่ใบสั่งซื้อ ล่าสุด - เก่า</option>
											</select>
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
									<th class="text-center">วันที่</th>
									<th class="text-center">เลขที่ใบสั่งซื้อ</th>
									<th class="text-center">รหัสสมาชิก</th>
									<th class="text-center">จำนวนเงิน</th>
									<th class="text-center">สถานะ</th>
									<th class="text-center" style="width:200px">เครื่องมือ</th>
								</tr>
							</thead>
							<tbody>
								<tr parser-repeat="[data_list]" id="row_{record_number}">
									<td style="text-align:center;">{record_number}</td>
									<td style="text-align:center;">{created}</td>
									<td style="text-align:center;">{id}</td>
									<td style="text-align:center;">{member_user_id}</td>
									<td style="text-align:center;">{grand_total}</td>
									<td style="text-align:center;">{status}</td>
									<td class="td-actions text-center">
										<a href="{site_url}cart/orderPDF/{id}" target="_blank" class="my-tooltip btn btn-info btn-md" data-toggle="tooltip" title="แสดงข้อมูลรายละเอียด">
											<i class="material-icons">picture_as_pdf</i>
										</a>
										<a href="#" data-toggle="modal" data-target="#p_b_u" class="my-tooltip btn btn-secondarying btn-md" data-toggle="tooltip" title="ประเภท โปรโมชั่น แบรนด์ หน่วย" data-row-id='{
											"id":"{id}"
											,"encrypt_id":"{encrypt_id}"
											,"record_order":"{record_number}"
											,"customer_id":"{member_user_id}"
											,"grand_total":"{grand_total}"
											,"status":"{status}"
										}'>
											<i class="material-icons">tune</i>
										</a>


										<a href="javascript:void(0);" class="btn-delete-row my-tooltip btn btn-danger" data-toggle="tooltip" title="ลบรายการนี้" data-id="{encrypt_id}" data-row-number="{record_number}">
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
					<input type="hidden" name="encrypt_id" />
				</form>
			</div>
			<div class="modal-footer" style="justify-content: center;">
				<button type="button" class="btn btn-Secondary" data-dismiss="modal">&nbsp;ยกเลิก&nbsp;</button>&emsp;
				<button type="button" class="btn btn-danger" id="btn_confirm_delete">&nbsp;ยืนยัน&nbsp;</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id='p_b_u' tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="text_order_code">
				</h4>
			</div>

			<!-- Modal Body -->
			<div class="modal-body">

				<form class="form-horizontal" role="form">
					<p style="font-size: 16px; text-align: center;">
						แก้ไข <span id="text_customer_id"></span>
					</p>

					<div class="container"">
					<div class=" form-row justify-content-around">
						<div class="form-group col-md-10 ">
						<label style=" font-weight: bold;" class="control-label" for="status" id="text_status"></label>
						<select id="status" class="status" name="status" value="">
							<option value="">- เลือก สถานะ -</option>
							<option value="1">รอชำระเงิน</option>
							<option value="2">อยู่ระหว่างจัดส่ง</option>
							<option value="3">ดำเนินการเรียบร้อย</option>
						</select>
						</div>
					</div>
			</div>
			</form>

		</div>

		<!-- Modal Footer -->
		<div class="modal-footer" style="justify-content: center;">
			<button onClick="window.location.reload();" type="button" class="btn btn-success  " data-dismiss="modal">
				ตกลง
			</button>
		</div>
	</div>
</div>
</div>

<script>
	var param_search_field = '{search_field}';
	var param_current_page = '{current_page_offset}';
</script>