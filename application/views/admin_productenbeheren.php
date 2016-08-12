<script src="<?php echo base_url() . APPPATH; ?>editor/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        $("input[type='number']").change(function () {
            var id = $(this).attr('id').replace("tekstgrootte", "");
            $("#" + id).css("font-size", $(this).val() + "%");
        });


    });
    function verwijdermenuitem(id) {
        $.ajax({type: "GET",
            url: site_url + "/admin/deletemenuitembyid",
            data: {id: id},
            success: function (result) {
                $("#menuitemrow" + id).fadeTo("slow", 0.1, function () {
                    // Animation complete.
                    $("#menuitemrow" + id).remove();
                });


            }
        });

    }

    function showProductInput(id) {
        $("#productInput" + id).show();
        $("#productInput" + id).css("display", "inline");
        $("#productInput" + id).css("text-align", "center");
        $("#product" + id).hide();
    }
    function editProductInput(id) {
        var value = $("#productInput" + id).val();
        $("#productInput" + id).hide();
        $("#product" + id).show();
        $("#product" + id).text(value);

        $.ajax({type: "GET",
            url: site_url + "/admin/editMenuItemNaam",
            data: {id: id, naam: value},
            success: function (result) {

            }
        });
    }
    function showProductPrijsInput(id) {
        $("#productPrijsInput" + id).show();
        $("#productPrijsInput" + id).css("display", "inline");
        $("#productPrijsInput" + id).css("text-align", "center");
        $("#productPrijs" + id).hide();
    }
    function editProductPrijsInput(id) {
        var value = $("#productPrijsInput" + id).val();
        $("#productPrijsInput" + id).hide();
        $("#productPrijs" + id).show();
        $("#productPrijs" + id).text('\u20AC ' + value);

        $.ajax({type: "GET",
            url: site_url + "/admin/editMenuItemPrijs",
            data: {id: id, prijs: value},
            success: function (result) {

            }
        });
    }

    function editproductvis(id) {
        var hasVis = 0;
        if ($("#menuitemvis" + id).hasClass('grayscale100')) {
            $("#menuitemvis" + id).removeClass('grayscale100');
            hasVis = 1;
        } else {
            $("#menuitemvis" + id).addClass('grayscale100');
            hasVis = 0;
        }

        $.ajax({type: "GET",
            url: site_url + "/admin/editMenuItemVis",
            data: {id: id, value: hasVis},
            success: function (result) {

            }
        });
    }

    function editproductvlees(id) {
        var hasVlees = 0;
        if ($("#menuitemvlees" + id).hasClass('grayscale100')) {
            $("#menuitemvlees" + id).removeClass('grayscale100');
            hasVlees = 1;
        } else {
            $("#menuitemvlees" + id).addClass('grayscale100');
            hasVlees = 0;
        }

        $.ajax({type: "GET",
            url: site_url + "/admin/editMenuItemVlees",
            data: {id: id, value: hasVlees},
            success: function (result) {

            }
        });
    }


    function editproductpikantheid(id) {
        // bij elke klik pikantheid opvragen
        var teller = $("#menuitempikantheid" + id).attr('pikantheid');
        teller++;

        if (teller > 5) {
            // cycle complete
            teller = 0;
        }

        $("#menuitempikantheid" + id).attr('src', '<?php echo base_url() . APPPATH; ?>images/pikant-' + teller + '.png');

        if (teller == 0) {
            // niet pikant
            $("#menuitempikantheid" + id).addClass('grayscale100');
            $("#menuitempikantheid" + id).attr('src', '<?php echo base_url() . APPPATH; ?>images/pikant-1.png');
        } else if ($("#menuitempikantheid" + id).hasClass('grayscale100')) {
            $("#menuitempikantheid" + id).removeClass('grayscale100');
        }

        $("#menuitempikantheid" + id).attr('pikantheid', teller);

        $.ajax({type: "GET",
            url: site_url + "/admin/editMenuItemPikantheid",
            data: {id: id, pikantheid: teller},
            success: function (result) {

            }
        });
    }

</script>

<!-- Content -->
<div id="content-wrapper">
    <?php
