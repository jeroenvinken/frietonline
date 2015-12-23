<!-- kleurpallet -->
<?php if ($stofkleurpalletten != null) { ?>
    
        <td><?php echo form_label('Kleurpallet: ', 'kleurpallet'); ?></td>
        <td>
            <?php
            $options[0] = '-- Selecteer een kleurpallet --';
            foreach ($stofkleurpalletten as $optie) {
                $options[$optie->id] = $optie->kleurpallet->naam;
            }
            echo form_dropdown('kleurpallet', $options, '0', 'id="kleurpallet" onchange="getKleurpalletkleuren()"');
            $options = null;
            ?>
        </td>
    
<?php } else { echo "<td></td><td>Helaas zijn er geen kleurpalletten gevonden voor deze bekleding.</td>"; }?> 