<?php
/*if ($gebruiker != null) {
    if ($gebruiker->level != 3 && $gebruiker->level != 2) {
        exit("Ga hier onmiddelijk weg!");
    }
} else {
    exit("Ga hier onmiddelijk weg!");
} */
?>

<script type="text/javascript">

    $(function() {

        $("#toevoegen").button();
    })

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
                            <h2>Series beheren</h2>
                            <h3>Hier kunt u de verschillende stoelen bewerken.</h3>
                        </header>

                        <div><input value="Extra stoel toevoegen" id="toevoegen" class="detail" iddb="0" type="button"></div>

                        <?php
                        echo "<table width='100%' class='tableMenu'>";

                        echo "<tr>";
                        echo "<th> Naam </th>";
                        echo "<th> Bewerken </th>";
                        echo "</tr>";

                        for ($i = 0; $i < count($stoelen); $i++) {
                            $stoel = $stoelen[$i];

                            echo "<tr>";
                            echo "<td>" . $stoel->naam . "</td>";
                        
                        ?>
                        <td class="menuPaddingTop"><a class='detail' href="#" iddb="<?php echo $stoel->id; ?>">Bewerken</a></td>
                        <?php
                        echo "</tr>";
                        }
                        echo "</table>";
                        ?>

                    </section>

                </div>

            </div>
        </div>
    </div>
</div>



<?php
include_once("dialogs_stoelen.php");
?>