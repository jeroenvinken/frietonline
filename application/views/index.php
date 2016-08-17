<script>

// shortcut voor gemak
    $(document).keypress("enter", function (e) {
        if (e.ctrlKey)
            window.location.href = site_url + "/admin";
    });
</script>

<!-- Banner -->
<section id="banner">
    <h2><?php echo global_bedrijfsnaam; ?></h2>

    <?php
    // kijken of het nu open is
    if (isset($openingsuren)) {        
        foreach ($openingsuren as $value) {
            if (date("w") == $value->dow) {
                if ($value->totMinuut == 0) {
                    $value->totMinuut = 59; // 16u00 -- 16u59
                    $value->totUur = $value->totUur - 1; // 16u59 -- 15u59
                }
                if (date("G") >= $value->vanUur && date("G") <= $value->totUur) {
                    // hier is het bv 9u30 (9u00-18u30)                               

                    if (date("i") >= $value->vanMinuut && date("i") <= $value->totMinuut) {
                        echo "<p style='color: #01ff01 !important; font-size: 170%; font-weight: 400; -webkit-text-stroke: 1px rgba(0,255,0,0.0);'>" . 'Nu open!' . "</p>";
                    } else {
                        //echo "<p style='color: red; font-weight: 500;'>" . 'Momenteel zijn wij gesloten...' . "</p>";
                    }
                } else {
                    echo "<p style='color: red !important; font-weight: 400; font-size: 170%; -webkit-text-stroke: 1px rgba(255,0,0,0.0);'>" . 'Momenteel zijn wij gesloten...' . "</p>";
                }
                break;
            }
        }
    }
    ?>

    

</section>

<!-- Main -->
<section id="main" class="container">

    <section class="box special">
        <header class="major">
            <div class="floatLeft">
                <h2>Frietjes zijn lekker vettig en zout
                <br />
                maar wij zijn toch al dik as fuck</h2>
                <hr/>
            <div class="fb-like" data-href="<?php echo global_facebookpage; ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
            <br/><?php echo anchor('index/kaart', '<input type="button" style="font-size: 120%; margin-top: 1em; width: 85%;" value="Bekijk onze kaart" />'); ?>
            </div>
            <div>
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
                    
            </div>
            
        </header>
        <iframe src="https://maps.google.it/maps?q=<?php echo global_locatie; ?>&output=embed&scrollwheel=false" width="100%" height="460"></iframe>
        <!--<span class="image featured"><img src="images/pic01.jpg" alt="" /></span>-->
    </section>