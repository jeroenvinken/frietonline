<script>

// shortcut voor gemak
    $(document).keypress("enter", function (e) {
        if (e.ctrlKey)
            window.location.href = site_url + "/admin";
    });

    function toonFoto(fotoPad) {
        $("#productFoto").attr('src', fotoPad);
        $("#productFoto").toggle();
    }
</script>


<!-- Features -->
<div id="features-wrapper">
    <div id="features">
        <div class="container">
            <div class="row">
                <!--<div class="12u">
                    <img src="<?php //echo base_url() . APPPATH;     ?>images/banner.png" width="100%"/>
                </div>-->
                <div class="12u">
                    <h2>Onze kaart:</h2>
                    <hr/>
                    <?php
                    foreach ($teksten as $val) {
                        echo $val->tekst . "<br>";
                    }
                    ?>

                    <table class="tableMenu">
                        <colgroup>
                            <col width="50%"/>
                            <col width="20%"/>
                            <col width="10%"/>
                            <col width="10%"/>
                            <col width="10%"/>
                        </colgroup>
                                   

                        <?php
                        $lastCatId = 0;
                        foreach ($producten as $product) {
                            if ($lastCatId != $product->categorieId) {
                                $lastCatId = $product->categorieId;
                                echo "<tr class='singleRow'><td colspan='5'>" . $product->categorie->naam . "</td></tr>";
                            } 
                                echo "<tr>";

                                echo "<td style='cursor:pointer;' title='$product->omschrijving' onclick='toonFoto(\"" . base_url() . APPPATH . "$product->fotoPad\")'>";
                                echo $product->naam;
                                echo "</td>";

                                echo "<td>";
                                echo "&euro; " . number_format($product->prijs, 2, ',', '.');
                                echo "</td>";

                                echo "<td>";
                                if ($product->vis == true) {
                                    echo "<img src='" . base_url() . APPPATH . "images/fish.png' title='Dit product bevat vis.'/>";
                                }
                                echo "</td>";

                                echo "<td>";
                                if ($product->vlees == true) {
                                    echo "<img src='" . base_url() . APPPATH . "images/meat.png' title='Dit product bevat vlees.'/>";
                                }
                                echo "</td>";

                                echo "<td>";
                                if ($product->pikantheid > 0) {
                                    echo "<img src='" . base_url() . APPPATH . "images/pikant-$product->pikantheid.png' title='Dit product heeft een pikantheidsniveau van $product->pikantheid.'/>";
                                }
                                echo "</td>";

                                echo "</tr>";
                            
                        }
                        ?>

                    </table>
                    </br>
                     


                </div>
            </div>
        </div>
    </div>
</div>

