<div>
    <p>Ici bientôt, une interface pour filtrer les combos</p>
</div>
<table>
    <th>ID</th><th>Character</th><th>Combo name</th><th>Author</th><th>Damages</th>
<?php
foreach($combos as $id =>  $combo){
    echo "<tr class=\"".$combo->getCharacterNormalizedName()."\">";
    echo "<td>".$id."</td>";
    echo "<td>".$combo->getCharacter()."</td>";
    echo "<td><a href=\"".$this->router->getComboURL($id)."\">".$combo->getName()."</a></td>";
    echo "<td>".$combo->getAuthor()."</td>";
    echo "<td>".$combo->getDamages()."</td>";
    echo "</tr>\n";
}
?>
</table>
