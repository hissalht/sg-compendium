<p class="feedback">
<?php
if(key_exists("creation_feedback", $_SESSION)){
    echo $_SESSION["creation_feedback"] . "\n";
    unset($_SESSION["creation_feedback"]);
}
?>
</p>
<form action="<?php
if(is_null($editedId)){
    echo $this->router->getComboSubmissionURL();
}else{
    echo $this->router->getComboReplacementURL($editedId);
}
?>" method="POST" id="new-combo">
    <div class="field">
        <label for="name">Combo name</label>
        <input type="text" name="<?php echo ComboBuilder::NAME_REF; ?>"
                id="name" value="<?php echo $comboData[ComboBuilder::NAME_REF]; ?>">
    </div>

    <div class="field">
        <label for="character">Character</label>
        <select name="<?php echo ComboBuilder::CHARACTER_REF; ?>" id="character"
            required>
    <?php
    foreach(Combo::CHARACTERS() as $id => $char){
        //echo "<option value=\"" . $id . "\">". $char. "</option>\n";
        echo "<option value=\"" . $id . "\"";
        if($id == $comboData[ComboBuilder::CHARACTER_REF])
            echo " selected=\"selected\"";
        echo ">" . $char . "</option>\n";
    }
    ?>
        </select>
    </div>

    <div class="field">
        <label for="description">Description</label>
        <textarea name="<?php echo Combobuilder::DESCRIPTION_REF; ?>"
            id="description"><?php echo $comboData[ComboBuilder::DESCRIPTION_REF]; ?></textarea>
    </div>

    <div class="field">
        <label for="damages">Damages</label>
        <input type="integer" id="damages" name="<?php echo ComboBuilder::DAMAGE_REF; ?>"
        value="<?php echo $comboData[ComboBuilder::DAMAGE_REF]; ?>">
    </div>

    <div class="field">
        <label for="difficulty">Difficulty</label>
        <select name="<?php echo ComboBuilder::DIFFICULTY_REF; ?>" id="difficulty"
        required value="<?php echo $comboData[ComboBuilder::DIFFICULTY_REF]; ?>">
    <?php
    foreach(Combo::DIFFICULTIES() as $id => $dif){
        //echo "<option value=\"" . $id . "\">" . $dif . "</option>\n";
        echo "<option value=\"" . $id . "\"";
        if($id == $comboData[ComboBuilder::DIFFICULTY_REF])
            echo " selected=\"selected\"";
        echo ">" . $dif . "</option>\n";
    }
    ?>
        </select>
    </div>

    <div class="field">
        <label for="moves">Moves</label>
        <textarea name="<?php echo ComboBuilder::MOVES_REF; ?>"
        id="moves"><?php echo $comboData[ComboBuilder::MOVES_REF]; ?></textarea>
    </div>

    <div class="field">
        <input type="submit" value="Save">
    </div>
</form>
