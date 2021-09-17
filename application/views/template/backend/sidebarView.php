<div class="sidebar" data-color="azure" data-background-color="white" data-image="{base_url}assets/themes/material/assets/img/sidebar-3.jpg">
	<div class="logo">
		<a href="{site_url}dashboard_user" class="simple-text logo-normal">
			<img src="{base_url}/assets/themes/frontend/assets/img/icon/logo_yeejub.png" alt="logo" style="width:100%">&emsp;
		</a>
	</div>
	<div class="sidebar-wrapper">
		<ul class="nav">
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'orders') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}orders/orders">
					<i class="material-icons">shopping_cart</i>
					<p>รายการสั่งซื้อสินค้า</p>
				</a>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'products') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}products/products">
					<i class="material-icons">category</i>
					<p>สินค้า</p>
				</a>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'members') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}members/members">
					<i class="material-icons">person</i>
					<p>สมาชิก</p>
				</a>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'products_types') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}products_types/products_types">
					<i class="material-icons">library_books</i>
					<p>ตั้งค่าหมวดหมู่สินค้า</p>
				</a>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'products_units') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}products_units/products_units">
					<i class="material-icons">library_books</i>
					<p>ตั้งค่าหน่วยสินค้า</p>
				</a>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'banners') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}banners/banners">
					<i class="material-icons">bubble_chart</i>
					<p>ตั้งค่าแบรนด์สินค้า</p>
				</a>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'promotions') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}promotions/promotions">
					<i class="material-icons">event</i>
					<p>ตั้งค่าโปรโมชั่นสินค้า</p>
				</a>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'settings_admin') { ?>active<?php } ?>">
				<a class="nav-link" href="{site_url}settings_admin/settings_admin/edit/<?php echo $this->session->userdata('encrypt_user_id'); ?>">
					<i class="material-icons">settings</i>
					<p>แก้ไขข้อมูลเว็บไซต์</p>
				</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link" href="{site_url}user_login/destroy">
					<i class="material-icons">logout</i>
					<p>ออกจากระบบ</p>
				</a>
			</li>
		</ul>
	</div>
</div>