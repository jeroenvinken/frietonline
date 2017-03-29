<script>

// shortcut voor gemak
    $(document).keypress("enter", function (e) {
        if (e.ctrlKey)
            window.location.href = site_url + "/admin";
    });
    $(document).ready(function () {

    });

    var currentstepnumber = 1;
    function goToNextStep() {
        $("#step-" + currentstepnumber).fadeOut("fast", function () {
            currentstepnumber = currentstepnumber + 1;
            $(this).removeClass("step-selected");
            $("#step-" + currentstepnumber).fadeIn("slow");
            $("#step-" + currentstepnumber).removeClass("step");
            updateNavigationText();
        });
    }

    function goToPreviousStep() {
        $("#step-" + currentstepnumber).fadeOut("fast", function () {
            currentstepnumber = currentstepnumber - 1;
            $(this).removeClass("step-selected");
            $("#step-" + currentstepnumber).fadeIn("slow");
            $("#step-" + currentstepnumber).removeClass("step");
            updateNavigationText();
        });
    }

    function updateNavigationText() {
        // function for updating relevant texts on the page        
        switch (currentstepnumber) {
            case 1:
                // Eerste stap = Broodje kiezen
                $("#nextbutton").html("Stap 2: Groentensds kiezen &raquo;");
                $("#previousbutton").html("&laquo; Terug");

                $("#breadcrumbs").html("Stap 1/4");
                break;
            case 2:
                // Tweede stap = Groenten kiezen kiezen
                $("#nextbutton").html("Stap 3: Vlees (snacks) kiezen &raquo;");
                $("#previousbutton").html("&laquo; Terug");

                $("#breadcrumbs").html("Stap 2/4");
                break;
            default:
                $("#nextbutton").html("Verder &raquo;");
                $("#previousbutton").html("&laquo; Terug");
        }
    }
</script>

<style>
    .btn {
        
    }
</style>


<!-- Features -->
<div id="features-wrapper">
    <div id="features">
        <div class="container">
            <div class="row">
                <div class="u12">
                    <h1 id="breadcrumbs">Stap 1/4</h1>
                    <div id="step-1" class="step step-selected">
                        <h2>Kies je broodje</h2>   
                        <?php
                        foreach ($menuitems->broodjes as $val) {
                            echo '<input type="button" onclick="addComponent(' . $val->id . ')" class="selectbutton" style="font-size: 120%; margin-top: 1em; width: 85%;" value="' . $val->naam . '" />';
                        }
                        ?>   
                    </div>

                    <div id="step-2" class="step ">
                        <h2>Kies je groenten</h2>                          
                        <?php
                        foreach ($menuitems->groenten as $val) {
                            echo '<input type="button" onclick="addComponent(' . $val->id . ')" class="selectbutton" style="font-size: 120%; margin-top: 1em; width: 85%;" value="' . $val->naam . '" />';
                        }
                        ?>
                    </div>

                    <div id="step-3" class="step">
                        <h2>Kies je vlees (snacks)</h2>
                        <?php
                        foreach ($menuitems->snacks as $val) {
                            echo '<input type="button" onclick="addComponent(' . $val->id . ')" class="selectbutton" style="font-size: 120%; margin-top: 1em; width: 85%;" value="' . $val->naam . '" />';
                        }
                        ?>
                    </div>

                    <div id="step-4" class="step">
                        <h2>Kies je beleg</h2>
                        <?php
                        foreach ($menuitems->beleg as $val) {
                            echo '<input type="button" onclick="addComponent(' . $val->id . ')" class="selectbutton" style="font-size: 120%; margin-top: 1em; width: 85%;" value="' . $val->naam . '" />';
                        }
                        ?>
                    </div>

                    <div id="step-5" class="step">
                        <h2>Kies je saus</h2>
                        <?php
                        foreach ($menuitems->beleg as $val) {
                            echo '<input type="button" onclick="addComponent(' . $val->id . ')" class="selectbutton" style="font-size: 120%; margin-top: 1em; width: 85%;" value="' . $val->naam . '" />';
                        }
                        ?>
                    </div>
                    <br>
                    <br>
                    <button id="previousbutton" class="button big" onclick="goToPreviousStep()" value="">&laquo; Terug</button>
                    <button id="nextbutton" class="button big" onclick="goToNextStep()" value="">Stap 2: Groenten kiezen &raquo;</button>
                </div>
            </div>
        </div>
    </div>
</div>

