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
    var stoelId = <?php
if (isset($stoel)) {
    echo $stoel->id;
} else {
    echo "0";
}
?>;
    function voegOptieOnderdeelAanStoelToe(optieId) {        
        var optieOnderdeelId = $("#dropoptie" + optieId).val();       
        $.ajax({type: "GET",
            url: site_url + "/admin/voegoptieonderdeelaanstoeltoe",
            data: {optieOnderdeelId: optieOnderdeelId, stoelId: stoelId, optieId: optieId},
            success: function (result) {                
                $("#gekozen" + optieId).html(result);
            }
        });        
    }
    
    function voegNieuweOptieOnderdeelAanStoelToe(optieId) {
        var optieNaam = $("#nieuweOptieNaam" + optieId).val();  
        var optiePrijs = $("#nieuweOptiePrijs" + optieId).val(); 
        var optiePromoPrijs = $("#nieuweOptiePromoPrijs" + optieId).val(); 
        $.ajax({type: "GET",
            url: site_url + "/admin/voegnieuweoptieonderdeelaanstoeltoe",
            data: {optieNaam: optieNaam, optiePrijs: optiePrijs, optiePromoPrijs: optiePromoPrijs, stoelId: stoelId, optieId: optieId},
            success: function (result) {                
                $("#gekozen" + optieId).html(result);
            }
        }); 
    }
    
    function laadToegewezenOpties(optieId) {        
        $.ajax({type: "GET",
            url: site_url + "/admin/laadtoegewezenstoelopties",
            data: {optieId: optieId, stoelId: stoelId},
            success: function (result) {
                alert(optieId + result);
                //laad stoel geselecteerde optieOnderdelen van die specifieke optie opnieuw
                $("#gekozen" + optieId).val(result);
            }
        });
    }
    
    function verwijderoptie(id)
    {        
        $.ajax({type: "GET",
            url: site_url + "/admin/verwijderoptieonderdeelvanstoel",
            data: {stoelOptieOnderdeelId: id},
            success: function (result) {                
                $("#optieonderdeel" + id).fadeTo("slow", 0.1, function () {
                    // Animation complete.
                    $("#optieonderdeel" + id).remove();
                });
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
                            <?php if (isset($stoel)) { ?>
                                <h2><?php echo $stoel->naam ?></h2>
                                <h3>Hier kunt u de gegevens van deze stoel aanpassen.</h3>
                            <?php } else { ?>
                                <h2>Nieuwe stoel aanmaken</h2>
                                <h3>Vul onderstaande gegevens in voor een nieuwe stoel aan te maken.</h3>
                            <?php } ?>
                        </header>                        

                        <?php
                        if (isset($stoel)) {
                            echo form_open_multipart('admin/update_stoel');
                        } else {
                            echo form_open_multipart('admin/update_stoel');
                        }
                        echo "<table width='100%' class='tableMenu'>";
                        echo "<colgroup>";
                        echo "<col width='20%'/>";
                        echo "<col width='80%'/>";
                        echo "</colgroup>";

                        // naam
                        echo "<tr>";
                        echo "<td class='firstTD'>Naam:</td>";
                        echo "<td><input type='text' id='stoelnaam' placeholder='Naam' name='naam' value='";
                        if (isset($stoel)) {
                            echo $stoel->naam;
                        }
                        echo "'/></td>";
                        echo "</tr>";

                        // prijs
                        echo "<tr>";
                        echo "<td class='firstTD'>Prijs:</td>";
                        echo "<td><input type='text' id='stoelprijs' placeholder='Prijs' name='prijs' value='";
                        if (isset($stoel)) {
                            echo $stoel->prijs;
                        }
                        echo "'/>";
                        echo "<input type='text' id='stoelpromoprijs' placeholder='Promoprijs' name='promoprijs' value='";
                        if (isset($stoel)) {
                            echo $stoel->promoprijs;
                        }
                        echo "' style='margin-left: 20px;'/></td>";
                        echo "</tr>";

                        // promoprijs
                        /*
                          echo "<tr>";
                          echo "<td class='firstTD'>Promoprijs:</td>";
                          echo "<td><input type='text' id='stoelpromoprijs' placeholder='Promoprijs' name='naam' value='";
                          if (isset($stoel)) {
                          echo $stoel->promoprijs;
                          }
                          echo "'/></td>";
                          echo "</tr>";
                         * 
                         */

                        // omschrijving
                        echo "<tr>";
                        echo "<td class='firstTD'>Omschrijving:</td>";
                        echo "<td><textarea id='stoelomschrijving' placeholder='Omschrijving' name='omschrijving' cols='45' rows='7'>";
                        if (isset($stoel)) {
                            echo $stoel->omschrijving;
                        }
                        echo "</textarea></td>";
                        echo "</tr>";

                        // youtubelink
                        echo "<tr>";
                        echo "<td class='firstTD'>Youtube link:</td>";
                        echo "<td><input type='text' id='stoelyoutubelink' placeholder='Youtube link' name='youtubelink' value='";
                        if (isset($stoel)) {
                            echo $stoel->youtubeLink;
                        }
                        echo "'/></td>";
                        echo "</tr>";

                        // pdf
                        echo "<tr>";
                        echo "<td class='firstTD'>PDF:</td>";
                        echo "<td><input type='text' id='stoelpdfpath' placeholder='PDF path' name='pdfpath' value='";
                        if (isset($stoel)) {
                            echo $stoel->pdfPath;
                        }
                        echo "'/><br/>";
                        $data = array('name' => 'filepdf', 'id' => 'filepdf', 'accept' => 'file/*', 'style' => 'padding: 15px 0;');
                        echo form_upload($data);
                        echo "</td>";
                        echo "</tr>";

                        // archief                       
                        echo "<tr>";
                        echo "<td class='firstTD'>Archiveer:</td>";
                        echo "<td><input type='checkbox' value='1' name='archief' id='stoelarchief' style='width: 30px; height: 30px;' ";
                        if (isset($stoel)) {
                        if ($stoel->archief == 1) {
                            echo 'checked';
                        }}
                        echo "/></td>";
                        echo "</tr>";

                        // spotlight                       
                        echo "<tr>";
                        echo "<td class='firstTD'>Spotlight:</td>";
                        echo "<td><input type='checkbox' value='1' name='spotlight' id='stoelspotlight' style='width: 30px; height: 30px;' ";
                        if (isset($stoel)) {
                        if ($stoel->spotlight == 1) {
                            echo 'checked';
                        }}
                        echo "/></td>";
                        echo "</tr>";

                        // foto
                        echo "<tr>";
                        echo "<td class='firstTD'>Foto:</td>";
                        echo "<td>";
                        if (isset($stoel)) {
                            if (($stoel->fotopad != null)) {
                                echo '<img src="' . base_url() . APPPATH . '' . $stoel->fotopad . '" alt="" width="300px" style="margin-top: 10px;" /><br />';
                            }
                        }
                        $data = array('name' => 'userfile[]', 'id' => 'userfile', 'accept' => 'image/*', 'style' => 'padding: 15px 0;');
                        echo form_upload($data);
                        echo "</td>";
                        echo "</tr>";

                        // hoofdcat
                        echo "<tr><td>Rubriek: </td><td colspan=''>";
                        $options[0] = '-- Geen rubriek --';
                        foreach ($alleSeries as $val) {
                            $options[$val->id] = $val->naam;
                        }
                        if (isset($stoel)) {
                            echo form_dropdown('hoofdrubriek', $options, $stoel->serieId, "id='hoofdrubriek'");
                        } else {
                            echo form_dropdown('hoofdrubriek', $options, 0, "id='hoofdrubriek'");
                        }
                        
                        echo "</td></tr>";
                        echo "</table>";
                        if (isset($stoel)) {
                            echo form_hidden('id', $stoel->id);
                        }
                        echo form_submit('submit', 'Opslaan!');
                        echo form_close();
                        ?>
                                <!--<div><a class='button icon fa-arrow-circle-right' id="btnupdatestoel" onclick="updatestoel(<?php //echo $stoel->id;                  ?>)" href="#">Opslaan</a></div>-->
                    </section>    

                    <section>
                        <header>
                            <?php if (isset($stoel)) { ?>                                
                                <h2>Hier kunt u de opties van deze stoel aanpassen.</h2>
                            <?php } else { ?>                                
                                <h2>Vul onderstaande gegevens in voor de opties van de nieuwe stoel in te stellen.</h2>
                            <?php } ?>
                        </header>   

                        <?php                        
                        foreach ($alleOpties as $optie) {
                            echo "<h3>" . $optie->naam . "</h3><br/>";
                            
                            echo "<div class='wrapperdiv'><div class='innerleft'>";
                            $options = null;
                            $options[0] = '-- Selecteer een optie --';
                            foreach ($optie->onderdelen as $val) {
                                $options[$val->id] = $val->naam . " - &euro;" . $val->prijs . " (" . $val->promoPrijs . ")";
                            }
                            echo form_dropdown($optie->naam, $options, 0, "id='dropoptie" . $optie->id . "'");
                            echo "<a class='button icon fa-arrow-circle-right' id='btnAddOptieToStoel' onclick='voegOptieOnderdeelAanStoelToe(" . $optie->id . ")' href='javascript:void(0);'>Toevoegen aan stoel</a>";
                            echo "</div><div class='innerright'>";
                            echo "<table class='tablepad10'><tr>";
                            echo "<td>Optienaam: </td><td><input type='text' id='nieuweOptieNaam" . $optie->id . "' placeholder='Optienaam'/></td></tr>";
                            echo "<td>Optieprijs: </td><td><input type='text' id='nieuweOptiePrijs" . $optie->id . "' placeholder='Optieprijs'/></td></tr>";
                            echo "<td>Optiepromoprijs: </td><td><input type='text' id='nieuweOptiePromoPrijs" . $optie->id . "' placeholder='Optiepromoprijs'/></td></tr>";
                            echo "</tr></table>";
                            echo "<a class='button icon fa-arrow-circle-right' id='btnAddNieuweOptieToStoel' onclick='voegNieuweOptieOnderdeelAanStoelToe(" . $optie->id . ")' href='javascript:void(0);'>Nieuwe optie toevoegen aan stoel</a>";
                            echo "</div></div>";
                            // laat opties zien die al toegewezen zijn                        
                            echo "<div id='gekozen" . $optie->id . "'>";
                            // toon toegewezenoptieonderdelen
                            ?>


                            <?php
                            $teller = 0;
                            if (count($alleToegewezenOptieOnderdelen) == 0) {
                                echo "Geen opties toegevoegd! <br/>";
                            }
                            foreach ($alleToegewezenOptieOnderdelen as $onderdeel) {
                                if ($onderdeel->optieOnderdeel->optieId == $optie->id) {
                                    $teller++;
                                    ?>
                                    <?php if ($teller == 1) { // enkel als er meer als 0 opties zijn de table tonen   ?>                                
                                        <table class="tableMenu">
                                            <tr>
                                                <th>Optienaam</th>
                                                <th>Prijs (promo)</th>
                                                <th></th>
                                            </tr>
                                        <?php } ?>
                                        <tr id="optieonderdeel<?php echo $onderdeel->id; ?>">
                                            <td><?php echo $onderdeel->optieOnderdeel->naam; ?></td>
                                            <td>
                                                <?php
                                                echo "&euro;" . $onderdeel->optieOnderdeel->prijs;
                                                if ($onderdeel->optieOnderdeel->promoPrijs != null) {
                                                    echo " (" . $onderdeel->optieOnderdeel->promoPrijs . ")";
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo '<a href="javascript:void(0);" onclick="verwijderoptie(' . $onderdeel->id . ')">verwijderen</a>'; ?></td>
                                        </tr>
                                    <?php } ?>                                   

                                    <?php
                                }

                                if ($teller > 0) { // enkel als er meer als 0 opties zijn de table tonen                               
                                    echo "</table><br/>";
                                }
                                //}
                                echo "</div>";
                                echo "<br/>";
                            }
                            ?>
                    </section>
                </div>

            </div>
        </div>
    </div>



</div>



