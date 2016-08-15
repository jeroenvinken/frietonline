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
        //$("#productInput" + id).focus();
        var element = $("#productInput" + id);

        // Multiply by 2 to ensure the cursor always ends up at the end;
        // Opera sometimes sees a carriage return as 2 characters.
        var strLength = element.val().length * 2;

        element.focus();
        element[0].setSelectionRange(strLength, strLength);


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
                $("#confirmMessage").show();
                var opacityValue = $("#confirmMessage").css("opacity");
                if (opacityValue == 1) {
                    $("#confirmMessage").animate({
                        opacity: 0,
                    }, 3800, function () {
                        // animation complete                    
                        $("#confirmMessage").hide();
                        $("#confirmMessage").css("opacity", "1");
                    });
                }
            }
        });
    }
    function showProductPrijsInput(id) {
        $("#productPrijsInput" + id).show();
        $("#productPrijsInput" + id).css("display", "inline");
        $("#productPrijsInput" + id).css("text-align", "center");
        $("#productPrijs" + id).hide();
        //cursor aan einde van textbox
        var element = $("#productPrijsInput" + id);

        // Multiply by 2 to ensure the cursor always ends up at the end;
        // Opera sometimes sees a carriage return as 2 characters.
        var strLength = element.val().length * 2;

        element.focus();
        element[0].setSelectionRange(strLength, strLength);
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
                $("#confirmMessage").show();
                var opacityValue = $("#confirmMessage").css("opacity");
                if (opacityValue === 1) {
                    $("#confirmMessage").animate({
                        opacity: 0,
                    }, 2500, function () {
                        // animation complete                    
                        $("#confirmMessage").hide();
                        $("#confirmMessage").css("opacity", "1");
                    });
                }
            }
        });
    }

    function editproductvis(id) {
        var hasVis = 0;
        if ($("#menuitemvis" + id).hasClass('grayscale100')) {
            $("#menuitemvis" + id).removeClass('grayscale100');
            hasVis = 1;
            $("#menuitemvis" + id).attr('title', "Dit product bevat vis.");
        } else {
            $("#menuitemvis" + id).addClass('grayscale100');
            $("#menuitemvis" + id).attr('title', "Dit product bevat geen vis.");
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
            $("#menuitemvlees" + id).attr('title', "Dit product bevat vlees.");
            hasVlees = 1;
        } else {
            $("#menuitemvlees" + id).addClass('grayscale100');
            $("#menuitemvlees" + id).attr('title', "Dit product bevat geen vlees.");
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
        $("#menuitempikantheid" + id).attr('title', "Dit product heeft een pikantheidsniveau van " + teller +".");
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
                    <div class="hiddenConfirmBox" id="confirmMessage">
                        <p>Opgeslagen!</p>
                    </div>

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
                            echo "<img src='" . base_url() . APPPATH . "images/fish.png' class='clickable ";
                            if ($product->vis != true) {
                                echo "grayscale100' title='Dit product bevat geen vis.'";
                            } else {
                                echo "' title='Dit product bevat vis.'";
                            }
                            echo " id='menuitemvis$product->id' onclick='editproductvis($product->id);'/>";
                            //}
                            echo "</td>";

                            echo "<td>";
                            //if ($product->vlees == true) {
                            echo "<img src='" . base_url() . APPPATH . "images/meat.png' class='clickable ";
                            if ($product->vlees != true) {
                                echo "grayscale100' title='Dit product bevat geen vlees.'";
                            } else {
                                echo "' title='Dit product bevat vlees.'";
                            }
                            echo " id='menuitemvlees$product->id' onclick='editproductvlees($product->id);'/>";
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