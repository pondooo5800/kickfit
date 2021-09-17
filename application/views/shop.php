<?php $CI = &get_instance(); ?>
<div class="container" id="container">
    <div class="row fix_menu" style="margin:  2px;">
        <div class="col-sm-3 my_menu my_menu1 select_menu">Promotion</div>
        <div class="col-sm-3 my_menu my_menu2">หมวดหมู่สินค้า</div>
        <div class="col-sm-3 my_menu my_menu3">แบรนด์สินค้า</div>
    </div>

    <div class="row fix_menu" id="my_menu1_des" style="margin:  2px;">
        <?php
        foreach ($promotion as $row) { ?>
        <?php
        if ($row['promotion_type'] == 1) { ?>
            <a href="<?php echo base_url('shop/promotion/') . $row['promotion_id']; ?>">
                <div class="col-sm-4 ads_brand">
                    <img style="margin: 10px" src="<?php echo base_url($row['promotion_img1']); ?>">
                </div>
            </a>
       <?php } else if ($row['promotion_type'] == 0) { ?>
        <a href="#" data-toggle="modal" data-target="#myPromotion"
            data-row-id='{
                "promotion_id":"<?php echo ($row['promotion_id']); ?>"
                ,"promotion_name":"<?php echo ($row['promotion_name']); ?>"
                ,"promotion_detail":"<?php echo ($row['promotion_detail']); ?>"
                ,"promotion_img1":"<?php echo base_url($row['promotion_img1']); ?>"
            }'>
                <div class="col-sm-4 ads_brand">
                    <img style="margin: 10px" src="<?php echo base_url($row['promotion_img1']); ?>">
                </div>
            </a>
        <?php }?>
        <?php } ?>
    </div>
    <div class="row fix_menu" id="my_menu2_des" style="margin:  2px;">
        <?php
        foreach ($product_type as $row) { ?>
            <a href="<?php echo base_url('shop/category/') . $row['product_type_id']; ?>">
                <div class="col-sm-2 ads_brand">
                    <p style="text-align: center;max-width: 100%;font-weight: bold;font-size: 16px;">
                        <?php echo $row['product_type_name']; ?>
                    </p>
                </div>
            </a>
        <?php } ?>
    </div>

    <div class="row fix_menu" id="my_menu3_des" style="margin:  2px;">
        <?php
            foreach ($brand as $row) { ?>
        <a href="<?php echo base_url('shop/brand/') . $row['banner_id']; ?>">
                <div class="col-sm-2 ads_brand">
                    <img style="margin: 10px" src="<?php echo base_url($row['banner_img1']); ?>">
                </div>
            </a>
        <?php } ?>
    </div>
