<?php
interface ComboStorage {
    public function getCombo($id);
    public function getAllCombos();
    public function addCombo(Combo $combo);
    public function replaceCombo(Combo $newCombo, $replacedId);
}
?>
