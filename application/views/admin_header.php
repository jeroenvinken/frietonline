<!-- Header -->
<div id="header-wrapper">
    <header id="header" class="container">
        <div class="row">
            <div class="12u">

                <!-- Logo -->
                <!--<h1><a href="#" id="logo">Buromas</a></h1>-->
                <?php echo anchor('admin/index', '<img src="' . base_url() . APPPATH . 'images/logo.png" alt="" id="logo" height="96"/>'); ?>


                <!-- Nav -->
                <nav id="nav">
                    <?php
                    echo anchor('index/index', 'Home');
                    echo anchor('index/overburomas', 'Over Buromas');
                    echo anchor('index/series', 'Series');
                    ?>                    

                </nav>

            </div>
        </div>
    </header>    
</div>