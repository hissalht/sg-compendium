<?php
class Combo {
    private $name;
    private $character;
    private $description;
    private $moves;
    private $damage;
    private $author;
    private $difficulty;

    public function __construct($name, $character, $description, $moves, $author, $difficulty="N/A", $damage="N/A"){
        $this->name = $name;
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

    public function getDamages(){
        return $this->damage;
    }

    public function getAuthor(){
        return $this->author;
    }

    public function getDifficulty(){
        return $this->difficulty;
    }

    public function getName(){
        return $this->name;
    }
}
?>
