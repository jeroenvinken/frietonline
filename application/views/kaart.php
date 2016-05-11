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
                <!--<div class="12u">
                    <img src="<?php //echo base_url() . APPPATH;    ?>images/banner.png" width="100%"/>
                </div>-->
                <div class="7u">
                    <h2>KAARTJE VO DE LARS</h2>                
                    <?php
                    foreach ($teksten as $val) {
                        echo $val->id . ": " . $val->tekst . "<br>";
                    }
                    ?>

                    <table>
                        <tr>
                            <th>Naam</th>
                            <th>Prijs</th>
                        </tr>                    

                        <?php
                        foreach ($producten as $product) {
                            echo "Naam";
                            echo $product->naam . ": " . $product->prijs . "<br>";
                            echo "Prijs";
                        }
                        ?>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

