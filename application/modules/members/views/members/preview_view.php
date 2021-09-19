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
				<div class="card-header card-header-rose card-header-text">
					<div class="card-icon">
						<i class="material-icons">list</i>
					</div>
					<h4 class="card-title">รายละเอียดข้อมูลลูกค้า</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover preview">
							<tbody>
								<tr>
									<td class="text-right fit"><b>เลขบัตรประจำตัวประชาชน :</b></td>
									<td>{record_member_user_id}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>ชื่อ :</b></td>
									<td>{record_member_fname}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>สกุล :</b></td>
									<td>{record_member_lname}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>วันเดือนปีเกิด :</b></td>
									<td>{record_date_of_birth}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>อายุ :</b></td>
									<td>{record_member_age}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>ที่อยู่ :</b></td>
									<td>{record_member_addr}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>อีเมล :</b></td>
									<td>{record_member_email_addr}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>อาชีพ :</b></td>
									<td>{record_member_employment}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>เบอร์โทรศัพท์ :</b></td>
									<td>{record_member_mobile_no}</td>
								</tr>
								<tr>
									<td class="text-right fit"><b>ประเภท :</b></td>
									<td>{record_member_type}</td>
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