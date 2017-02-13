<div>
    <p>Ici bientôt, une interface pour filtrer les combos</p>
</div>
<table>
<?php
foreach($combos as $id =>  $combo){
    echo "<tr>";
    echo "<td>".$id."</td>";
    echo "<td>".$combo->getCharacter()."</td>";
    echo "<td>".$combo->getDescription()."</td>";
    echo "</tr>\n";
}
?>
</table>
