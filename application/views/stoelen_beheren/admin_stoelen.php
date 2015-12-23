<?php
/* if ($gebruiker != null) {
  if ($gebruiker->level != 3 && $gebruiker->level != 2) {
  exit("Ga hier onmiddelijk weg!");
  }
  } else {
  exit("Ga hier onmiddelijk weg!");
  } */
?>

<script type="text/javascript">
    //zoek alles eerst
    $(document).ready(function () {
        zoekStoel();
    });


    function zoekStoel() {
        var input = $("#zoekstoel").val();        
        $.ajax({type: "GET",
            url: site_url + "/admin/zoekstoelenbyinput",
            data: {input: input},
            success: function (result) {
                $("#stoelenResultaat").html(result);
            }
        });
    }

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
                            <h2>Stoelen beheren</h2>
                            <h3>Hier kunt u de verschillende stoelen bewerken en toevoegen.</h3>
                        </header>

                        <div>
                            <?php echo anchor('/admin/stoel_toevoegen/', 'Extra stoel toevoegen', array('class' => 'button icon fa-arrow-circle-right')); ?>
                        </div>
                        <br/><br/>


                        <datalist id="cat">
                            <?php
                            foreach ($stoelen as $val) {
                                echo '<option value="' . $val->naam . '">';
                            }
                            ?>
                        </datalist>
                        <?php
                        $data = array('name' => 'categorie', 'id' => 'zoekstoel', 'placeholder' => 'Zoek een stoel op naam', 'list' => 'cat', 'class' => 'zoekinput', 'autocomplete' => 'off');
                        $js = 'onkeyup="zoekStoel();" onblur="zoekStoel();"';
                        echo form_input($data, '', $js);
                        ?>

                    
                        <!--<input type="text" placeholder="Zoek een stoel op naam" id="zoekstoel" class="zoekinput" onkeyup="zoekStoel()" />-->
                    
                        <div id='stoelenResultaat'></div>

                        <!-- oude layout -->
                        <?php
                        /*
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
                        echo "</table>";*/
                        ?>
                        <!-- einde oude layout -->

                    </section>

                </div>

            </div>
        </div>
    </div>
</div>



<?php
include_once("dialogs_stoelen.php");
?>