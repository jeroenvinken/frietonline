<script src="<?php echo base_url(); ?>application/js/Chart.js"></script>
<script>
    $(document).ready(function () {
        $("#grafieken").show();
        $("#grafieken").css({height: "auto"});

        $.ajax({type: "GET",
            url: site_url + "/admin/grafiekbezoekersperuur",
            data: {},
            success: function (result) {
                $("#bezoekersperuur").html(result);
            }
        });
/*
        $.ajax({type: "GET",
            url: site_url + "/admin/grafiekbestellingenpermaand",
            data: {},
            success: function (result) {
                $("#bestellingenpermaand").html(result);
            }
        });

        $.ajax({type: "GET",
         url: site_url + "/admin/grafiekleeftijdenbestellers",
         data: {},
         success: function (result) {
         $("#leeftijdenbestellers").html(result);
         }
         });*/
    });
</script>
<!-- Content -->
<div id="content-wrapper">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="12u">

                    <!-- Box #1 -->
                    <section>
                        <header>
                            <h2>Admin grafieken</h2>
                            <h3>Hieronder kunt u enkele grafieken terugvinden</h3>
                        </header>

                        <div id="grafieken" style='height: 0px; overflow: hidden;'>                    
                            <div id="bezoekersperuur">

                            </div>   
                            <div id="bestellingenpermaand">

                            </div>                            
                        </div>

                    </section>

                </div>

            </div>
        </div>
    </div>
</div>