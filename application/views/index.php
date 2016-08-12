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
                        echo "<p style='color: green !important; font-weight: 500; -webkit-text-stroke: 1px rgba(0,255,0,0.7);'>" . 'Nu open!' . "</p>";
                    } else {
                        //echo "<p style='color: red; font-weight: 500;'>" . 'Momenteel zijn wij gesloten...' . "</p>";
                    }
                } else {
                    echo "<p style='color: red !important; font-weight: 500; -webkit-text-stroke: 1px rgba(255,0,0,0.7);'>" . 'Momenteel zijn wij gesloten...' . "</p>";
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
            <p>Bij <?php echo global_bedrijfsnaam; ?> kan je altijd genieten van lekkerste frietjes.<br />
                Natte broek garantie!</p>
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
        <iframe src="https://maps.google.it/maps?q=<?php echo global_locatie; ?>&output=embed" width="100%" height="460"></iframe>
        <!--<span class="image featured"><img src="images/pic01.jpg" alt="" /></span>-->
    </section>

    <section class="box special features">
        <div class="features-row">
            <section>
                <span class="icon major fa-bolt accent2"></span>
                <h3>Magna etiam</h3>
                <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
            </section>
            <section>
                <span class="icon major fa-area-chart accent3"></span>
                <h3>Ipsum dolor</h3>
                <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
            </section>
        </div>
        <div class="features-row">
            <section>
                <span class="icon major fa-cloud accent4"></span>
                <h3>Sed feugiat</h3>
                <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
            </section>
            <section>
                <span class="icon major fa-lock accent5"></span>
                <h3>Enim phasellus</h3>
                <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
            </section>
        </div>
    </section>

    <div class="row">
        <div class="6u 12u(narrower)">

            <section class="box special">
                <span class="image featured"><img src="images/pic02.jpg" alt="" /></span>
                <h3>Sed lorem adipiscing</h3>
                <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
                <ul class="actions">
                    <li><a href="#" class="button alt">Learn More</a></li>
                </ul>
            </section>

        </div>
        <div class="6u 12u(narrower)">

            <section class="box special">
                <span class="image featured"><img src="images/pic03.jpg" alt="" /></span>
                <h3>Accumsan integer</h3>
                <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
                <ul class="actions">
                    <li><a href="#" class="button alt">Learn More</a></li>
                </ul>
            </section>

        </div>
    </div>

</section>

<!-- CTA -->
<section id="cta">

    <h2>Sign up for beta access</h2>
    <p>Blandit varius ut praesent nascetur eu penatibus nisi risus faucibus nunc.</p>

    <form>
        <div class="row uniform 50%">
            <div class="8u 12u(mobilep)">
                <input type="email" name="email" id="email" placeholder="Email Address" />
            </div>
            <div class="4u 12u(mobilep)">
                <input type="submit" value="Sign Up" class="fit" />
            </div>
        </div>
    </form>

</section>