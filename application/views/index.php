<script>

// shortcut voor gemak
    $(document).keypress("enter", function (e) {
        if (e.ctrlKey)
            window.location.href = site_url + "/admin";
    });
</script>

<!-- Features -->
<div id="features-wrapper">
    <div id="features">
        <div class="container">
            <div class="row">
                <?php
                $teller = 0;
                foreach ($series as $serie) {
                    if ($teller == 4) {
                        echo "</div><!-- row " . ($teller + 2) . " --><div class='row'>";
                        $teller = 0;
                    }

                    //if (($serie->hoofdrubriekId == null) || $serie->hoofdrubriekId == 0) {
                    ?>

                    <div class="3u">
                        <!-- Feature #1 -->
                        <section>
                            <?php echo anchor('serie/index/' . $serie->id, '<img src="' . base_url() . APPPATH . '' . $serie->fotopad . '" alt="Foto van de stoel">', array('class' => 'bordered-feature-image')); ?>
                            <h2><?php echo $serie->naam; ?></h2>
                            <p>
                                <?php echo $serie->omschrijving; ?>
                            </p>
                        </section>
                    </div>                
                    <?php
                    $teller++;
                    //}
                }
                ?>                
            </div>
        </div>
    </div>
</div>

<!-- Content 
<div id="content-wrapper">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="12u">

<!-- Box #1 -->
<!--
<section>
    <header>
        <h2>Wie zijn wij</h2>
        <h3>Korte inleidende tekst. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
    </header>
    <a href="#" class="feature-image"><img src="<?php //echo base_url() . APPPATH;    ?>images/winkel.jpg" alt="" /></a>
    <p>
        Duis neque nisi, dapibus sed mattis quis, rutrum accumsan sed. 
        Suspendisse eu varius nibh. Suspendisse vitae magna eget odio amet mollis 
        justo facilisis quis. Sed sagittis mauris amet tellus gravida lorem ipsum.
        
        Cras facilisis nisl eu purus luctus mollis. Sed iaculis massa et dui aliquet, nec dapibus mauris aliquam. 
        Vestibulum at quam ac lectus congue tristique. Aliquam lacinia, arcu egestas tempor convallis, augue lectus rutrum sapien, at egestas lacus mauris ut nisl. 
        Curabitur luctus, ipsum non gravida elementum, dolor eros sollicitudin sem, ut sagittis lorem justo ut nunc.
    </p>
</section>

</div>

</div>
</div>
</div>
</div>-->