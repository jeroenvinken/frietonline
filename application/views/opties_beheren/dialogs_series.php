<script type="text/javascript">

    var dialogmagtoe = false;
    var deleteid = 0;
    var ok = true;

    function inputOnlyNumbers(evt) {
        var e = window.event || evt; // for trans-browser compatibility  
        var charCode = e.which || e.keyCode;
        if ((charCode > 45 && charCode < 58) || charCode == 8) {
            if ($("#prijs").val().indexOf(".") !== -1)
            {
                if (charCode == 46) {
                    return false;
                }
                else {
                    return true;
                }
            } else {
                return true;
            }
        }
        return false;
    }

    $(function() {
        $("#dialog:ui-dialog").dialog("destroy");

        function validatieOK()
        {
            // alle validaties nagaan
            ok = true;

            if ($("#naam").val() == "") {
                $("#naam").addClass("ui-state-error");
                ok = false;
            } else {
                $("#naam").removeClass("ui-state-error");
            }
            if ($("#prijs").val() == "") {
                $("#prijs").addClass("ui-state-error");
                ok = false;
            } else {
                $("#prijs").removeClass("ui-state-error");
            }
            return ok;
        }

        // detail dialoog

        $("#dialog-detail").dialog({
            autoOpen: false,
            height: 550,
            width: 700,
            modal: true,
            open: function() {
                dialogmagtoe = false;
            },
            buttons: {
                "OK": function() {
                    if (validatieOK()) {
                        // gegevens wegschrijven via ajax (doorgeven naar server via json)
                        var dataString = $("#JqAjaxForm:eq(0)").serialize();
                        $.ajax({
                            type: "POST",
                            url: site_url + "/admin/update_serie",
                            async: false,
                            data: dataString,
                            dataType: "json"
                        });
                        dialogmagtoe = true;
                        location.reload();
                        $(this).dialog("close");
                    }
                },
                "Annuleren": function() {
                    $(this).dialog("close");


                },
                "Verwijderen": function() {
                    $("#dialog-delete").dialog("open");
                }
            },
            beforeClose: function() {
                if (!dialogmagtoe) {
                    $("#dialog-annuleer").dialog("open");
                    return false;
                }
            },
            close: function() {
            }
        });

        $(".detail").click(function(e) {
            e.preventDefault();
            var iddb = $(this).attr("iddb").valueOf();
            deleteid = $(this).attr("iddb").valueOf();
            $("#id").val(iddb);
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/admin/read_serie",
                    async: false,
                    data: {id: iddb},
                    success: function(result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#naam").val(jobject.naam);
                        $("#omschrijving").val(jobject.omschrijving);                        
                        $("#fotopad").val(jobject.fotopad);
                    },
                    error: function(a, b, c) {
                        //alert("test");
                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken
                $("#naam").val("");
                $("#omschrijving").val("");                
                $("#fotopad").val("");

            }
            // eventuele fouten van vorig dialoogvenster wegdoen
            //$("#prijs").removeClass("ui-state-error");
            //$("#prijs").removeClass("ui-state-error");
            //$("#aantalgangen").removeClass("ui-state-error");

            // dialoogvenster openen
            $("#dialog-detail").dialog("open");
        });

        // annuleren dialoog

        $("#dialog-annuleer").dialog({
            autoOpen: false,
            resizable: false,
            width: 450,
            height: 230,
            modal: true,
            buttons: {
                "Ja": function() {
                    dialogmagtoe = true;
                    $(this).dialog("close");
                    $("#dialog-detail").dialog("close");
                },
                "Neen": function() {
                    $(this).dialog("close");
                }
            }
        });

        $("#dialog-delete-fout").dialog({
            autoOpen: false,
            resizable: false,
            width: 400,
            height: 300,
            modal: true,
            buttons: {
                "OK": function() {
                    $(this).dialog("close");
                }
            }
        });

        // delete dialoog

        $("#dialog-delete").dialog({
            autoOpen: false,
            resizable: false,
            width: 450,
            height: 230,
            modal: true,
            buttons: {
                "Ja": function() {
                    // gegevens verwijderen via ajax
                    $.ajax({
                        type: "GET",
                        url: site_url + "/admin/delete_serie",
                        async: false,
                        data: {id: deleteid},
                        success: function(result) {
                            if (result == '0') {
                                // verwijderen is mislukt, foutmelding tonen
                                $("#dialog-delete-fout").dialog("open");
                                $("#dialog-delete").dialog("close");
                            } else {
                                location.reload();
                                $("#dialog-delete").dialog("close");
                            }
                        }
                    });
                },
                "Neen": function() {
                    $(this).dialog("close");
                }
            }
        });

        $(".delete").click(function(e) {
            e.preventDefault();
            deleteid = $(this).attr("iddb").valueOf();
            $("#dialog-delete").dialog("open");
        });

    });

</script>

<div id="dialog-detail" title="Serie beheren">
    <form id="JqAjaxForm">
        <input type="hidden" name="id" id="id" />
        <p><italic>Gebruik een punt voor kommagetallen.</italic></p>
        <table>
            <tr>
                <td><?php echo form_label('Naam*:', 'naam'); ?></td>
                <td><?php echo form_input(array('name' => 'naam', 'id' => 'naam', 'size' => '50', 'class' => 'text ui-widget-content')); ?></td>
            </tr>
            <tr>
                <td><?php echo form_label('Omschrijving*:', 'omschrijving'); ?></td>
                <td><?php echo form_textarea(array('name' => 'omschrijving', 'id' => 'omschrijving', 'rows' => '5', 'cols' => '49', 'class' => 'text ui-widget-content')); ?></td>
            </tr>            
            <tr>
                <td><?php echo form_label('Fotopad*:', 'fotopad'); ?></td>
                <td><?php echo form_input(array('name' => 'fotopad', 'id' => 'fotopad', 'size' => '20', 'class' => 'text ui-widget-content')); ?></td>
            </tr>

        </table>
    </form>
</div>

<div id="dialog-annuleer" title="Afsluiten">
    <p><span style="float:left; margin:0 20px 20px 0;"><img src="<?php echo base_url() . APPPATH; ?>images/icons/warning.png" /></span>
        <span>Eventuele aanpassingen gaan verloren. Ben je zeker?</span>
    </p>
</div>

<div id="dialog-delete" title="Bevestiging">
    <p><span style="float:left; margin:0 20px 20px 0;"><img src="<?php echo base_url() . APPPATH; ?>images/icons/delete.png" /></span>
        <span>De serie wordt verwijderd. Ben je zeker?</span>
    </p>
</div>

<div id="dialog-delete-fout" title="Fout">
    <p><span style="float:left; margin:0 20px 20px 0;"><img src="<?php echo base_url() . APPPATH; ?>images/icons/delete.png" /></span>
        <span>Je kan deze serie niet verwijderen.</span>
    </p>
</div>
