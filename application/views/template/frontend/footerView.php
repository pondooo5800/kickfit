    <!-- Footer -->
    <footer id="footer">
        <div class="container">
            <!-- introduce-box -->

            <!-- /#trademark-box -->
            <div id="trademark-box" class="row" align="center" style="padding-top: 15px">
                <div class="col-sm-12">
                    <ul class="owl-intab owl-carousel" data-loop="true" data-responsive='{"0":{"items":2},"600":{"items":4},"1000":{"items":6}}' data-autoplay="true" data-dots="false" data-nav="true">
                <?php
                	$this->load->model('common_model');
                    $brand =  $this->common_model->custom_query("select * from tb_banners where fag_allow = 'allow'");
                    foreach ($brand as $row) { ?>
                            <li style="margin: 5px">
                                <a href="<?php echo base_url('shop/brand/') . $row['banner_id']; ?>">
                                    <img src="<?php echo base_url($row['banner_img1']); ?>" alt="" />
                                </a>
                            </li>
                <?php } ?>
                        </ul>

                </div>
            </div>
            <!-- introduce-box -->
            <div id="introduce-box" class="row">
                <div class="col-md-2">
                    <div id="address-box">
                        <a href="#"><img class="img-logo" src="{base_url}/assets/themes/frontend/assets/img/icon/logo_yeejub.png" alt="logo" /></a>
                        <br />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="introduce-title">About Us</div>
                            <ul id="introduce-company" class="introduce-list">
                                <li><a href="{site_url}about">เกี่ยวกับเรา</a>
                                </li>
                                <li><a href="{site_url}how_order">วิธีการสั่งซื้อ</a>
                                </li>
                                <li><a href="{site_url}how_payment">วิธีการแจ้งชำระเงิน และการจัดส่ง</a>
                                </li>

                            </ul>
                        </div>
                        <div class="col-sm-5">
                            <div class="introduce-title">Contact</div>
                            <ul id="introduce-Account" class="introduce-list">
                            <?php
                                    $this->load->model('common_model');
                                    $contact_value = $this->db->query("select * from tb_admin where user_id = 1 AND fag_allow = 'allow'");
                                    $contact = $contact_value->row_array();

                            ?>
                                <li>
                                    <p><?php echo $contact['contact_name']?></p>
                                </li>
                                <li>
                                <p><?php echo $contact['contact_addr']?></p>
                                </li>
                                <li>
                                    <p>โทร : <?php echo $contact['contact_tel']?></p>
                                </li>
                                <li>
                                    <p>E-mail : <?php echo $contact['contact_email']?></p>
                                </li>
                                <li>
                                    <p>Facebook : <a href="<?php echo $contact['contact_facebook_link']?>" target="_blank"><?php echo $contact['contact_facebook']?></a> </p>
                                </li>
                                <li>
						            <p>Line : <a href="<?php echo $contact['contact_line_link']?>" target="_blank"><?php echo $contact['contact_line']?></a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4" align="center">
                    <div class="card">
                        <div class="card-content">
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

                        </div><!-- card content -->
                    </div>

                </div>


            </div><!-- /#introduce-box -->

            <!-- #trademark-box -->
            <div id="trademark-box" class="row">
                <div class="col-sm-12">

                    <ul id="trademark-list">

                    </ul>
                </div>
            </div> <!-- /#trademark-box -->

            <!-- #trademark-text-box -->
            <div id="footer-menu-box">
                <p class="text-center">Copyrights &#169; 2021 YeeJub.net</p>
            </div><!-- /#footer-menu-box -->
        </div>
    </footer>