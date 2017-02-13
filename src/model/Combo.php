<?php
class Combo {
    private $character;
    private $description;
    private $moves;
    private $damage;
    private $author;
    private $difficulty;

    public function __construct($character, $description, $moves, $author, $difficulty="N/A", $damage="N/A"){
        $this->character = $character;
        $this->description = $description;
        $this->moves = $moves;
        $this->damage = $damage;
        $this->difficulty = $difficulty;
        $this->author = $author;
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

    public function getAuthor(){
        return $this->author;
    }

    public function getDifficulty(){
        return $this->difficulty;
    }
}
?>
