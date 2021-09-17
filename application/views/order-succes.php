<div class="columns-container">
    <div class="container" id="columns" style="padding-bottom: 0px;">
        <div class="alert alert-success" style="text-align: center;">
            <span style="font-weight: bold;font-size:16px">สั่งซื้อสินค้าสำเร็จ</span>
        </div>
        <div class="page-content page-order">
            <div class="order-detail-content" id="view_cart">
                <div class="table-responsive">
                    <table class="table table-curved">
                        <table class="table table-curved">
                            <thead>
                                <tr>
                                    <th style="font-weight: bold;text-align: center; vertical-align: middle;">เลขที่ใบสั่งซื้อ</th>
                                    <th style="font-weight: bold;text-align: center; vertical-align: middle;">วันที่สั่งซื้อ</th>
                                    <th style="font-weight: bold;text-align: center; vertical-align: middle; ;">ยอดที่ต้องชำระ</th>
                                    <th style="font-weight: bold;text-align: center; vertical-align: middle;">ชื่อผู้ซื้อ</th>
                                    <th style="font-weight: bold;text-align: center; vertical-align: middle;">เบอร์โทรศัพท์</th>
                                    <th style="font-weight: bold;text-align: center; vertical-align: middle;">อีเมล</th>
                                </tr>
                            </thead>
                            <?php if (!empty($order)) { ?>
                                <tbody>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"> #<?php echo $order['id']; ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo setThaiDateShortMonth($order['created']); ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo number_format($order['grand_total'], 2); ?></td>
                                        <td style="text-align: center; vertical-align: middle;"> <?php echo $order['name']; ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $order['phone']; ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?php echo $order['email']; ?></td>
                                    </tr>
                                </tbody>

                            <?php } else { ?>
                                <div class="col-md-12">
                                    <div class="alert alert-danger">Your order submission failed.</div>
                                </div>
                            <?php } ?>
                        </table>

                    </table>
                </div>
                <div class="content-text clearfix">
                <div class="container">
                <form class="form-inline" method='post' action='<?php echo base_url('cart/order_sendMail/' . $order['id']); ?>'>
                        <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <span style="font-size:16px;font-weight: bold;">ส่งใบสั่งซื้อ</span>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="member_email_order" name="member_email_order" placeholder="ระบุ Email ที่ต้องการส่งใบสั่งซื้อสินค้า" value="<?php echo ($this->session->userdata('member_email_addr')) ?>">
                                    <input type="hidden" class="form-control" id="member_email_type" name="member_email_type" value="type_order">
                                </div>
                                <button type="submit" class="btn btn-primary" style="width: 110px;">ส่ง E-mail</button>
                        </div>
                        </form>

                        <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
                            <button onClick="window.open('{base_url}cart/orderPDF/<?php echo $order['id']; ?>')" style="background-color: #5a6268; color: #FFFFFF" class="btn btn-info">พิมพ์ใบสั่งซื้อสินค้า</button>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-2">
                            <button type="button" onclick="window.location.href='{base_url}'"class="btn btn-primary">กลับหน้าแรก</button>
                        </div>
                </div>
                </div>
                <hr>
                <?php
                if ($this->session->flashdata("message")) {
                    echo "
                    <div class='alert alert-success' style='text-align: center;'>
                        <span style='font-weight: bold;font-size:16px'>" . $this->session->flashdata("message") . "</span>
                    </div>
                    ";
                }
                ?>
                <!-- <div class="content-text clearfix">
                    <h2><span style="font-size:16px;font-weight: bold;">ส่งใบสั่งซื้อไปยัง E-mail</span></h2>
                    <br>
                    <form class="form-horizontal" method='post' action='<?php echo base_url('cart/order_sendMail/' . $order['id']); ?>'>
                        <div class="form-group">
                            <div class="col-sm-3" style="margin-bottom: 20px;">
                                <input type="email" class="form-control" id="member_email_order" name="member_email_order" placeholder="ระบุ Email ที่ต้องการส่งใบสั่งซื้อสินค้า" value="<?php echo ($this->session->userdata('member_email_addr')) ?>">
                                <input type="hidden" class="form-control" id="member_email_type" name="member_email_type" value="type_order">
                            </div>
                            <div class="col-sm-2" style="margin-bottom: 20px;">
                                <button type="submit" class="btn btn-primary" style="width: 110px;">ส่ง E-mail</button>
                            </div>
                        </div>
                    </form>
                </div> -->
            </div>
        </div>
    </div>
</div>
<div class="columns-container">
    <div class="container" id="columns">
        <b>
            <h2 class="page-heading"><span class="page-heading-title2">แจ้งชำระเงิน</span></h2>
        </b>
        <div class="row">
            <div class="center_column col-xs-12 col-sm-12" id="center_column">
                <div class="content-text clearfix">
                    <div style="padding: 0px 50px;">
                        <img src="{base_url}assets/images/kbank.jpg" style="width: 300px; height: auto;" alt="">
                    </div>
                    <p><span style="font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ธนาคาร:</b> ธนาคารกสิกรไทย</span></p>
                    <p><span style="font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>สาขา:</b> บางมด</span></p>
                    <p><span style="font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>เลขที่บัญชี:</b> 09-02-633-677</span></p>
                    <p><span style="font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ชื่อบัญชี:</b> นิพนธ์ คุปตะนุรักษ์</span></p>
                    <p><span style="font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ประเภทบัญชี:</b> ออมทรัพย์</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    // setTimeout(function() {
    //     var $order = <?php echo $order['id']; ?>;
    //     window.open('{base_url}cart/orderPDF/' + $order)
    // }, 3000);
</script> -->