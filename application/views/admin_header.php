<div id="page-wrapper">

    <!-- Header -->
    <header id="header" <?php if ($pagina == 'index') {
    echo 'class="alt"';
} ?>>
        <h1><?php echo anchor('index/index', 'Frietonline'); ?></h1>
        <nav id="nav">
            <ul>
                <li><?php echo anchor('index/index', 'Home'); ?></li>
                <li><?php echo anchor('index/kaart', 'Kaart'); ?></li>
                <li><?php echo anchor('index/contact', 'Contact'); ?></li>


            </ul>
        </nav>
    </header>