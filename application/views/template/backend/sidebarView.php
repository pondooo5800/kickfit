<div class="sidebar" data-color="rose" data-background-color="white" data-image="{base_url}assets/themes/material/assets/img/sidebar-3.jpg">
	<div class="logo">
		<a class="simple-text logo-normal">
			<img src="{base_url}/assets/images/logo.png" alt="logo" style="width:50%">&emsp;
		</a>
	</div>
	<div class="sidebar-wrapper">
		<ul class="nav">
			<?php if ($this->session->userdata('user_level') == 'admin') { ?>
				<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'members') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}members/members">
					<i class="material-icons">person</i>
					<p>ข้อมูลลูกค้า</p>
				</a>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'promotions') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}promotions/promotions">
					<i class="material-icons">event</i>
					<p>ข้อมูลแพ็กเกจ</p>
				</a>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'trainers') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}trainers/trainers">
					<i class="material-icons">person</i>
					<p>ข้อมูลเทรนเนอร์</p>
				</a>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'services') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}services/services">
					<i class="material-icons">library_books</i>
					<p>การเข้าใช้บริการ</p>
				</a>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'reports') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}reports/reports">
					<i class="material-icons">pie_chart</i>
					<p>แพ็กเกจยอดนิยมประจำวัน</p>
				</a>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'reports_month') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}reports_month/reports_month">
					<i class="material-icons">pie_chart</i>
					<p>แพ็กเกจยอดนิยมประจำเดือน</p>
				</a>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'reports_seller') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}reports_seller/reports_seller">
					<i class="material-icons">pie_chart</i>
					<p>แพ็กเกจขายดี 3 อันดับ</p>
				</a>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'reports_not_seller') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}reports_not_seller/reports_not_seller">
					<i class="material-icons">pie_chart</i>
					<p>แพ็กเกจขายไม่ดี 3 อันดับ</p>
				</a>
			</li>

			<?php
			}
			?>
			<?php if ($this->session->userdata('user_level') == 'trainer') { ?>
				<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'members') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}members/members">
					<i class="material-icons">person</i>
					<p>ข้อมูลลูกค้า</p>
				</a>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'promotions') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}promotions/promotions">
					<i class="material-icons">event</i>
					<p>ข้อมูลแพ็กเกจ</p>
				</a>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'trainers') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}trainers/trainers">
					<i class="material-icons">person</i>
					<p>ข้อมูลเทรนเนอร์</p>
				</a>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'services') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}services/services">
					<i class="material-icons">library_books</i>
					<p>การเข้าใช้บริการ</p>
				</a>
			</li>
			<?php
			}
			?>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'settings_admin') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}settings_admin/settings_admin/edit/<?php echo $this->session->userdata('encrypt_user_id'); ?>">
					<i class="material-icons">settings</i>
					<p>แก้ไขข้อมูลส่วนตัว</p>
				</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link" href="{site_url}user_login/destroy">
					<i class="material-icons">logout</i>
					<p>ออกจากระบบ</p>
				</a>
			</li>
		</ul>
		<br>
		<br><br>
	</div>
</div>