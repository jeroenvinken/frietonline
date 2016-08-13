<script src="<?php echo base_url() . APPPATH; ?>editor/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        $("input[type='number']").change(function () {
            var id = $(this).attr('id').replace("tekstgrootte", "");
            $("#" + id).css("font-size", $(this).val() + "%");
        });
        
        // vlees klik handler
        $('#vleesimg').click(function () {            
            if ($(this).hasClass('grayscale100')) {
                $(this).removeClass('grayscale100');
                $("#vlees").attr('checked', true);
            } else {
                $(this).addClass('grayscale100');
                $("#vlees").attr('checked', false);
            }
        });

        // vis klik handler
        $('#visimg').click(function () {
            if ($(this).hasClass('grayscale100')) {
                $(this).removeClass('grayscale100');
                $("#vis").attr('checked', true);
            } else {
                $(this).addClass('grayscale100');
                $("#vis").attr('checked', false);
            }
        });
        // pikant klik handler
        var teller = 0;
        $('#pikantimg').click(function () {
            teller++;
            if (teller > 5) {
                // cycle complete
                teller = 0;
            }

            $(this).attr('src', '<?php echo base_url() . APPPATH; ?>images/pikant-' + teller + '.png');

            if (teller == 0) {
                // niet pikant
                $(this).addClass('grayscale100');
                $(this).attr('src', '<?php echo base_url() . APPPATH; ?>images/pikant-1.png');
            } else if ($(this).hasClass('grayscale100')) {
                $(this).removeClass('grayscale100');
            }

            $("#pikant").val(teller);

        });
    });
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

                    <!-- Box #1 -->
                    <section>
                        <header>
                            <h2>Producten aanmaken</h2>
                            <h3>Geef de naam, omschrijving, prijs en het type van het product op.</h3>                            
                        </header>

                        <br/>
                        <br/>

                        <?php echo form_open('admin/nieuwmenuitemtoevoegen'); ?>

                        <table border="0" class="admintable">           
                            <tr>                    
                                <td><?php echo form_label('Naam product*: ', 'naam'); ?></td>
                                <td>
                                    <?php
                                    $data = array('name' => 'naam', 'id' => 'naam', 'placeholder' => 'Naam', 'required' => 'required');
                                    echo form_input($data);
                                    ?>
                                </td> 
                            </tr>    
                            <tr>
                                <td><?php echo form_label('Omschrijving: ', 'omschrijving'); ?></td>
                                <td>
                                    <?php
                                    $data = array('name' => 'omschrijving', 'id' => 'omschrijving', 'required' => 'required', 'placeholder' => 'Omschrijving');
                                    echo form_input($data);
                                    ?>
                                </td>                                               
                            </tr>
                            <tr>
                                <td><?php echo form_label('Prijs*: ', 'prijs'); ?></td>
                                <td>
                                    <?php
                                    $data = array('name' => 'prijs', 'id' => 'prijs', 'required' => 'required', 'placeholder' => 'Prijs');
                                    echo form_input($data);
                                    ?>
                                </td>                                               
                            </tr>
                            <tr>                    
                                <td><?php echo form_label('Categorie*: ', 'categorie'); ?></td>
                                <td colspan="3">
                                    <datalist id="cat">
                                        <?php
                                        foreach ($categorien as $categorie) {
                                            echo '<option value="' . $categorie->naam . '">';
                                        }
                                        ?>
                                    </datalist>
                                    <?php
                                    $val = '';
                                    if (isset($product)) {
                                        if ($artikel->categorie->id != NULL) {
                                            // is hoofdartikel
                                            $val = $artikel->categorie->naam;
                                        }
                                    }
                                    $data = array('name' => 'categorie', 'id' => 'categorie', 'placeholder' => 'Categorie', 'required' => 'required', 'list' => 'cat', 'value' => $val);
                                    $js = 'autocomplete="on"';
                                    echo form_input($data, '', $js);
                                    ?>
                                </td> 

                            </tr>
                            <tr>
                                <td><?php echo form_label('Vlees: ', 'vlees'); ?></td>
                                <td>
                                    <img src="<?php echo base_url() . APPPATH; ?>images/meat.png" alt="vlees" class="grayscale100 clickable" id="vleesimg"/>
                                    <?php
                                    $data = array('name' => 'vlees', 'id' => 'vlees', 'value' => '1', 'style' => 'display: none;');
                                    echo form_checkbox($data);
                                    ?>
                                </td>                                               
                            </tr>
                            <tr>
                                <td><?php echo form_label('Vis: ', 'vis'); ?></td>
                                <td>
                                    <img src="<?php echo base_url() . APPPATH; ?>images/fish.png" alt="vis" class="grayscale100 clickable" id="visimg"/>
                                    <?php
                                    $data = array('name' => 'vis', 'id' => 'vis', 'value' => '1', 'style' => 'display: none;');
                                    echo form_checkbox($data);
                                    ?>
                                </td>                                               
                            </tr>
                            <tr>
                                <td><?php echo form_label('Pikant: ', 'pikant'); ?></td>
                                <td>
                                    <img src="<?php echo base_url() . APPPATH; ?>images/pikant-1.png" alt="pikant" class="grayscale100 clickable" id="pikantimg"/>
                                    <?php
                                    $data = array('name' => 'pikant', 'id' => 'pikant', 'value' => '0', 'style' => 'display: none;');
                                    echo form_input($data);
                                    ?>
                                </td>                                               
                            </tr>
                        </table>                

                        <?php
                        echo form_submit('submit', 'Bewaar product');
                        echo form_close();
                        ?>

                    </section>

                </div>

            </div>
        </div>
    </div>
</div>