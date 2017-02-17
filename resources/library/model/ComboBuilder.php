<?php
class ComboBuilder {
    private $data;
    private $error;

    const NAME_REF = "name";
    const CHARACTER_REF = "character";
    const DESCRIPTION_REF = "description";
    const MOVES_REF = "moves";
    const DAMAGE_REF = "damages";
    const AUTHOR_REF = "author";
    const DIFFICULTY_REF = "difficulty";

    const ERROR_EMPTY_FIELD = "Empty field";
    const ERROR_WRONG_FORMAT = "Wrong format";

    public function __construct($data){
        $this->data = $data;
        $this->error = null;
    }

    public function createCombo(){
        $name = $this->data[self::NAME_REF];
        $character = (int) $this->data[self::CHARACTER_REF];
        $description = $this->data[self::DESCRIPTION_REF];
        $moves = $this->data[self::MOVES_REF];
        $damages = (int) $this->data[self::DAMAGE_REF];
        $author = (int) $this->data[self::AUTHOR_REF];
        $difficulty = $this->data[self::DIFFICULTY_REF];
        return new Combo($name, $character, $description, $moves, $author, $difficulty, $damage);
    }

    public function isValid(){
        return ($this->checkForEmptyFields() && $this->checkFieldsFormat());
    }


    private function checkFieldsFormat(){
        //character
        $char = $this->data[self::CHARACTER_REF];
        if(!(ctype_digit($char) || 0 <= $char || $char < count(Combo::CHARACTERS))){
            $this->error = self::ERROR_WRONG_FORMAT;
            return FALSE;
        }

        $author = $this->data[self::AUTHOR_REF];
        $dmg = $this->data[self::DAMAGE_REF];
        if(!ctype_digit($author) || !ctype_digit($dmg)){
            $this->error = self::ERROR_WRONG_FORMAT;
            return FALSE;
        }

        return TRUE;
    }


    private function checkForEmptyFields(){
        return ($this->checkEmptyField(self::NAME_REF) &&
                $this->checkEmptyField(self::CHARACTER_REF) &&
                $this->checkEmptyField(self::DESCRIPTION_REF) &&
                $this->checkEmptyField(self::MOVES_REF) &&
                $this->checkEmptyField(self::DAMAGE_REF) &&
                $this->checkEmptyField(self::AUTHOR_REF) &&
                $this->checkEmptyField(self::DIFFICULTY_REF));
    }


    private function checkEmptyField($field){
        if(!key_exists($field, $this->data) || empty($this->data[$field])){
            $this->error = self::ERROR_EMPTY_FIELD;
            return FALSE;
        }
        return TRUE;
    }

    public function getError(){
        return $this->error;
    }

}
?>
