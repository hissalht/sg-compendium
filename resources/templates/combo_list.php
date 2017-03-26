<div>
    <p>Ici bientôt, une interface pour filtrer les combos</p>
</div>
<table>
    <tr>
        <th>ID</th>
        <th>Character</th>
        <th>Combo name</th>
        <th>Author</th>
        <th>Damages</th>
        <th>Actions</th>
    </tr>
<?php
foreach($combos as $id => $combo){
    echo "<tr class=\"".$combo->getCharacterNormalizedName()."\">";
    echo "<td>".$id."</td>";
    echo "<td>".$combo->getCharacterName()."</td>";
    echo "<td><a href=\"".$this->router->getComboURL($id)."\">".$combo->getName()."</a></td>";
    echo "<td>".$combo->getAuthor()."</td>";
    echo "<td>".$combo->getDamages()."</td>";
    echo "<td><a href=\"".$this->router->getComboEditingURL($id)."\">Edit</a></td>";
    echo "</tr>\n";
}
?>
</table>
