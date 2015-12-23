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
                <div class="7u">
                    <h2>Frietonline</h2>                
                    <?php
                    foreach ($teksten as $tekst) {
                        if ($tekst->naam == "Home tekst") {
                            echo '<p style="font-size:' . $tekst->tekstgrootte . '%">' . $tekst->tekst . '</p>';
                        }
                    }
                    ?>                
                </div>
            </div>
        </div>
    </div>
</div>

