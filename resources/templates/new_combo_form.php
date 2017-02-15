<form action="<?php echo $this->router->getComboSubmissionURL(); ?>" method="POST">
    <label for="character">Character : </label>
    <select name="character" id="character" required>
<?php
foreach(Combo::CHARACTERS as $char){
    echo "<option value=\"" . $char . "\">". $char . "</option>\n";
}
?>
    </select>
    <label for="damages">Damages : </label>
    <input type="integer" id="damages" name="damages">
    <label for="moves">Moves</label>
    <textarea name="moves" id="moves"></textarea>
</form>
