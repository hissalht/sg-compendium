<form action="<?php echo $this->router->getComboSubmissionURL(); ?>" method="POST" id="new-combo">
    <div class="field">
        <label for="name">Combo name</label>
        <input type="text" name="<?php echo ComboBuilder::NAME_REF; ?>" id="name">
    </div>

    <div class="field">
        <label for="character">Character</label>
        <select name="<?php echo ComboBuilder::CHARACTER_REF; ?>" id="character" required>
    <?php
    foreach(Combo::CHARACTERS() as $id => $char){
        echo "<option value=\"" . $id . "\">". $char . "</option>\n";
    }
    ?>
        </select>
    </div>

    <div class="field">
        <label for="description">Description</label>
        <textarea name="<?php echo Combobuilder::DESCRIPTION_REF; ?>" id="description"></textarea>
    </div>

    <div class="field">
        <label for="damages">Damages</label>
        <input type="integer" id="damages" name="<?php echo ComboBuilder::DAMAGE_REF; ?>">
    </div>

    <div class="field">
        <label for="difficulty">Difficulty</label>
        <select name="<?php echo ComboBuilder::DIFFICULTY_REF; ?>" id="difficulty" required>
    <?php
    foreach(Combo::DIFFICULTIES() as $id => $dif){
        echo "<option value=\"" . $id . "\">" . $dif . "</option>\n";
    }
    ?>
        </select>
    </div>

    <div class="field">
        <label for="moves">Moves</label>
        <textarea name="<?php echo ComboBuilder::MOVES_REF; ?>" id="moves"></textarea>
    </div>

    <div class="field">
        <input type="submit" value="Save">
    </div>
</form>
