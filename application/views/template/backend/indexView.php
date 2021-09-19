<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Kick Fit Boxing Club</title>

	<link rel="shortcut icon" type="image/png" href="{base_url}assets/images/favicon.png" />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="{base_url}assets/themes/material/assets/css/material-font.css">
	<link rel="stylesheet" href="{base_url}assets/font-awesome/css/font-awesome.min.css">

	<!-- CSS Files -->
	<link rel="stylesheet" href="{base_url}assets/themes/material/assets/css/material-dashboard.css?v=2.1.2">
	<link rel="stylesheet" href="{base_url}assets/themes/material/assets/demo/demo.css">
	<!-- Require -->
	<link href="{base_url}assets/select2/dist/css/select2.css" rel="stylesheet">
	<link href="{base_url}assets/css/jquery-ui.min.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
	<style type="text/css">
		* {
			font-family: 'Sarabun', sans-serif;
		}
	</style>
	{another_css}

	<style type="text/css">
		* {
			font-family: 'Sarabun', sans-serif;
		}

		.logo>a>span {
			color: #fff;
			font-size: 1.5rem;
			margin-right: 0;
			padding: .25rem 0;
			vertical-align: middle;
		}

		.avatar {
			vertical-align: middle;
			width: 40px;
			height: 40px;
			border-radius: 50%;
		}

		.nav-profile-name {
			margin-left: .5rem;
			margin-right: .5rem;
			color: #4a4a4a;
			font-weight: 500;
			font-size: 14px;
		}

		.card-stats .card-footer {
			justify-content: flex-end;
		}

		.card-footer .stats>p {
			font-size: 15px;
			font-weight: bold;
		}

		.nav-tabs-navigation .nav-tabs-wrapper>h4 {
			font-weight: bold;
		}

		.card .card-header.card-header-icon .card-title,
		.card .card-header.card-header-text .card-title {
			font-weight: bold;
		}

		.btn {
			font-size: 13px
		}

		.btn-file {
			background-color: #E97A2E !important;
			color: #fff !important;
			padding: 5px !important;
		}

		.form-group .select2 {
			color: #444;
			line-height: 28px;
			width: 100% !important;
			text-align: center;
		}

		.pull-right .form-group .select2 {
			color: #444;
			line-height: 28px;
			width: 200px !important;
			text-align: center;
		}

		.select2-container .select2-selection--single .select2-selection__rendered {
			font-size: 13px !important;
		}

		.select2-results__option {
			font-size: 14px !important;
		}

		.card .card-body .form-group {
			margin: 0px !important;
		}

		@media only screen and (min-width: 500px) {
			#search {
				width: 100%;
			}

			#btn-search {
				width: 100%;
			}
		}

		.modal-title {
			font-weight: bold;
		}
	</style>

	<script>
		var baseURL = '{base_url}/';
		var siteURL = '{site_url}/';
		var csrf_token_name = '{csrf_token_name}';
		var csrf_cookie_name = '{csrf_cookie_name}';

		function noimage(image) {
			image.onerror = "";
			image.src = baseURL + 'assets/images/noimage.gif';
			return true;
		}
	</script>
</head>

