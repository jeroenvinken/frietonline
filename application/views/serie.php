<!-- Features -->
<div id="features-wrapper">
    <div id="features">
        <div class="container">
            <div class="row">
                <?php
                foreach ($stoelen as $stoel) { 
                    if ($stoel->id == 5) {
                        echo "</div><!-- row 2 --><div class='row'>";
                    }
                    ?>
                
                    <div class="3u">
                    <!-- Feature #1 -->
                    <section>
                        <?php echo anchor('samenstellen/index/' . $stoel->id, '<img src="' . base_url() . APPPATH . '' . $stoel->fotopad . '" alt="Foto van de stoel">', array('class' => 'bordered-feature-image'));?>
                        <h2><?php echo $stoel->naam ?></h2>
                        <p>
                            <?php echo $stoel->omschrijving ?>
                        </p>
                    </section>
                </div>                
                <?php } ?>                
            </div>
        </div>
    </div>
</div>
