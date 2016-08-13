<!-- Content -->
<div id="content-wrapper">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="12u">

                    <!-- Box #1 -->
                    <section>
                        <header>
                            <h2>Admin pagina</h2>
                            <h3>Klik op onderstaande links om verder te gaan met beheren</h3>
                        </header>
                        
                        <?php echo anchor('admin/menuitems_beheren', 'Producten beheren', 'class="button icon fa-arrow-circle-right"');?><br/>
                        <?php echo anchor('admin/menuitems_aanmaken', 'Producten aanmaken', 'class="button icon fa-arrow-circle-right"');?><br/>
                        <?php echo anchor('admin/teksten_beheren', 'Teksten beheren', 'class="button icon fa-arrow-circle-right"');?><br/>
                        <?php echo anchor('admin/grafieken', 'Grafieken', 'class="button icon fa-arrow-circle-right"');?><br/>
                        <?php echo anchor('admin/uitloggen', 'Uitloggen', 'class="button icon fa-arrow-circle-right"');?><br/>
                        
                    </section>

                </div>
                
            </div>
        </div>
    </div>
</div>