<div class="columns-container">
    <div class="container" id="columns">
        <h2 class="page-heading"><span class="page-heading-title2">วิธีการแจ้งชำระเงิน และการจัดส่ง</span></h2>
        <!-- ../page heading-->
        <div id="contact" class="page-content page-contact">
            <div id="message-box-conact"></div>
            <div class="row">
                <div class="col-sm-7">

                    <div class="content-text clearfix">
                        <h2><span style="font-size:16px;font-weight: bold;">ชำระเงินที่</span></h2>
                        <br>
                        <div style="padding: 0px 50px;">
                            <img src="{base_url}assets/images/kbank.jpg" style="width: 75%; height: auto;" alt="">
                        </div>
                        <p><span style="font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ธนาคาร:</b>	ธนาคารกสิกรไทย</span></p>
                        <p><span style="font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>สาขา:</b>	บางมด</span></p>
                        <p><span style="font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>เลขที่บัญชี:</b>	09-02-633-677</span></p>
                        <p><span style="font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ชื่อบัญชี:</b>	นิพนธ์ คุปตะนุรักษ์</span></p>
                        <p><span style="font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ประเภทบัญชี:</b>	ออมทรัพย์</span></p>
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