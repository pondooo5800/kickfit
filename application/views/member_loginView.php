<style>
	.login-container {
		margin-top: 5%;
		margin-bottom: 5%;
	}

	.login-form-1 {
		padding: 5%;
		box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
	}

	.login-form-1 h4 {
		text-align: center;
		color: #333;
	}

	.login-form-2 {
		padding: 5%;
		background: #0062cc;
		box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
	}

	.login-form-2 h4 {
		text-align: center;
		color: #fff;
	}

	.login-container form {
		padding: 10%;
	}

	.btnSubmit {
		width: 50%;
		border-radius: 1rem;
		padding: 1.5%;
		border: none;
		cursor: pointer;
	}

	.login-form-1 .btnSubmit {
		font-weight: 600;
		color: #fff;
		background-color: #0062cc;
	}

	.login-form-2 .btnSubmit {
		font-weight: 600;
		color: #0062cc;
		background-color: #fff;
	}

	.login-form-2 .ForgetPwd {
		color: #fff;
		font-weight: 600;
		text-decoration: none;
	}

	.login-form-1 .ForgetPwd {
		color: #0062cc;
		font-weight: 600;
		text-decoration: none;
	}
	/* Footer */
@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
section {
    padding: 60px 0;
    padding-bottom: 10px;
}

section .section-title {
    text-align: center;
    color: #0062cc;
    margin-bottom: 50px;
    text-transform: uppercase;
}
#footer {
    background: #0062cc !important;
}
#footer h5{
	padding-left: 10px;
    border-left: 3px solid #eeeeee;
    padding-bottom: 6px;
    margin-bottom: 20px;
    color:#ffffff;
}
#footer a {
    color: #ffffff;
    text-decoration: none !important;
    background-color: transparent;
    -webkit-text-decoration-skip: objects;
}
#footer ul.social li{
	padding: 3px 0;
}
#footer ul.social li a i {
    margin-right: 5px;
	font-size:25px;
	-webkit-transition: .5s all ease;
	-moz-transition: .5s all ease;
	transition: .5s all ease;
}
#footer ul.social li:hover a i {
	font-size:30px;
	margin-top:-10px;
}
#footer ul.social li a,
#footer ul.quick-links li a{
	color:#ffffff;
}
#footer ul.social li a:hover{
	color:#eeeeee;
}
#footer ul.quick-links li{
	padding: 3px 0;
	-webkit-transition: .5s all ease;
	-moz-transition: .5s all ease;
	transition: .5s all ease;
}
#footer ul.quick-links li:hover{
	padding: 3px 0;
	margin-left:5px;
	font-weight:700;
}
#footer ul.quick-links li a i{
	margin-right: 5px;
}
#footer ul.quick-links li:hover a i {
    font-weight: 700;
}

@media (max-width:767px){
	#footer h5 {
    padding-left: 0;
    border-left: transparent;
    padding-bottom: 0px;
    margin-bottom: 10px;
}
}

