<div class="row">
    <?php
    $teller = 0;
    foreach ($stoelen as $stoel) {
        if ($teller == 4) {
            echo "</div><!-- row " . ($teller + 2) . " --><div class='row'>";
            $teller = 0;
        }
        ?>

        <div class="3u">
            <!-- Feature #1 -->
            <section style='box-shadow: 0 0 0 0;'>
                <?php echo anchor('admin/stoel_bewerken/' . $stoel->id, '<img src="' . base_url() . APPPATH . '' . $stoel->fotopad . '" alt="Foto van de stoel">', array('class' => 'bordered-feature-image')); ?>
                <h2><?php echo $stoel->naam ?></h2>
                <p>
                    <?php echo $stoel->omschrijving ?>
                </p>
            </section>
        </div>                
    <?php $teller++;
    
        } ?>                
</div>