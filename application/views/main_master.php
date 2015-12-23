<!DOCTYPE HTML>
<!--
	Halcyonic 3.1 by HTML5 UP
	html5up.net | @n33co
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
        <link rel="stylesheet" href="<?php echo base_url() . APPPATH; ?>css/skel-noscript.css">
        <link rel="stylesheet" href="<?php echo base_url() . APPPATH; ?>css/style.css">
        <link rel="stylesheet" href="<?php echo base_url() . APPPATH; ?>css/style-desktop.css">        
        <!--[if lte IE 9]><link rel="stylesheet" href="<?php echo base_url() . APPPATH; ?>css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><script src="<?php echo base_url() . APPPATH; ?>js/html5shiv.js"></script><![endif]-->
        <script src="<?php echo base_url() . APPPATH; ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url() . APPPATH; ?>js/config.js"></script>
        <script src="<?php echo base_url() . APPPATH; ?>js/skel.min.js"></script>
        <script src="<?php echo base_url() . APPPATH; ?>js/skel-panels.min.js"></script>      
        
        <script src="<?php echo base_url() . APPPATH; ?>js/jquery-1.6.2.min.js"></script>  
        
        <script type="text/javascript" src="<?php echo base_url() . APPPATH; ?>js/jquery-ui-1.8.16.custom.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . APPPATH; ?>css/ui-lightness/jquery-ui-1.8.16.custom.css" />
        
        <script type="text/javascript">
            var site_url = '<?php echo site_url(); ?>';
            var img_url = '<?php echo base_url() . APPPATH; ?>';
        </script>        
        
    </head>
    <body>
        <?php echo $header; ?>
        <?php echo $content; ?>
        <?php echo $footer; ?>
    </body>
</html>