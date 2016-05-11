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
                        if ($tekst->naam == "Contact openingsuren") {
                            echo '<p style="font-size:' . $tekst->tekstgrootte . '%">' . $tekst->tekst . '</p>';
                        }
                    }
                    ?>
                      
                    <iframe src="https://maps.google.it/maps?q=<?php echo global_locatie; ?>&output=embed" width="100%" height="460"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

