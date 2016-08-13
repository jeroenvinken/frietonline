<div id="page-wrapper">

    <!-- Header -->
    <header id="header" <?php
    if (isset($pagina)) {
        if ($pagina == 'index') {
            echo 'class="alt"';
        }
    }
    ?>>
        <h1><?php echo anchor('admin/index', 'Frietonline'); ?></h1>
        <nav id="nav">
            <ul>
                <li><?php echo anchor('index/index', 'Ga naar live website'); ?></li>                
                <li><?php echo anchor('admin/uitloggen', '<i class="fa fa-sign-out" aria-hidden="true" title="Uitloggen"></i>'); ?></li>

            </ul>
        </nav>
    </header>