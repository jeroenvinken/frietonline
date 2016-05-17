<script src="<?php echo base_url() . APPPATH; ?>editor/ckeditor.js"></script>
<script>
    $(document).ready(function () {
    $("input[type='number']").change(function () {        
        var id = $(this).attr('id').replace("tekstgrootte", "");        
        $("#" + id).css("font-size", $(this).val() + "%");
    }); });
</script>

<style>
    .bigger {
        font-size: 150%;
        font-style: bold;
    }
    
    </style>

<!-- Content -->
<div id="content-wrapper">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="12u">

                    <!-- Box #1 -->
                    <section>
                        <header>
                            <h2>Teksten beheren</h2>
                            <h3>Pas hier de teksten van de website aan.</h3>                            
                        </header>

                        <br/>
                        <br/>
                        <?php echo form_open('admin/tekstenaanpassen'); ?>
                        <?php foreach ($teksten as $tekst) { ?>
                            <p class="bigger"><?php echo $tekst->naam . " (" . $tekst->pagina . ")"; ?></p>
                            <?php
                            $data = array('name' => str_replace(' ', '', $tekst->naam . "tekstgrootte"), 'id' => str_replace(' ', '', $tekst->naam . "tekstgrootte"), 'type' => 'number', "style" => 'width:100px;margin:10px;', 'placeholder' => 'Tekstgrootte.', 'value' => $tekst->tekstgrootte);
                            echo "<b>Tekstgroote in %: </b>" . form_input($data);
                            ?>
                            <?php
                            $data = array('name' => str_replace(' ', '', $tekst->naam), 'id' => str_replace(' ', '', $tekst->naam), 'cols' => '50', 'rows' => '6', "style" => 'font-size:' . $tekst->tekstgrootte . '%;', 'placeholder' => 'Vul hier je tekst in.', 'value' => $tekst->tekst);
                            echo form_textarea($data);
                            echo "<br/>";
                            echo "<script>CKEDITOR.replace('" . str_replace(' ', '', $tekst->naam) . "');</script>";
                            echo "<br/>";
                            ?>
                        <?php } ?>
                        <br/>
                        <?php
                        echo form_submit('submit', 'Bewaar gegevens!');
                        echo form_close();
                        ?>

                    </section>

                </div>

            </div>
        </div>
    </div>
</div>