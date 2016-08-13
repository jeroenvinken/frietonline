<!DOCTYPE HTML>
<!--
        Alpha by HTML5 UP
        html5up.net | @ajlkn
        Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
    <head>

        <title><?php echo $title; ?></title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />

        <meta charset="utf-8">
        <link rel="icon" href="<?php echo base_url() . APPPATH; ?>images/favicon.ico">
        <link rel="shortcut icon" href="<?php echo base_url() . APPPATH; ?>images/favicon.ico" />

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="<?php echo base_url() . APPPATH; ?>assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="<?php echo base_url() . APPPATH; ?>assets/css/main.css" />
        <!--[if lte IE 8]><link rel="stylesheet" href="<?php echo base_url() . APPPATH; ?>assets/css/ie8.css" /><![endif]-->

        <link rel="stylesheet" href="<?php echo base_url() . APPPATH; ?>css/style_extra.css" />


        <script src="<?php echo base_url() . APPPATH; ?>js/jquery-1.6.2.min.js"></script>  

        <script type="text/javascript" src="<?php echo base_url() . APPPATH; ?>js/jquery-ui-1.8.16.custom.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . APPPATH; ?>css/ui-lightness/jquery-ui-1.8.16.custom.css" />


        <script type="text/javascript">
            var site_url = '<?php echo site_url(); ?>';
            var img_url = '<?php echo base_url() . APPPATH; ?>';
        </script>   



    </head>
    <body <?php
    if (isset($pagina)) {
        if ($pagina == 'index') {
            echo 'class="landing"';
        }
    }
    ?>>

        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.7";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
<?php echo $header; ?>
<?php echo $content; ?>
<?php echo $footer; ?>
    </body>
    <script src="<?php echo base_url() . APPPATH; ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url() . APPPATH; ?>assets/js/jquery.dropotron.min.js"></script>
    <script src="<?php echo base_url() . APPPATH; ?>assets/js/jquery.scrollgress.min.js"></script>
    <script src="<?php echo base_url() . APPPATH; ?>assets/js/skel.min.js"></script>
    <script src="<?php echo base_url() . APPPATH; ?>assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="<?php echo base_url() . APPPATH; ?>assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="<?php echo base_url() . APPPATH; ?>assets/js/main.js"></script>
</html>