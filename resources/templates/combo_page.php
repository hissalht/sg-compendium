<p id="character">Character : <?php echo $character; ?></p>
<p id="description">Description : <?php echo $description; ?></p>
<ul id="combo">
<?php
foreach($moveList as $move){
    echo "<li>".View::convertMove($move)."</li>\n";
}
?>
</ul>
