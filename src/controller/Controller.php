<?php
class Controller{
    private $view;
    private $comboStorage;

    public function __construct(View $view, ComboStorage $comboStorage){
        $this->view = $view;
        $this->comboStorage = $comboStorage;
    }

    public function showCombo($id){
        $combo = $this->comboStorage->getCombo($id);
        $this->view->makeComboPage($combo);
    }
}
?>
