<?php
$teller = 0;
foreach ($opties as $value) {    
    $teller++;
    if ($teller == 1) { // enkel als er meer als 0 opties zijn de table tonen    
        ?>
        <table class="tableMenu">
            <tr>
                <th>Optienaam</th>
                <th>Prijs (promo)</th>
                <th></th>
            </tr>
        <?php } ?>
        <tr id="optieonderdeel<?php echo $value->id; ?>">
            <td><?php echo $value->optieOnderdeel->naam; ?></td>
            <td>
                <?php
                echo "&euro;" . $value->optieOnderdeel->prijs;
                if ($value->optieOnderdeel->promoPrijs != null) {
                    echo " (" . $value->optieOnderdeel->promoPrijs . ")";
                }
                ?>
            </td>
            <td><?php echo '<a href="javascript:void(0);" onclick="verwijderoptie(' . $value->id . ')">verwijderen</a>'; ?></td>
        </tr>
    <?php
    }
    if ($teller > 0) { // enkel als er meer als 0 opties zijn de table tonen                               
        echo "</table><br/>";
    }
    ?>
