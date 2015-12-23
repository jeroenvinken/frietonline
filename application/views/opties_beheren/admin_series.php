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
                            <h2>Rubrieken beheren</h2>
                            <h3>Hier kunt u de verschillende stoelen rubrieken bewerken.</h3>
                        </header>

                        <div>
                        <?php echo anchor('/admin/serie_toevoegen/' , 'Extra rubriek toevoegen', array('class' => 'button icon fa-arrow-circle-right')); ?>
                        </div>

                        <?php
                        echo "<table width='100%' class='tableMenu'>";

                        echo "<tr>";
                        echo "<th> Naam </th>";
                        echo "<th> Bewerken </th>";
                        echo "</tr>";

                        for ($i = 0; $i < count($series); $i++) {
                            $serie = $series[$i];

                            echo "<tr>";
                            echo "<td>" . $serie->naam . "</td>";
                        
                        ?>
                        <td class="menuPaddingTop"><?php echo anchor('/admin/serie_bewerken/' . $serie->id, 'Bewerken', 'class="detail"')?></td>
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
//include_once("dialogs_series.php");
?>