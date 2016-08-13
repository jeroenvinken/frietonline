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
                    <img src="<?php //echo base_url() . APPPATH; ?>images/banner.png" width="100%"/>
                </div>-->
                <div class="12u">
                   <?php
                    foreach ($teksten as $tekst) {
                        if ($tekst->naam == "Contact") {
                            echo '<p style="font-size:' . $tekst->tekstgrootte . '%">' . $tekst->tekst . '</p>';
                        }
                    }
                    ?>
                    
                    <table class='openingsurenHome'>
                    <th colspan="2">Openingsuren</th>
                    <?php 
                        foreach ($openingsuren as $openingsuur) {
                            if (date("w") == $openingsuur->dow) {
                                echo "<tr style='font-weight: 700;'><td>";
                            } else {
                                echo "<tr><td>";
                            }
                            
                            echo $openingsuur->dag;
                            echo "</td><td>";
                            if ($openingsuur->vanUur == 0 && $openingsuur->vanMinuut == 0 && $openingsuur->totUur == 0 && $openingsuur->totMinuut == 0) {
                                echo "gesloten";
                            } else {
                                echo $openingsuur->vanUur . ":" . sprintf("%02d", $openingsuur->vanMinuut) . " - " . $openingsuur->totUur . ":" . sprintf("%02d", $openingsuur->totMinuut);
                            }                            
                            echo "</td></tr>";
                        }
                    ?>
                </table>
                      
                    <iframe src="https://maps.google.it/maps?q=<?php echo global_locatie; ?>&output=embed" width="100%" height="460"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