</div>
<div class="columns-container">
    <div class="container" id="columns">
        <!-- row -->
        <div class="row">
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-12" id="center_column">
                <!-- view-product-list-->
                <?php if ($this->uri->segment(2) === 'category') { ?>
                    <div id="view-product-list" class="view-product-list">
                        <h2 class="page-heading"><span class="page-heading-title"><?php echo $product_type_name ?></span></h2>
                        <ul class="row product-list style2 grid">
                            <p id="oneflashsale" style="display:none">EXPIRED</p>
                            <?php
                            foreach ($products as $value) { ?>
                                <li class="col-sx-12 col-sm-4">
                                    <div class="product-container">
                                        <div class="left-block">
                                            <a href="#" data-toggle="modal" data-target="#my_modal" data-row-id='{"product_id":"<?php echo ($value['product_id']); ?>","product_name":"<?php echo ($value['product_name']); ?>","price":"<?php echo ($value['price']); ?>","product_unit_name":"<?php echo ($value['product_unit_name']); ?>","product_img1":"<?php echo base_url($value['product_img1']); ?>"}'>
                                                <img class="img-responsive" style="width:350px; height:350px; object-fit:contain" alt="product" src="<?php echo base_url($value['product_img1']); ?>" /></a>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name" style="font-weight: bold;text-align: center;">
                                                <? echo $value['product_name'] ?>
                                            </h5>
                                            <div style="text-align: center;">
                                                <div class="content_price">
                                                    <span class="price product-price" style="color: #f30; font-weight: bold;">ราคา <? echo $value['price'] ?> บาท / <?php echo $value['product_unit_name'] ?></span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="button-container" style="align-items: center;justify-content: space-around;">
                                                    <div class="button-container">
                                                        <button class="cart-qty-minus" type="button" value="-">-</button>
                                                        <input type="text" min="1" name="qty" id="<?php echo $value['product_id'] ?>" class="qty form-control" value="1" OnKeyPress="return chkNumber(this)" />
                                                        <button class="cart-qty-plus" type="button" value="+">+</button>
                                                    </div>
                                                    <span>
                                                        <button style="width: 100px;" type="button" name="add_cart" class="btn btn-success add_cart add-cart" data-segment="ajax" data-productname="<?php echo $value['product_name'] ?>" data-price="<?php echo $value['price'] ?>" data-productid="<?php echo $value['product_id'] ?>" />สั่งซื้อ</button>
                                                    </span>
                                                </div>
                                                <input type="hidden" id="product_id" name="product_id" value="<? echo $value['product_id'] ?>">
                                                <input type="hidden" name="segment" value="index">
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            <? } ?>
                        </ul>
                        <!-- ./PRODUCT LIST -->
                    </div>
                    <!-- ./view-product-list-->
                    <div class="sortPagiBar">
                        <div class="bottom-pagination">
                            <nav>
                                <?php echo $links; ?>
                            </nav>
                        </div>

                    </div>
                <?php } else if ($this->uri->segment(2) === 'brand') { ?>
                    <div id="view-product-list" class="view-product-list">
                        <h2 class="page-heading"><span class="page-heading-title"><?php echo $banner_name ?></span></h2>
                        <ul class="row product-list style2 grid">
                            <p id="oneflashsale" style="display:none">EXPIRED</p>
                            <?php
                            if (is_array($banners)) {
                                foreach ($banners as $value) { ?>
                                <li class="col-sx-12 col-sm-4">
                                    <div class="product-container">
                                        <div class="left-block">
                                            <a href="#" data-toggle="modal" data-target="#my_modal" data-row-id='{"product_id":"<?php echo ($value['product_id']); ?>","product_name":"<?php echo ($value['product_name']); ?>","price":"<?php echo ($value['price']); ?>","product_unit_name":"<?php echo ($value['product_unit_name']); ?>","product_img1":"<?php echo base_url($value['product_img1']); ?>"}'>
                                                <img class="img-responsive" style="width:350px; height:350px; object-fit:contain" alt="product" src="<?php echo base_url($value['product_img1']); ?>" /></a>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name" style="font-weight: bold;text-align: center;">
                                                <? echo $value['product_name'] ?>
                                            </h5>
                                            <div style="text-align: center;">
                                                <div class="content_price">
                                                    <span class="price product-price" style="color: #f30; font-weight: bold;">ราคา <? echo $value['price'] ?> บาท / <?php echo $value['product_unit_name'] ?></span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="button-container" style="align-items: center;justify-content: space-around;">
                                                    <div class="button-container">
                                                    <button class="cart-qty-minus" type="button" value="-">-</button>
                                                        <input type="text" min="1" name="qty" id="<?php echo $value['product_id'] ?>" class="qty form-control" value="1" OnKeyPress="return chkNumber(this)" />
                                                        <button class="cart-qty-plus" type="button" value="+">+</button>
                                                    </div>
                                                    <span>
                                                        <button style="width: 100px;" type="button" name="add_cart" class="btn btn-success add_cart add-cart" data-segment="ajax" data-productname="<?php echo $value['product_name'] ?>" data-price="<?php echo $value['price'] ?>" data-productid="<?php echo $value['product_id'] ?>" />สั่งซื้อ</button>
                                                    </span>
                                                </div>
                                                <input type="hidden" id="product_id" name="product_id" value="<? echo $value['product_id'] ?>">
                                                <input type="hidden" name="segment" value="index">
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            <? } ?>
                            <? } ?>

                        </ul>
                        <!-- ./PRODUCT LIST -->
                    </div>
                    <!-- ./view-product-list-->
                    <div class="sortPagiBar">
                        <div class="bottom-pagination">
                            <nav>
                                <?php echo $links; ?>
                            </nav>
                        </div>

                    </div>
                <?php } else if ($this->uri->segment(2) === 'promotion') { ?>
                    <div id="view-product-list" class="view-product-list">
                        <h2 class="page-heading"><span class="page-heading-title"><?php echo $promotion_name ?></span></h2>
                        <ul class="row product-list style2 grid">
                            <p id="oneflashsale" style="display:none">EXPIRED</p>
                            <?php
                            if (is_array($promotions)) {
                                foreach ($promotions as $value) { ?>
                                <li class="col-sx-12 col-sm-4">
                                    <div class="product-container">
                                        <div class="left-block">
                                            <a href="#" data-toggle="modal" data-target="#my_modal" data-row-id='{"product_id":"<?php echo ($value['product_id']); ?>","product_name":"<?php echo ($value['product_name']); ?>","price":"<?php echo ($value['price']); ?>","product_unit_name":"<?php echo ($value['product_unit_name']); ?>","product_img1":"<?php echo base_url($value['product_img1']); ?>"}'>
                                                <img class="img-responsive" style="width:350px; height:350px; object-fit:contain" alt="product" src="<?php echo base_url($value['product_img1']); ?>" /></a>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name" style="font-weight: bold;text-align: center;">
                                                <? echo $value['product_name'] ?>
                                            </h5>
                                            <div style="text-align: center;">
                                                <div class="content_price">
                                                    <span class="price product-price" style="color: #f30; font-weight: bold;">ราคา <? echo $value['price'] ?> บาท / <?php echo $value['product_unit_name'] ?></span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="button-container" style="align-items: center;justify-content: space-around;">
                                                    <div class="button-container">
                                                    <button class="cart-qty-minus" type="button" value="-">-</button>
                                                        <input type="text" min="1" name="qty" id="<?php echo $value['product_id'] ?>" class="qty form-control" value="1" OnKeyPress="return chkNumber(this)" />
                                                        <button class="cart-qty-plus" type="button" value="+">+</button>
                                                    </div>
                                                    <span>
                                                        <button style="width: 100px;" type="button" name="add_cart" class="btn btn-success add_cart add-cart" data-segment="ajax" data-productname="<?php echo $value['product_name'] ?>" data-price="<?php echo $value['price'] ?>" data-productid="<?php echo $value['product_id'] ?>" />สั่งซื้อ</button>
                                                    </span>
                                                </div>
                                                <input type="hidden" id="product_id" name="product_id" value="<? echo $value['product_id'] ?>">
                                                <input type="hidden" name="segment" value="index">
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            <? } ?>
                            <? } ?>

                        </ul>
                        <!-- ./PRODUCT LIST -->
                    </div>
                    <!-- ./view-product-list-->
                    <div class="sortPagiBar">
                        <div class="bottom-pagination">
                            <nav>
                                <?php echo $links; ?>
                            </nav>
                        </div>

                    </div>
                <?php } else { ?>
                    <div id="view-product-list" class="view-product-list">
                        <h2 class="page-heading"><span class="page-heading-title">สินค้าทั้งหมด</span></h2>
                        <ul class="row product-list style2 grid">
                            <p id="oneflashsale" style="display:none">EXPIRED</p>
                            <?php
                            foreach ($products as $value) { ?>
                                <li class="col-sx-12 col-sm-4">
                                    <div class="product-container">
                                        <div class="left-block">
                                            <a href="#" data-toggle="modal" data-target="#my_modal" data-row-id='{"product_id":"<?php echo ($value['product_id']); ?>","product_name":"<?php echo ($value['product_name']); ?>","price":"<?php echo ($value['price']); ?>","product_unit_name":"<?php echo ($value['product_unit_name']); ?>","product_img1":"<?php echo base_url($value['product_img1']); ?>"}'>
                                                <img class="img-responsive" style="width:350px; height:350px; object-fit:contain" alt="product" src="<?php echo base_url($value['product_img1']); ?>" /></a>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name" style="font-weight: bold;text-align: center;">
                                                <? echo $value['product_name'] ?>
                                            </h5>
                                            <div style="text-align: center;">
                                                <div class="content_price">
                                                    <span class="price product-price" style="color: #f30; font-weight: bold;">ราคา <? echo $value['price'] ?> บาท / <?php echo $value['product_unit_name'] ?></span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="button-container" style="align-items: center;justify-content: space-around;">
                                                    <div class="button-container">
                                                    <button class="cart-qty-minus" type="button" value="-">-</button>
                                                        <input type="text" min="1" name="qty" id="<?php echo $value['product_id'] ?>" class="qty form-control" value="1" OnKeyPress="return chkNumber(this)" />
                                                        <button class="cart-qty-plus" type="button" value="+">+</button>
                                                    </div>
                                                    <span>
                                                        <button style="width: 100px;" type="button" name="add_cart" class="btn btn-success add_cart add-cart" data-segment="ajax" data-productname="<?php echo $value['product_name'] ?>" data-price="<?php echo $value['price'] ?>" data-productid="<?php echo $value['product_id'] ?>" />สั่งซื้อ</button>
                                                    </span>
                                                </div>
                                                <input type="hidden" id="product_id" name="product_id" value="<? echo $value['product_id'] ?>">
                                                <input type="hidden" name="segment" value="index">
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            <? } ?>
                        </ul>
                        <!-- ./PRODUCT LIST -->
                    </div>
                    <!-- ./view-product-list-->
                    <div class="sortPagiBar">
                        <div class="bottom-pagination">
                            <nav>
                                <?php echo @$links; ?>
                            </nav>
                        </div>

                    </div>

                <?php   } ?>

            </div>
        </div>
        <!-- ./row-->
    </div>
