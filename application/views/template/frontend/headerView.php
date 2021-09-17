<div id="" class="header">
    <!--/.top-header -->
    <div class="top-header">
        <div class="container">
            <div class="currency ">
                YEEJUB.NET : ร้านหยี่จั๊บทุกอย่าง 20 บาท
            </div>

            <div id="user-line-top" class="user-info pull-right">
                <a href="https://line.me/ti/p/~@yeejub" target="_blank"><img height="20" border="0" alt="kgg.co.th" src="https://scdn.line-apps.com/n/line_add_friends/btn/en.png"></a>
            </div>
            <div id="user-info-top" class="user-info pull-right">
                <div class="dropdown">
                    <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                        <span>Hi <?php echo ($this->session->userdata('member_fname')) ?></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{site_url}index/member_index/<?php echo ($this->session->userdata('url_encrypt_id')) ?>">ข้อมูลบัญชี</a></li>
                        <li><a href="{site_url}member_login/destroy">ออกจากระบบ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--/.top-header -->
    <!-- MAIN HEADER -->
    <div class="container main-header">
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3 logo">
                <a href="{site_url}"><img class="img-logo" alt="Kute Shop" src="{base_url}/assets/themes/frontend/assets/img/icon/logo_yeejub.png"></a>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6 header-search-box">
                <form class="form-inline" action="{site_url}shop/search" method="post">
                    <div class="form-group form-category">
                    </div>
                    <div class="form-group input-serach">
                        <input type="text" name="search" placeholder="ค้นหาสินค้า" value="<?php echo ($this->uri->segment(2) == "search" ? "{txt_search}" : "") ?>">
                    </div>
                    <button type="submit" class="pull-right btn-search"></button>
                </form>
            </div>
            <div id="cart-block" class="col-xs-5 col-sm-2 col-md-3 shopping-cart-box">
                    <a class="cart-link" href="{site_url}cart">
                        <span class="title">ตะกร้าสินค้าของคุณ</span>
                        <span class="total">ราคาทั้งหมด <span><?php echo number_format($this->cart->total()) . ' ' . 'บาท'; ?></span></span>
                        <!-- <?php
                        if ($this->cart->total_items() > 0) { ?>
                            <span class="notify notify-left"><?php echo $this->cart->total_items(); ?></span>
                        <?php } ?> -->
                    </a>
            </div>
        </div>

    </div>
    <!-- END MANIN HEADER -->
    <div id="nav-top-menu" class="nav-top-menu">
        <div class="container">
            <div class="row fix_menu">
                <div class="col-sm-3" id="box-vertical-megamenus">
                    <div class="box-vertical-megamenus" style="background: none; border: 0px">
                        <h4 class="title" style="background: none;  border: 0px">
                        </h4>
                    </div>
                </div>
                <div id="main-menu" class="col-sm-12 main-menu">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <a class="navbar-brand" href="#">MENU</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li class="<?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'index') { ?>active<?php } ?>"><a href="{site_url}">หน้าแรก</a></li>
                                    <li class="<?php if ($this->uri->segment(1) == 'shop') { ?>active<?php } ?>"><a href="{site_url}"><a href="{site_url}shop">สินค้าทั้งหมด</a></li>
                                    <li class="<?php if ($this->uri->segment(1) == 'how_order') { ?>active<?php } ?>"><a href="{site_url}"><a href="{site_url}how_order">วิธีการสั่งซื้อ</a></li>
                                    <li class="<?php if ($this->uri->segment(1) == 'how_payment') { ?>active<?php } ?>"><a href="{site_url}"><a href="{site_url}how_payment">วิธีการแจ้งชำระเงิน และการจัดส่ง</a></li>
                                    <li class="<?php if ($this->uri->segment(1) == 'about') { ?>active<?php } ?>"><a href="{site_url}"><a href="{site_url}about">เกี่ยวกับเรา</a></li>
                                    <li class="<?php if ($this->uri->segment(1) == 'contact') { ?>active<?php } ?>"><a href="{site_url}"><a href="{site_url}contact">ติดต่อเรา</a></li>
                                </ul>
                            </div>
                            <!--/.nav-collapse -->
                        </div>
                    </nav>
                </div>
            </div>
            <!-- userinfo on top-->
            <div id="form-search-opntop">
            </div>
            <!-- userinfo on top-->
            <div id="user-info-opntop">
            </div>
            <div id="user-line-opntop">
            </div>
            <!-- CART ICON ON MMENU -->
            <div id="shopping-cart-box-ontop">
                <a class="cart-link" href="{site_url}cart">
                <i class="fa fa-shopping-cart"></i>
                </a>
                <div class="shopping-cart-box-ontop-content"></div>
            </div>
        </div>
    </div>
</div>
