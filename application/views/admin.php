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
                        
                        <?php echo anchor('admin/series_beheren', 'Series beheren', 'class="button icon fa-arrow-circle-right"');?><br/>
                        <?php echo anchor('admin/stoelen_beheren', 'Stoelen beheren', 'class="button icon fa-arrow-circle-right"');?><br/>
                        <?php echo anchor('admin/opties_beheren', 'Opties beheren', 'class="button icon fa-arrow-circle-right"');?><br/>
                        <?php echo anchor('admin/kleurpalletten_beheren', 'Kleurpalletten beheren', 'class="button icon fa-arrow-circle-right"');?><br/>
                        
                    </section>

                </div>
                
            </div>
        </div>
    </div>
</div>