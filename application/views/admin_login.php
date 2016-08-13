<div id="features-wrapper">
    <div id="features">
        <div class="container">
            <div class="row">
                <article class="post">
                    <header>                        
                        <div class="title">
                            <h2>Inloggen</h2>
                            <br/>
                            <?php 
                            if ($foutmelding != "") {
                                echo "<p style='color: red;'>" . $foutmelding . "</p>";
                            } else {
                                echo "<p>Gelieve in te loggen om verder te gaan.</p>";
                            }                            
                            ?>
                            
                            <br/>
                        </div>

                    </header> 
                    <div class="row">                           
                        <?php echo form_open_multipart('admin/login'); ?>

                        <table border="0">           
                            <tr>                    
                                <td><?php echo form_label('Naam*: ', 'naam'); ?></td>
                                <td>
                                    <?php
                                    $data = array('name' => 'naam', 'id' => 'naam', 'placeholder' => 'Naam', 'required' => 'required');
                                    echo form_input($data);
                                    ?>
                                </td>                                                 
                                <td><?php echo form_label('Wachtwoord*: ', 'wachtwoord'); ?></td>
                                <td>
                                    <?php
                                    $data = array('name' => 'wachtwoord', 'id' => 'wachtwoord', 'required' => 'required', 'placeholder' => 'wachtwoord');
                                    echo form_password($data);
                                    ?>
                                </td>                                               
                            </tr>
                        </table>                


                        <?php
                        echo form_submit('submit', 'Log in!');
                        echo form_close();
                        ?>              

                    </div>        
                </article>
            </div>
        </div>
    </div>
</div>