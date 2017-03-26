<?php
require_once("model/User.php");
class UserBuilder {
    private $data;
    private $error;

    const LOGIN_REF = "newlogin";
    const NAME_REF = "newname";
    //const STATUS_REF = "status";
    const MAIL_REF = "newmail";
    const PASSWORD_REF = "newpassword";
    //présent uniquement pour la mise en page du formulaire
    // pas de ref d'ID, l'ID n'est attribué que lors de l'inserttion dans la db
    // idem pour le statut

    public function __construct($data){
        if(!isset($data[self::LOGIN_REF])) $data[self::LOGIN_REF] = "";
        if(!isset($data[self::NAME_REF])) $data[self::NAME_REF] = "";
        //if(!isset($data[STATUS_REF])) $data[STATUS_REF] = "";
        if(!isset($data[self::MAIL_REF])) $data[self::MAIL_REF] = "";

        $this->data = $data;
        $this->error = null;
    }

    public function createUser(){
        $login = $this->data[self::LOGIN_REF];
        $name = $this->data[self::NAME_REF];
        //$status = $this->data[STATUS_REF];
        $mail = $this->data[self::MAIL_REF];
        return new UserAccount(null, $login, $name, null, UserAccount::STATUS_NORMAL, $mail);
    }

    public function isValid(){
        $login = $this->data[self::LOGIN_REF];
        $name = $this->data[self::NAME_REF];
        //$status = $this->data[self::STATUS_REF];
        $mail = $this->data[self::MAIL_REF];

        if(empty($login) || !ctype_alnum($login)){
            $this->error = $login . " n'est pas un login valide. Le login ne peut pas être vide et ne doit contenir que des lettres et des chiffres";
            return FALSE;
        }

        if(empty($name)){
            $this->error = "Le nom ne peut être vide";
            return FALSE;
        }

        if(empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)){
            $this->error = "L'adresse mail doit être de la forme whatever@mail.xy";
            return FALSE;
        }
        return TRUE;
    }

    public function getData(){
        return $this->data;
    }

    public function getError(){
        return $this->error;
    }

}
?>
