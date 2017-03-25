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
        if(!key_exists(self::NAME_REF, $data))
            $data[self::NAME_REF] = "";
        if(!key_exists(self::CHARACTER_REF, $data))
            $data[self::CHARACTER_REF] = "";
        if(!key_exists(self::DESCRIPTION_REF, $data))
            $data[self::DESCRIPTION_REF] = "";
        if(!key_exists(self::MOVES_REF, $data))
            $data[self::MOVES_REF] = "";
        if(!key_exists(self::DAMAGE_REF, $data))
            $data[self::DAMAGE_REF] = "";
        if(!key_exists(self::AUTHOR_REF, $data))
            $data[self::AUTHOR_REF] = "";
        if(!key_exists(self::DIFFICULTY_REF, $data))
            $data[self::DIFFICULTY_REF] = "";

        $this->data = $data;
        $this->error = null;
    }

    public function createCombo(){
        $name = $this->data[self::NAME_REF];
        $character = (int) $this->data[self::CHARACTER_REF];
        $description = $this->data[self::DESCRIPTION_REF];

        //$moves = $this->data[self::MOVES_REF];
        $moves = explode("\n", $this->data[self::MOVES_REF]);

        $damages = (int) $this->data[self::DAMAGE_REF];
        $author = (int) $this->data[self::AUTHOR_REF];
        $difficulty = $this->data[self::DIFFICULTY_REF];

        return new Combo($name, $character, $description, $moves, $author, $difficulty, $damages);
    }

    public function isValid(){
        return ($this->checkForEmptyFields() && $this->checkFieldsFormat());
    }


    private function checkFieldsFormat(){
        //character
        //$char = $this->data[self::CHARACTER_REF];
        //if(!(ctype_digit($char) || 0 <= $char || $char < count(Combo::CHARACTERS))){
            //$this->error = self::ERROR_WRONG_FORMAT;
            //return FALSE;
        //}

        //$author = $this->data[self::AUTHOR_REF];
        //$dmg = $this->data[self::DAMAGE_REF];
        //if(!ctype_digit($author) || !ctype_digit($dmg)){
            //$this->error = self::ERROR_WRONG_FORMAT;
            //return FALSE;
        //}

        //return TRUE;

        $char = $this->data[self::CHARACTER_REF];
        if(!(ctype_digit($char) && 0 <= $char && $char < count(Combo::CHARACTERS()))){
            $this->error = "character must be a number between 0 and 13, value=" . $char;
            return FALSE;
        }

        //pas besoin de tester, ne vient pas du client
        //$author = $this->data[self::AUTHOR_REF];
        //if(!(ctype_digit($author))){
            //$this->error = "author must be an user id, value=" . $author;
            //return FALSE;
        //}

        $dmg = $this->data[self::DAMAGE_REF];
        if(!(ctype_digit($dmg) && 0 <= $dmg)){
            $this->error = "damages must be a positive integer, value=" . $dmg;
            return FALSE;
        }

        $moves = $this->data[self::MOVES_REF];
        if(ctype_space($moves)){
            $this->error = "The moves text cannot contain only whitespaces";
            return FALSE;
        }

        $description = $this->data[self::DESCRIPTION_REF];
        if(ctype_space($description)){
            $this->error = "The description text cannot contain only whitespaces";
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
        //if(!key_exists($field, $this->data) || empty($this->data[$field])){
            //$this->error = self::ERROR_EMPTY_FIELD . " : " . $field;
            //return FALSE;
        //}
        //return TRUE;
        if(strlen($this->data[$field]) <= 0){
            $this->error = self::ERROR_EMPTY_FIELD . " : " . $field;
            return FALSE;
        }
        return TRUE;
    }

    public function getError(){
        return $this->error;
    }


    public function getData(){
        return $this->data;
    }
}
?>