// message artikel toegevoegd
    if (isset($toegevoegd)) {
        echo "<div class='toegevoegd'><p>" . $toegevoegd . "</p></div>";
    }
    ?>
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="12u">
                    <h2>Onze kaart:</h2>
                    <hr/>


                    <table class="tableMenu">
                        <colgroup>
                            <col width="45%"/>
                            <col width="15%"/>
                            <col width="10%"/>
                            <col width="10%"/>
                            <col width="10%"/>
                            <col width="10%"/>
                        </colgroup>


                        <?php
                        $lastCatId = 0;
                        foreach ($producten as $product) {
                            if ($lastCatId != $product->categorieId) {
                                $lastCatId = $product->categorieId;
                                echo "<tr class='singleRow'><td colspan='6'>" . $product->categorie->naam . "</td></tr>";
                            }
                            echo "<tr id='menuitemrow$product->id'>";

                            echo "<td style='cursor:pointer;' title='$product->omschrijving' onclick='toonFoto(\"" . base_url() . APPPATH . "$product->fotoPad\")'>";
                            ?>

                            <label style="font-weight: 100;" id="product<?php echo $product->id; ?>" onclick="showProductInput(<?php echo $product->id; ?>)"><?php echo $product->naam; ?></label>
                            <input style="display: none;" type="text" id="productInput<?php echo $product->id; ?>" value="<?php echo $product->naam; ?>" onkeydown="javascript: if (event.keyCode == 13)
                                            editProductInput(<?php echo $product->id; ?>)"/></td>
                    
                            <?php
                            echo "</td>";

                            echo "<td>";
                            //echo "&euro; " . number_format(number_format($product->prijs, 2, ',', '.'), 2, ',', '.');
                            ?>

                            <label style="font-weight: 100;" id="productPrijs<?php echo $product->id; ?>" onclick="showProductPrijsInput(<?php echo $product->id; ?>)">&euro; <?php echo number_format($product->prijs, 2, ',', '.'); ?></label>
                            <input style="display: none;" type="text" id="productPrijsInput<?php echo $product->id; ?>" value="<?php echo number_format($product->prijs, 2, ',', '.'); ?>" onkeydown="javascript: if (event.keyCode == 13)
                                            editProductPrijsInput(<?php echo $product->id; ?>)"/></td>

                            <?php
                            echo "</td>";

                            echo "<td>";
                            //if ($product->vis == true) {
                            echo "<img src='" . base_url() . APPPATH . "images/fish.png' title='Dit product bevat vis.' class='clickable ";
                            if ($product->vis != true) {
                                echo "grayscale100";
                            }
                            echo "' id='menuitemvis$product->id' onclick='editproductvis($product->id);'/>";
                            //}
                            echo "</td>";

                            echo "<td>";
                            //if ($product->vlees == true) {
                            echo "<img src='" . base_url() . APPPATH . "images/meat.png' title='Dit product bevat vlees.' class='clickable ";
                            if ($product->vlees != true) {
                                echo "grayscale100";
                            }
                            echo "' id='menuitemvlees$product->id' onclick='editproductvlees($product->id);'/>";
                            //}
                            echo "</td>";

                            echo "<td>";
                            if ($product->pikantheid == 0) {
                                echo "<img src='" . base_url() . APPPATH . "images/pikant-1.png' id='menuitempikantheid$product->id' class='clickable grayscale100' pikantheid='0' title='Dit product heeft een pikantheidsniveau van $product->pikantheid.' onclick='editproductpikantheid($product->id);'/>";
                            }
                            if ($product->pikantheid > 0) {
                                echo "<img src='" . base_url() . APPPATH . "images/pikant-$product->pikantheid.png' id='menuitempikantheid$product->id' class='clickable' pikantheid='$product->pikantheid' title='Dit product heeft een pikantheidsniveau van $product->pikantheid.' onclick='editproductpikantheid($product->id);'/>";
                            }
                            echo "</td>";



                            echo "<td>";

                            echo "<img src='" . base_url() . APPPATH . "images/icons/delete.png' title='$product->naam verwijderen.' class='clickable' id='menuitem$product->id' onclick='verwijdermenuitem($product->id);'/>";
                            echo "</td>";


                            echo "</tr>";
                        }
                        ?>

                    </table>
                    </br>



                </div>
            </div>
        </div>
    </div>
</div>