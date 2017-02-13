<?php
class Controller{
    private $view;
    private $combo;

    public function __construct(View $view){
        $this->view = $view;
        $this->combo = array(
            "name" => "Big Band Baby Combo",
            "description" => "Babby Combo for new Big Band players (works midscreen, works in the corner, not hard, does no damage)",
            "character" => "Big Band",
            "moves" => array(
                "c.LK",
                "c.MK",
                "s.HP",
                "j.MP",
                "j.HP",
                "H Cymbal Clash",
                "H Take the A-Train",
            )
        );
    }

    public function showCombo(){
        $this->view->makeComboPage($this->combo);
    }
}
?>
