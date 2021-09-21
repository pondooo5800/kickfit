<!-- [ View File name : preview_view.php ] -->

<style>
	.table th.fit,
	.table td.fit {
		white-space: nowrap;
		width: 2%;
		font-weight: bold;
	}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">

			<div class="card">
				<div class="card-header card-header-success card-header-text">
					<div class="card-icon">
						<i class="material-icons">list</i>
					</div>
					<h4 class="card-title">รายละเอียด แพ็กเกจ</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover preview">
							<tbody>
								<tr>
									<td class="text-right fit"><b>ชื่อ แพ็กเกจ :</b></td>
									<td>{record_promotion_name}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>รายละเอียดแพ็กเกจ :</b></td>
									<td>{record_promotion_detail}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>ประเภทรายเดือน/ครั้ง :</b></td>
									<td>{record_promotion_type}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>ราคา :</b></td>
									<td>{record_promotion_price}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>ส่วนลดโปรโมชั่น :</b></td>
									<td>{record_promotion_discount}</td>
								</tr>

								<tr>
									<td class="text-right fit"><b>วันที่เริ่มต้น :</b></td>
									<td>{date_of_promotion_start}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>วันที่สิ้นสุด :</b></td>
									<td>{date_of_promotion_end}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>วันเวลาที่เพิ่ม :</b></td>
									<td>{record_datetime_add}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12 text-right">
						<input type="hidden" id="add_encrypt_id" />
						<a href="{page_url}" class="my-tooltip btn btn-Secondarying btn-md" data-toggle="tooltip">
							&nbsp;&nbsp;<i class="fa fa-close"></i> &nbsp;ยกเลิก &nbsp;&nbsp;
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>