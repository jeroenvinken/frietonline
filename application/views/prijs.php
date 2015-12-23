<script>
    $("#totaal").html($("#berekendtotaalprijs").text().substring(1));
</script>
<?php
$totaalprijs = 0;
//(($stoel->promoprijs != NULL) ? $totaalprijs = $stoel->promoprijs : $totaalprijs = $stoel->prijs);
?>

<table class="prijsSamenvatting">
    <colgroup>
        <col width="90%"/>
    </colgroup>
    <?php
    if ($stoel != null) {
        $totaalprijs += (($stoel->promoprijs != NULL && $stoel->promoprijs != 0) ? $stoel->promoprijs : $stoel->prijs);
        ?>
        <tr>
            <td><?php echo $stoel->naam; ?></td>
            <td><?php echo "&euro;" . (($stoel->promoprijs != NULL && $stoel->promoprijs != 0) ? $stoel->promoprijs : $stoel->prijs); ?></td> 
        </tr>
    <?php } ?>
    <?php      
    if ($gekozenOptieOnderdelen != null) {
        foreach ($gekozenOptieOnderdelen as $value)  {
        $totaalprijs += (($value->promoPrijs != NULL) ? $value->promoPrijs : $value->prijs);
        ?>
        <tr>
            <td><?php echo $value->naam; ?></td>
            <td><?php echo "&euro;" . (($value->promoPrijs != NULL) ? $value->promoPrijs : $value->prijs); ?></td> 
        </tr>
    <?php } }?>

    
</table>

<hr width="100%" />

<table>
    <colgroup>
        <col width="90%"/>
    </colgroup>
    <tr>
        <td>Totaalprijs (incl. BTW): </td>
        <td id="berekendtotaalprijs">&euro;<?php echo $totaalprijs ?></td>
    </tr>
</table>