<p id="character">Character : <?php echo $character; ?></p>
<p id="description">Description : <?php echo $description; ?></p>
<p id="damages">Damages : <?php echo $combo->getDamages(); ?></p>
<ul id="combo">
<?php
foreach($moveList as $section){
    echo "<li>";
    foreach($section as $move){
        echo View::convertMove($move) . ", ";
    }
    echo "</li>";
    //echo "<li>".View::convertMove($move)."</li>\n";
}
?>
</ul>