</div>

<div class='modal fade' id='my_modal' tabindex='-1' role='dialog' aria-labelledby='delModalLabel' aria-hidden='true'>
    <div class='modal-dialog modal-lg' role='document'>
        <div class='modal-content'>
            <div class="modal-header" style="border-bottom: 0px;">
                <button type="button" style="font-size: 25px;" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class='modal-body' style="text-align: center;">
                <div class="modal-body">
                    <img style="width:400px; height:400px; object-fit:contain" id="my_image" /></a>
                </div>
            </div>
            <div class='modal-footer text-left'>
                <form method='post' action='<?php echo base_url('shop/addToCart/'); ?>'>
                    <div class="row vertical-align">
                    <div class="col-sm-12 col-md-5">
                            <div class="button-container" style="align-items: center;justify-content: center;">
                                <p style="font-size:14px;text-align: center;" id="product_name"></p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="button-container" style="align-items: center;justify-content: center;">
                                <p style="color: #f30; font-weight: bold;font-size:14px;text-align: center;" id="unit_text"></p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-5">
                            <div class="button-container" style="align-items: center;justify-content: space-around;">
                                <span>
                                    จำนวน
                                </span>
                                <button class="cart-qty-minus" type="button" value="-">-</button>
                                <input type="text" min="1" id="qty" name="qty" class="qty form-control" value="1" OnKeyPress="return chkNumber(this)" />
                                <button class="cart-qty-plus" type="button" value="+">+</button>

                                <span>
                                <button style="width: 100px;" type='submit' name='submit' value="submit" class="btn btn-success">สั่งซื้อ</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="product_id" name="product_id" value="">
                    <?php if ($this->uri->segment(2) === 'category') { ?>
                        <input type="hidden" name="segment" value="category">
                        <input type="hidden" name="product_type" value="<?php echo $product_type_id ?>">
                    <?php } else { ?>
                        <input type="hidden" name="segment" value="shop">
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>
<div class='modal fade' id='myPromotion' tabindex='-1' role='dialog' aria-labelledby='delModalLabel' aria-hidden='true'>
    <div class='modal-dialog modal-lg' role='document'>
        <div class='modal-content'>
            <div class="modal-header" style="border-bottom: 0px;">
                <button type="button" style="font-size: 25px;" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class='modal-body' style="text-align: center;">
                <div class="modal-body">
                    <img style="width:400px; height:400px; object-fit:contain" id="my_image_promotion" /></a>
                </div>
            </div>
            <div class='modal-footer text-left'>
                    <div class="row vertical-align">
                        <div class="col-sm-12 col-md-12">
                            <div class="button-container" style="align-items: center;justify-content: center;padding-bottom: 5px;">
                            <p style="font-size:14px;text-align: center;" id="promotion_detail_text"></p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
