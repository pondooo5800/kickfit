<script>
	var state = 'edit';
</script>
<div class="columns-container">
    <div class="container" id="columns">
        <h2 class="page-heading"><span class="page-heading-title2">ข้อมูลส่วนตัวของสมาชิก</span></h2>
        <br>
        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">
                <!-- block category -->
                <div class="block left-module">
                    <p class="title_block">เมนู</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-category">
                            <div class="layered-content">
                                <ul class="tree-menu">

                                    <li><span></span><a href="{site_url}index/member_index/<?php echo ($this->session->userdata('url_encrypt_id'))?>">ข้อมูลลูกค้า</a></li>
                                    <li><span></span><a href="{site_url}member_login/destroy">ออกจากระบบ</a></li>
                                    <!-- <li><span></span><a href="member-history.html">แจ้งชำระเงิน</a></li>
                                    <li><span></span><a href="member-howto_pay.html">การชำระเงิน</a></li>
                                    <li><span></span><a href="member-payment_detail.html">ประวัติการชำระเงิน</a></li> -->
                                </ul>
                            </div>
                        </div>
                        <!-- ./layered -->
                    </div>
                </div>
                <!-- ./block category  -->
                <!-- block filter -->


                <!-- left silide -->

            </div>
            <!-- ./left colunm -->
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <!-- page heading-->
                <h2 class="page-heading no-line"><span class="page-heading-title2">ข้อมูลส่วนตัว</span></h2>
                <!-- ../page heading-->
                <div class="box-border">
                    <ul>
                        <li class="row">
                        <form class='form-horizontal' id='formEdit' accept-charset='utf-8'>
                            {csrf_protection_field}
                            <input type="hidden" name="submit_case" value="edit" />
                            <input type="hidden" name="data_id" value=" <?php echo ($this->session->userdata('member_id'))?>" />
                            <input type="hidden" name="encrypt_member_id" value="<?php echo ($this->session->userdata('encrypt_member_id'))?>" />

                            <div class="col-sm-12">
                                    <label for="member_user_id" class="required">รหัสสมาชิก <spen style="color: red;">*</spen></label>
                                    <input type="text" class="input form-control" name="member_user_id" id="member_user_id" readonly value="<?php echo ($this->session->userdata('member_user_id'))?>">
                                    <br>
                                    <label for="member_mobile_no" class="required">เบอร์โทรศัพท์ <spen style="color: red;">*</spen> </label>
                                    <input type="text" class="input form-control" name="member_mobile_no" id="member_mobile_no" readonly value="<?php echo ($this->session->userdata('member_mobile_no'))?>">
                                    <br>

                                    <label for="member_fname" class="required">ชื่อ <spen style="color: red;">*</spen> </label>
                                    <input type="text" class="input form-control" name="member_fname" id="member_fname" value="{record_member_fname}">
                                    <br>
                                    <label for="member_lname" class="required">นามสกุล <spen style="color: red;">*</spen> </label>
                                    <input type="text" class="input form-control" name="member_lname" id="member_lname" value="{record_member_lname}">
                                    <br>
                                    <label for="member_shop" class="required">ชื่อร้าน <spen style="color: red;">*</spen> </label>
                                    <input type="text" class="input form-control" name="member_shop" id="member_shop" value="{record_member_shop}">
                                    <br>
                                    <label for="member_email_addr">Email Address </label>
                                    <input type="text" name="member_email_addr" class="input form-control" id="member_email_addr" value="{record_member_email_addr}">
                                    <br>
                                    <label for="member_addr">ที่อยู่ในการจัดส่งสินค้า  <spen style="color: red;">*</spen></label>
                                    <textarea class="input form-control" id="member_addr" name="member_addr" rows="3">{record_member_addr}</textarea>
                                    <br>
                                    <label for="member_addr">ที่อยู่สำหรับออกใบเสร็จรับเงิน : </label>&nbsp;&nbsp;
                                    <small style="color: #01549c;"><input type="checkbox" id="checkboxDetermine" value="1" name="same" {record_same}> ใช้ที่อยู่เดียวกันกับ ที่อยู่สำหรับจัดส่งสินค้า  </small>
                                    <textarea class="input form-control" id="checkboxConditioned" name="member_same" rows="3">{record_member_same}</textarea>
                                    <br>
                                    <label for="member_note">หมายเหตุ (ถ้ามี) </label>
                                    <textarea class="input form-control" id="member_note" name="member_note" rows="3">{record_member_note}</textarea>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-sm-12 text-center">
                                            <button type="button" id="btnConfirmSave" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
                                            &nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;บันทึก &nbsp;&nbsp;
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </li>
                        <!--/ .row -->
                        <li>


                        </li>

                    </ul>
                </div>


            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>
<!-- Modal -->
<div class='modal fade' id='editModal' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>
	<div class='modal-dialog' role='document'>
		<div class='modal-content'>
			<div class='modal-header'>
				<h4 class='modal-title' id='editModalLabel'>บันทึกข้อมูล</h4>
			</div>
			<div class='modal-body' style="text-align: center;">
				<p class="alert alert-info">ยืนยันการเปลี่ยนแปลงแก้ไขข้อมูล ?</p>
				<form class="form-horizontal" onsubmit="return false;">
					<div class="form-group">
					</div>
				</form>
			</div>
			<div class='modal-footer text-center'>
				<button type="button" class="btn btn-default" data-dismiss="modal">&nbsp;&nbsp;<i class="fa fa-close"></i> &nbsp;ปิด &nbsp;&nbsp;</button>&emsp;
				<button type="button" class="btn btn-success" id="btnSaveEditMember">&nbsp;&nbsp;<i class="fa fa-save"></i> &nbsp;ยืนยัน &nbsp;&nbsp;</button>
			</div>
		</div>
	</div>
</div>

<script>
    // Get your checkbox who determine the condition
var determine = document.getElementById("checkboxDetermine");
// Make a function who disabled or enabled your conditioned checkbox
var disableCheckboxConditioned = function () {
    if(determine.checked) {
        document.getElementById("checkboxConditioned").disabled = true;
        document.getElementById('checkboxConditioned').value = ''
    }
    else {
        document.getElementById("checkboxConditioned").disabled = false;
    }
}
// On click active your function
determine.onclick = disableCheckboxConditioned;
disableCheckboxConditioned();
</script>