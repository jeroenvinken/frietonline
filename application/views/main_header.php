<!-- Header -->
<div id="header-wrapper">
    <header id="header" class="container">
        <div class="row">
            <div class="12u">

                <!-- Logo -->                
                <?php echo anchor('index/index', '<img src="' . base_url() . APPPATH . 'images/logo_broodje_tekst.png" alt="" id="logo" height="96"/>'); ?>


                <!-- Nav -->
                <nav id="nav">
                    <?php
                    echo anchor('index/index', 'Home');                   
                    echo anchor('index/kaart', 'Kaart');
                    echo anchor('index/contact', 'Contact');
                    ?>                    

                </nav>

            </div>
        </div>
    </header>    
</div>