<?php
/* if ($gebruiker != null) {
  if ($gebruiker->level != 3 && $gebruiker->level != 2) {
  exit("Ga hier onmiddelijk weg!");
  }
  } else {
  exit("Ga hier onmiddelijk weg!");
  } */
?>

<script type="text/javascript">

// niet gebruikt?
    function updateserie(serieid) {
        var naam = $("#serienaam").val();
        var omschrijving = $("#serieomschrijving").val();
        var id = serieid;
        $.ajax({type: "GET",
            url: site_url + "/admin/update_serie",
            data: {id: id, naam: naam, omschrijving: omschrijving},
            success: function (result) {
                $("#btnupdateserie").html("Opgeslagen!");
            }
        });
    }

</script>

<?php
// message artikel toegevoegd
if (isset($aangepast)) {
    echo "<div class='toegevoegd'><p>" . $aangepast . "</p></div>";
}
?>

<!-- Content -->
<div id="content-wrapper">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="12u">

                    <!-- Box #1 -->
                    <section>
                        <header>
                            <?php if (isset($serie)) { ?>
                                <h2><?php echo $serie->naam ?></h2>
                                <h3>Hier kunt u de gegevens van deze rubriek aanpassen.</h3>
                            <?php } else { ?>
                                <h2>Nieuwe rubriek aanmaken</h2>
                                <h3>Vul onderstaande gegevens in voor een nieuwe rubriek aan te maken.</h3>
                            <?php } ?>
                        </header>                        

                        <?php
                        if (isset($serie)) {
                            echo form_open_multipart('admin/update_serie');
                        } else {
                            echo form_open_multipart('admin/update_serie');
                        }
                        echo "<table width='100%' class='tableMenu'>";
                        echo "<colgroup>";
                        echo "<col width='40%'/>";
                        echo "<col width='20%'/>";
                        echo "<col width='40%'/>";
                        echo "</colgroup>";

                        echo "<tr>";
                        echo "<th> Foto </th>";
                        echo "<th> Naam </th>";
                        echo "<th> Omschrijving </th>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>";
                        if (isset($serie)) {
                            if (($serie->fotopad != null)) {
                                echo '<img src="' . base_url() . APPPATH . '' . $serie->fotopad . '" alt="" width="300px" style="margin-top: 10px;" /><br />';
                            }
                        }
                        $data = array('name' => 'userfile[]', 'id' => 'userfile', 'accept' => 'image/*', 'style' => 'padding: 15px 0;');
                        echo form_upload($data);
                        echo "</td>";
                        echo "<td><input type='text' id='serienaam' placeholder='Naam' name='naam' value='";
                        if (isset($serie)) {
                            echo $serie->naam;
                        }
                        echo "'/></td>";

                        echo "<td><textarea id='serieomschrijving' placeholder='Omschrijving' name='omschrijving' cols='45' rows='12'>";
                        if (isset($serie)) {
                            echo $serie->omschrijving;
                        }
                        echo "</textarea></td>";
                        echo "</tr>";

                        // hoofdcat
                        echo "<tr><td>Hoofdrubriek: </td><td colspan='2'>";
                        $options[0] = '-- Geen hoofdrubriek --';
                        foreach ($alleSeries as $val) {                            
                            $options[$val->id] = $val->naam;
                        }
                        echo form_dropdown('hoofdrubriek', $options, $serie->hoofdrubriekId, "id='hoofdrubriek'");
                        echo "</td></tr>";
                        echo "</table>";
                        if (isset($serie)) {
                            echo form_hidden('id', $serie->id);
                        }
                        echo form_submit('submit', 'Opslaan!');
                        echo form_close();
                        ?>
                        <!--<div><a class='button icon fa-arrow-circle-right' id="btnupdateserie" onclick="updateserie(<?php //echo $serie->id;        ?>)" href="#">Opslaan</a></div>-->
                    </section>

                    <?php if (isset($serie)) { ?>             


                        <h2>Subrubrieken</h2>

                        <?php
                        $teller = 0;
                        if (count($serie->subrubrieken) > 0) {
                            foreach ($serie->subrubrieken as $subrubriek) {
                                if ($teller == 4) {
                                    echo "</div><!-- row " . ($teller + 2) . " --><div class='row'>";
                                    $teller = 0;
                                }

                                //if (($serie->hoofdrubriekId == null) || $serie->hoofdrubriekId == 0) {
                                ?>

                                <div class="3u">
                                    <!-- Feature #1 -->
                                    <section>
                                        <?php echo anchor('/admin/serie_bewerken/' . $subrubriek->id, '<img src="' . base_url() . APPPATH . '' . $subrubriek->fotopad . '" alt="Foto van de stoel">', array('class' => 'bordered-feature-image')); ?>
                                        <h2><?php echo $subrubriek->naam ?></h2>
                                        <p>
                                            <?php echo $subrubriek->omschrijving ?>
                                        </p>
                                    </section>
                                </div>                
                                <?php
                                $teller++;
                                //}
                            }
                        } else {
                            echo "<h3>Geen subrubrieken gevonden!</h3>";
                        }
                        ?>

                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</div>



<?php
include_once("dialogs_series.php");
?>