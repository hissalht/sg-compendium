<?php
interface ComboStorage {
    public function getCombo($id);
    public function getAllCombos();
    public function addCombo(Combo $combo);
}
?>