</style>
<div class="container login-container">
	<div class="row w-100 mx-0">
		<div class="col-lg-6 mx-auto">
			<div class="form-row justify-content-center ">
				<a href="{site_url}index" class="simple-text logo-normal">
					<img src="{base_url}/assets/themes/frontend/assets/img/icon/logo_yeejub.png" alt="logo" width="80%">
				</a>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	<div class="row">
		<div class="col-md-6 login-form-1">
			<h4>ลงทะเบียนสำหรับลูกค้าใหม่</h4>
			<form class="form-signin pt-3" id="formAdd" accept-charset="utf-8">
			{csrf_protection_field}
				<div class="form-group">
					<input type="text" class="form-control form-control" placeholder="เบอร์โทรศัพท์ (ใช้สำหรับเข้าสู่เว็บไซต์) *" id="member_mobile_no" name="member_mobile_no" value="" OnKeyPress="return chkNumber(this)" />
				</div>
				<div class="form-group">
					<input type="password" class="form-control form-control " id="cus_passwd" name="cus_passwd" placeholder="รหัสผ่าน (อย่างน้อย 6 ตัว) *" value="" />
				</div>
				<div class="form-group">
					<input type="password" class="form-control " id="confirmpassword" name="confirmpassword" placeholder="ยืนยันรหัสผ่าน (อย่างน้อย 6 ตัว) *" value="" />
				</div>
				<div class="form-group">
					<input type="text" class="form-control form-control " id="member_fname" name="member_fname" placeholder="ชื่อ *" value="" />
				</div>
				<div class="form-group">
					<input type="text" class="form-control form-control " id="member_lname" name="member_lname" placeholder="นามสกุล *" value="" />
				</div>
				<div class="form-group">
					<input type="text" class="form-control form-control " id="member_shop" name="member_shop" placeholder="ชื่อร้าน *" value="" />
				</div>
				<div class="form-group">
					<input type="email" class="form-control form-control " id="member_email_addr" name="member_email_addr" placeholder="E-mail" value="" />
				</div>
				<div class="mt-3">
					<button type="button" id="btnConfirmSave" class="btn btn-block btn-primary btn font-weight-medium auth-form-btn" data-toggle="modal" data-target="#addModal">
						&nbsp;&nbsp;<i class="fa fa-user"></i> &nbsp;สมัครสมาชิก &nbsp;&nbsp;
					</button>
				</div>
			</form>
		</div>
		<div class="col-md-6 login-form-2">
			<h4>เข้าสู่ระบบ สำหรับลูกค้าเก่า</h4>
			<form class="form-signin pt-3" class="form-signin" role="form" method="post" id="frm_login" onsubmit="return LogIn();return false;">
				{csrf_protection_field}
				<div class="form-group">
					<input type="text" class="form-control form-control" name="input_username" id="input_username" class="form-control" placeholder="เบอร์โทรศัพท์ *" OnKeyPress="return chkNumber(this)" required autofocus>
				</div>
				<div class="form-group">
					<input type="password" class="form-control form-control" name="input_password" id="input_password" placeholder="รหัสผ่าน *" required>
				</div>
				<div class="mt-3">
					<button class="btn btn-block btn-success btn font-weight-medium auth-form-btn" id="btn_login" type="submit"><i class="fas fa-store"></i> &nbsp;เข้าสู่ร้านค้า&nbsp;&nbsp;</button>
				</div>
				<div class="mt-3">
					<button onclick="window.location.href='{base_url}orders'" class="btn btn-block btn-secondary btn font-weight-medium auth-form-btn" id="btn_register" type="submit"><i class="fas fa-user-cog"></i> &nbsp;ระบบบริหารจัดการข้อมูล&nbsp;&nbsp;</button>
				</div>
			</form>
		</div>
	</div>
</div>
<section id="footer">
		<div class="container">
			<div class="row text-center text-xs-center text-sm-left text-md-left">
				<div class="col-xs-12 col-sm-4 col-md-4">
					<h5>Add Line</h5>
					<a href="<?php echo $contact['contact_line_link']?>" target="_blank"><img src="{base_url}/assets/themes/frontend/assets/img/icon/line-yeejub.png" alt="generated QR Code"></a><br><br>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
				<h5>ติดต่อ</h5>
					<ul class="list-unstyled quick-links" style="color: white;">
						<p><?php echo $contact['contact_name']?></p>
						<p><?php echo $contact['contact_addr']?></p>
						<p>โทร: <?php echo $contact['contact_tel']?></p>
						<p>E-mail: <?php echo $contact['contact_email']?></p>
						<p>Facebook : <a href="<?php echo $contact['contact_facebook_link']?>" target="_blank"><?php echo $contact['contact_facebook']?></a> </p>
						<p>Line : <a href="<?php echo $contact['contact_line_link']?>" target="_blank"><?php echo $contact['contact_line']?></a></p>
					</ul>

				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
				<h5>แผนที่การเดินทาง</h5>

				<div class="mapouter">
                                <div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=250&amp;height=250&amp;hl=en&amp;q=หยี่จั๊บ แฟรนไชส์ ขายส่งทุกอย่าง 20 บาท (เฮียพ้ง-เจ้แขก)&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.fridaynightfunkin.net/friday-night-funkin-mods-fnf-play-online/">FNF Mods</a></div>
                                <style>
                                    .mapouter {
                                        position: relative;
                                        text-align: right;
                                        width: 100%;
                                        height: 270px;
                                    }

                                    .gmap_canvas {
                                        overflow: hidden;
                                        background: none !important;
                                        width: 100%;
                                        height: 270px;
                                    }

                                    .gmap_iframe {
                                        height: 270px !important;
                                    }
                                </style>
                            </div>

				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                	<p class="text-center">Copyrights &#169; 2021 YeeJub.net</p>
				</div>
				<hr>
			</div>
		</div>
	</section>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addModalLabel">ลงทะเบียนสมาชิกใหม่</h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<p class="alert alert-primary">ยืนยันการลงทะเบียน ?</p>
			</div>
			<div class="modal-footer" style="justify-content: center;">
				<button type="button" class="btn btn-success" id="btnSave">&nbsp;&nbsp;<i class="fa fa-check-circle"></i> &nbsp;ยืนยัน &nbsp;&nbsp;</button>
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