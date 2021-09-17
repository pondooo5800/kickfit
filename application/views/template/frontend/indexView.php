<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YeeJub | ร้านหยี่จั๊บทุกอย่าง 20 บาท</title>
    <meta name="keywords" content="YeeJub, ร้านหยี่จั๊บทุกอย่าง 20 บาท" />
    <link rel="shortcut icon" type="image/png" href="{base_url}assets/themes/frontend/assets/img/favicon_io/favicon.png" />
    <link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/lib/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/lib/select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/lib/jquery.bxslider/jquery.bxslider.css" />
    <link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/lib/owl.carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/lib/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/css/cart.css" />
    <link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/lib/fancyBox/jquery.fancybox.css" />
    <link rel="stylesheet" type="text/css" href="{base_url}assets/themes/frontend/assets/css/fancybox.css" />
    <style type="text/css">
        * {
            font-family: 'Sarabun', sans-serif;
        }
    </style>
    {another_css}
    <script>
        var baseURL = '{base_url}/';
        var siteURL = '{site_url}/';
        var csrf_token_name = '{csrf_token_name}';
        var csrf_cookie_name = '{csrf_cookie_name}';
    </script>
</head>

<body class="home">
    <a href="{site_url}cart">
        <div class="br-icon">
                <span class="notify notify-left cartcount"><?php echo ($this->cart->total_items());  ?></span>
        </div>
    </a>

    <!-- HEADER -->
    {page_header}
    <!-- END HEADER -->

    <!-- CONTENT -->
    {page_content}
    <!-- END CONTENT -->

    <!-- Footer -->
    {page_footer}
    <!-- END Footer -->

    <script type="text/javascript" src="{base_url}assets/themes/frontend/assets/js/fancybox.umd.js"></script>
    <script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/jquery/jquery-3.4.1.js"></script>
    <script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/jquery/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/select2/js/select2.min.js"></script>
    <script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/jquery.bxslider/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/owl.carousel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/jquery.countdown/jquery.countdown.min.js"></script>
    <script type="text/javascript" src="{base_url}assets/themes/frontend/assets/js/jquery.actual.min.js"></script>
    <script type="text/javascript" src="{base_url}assets/themes/frontend/assets/js/theme-script.js"></script>
    <script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/jquery.elevatezoom.js"></script>
    <script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{base_url}assets/themes/frontend/assets/lib/fancyBox/jquery.fancybox.js"></script>
    <script type="text/javascript" src="{base_url}assets/js/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="{base_url}assets/js/ci_utilities.js?ver=1541805506"></script>
    <script src="{base_url}assets/bootstrap_extras/bootstrap-notify.min.js"></script>



    {another_js}
</body>

</html>