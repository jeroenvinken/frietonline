<script>
    $(document).ready(function () {
        getPrijzen();
    });

    $("select").change(function () {
        getPrijzen();
    });

    function getPrijzen() {

        var armsteunId = $('#armsteun').attr('value');
        var hoofdsteunId = $('#hoofdsteun').attr('value');
        var onderstelId = $('#onderstel').attr('value');
        var stofId = $('#stof').attr('value');
        var wielenId = $('#wielen').attr('value');
        var zitdiepteId = $('#zitdiepte').attr('value');
        var zitkantelId = $('#zitkantel').attr('value');
        var kleurId = $('#gekozenkleurId').attr('value');
        var stoelId = <?php echo $stoel->id ?>;

        //alert(kleurId);

        $.ajax({type: "GET",
            url: site_url + "/samenstellen/prijs",
            data: {armsteunId: armsteunId, hoofdsteunId: hoofdsteunId, onderstelId: onderstelId, stofId: stofId, wielenId: wielenId, zitdiepteId: zitdiepteId, zitkantelId: zitkantelId, kleurId: kleurId, stoelId: stoelId},
            success: function (result) {
                $("#resultaat").html(result);
            }
        });
    }

    function getStofKleurpalletten() {
        var stofId = $('#stof').attr('value');
        var stoelId = <?php echo $stoel->id ?>;

        $.ajax({type: "GET",
            url: site_url + "/samenstellen/getstofkleurpallet",
            data: {stofId: stofId, stoelId: stoelId},
            success: function (result) {
                $("#stofkleurpalletten").html(result);
                $("#kleuren").hide();
            }
        });
    }

    function getKleurpalletkleuren() {
        var kleurpalletId = $('#kleurpallet').attr('value');
        var stoelId = <?php echo $stoel->id ?>;
        $.ajax({type: "GET",
            url: site_url + "/samenstellen/getkleurpalletkleuren",
            data: {kleurpalletId: kleurpalletId, stoelId: stoelId},
            success: function (result) {
                $("#kleuren").html(result);
                $("#kleuren").show();
            }
        });
    }

    function hoverColor(color) {

    }

    function toonOmschrijving(optie) {
        var optienaam = $(optie).attr('id');
        $.ajax({type: "GET",
            url: site_url + "/samenstellen/toonomschrijving",
            data: {optienaam: optienaam},
            success: function (result) {
                $("#optieomschrijving").html(result);
                $("#optieomschrijving").show();
            }
        });

    }

    function removeOptieOmschrijving() {
        $("#optieomschrijving").hide();
    }

    function colorClick(color) {
        $(".colorblock").each(function () {
            $(this).removeClass('selectedColor');
        });

        $(color).addClass('selectedColor');
        $("#gekozenkleurId").val($(color).data('colorid'));
    }
