<td></td>
<td>
<div style="overflow: hidden;">
            <?php
            $teller = 0;
            foreach ($kleuren as $kleur) {
                $teller++;
                if ($teller < 5) {
                    echo "<div class='colorblock' style='background-color: $kleur->kleurcode;' title='$kleur->kleurnaam' onclick='colorClick(this); getPrijzen();' data-colorid='$kleur->id'></div>";
                } else {
                    $teller = 0;
                    //echo "</td></tr><tr><td>" . "<div class='colorblock' style='background-color: $kleur->kleurcode;'></div>";
                    echo "</div><div style='overflow: hidden;'>" . "<div class='colorblock' style='background-color: $kleur->kleurcode;' title='$kleur->kleurnaam' onclick='colorClick(this); getPrijzen();' data-colorid='$kleur->id'></div>";
                }
            }
            ?>   
</div></td>