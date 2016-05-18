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
                    <img src="<?php //echo base_url() . APPPATH;    ?>images/banner.png" width="100%"/>
                </div>-->
                <div class="12u">
                    <h2>Onze kaart:</h2>
                    <hr/>
                    <?php
                    foreach ($teksten as $val) {
                        echo $val->tekst . "<br>";
                    }
                    ?>

                    <table>
                        <colgroup>
                            <col width="90%"/>
                            <col width="10%"/>
                        </colgroup>
                        <tr>
                            <th>Naam</th>
                            <th>Prijs</th>
                        </tr>                    

                        <?php
                        foreach ($producten as $product) {
                            echo "<tr>";
                            echo "<td style='cursor:pointer;' title='$product->omschrijving' onclick='toonFoto(\"" . base_url() . APPPATH . "$product->fotoPad\")'>";
                            echo $product->naam;
                            echo "</td>";
                            
                            echo "<td>";  
                            echo "&euro; " . number_format($product->prijs,2,',','.');
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>

                    </table>
                    <img src="" alt="" id="productFoto" width="300" style="display: none;" />
                    

                </div>
            </div>
        </div>
    </div>
</div>