</script>
<!-- Content -->
<div id="content-wrapper">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="4u">
                    <!-- Box #1 -->
                    <section>
                        <header>
                            <h2><?php echo $stoel->naam ?></h2>
                            <h3><?php echo $stoel->omschrijving ?></h3>
                        </header>
                        <?php echo anchor('#', '<img src="' . base_url() . APPPATH . '' . $stoel->fotopad . '" alt="Foto van de stoel">', array('class' => 'feature-image')); ?>
                        <!-- vroeger hier resultaat
                        <div id="resultaat">

                        </div>-->
                        <div style='width: 100% !important;' id="extraInfo">
                            <?php if($stoel->youtubeLink != NULL) { ?>
                            <h2>Youtube filmpje</h2>
                            <iframe style='padding-bottom: 15px;' width="100%" src="<?php echo $stoel->youtubeLink . '?autoplay=0'; ?>" allowfullscreen>
                            </iframe>   
                            <?php }
                            if ($stoel->pdfPath != NULL) {
                            ?>
                            <h2>Uitgebreide informatie</h2>
                            <?php echo anchor(base_url() . APPPATH . '' . $stoel->pdfPath, '<img src="' . base_url() . APPPATH . 'images/download-pdf.png' . '" alt="PDF met extra info over de stoel."> Toon PDF', array('class' => 'pdfImage')); ?>
                            <?php } ?>
                        </div>
                    </section>

                </div>

                <div class="4u">
                    <!-- Box #2 -->
                    <section>
                        <header>
                            <h2>Uw stoel samenstellen</h2>
                            <h3>Kies hieronder de specificaties van uw stoel</h3>
                        </header>
                        <p>
                            Duis neque nisi, dapibus sed mattis quis, rutrum accumsan sed. 
                            Suspendisse eu varius nibh. Suspendisse vitae magna eget odio amet mollis 
                            justo facilisis quis. Sed sagittis mauris amet tellus gravida lorem ipsum.                            
                        </p>                        
                        <br />
                        <br />

                        <table border="0" class="tableWithPadding">
                            <!-- Armsteunopties -->
                            <?php if ($armsteunOpties != null) { ?>
                                <tr>
                                    <td><?php echo form_label('Armsteun: ', 'armsteun'); ?></td>
                                    <td>
                                        <?php
                                        $options[0] = '-- Selecteer --';
                                        foreach ($armsteunOpties as $optie) {
                                            $options[$optie->id] = $optie->naam . " - (+&euro;" . (($optie->promoprijs != NULL) ? $optie->promoprijs : $optie->prijs) . ")";
                                        }
                                        echo form_dropdown('armsteun', $options, '0', 'id="armsteun" onmouseover="toonOmschrijving(this)" onmouseleave="removeOptieOmschrijving()"');
                                        $options = null;
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>   

                            <!-- Hoofdsteunopties -->
                            <?php if ($hoofdsteunOpties != null) { ?>
                                <tr>
                                    <td><?php echo form_label('Hoofdsteun: ', 'hoofdsteun'); ?></td>
                                    <td>
                                        <?php
                                        $options[0] = '-- Selecteer --';
                                        foreach ($hoofdsteunOpties as $optie) {
                                            $options[$optie->id] = $optie->naam . " - (&euro;" . (($optie->promoprijs != NULL) ? $optie->promoprijs : $optie->prijs) . ")";
                                        }
                                        echo form_dropdown('hoofdsteun', $options, '0', 'id="hoofdsteun" onmouseover="toonOmschrijving(this)" onmouseleave="removeOptieOmschrijving()"');
                                        $options = null;
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>  

                            <!-- Onderstelopties -->
                            <?php if ($onderstelOpties != null) { ?>
                                <tr>
                                    <td><?php echo form_label('Onderstel: ', 'onderstel'); ?></td>
                                    <td>
                                        <?php
                                        $options[0] = '-- Selecteer --';
                                        foreach ($onderstelOpties as $optie) {
                                            $options[$optie->id] = $optie->naam . " - (&euro;" . (($optie->promoprijs != NULL) ? $optie->promoprijs : $optie->prijs) . ")";
                                        }
                                        echo form_dropdown('onderstel', $options, '0', 'id="onderstel" onmouseover="toonOmschrijving(this)" onmouseleave="removeOptieOmschrijving()"');
                                        $options = null;
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?> 

                            <!-- Stofopties -->
                            <?php if ($stofOpties != null) { ?>
                                <tr>
                                    <td><?php echo form_label('Stof: ', 'stof'); ?></td>
                                    <td>
                                        <?php
                                        $options[0] = '-- Selecteer --';
                                        foreach ($stofOpties as $optie) {
                                            $options[$optie->id] = $optie->naam . " - (&euro;" . (($optie->promoprijs != NULL) ? $optie->promoprijs : $optie->prijs) . ")";
                                        }
                                        echo form_dropdown('stof', $options, '0', 'id="stof" onchange="getStofKleurpalletten()" onmouseover="toonOmschrijving(this)" onmouseleave="removeOptieOmschrijving()"');
                                        $options = null;
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>

                            <!-- Kleurpalletopties (enkel zichtbaar na selecteren van stof -->
                            <tr id="stofkleurpalletten"></tr>

                            <!-- Kleuropties (enkel zichtbaar na selecteren van stof kleurpallet-->
                            <tr id="kleuren"></tr>
                            <input type="hidden" value="0" id="gekozenkleurId"/> 


                            <!-- Wielenopties -->
                            <?php if ($wielenOpties != null) { ?>
                                <tr>
                                    <td><?php echo form_label('Wielen: ', 'wielen'); ?></td>
                                    <td>
                                        <?php
                                        $options[0] = '-- Selecteer --';
                                        foreach ($wielenOpties as $optie) {
                                            $options[$optie->id] = $optie->naam . " - (&euro;" . (($optie->promoprijs != NULL) ? $optie->promoprijs : $optie->prijs) . ")";
                                        }
                                        echo form_dropdown('wielen', $options, '0', 'id="wielen" onmouseover="toonOmschrijving(this)" onmouseleave="removeOptieOmschrijving()"');
                                        $options = null;
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>

                            <!-- Zitdiepteopties -->
                            <?php if ($zitdiepteOpties != null) { ?>
                                <tr>
                                    <td><?php echo form_label('Zitdiepte: ', 'zitdiepte'); ?></td>
                                    <td>
                                        <?php
                                        $options[0] = '-- Selecteer --';
                                        foreach ($zitdiepteOpties as $optie) {
                                            $options[$optie->id] = $optie->naam . " - (&euro;" . (($optie->promoprijs != NULL) ? $optie->promoprijs : $optie->prijs) . ")";
                                        }
                                        echo form_dropdown('zitdiepte', $options, '0', 'id="zitdiepte" onmouseover="toonOmschrijving(this)" onmouseleave="removeOptieOmschrijving()"');
                                        $options = null;
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>

                            <!-- Zitkantelopties -->
                            <?php if ($zitkantelOpties != null) { ?>
                                <tr>
                                    <td><?php echo form_label('Zitkantel: ', 'zitkantel'); ?></td>
                                    <td>
                                        <?php
                                        $options[0] = '-- Selecteer --';
                                        foreach ($zitkantelOpties as $optie) {
                                            $options[$optie->id] = $optie->naam . " - (&euro;" . (($optie->promoprijs != NULL) ? $optie->promoprijs : $optie->prijs) . ")";
                                        }
                                        echo form_dropdown('zitkantel', $options, '0', 'id="zitkantel" onmouseover="toonOmschrijving(this)" onmouseleave="removeOptieOmschrijving()"');
                                        $options = null;
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </section>
                </div>

                <div class="4u">
                    <!-- Box #3 -->
                    <section>
                        <header>
                            <h2>Bestellen</h2>
                            <h3>Door op onderstaande knop te klikken kunt u uw gepersonaliseerde stoel bestellen</h3>
                        </header>
                        <div id="resultaat">

                        </div>
                        <p style='display: none;'>
                            <strong>Totaalprijs</strong> (incl. BTW): &euro;<label id="totaal">125</label>
                        </p>
                        <br />
                        <!--<a href="#" class="feature-image"><img src="<?php //echo base_url() . APPPATH;       ?>images/verder.png" alt="" /></a>-->
                        <a href="" class="button icon fa-arrow-circle-right">Ga verder</a>
                    </section>
                    <div id="optieomschrijving"></div>

                </div>

            </div>
        </div>
    </div>
</div>