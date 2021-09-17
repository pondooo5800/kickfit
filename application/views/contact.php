<div class="columns-container">
    <div class="container" id="columns">
        <h2 class="page-heading"><span class="page-heading-title2">ติดต่อเรา</span></h2>
        <!-- ../page heading-->
        <div id="contact" class="page-content page-contact">
            <div id="message-box-conact"></div>
            <div class="row">
                <div class="col-sm-7">

                    <div class="content-text clearfix">
                        <h2><span style="font-size:16px;font-weight: bold;">สนใจสั่งซื้อสินค้า หรือสอบถามข้อมูลเพิ่มเติมได้ที่:</span></h2>
                        <br>
                        <p><span style="font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>โทรศัพท์ :</b> <?php echo $contact['contact_tel']?></span></p>
                        <p><span style="font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Email :</b> <?php echo $contact['contact_email']?></span></p>
                        <h2><span style="font-size:16px;font-weight: bold;">แผนที่และการเดินทาง:</span></h2>
                    </div>
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
                <div class="col-xs-12 col-sm-5" id="contact_form_map" style="padding-left: 50px">
                    <p>
                    <a href="<?php echo $contact['contact_line_link']?>"><img src="{base_url}/assets/themes/frontend/assets/img/icon/line-yeejub.png" alt="generated QR Code"></a><br><br>
                    </p>


                    <br>
                    <ul class="store_info">
                        <i class="fa fa-user"></i>ADMIN <li><i class="fa fa-phone"></i><span>088-025 8888</span></li>
                        <li>
                            <i class="fa fa-facebook"></i><span><a href="<?php echo $contact['contact_facebook_link']?>"><?php echo $contact['contact_facebook']?></a></span>
                        </li>

                        <li>
                            <i class="fa fa-envelope"></i>Email: <span><?php echo $contact['contact_email']?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>