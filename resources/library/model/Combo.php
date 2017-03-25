<?php
class Combo {

    //public const CHARACTERS = array(
        //"Big Band",
        //"Beowulf",
        //"Filia",
        //"Valentine",
        //"Peacock",
        //"Squigly",
        //"Eliza",
        //"Ms. Fortune",
        //"Cerebella",
        //"Parasoul",
        //"Double",
        //"Fukua",
        //"Painwheel",
        //"Robo-Fortune",
    //);

    //Methode statique dégueulasse parce vieille-version de PHP a décidé qu'on ne mettait pas de tableau en constante
    public static function CHARACTERS(){
        return array(
            "Big Band",
            "Beowulf",
            "Filia",
            "Valentine",
            "Peacock",
            "Squigly",
            "Eliza",
            "Ms. Fortune",
            "Cerebella",
            "Parasoul",
            "Double",
            "Fukua",
            "Painwheel",
            "Robo-Fortune",
        );
    }

    public static function DIFFICULTIES(){
        return array(
            "Baby Combo",
            "Quite Easy",
            "Tricky",
            "Impossible",
            "TAS"
        );
    }
    //public const DIFFICULTIES = array(
        //"Baby Combo",
        //"Quite Easy",
        //"Tricky",
        //"Impossible",
        //"TAS"
    //);

    private $name;
    private $character;
    private $description;
    private $moves;
    private $damage;
    private $author;
    private $difficulty;
    private $normalizedCharacterName;

    public function __construct($name, $character, $description, $moves, $author, $difficulty, $damage){
        $this->name = $name;
        $this->character = $character;
        $this->description = $description;
        $this->moves = $moves;
        $this->damage = $damage;
        $this->difficulty = $difficulty;
        $this->author = $author;
        $this->normalizedCharacterName =  strtolower(str_replace(" ", "", $this->character));
    }

    //public function getCharacterId(){
        //return $this->character;
    //}

    public function getCharacterName(){
        //return self::CHARACTERS[$this->character];
        //return $this->character;
        return self::CHARACTERS()[$this->character];
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

    public function getDifficultyId(){
        return $this->difficulty;
    }

    public function getDifficultyString(){
        return self::DIFFICULTIES[$this->difficulty];
    }

    public function getName(){
        return $this->name;
    }

    public function getCharacterNormalizedName(){
        return strtolower(str_replace(" ", "", $this->character));
    }
}
?>
