<?php
class Combo {
    private $character;
    private $description;
    private $moves;
    private $damage;

    public function __construct($character, $description, $moves, $damage = null){
        $this->character = $character;
        $this->description = $description;
        $this->moves = $moves;
        $this->damage = $damage;
    }

    public function getCharacter(){
        return $this->character;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getMoves(){
        return $this->moves;
    }

    public function getDamage(){
        return $this->damage;
    }
}
?>
