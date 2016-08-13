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
                    <img src="<?php //echo base_url() . APPPATH;  ?>images/banner.png" width="100%"/>
                </div>-->
                <div class="12u">
                    <?php
                    foreach ($teksten as $tekst) {
                        if ($tekst->naam == "Contact") {
                            echo '<p style="font-size:' . $tekst->tekstgrootte . '%">' . $tekst->tekst . '</p>';
                        }
                    }
                    ?>
                    <div style="display: flex;">
                        <div style="flex: 1;">
                            <table class='openingsurenHome' style="margin-left:0px !important; margin-right:0px !important; width: 90%;">
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
                        </div>
                        <div style="width: 50%">
                            <h2>Contact</h2>
                            <i class="fa fa-phone" aria-hidden="true"></i>&nbsp;<?php echo "0473 13 73 32" ?><br/><br/>
                            <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;<?php echo global_locatie; ?><br/><br/>
                            <i class="fa fa-envelope" aria-hidden="true"></i><span>&nbsp;<?php echo "info@jeroenvinken.be"; ?></span><br/><br/>
                            <i class="fa fa-facebook-official" aria-hidden="true"></i>&nbsp;<a href="<?php echo global_facebookpage; ?>">Facebook pagina</a><br/><br/>
                        </div>
                    </div>

                    <iframe src="https://maps.google.it/maps?q=<?php echo global_locatie; ?>&output=embed" width="100%" height="460"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