<body id="page-top">
	<div class="wrapper ">
		<!-- Sidebar -->
		{left_sidebar}

		<div class="main-panel">
			<!-- Navbar -->
			{top_navbar}
			<!-- End Navbar -->
			<div class="content">
				{page_content}
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<div class="copyright float-right">
						Copyright © <script>
							document.write(new Date().getFullYear());
						</script>
						<a style="color: #7caff8;" href="http://YEEJUB.NET/" target="_blank">YEEJUB.NET</a>. All rights reserved.
					</div>
				</div>
			</footer>
		</div>
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="{base_url}assets/themes/sb-admin-bs4/vendor/jquery/jquery.min.js"></script>
	<script src="{base_url}assets/themes/sb-admin-bs4/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="{base_url}assets/themes/sb-admin-bs4/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Page level plugin JavaScript-->
	<script src="{base_url}assets/themes/sb-admin-bs4/vendor/datatables/jquery.dataTables.js"></script>
	<script src="{base_url}assets/themes/sb-admin-bs4/vendor/datatables/dataTables.bootstrap4.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="{base_url}assets/themes/sb-admin-bs4/js/sb-admin.min.js"></script>

	<!-- Require -->
	<script src="{base_url}assets/js/jquery-ui.min.js"></script>
	<script src="{base_url}assets/bootstrap_extras/bootstrap-notify.min.js"></script>
	<script src="{base_url}assets/select2/dist/js/select2.min.js"></script>
	<script src="{base_url}assets/js/jquery.cookie.min.js"></script>
	<script src="{base_url}assets/js/ci_utilities.js?ver=1541805506"></script>

	<script src="{base_url}assets/js/member_reset_pass.js"></script>

	{another_js}
	<script>
		$(function() {
			$("body").find('input').attr('autocomplete', 'off');
		});
		$(document).ready(function() {
			$('.select2-search').select2();
		});
	</script>

	<!--   Core JS Files   -->
	<!-- <script src="{base_url}assets/themes/material/assets/js/core/jquery.min.js"></script> -->
	<script src="{base_url}assets/themes/material/assets/js/core/popper.min.js"></script>
	<script src="{base_url}assets/themes/material/assets/js/core/bootstrap-material-design.min.js"></script>
	<script src="{base_url}assets/themes/material/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
	<!-- Plugin for the momentJs  -->
	<script src="{base_url}assets/themes/material/assets/js/plugins/moment.min.js"></script>
	<!--  Plugin for Sweet Alert -->
	<script src="{base_url}assets/themes/material/assets/js/plugins/sweetalert2.js"></script>
	<!-- Forms Validations Plugin -->
	<script src="{base_url}assets/themes/material/assets/js/plugins/jquery.validate.min.js"></script>
	<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
	<script src="{base_url}assets/themes/material/assets/js/plugins/jquery.bootstrap-wizard.js"></script>
	<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
	<script src="{base_url}assets/themes/material/assets/js/plugins/bootstrap-selectpicker.js"></script>
	<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
	<script src="{base_url}assets/themes/material/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
	<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
	<script src="{base_url}assets/themes/material/assets/js/plugins/jquery.dataTables.min.js"></script>
	<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
	<script src="{base_url}assets/themes/material/assets/js/plugins/bootstrap-tagsinput.js"></script>
	<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
	<script src="{base_url}assets/themes/material/assets/js/plugins/jasny-bootstrap.min.js"></script>
	<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
	<script src="{base_url}assets/themes/material/assets/js/plugins/fullcalendar.min.js"></script>
	<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
	<script src="{base_url}assets/themes/material/assets/js/plugins/jquery-jvectormap.js"></script>
	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<script src="{base_url}assets/themes/material/assets/js/plugins/nouislider.min.js"></script>
	<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
	<!-- Library for adding dinamically elements -->
	<script src="{base_url}assets/themes/material/assets/js/plugins/arrive.min.js"></script>
	<!--  Google Maps Plugin    -->
	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
	<!-- Chartist JS -->
	<script src="{base_url}assets/themes/material/assets/js/plugins/chartist.min.js"></script>
	<!--  Notifications Plugin    -->
	<script src="{base_url}assets/themes/material/assets/js/plugins/bootstrap-notify.js"></script>
	<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
	<script src="{base_url}assets/themes/material/assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
	<!-- Material Dashboard DEMO methods, don't include it in your project! -->
	<script src="{base_url}assets/themes/material/assets/demo/demo.js"></script>
	<script>
		$(document).ready(function() {
			// Javascript method's body can be found in assets/js/demos.js
			md.initDashboardPageCharts();

		});
	</script>
</body>

</html>
